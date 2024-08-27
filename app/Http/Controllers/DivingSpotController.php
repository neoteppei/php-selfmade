<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DivingSpot;
use Illuminate\Support\Facades\Http;

class DivingSpotController extends Controller
{
    public function create()
    {
        return view('diving_spots.create');
    }

    public function search(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
        ]);

        $location = $request->input('location');

        // Step 1: 都市名から緯度経度を取得
        $geocodeResponse = Http::get('http://api.openweathermap.org/data/2.5/weather', [
            'q' => $location,
            'appid' => env('OPENWEATHERMAP_API_KEY'),
        ])->json();

        // レスポンスが成功したかどうかを確認
        if (!isset($geocodeResponse['coord'])) {
            return back()->withErrors(['message' => 'Location data could not be retrieved.']);
        }

        $latitude = $geocodeResponse['coord']['lat'];
        $longitude = $geocodeResponse['coord']['lon'];

        // Step 2: 緯度経度を使って天気データを取得
        $weatherResponse = Http::get('http://api.openweathermap.org/data/2.5/weather', [
            'lat' => $latitude,
            'lon' => $longitude,
            'appid' => env('OPENWEATHERMAP_API_KEY'),
            'units' => 'metric',
        ])->json();

        

        // ダイビングスポットの保存
        $divingSpot = new DivingSpot();
        $divingSpot->location = $location;
        $divingSpot->latitude = $latitude;
        $divingSpot->longitude = $longitude;
        $divingSpot->temperature = $weatherResponse['main']['temp'] ?? null;
        $divingSpot->humidity = $weatherResponse['main']['humidity'] ?? null;
        $divingSpot->pressure = $weatherResponse['main']['pressure'] ?? null;
        $divingSpot->weather_description = $weatherResponse['weather'][0]['description'] ?? null;
        $divingSpot->wind_speed = $weatherResponse['wind']['speed'] ?? null;
        $divingSpot->wind_direction = $weatherResponse['wind']['deg'] ?? null;
        $divingSpot->sea_level_pressure = $weatherResponse['main']['sea_level'] ?? null;
        $divingSpot->ground_level_pressure = $weatherResponse['main']['grnd_level'] ?? null;
        $divingSpot->temp_min = $weatherResponse['main']['temp_min'] ?? null;
        $divingSpot->temp_max = $weatherResponse['main']['temp_max'] ?? null;
        $divingSpot->save();

        return view('diving_spots.create', [
            'divingSpot' => $divingSpot,
            'location' => $location,
        ]);
    }
}