<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

class LogController extends Controller
{
    public function index()
    {
        $logs = Log::all();
        return view('logs.index', compact('logs'));
    }

    public function show($id)
    {
        $log = Log::findOrFail($id);
        return view('logs.show', compact('log'));
    }

    public function create()
    {
        return view('logs.create'); // 新規作成用のビュー
    }
    public function store(Request $request)
    {
        $request->validate([
            'dive_date' => 'required|date',
            'experience_number' => 'required|integer',
            'dive_location' => 'required|string',
            'dive_point' => 'nullable|string',
            'dive_type' => 'required|string',
            'weather' => 'required|string',
            'temperature' => 'nullable|integer',
            'wind_direction' => 'nullable|string',
            'wave_height' => 'nullable|string',
            'swell' => 'nullable|string',
            'current' => 'nullable|string',
            'low_tide_time' => 'nullable|date_format:H:i',
            'high_tide_time' => 'nullable|date_format:H:i',
            'cylinder_capacity' => 'nullable|string',
            'cylinder_type' => 'nullable|array',
            'nitrox_percentage' => 'nullable|integer',
            'fabric_thickness' => 'nullable|integer',
            'equipment_type' => 'nullable|array',
            'other_equipment' => 'nullable|string',
            'weight_kg' => 'nullable|numeric',
            'photography_equipment' => 'nullable|string',
            'accessory' => 'nullable|array',
            'other_accessories' => 'nullable|string',
            'entry_time' => 'nullable|date_format:H:i',
            'exit_time' => 'nullable|date_format:H:i',
            'dive_duration' => 'nullable|integer',
            'max_depth' => 'nullable|numeric',
            'avg_depth' => 'nullable|numeric',
            'water_temp' => 'nullable|integer',
            'visibility' => 'nullable|integer',
            'start_pressure' => 'nullable|integer',
            'end_pressure' => 'nullable|integer',
            'memo' => 'nullable|string',
            'photo_path' => 'nullable|image',
            'buddy_signature' => 'nullable|string',
            'instructor_signature' => 'nullable|string',
        ]);
    
        // JSON エンコードが必要なフィールドを処理
        $logData = $request->except(['photo_path', 'buddy_signature', 'instructor_signature']);
        $logData['cylinder_type'] = json_encode($request->input('cylinder_type'));
        $logData['equipment_type'] = json_encode($request->input('equipment_type'));
        $logData['accessory'] = json_encode($request->input('accessory'));
    
        $log = new Log($logData);
    
        if ($request->hasFile('photo_path')) {
            $path = $request->file('photo_path')->store('photos', 'public');
            $log->photo_path = $path;
        }
    
        if ($request->has('buddy_signature')) {
            $buddySignature = $this->saveSignature($request->input('buddy_signature'), 'buddy_signature');
            $log->buddy_signature = $buddySignature;
        }
    
        if ($request->has('instructor_signature')) {
            $instructorSignature = $this->saveSignature($request->input('instructor_signature'), 'instructor_signature');
            $log->instructor_signature = $instructorSignature;
        }
    
        $log->save();
    
        return redirect()->route('logs.index');
    }

    public function edit($id)
    {
        $log = Log::findOrFail($id);
        return view('logs.edit', compact('log'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dive_date' => 'required|date',
            'experience_number' => 'required|integer',
            'dive_location' => 'required|string',
            'dive_point' => 'nullable|string',
            'dive_type' => 'required|string',
            'weather' => 'required|string',
            'temperature' => 'nullable|integer',
            'wind_direction' => 'nullable|string',
            'wave_height' => 'nullable|string',
            'swell' => 'nullable|string',
            'current' => 'nullable|string',
            'low_tide_time' => 'nullable|date_format:H:i',
            'high_tide_time' => 'nullable|date_format:H:i',
            'cylinder_capacity' => 'nullable|string',
            'cylinder_type' => 'nullable|array',
            'nitrox_percentage' => 'nullable|integer',
            'fabric_thickness' => 'nullable|integer',
            'equipment_type' => 'nullable|array',
            'other_equipment' => 'nullable|string',
            'weight_kg' => 'nullable|numeric',
            'photography_equipment' => 'nullable|string',
            'accessory' => 'nullable|array',
            'other_accessories' => 'nullable|string',
            'entry_time' => 'nullable|date_format:H:i',
            'exit_time' => 'nullable|date_format:H:i',
            'dive_duration' => 'nullable|integer',
            'max_depth' => 'nullable|numeric',
            'avg_depth' => 'nullable|numeric',
            'water_temp' => 'nullable|integer',
            'visibility' => 'nullable|integer',
            'start_pressure' => 'nullable|integer',
            'end_pressure' => 'nullable|integer',
            'memo' => 'nullable|string',
            'photo_path' => 'nullable|image',
            'buddy_signature' => 'nullable|string',
            'instructor_signature' => 'nullable|string',
        ]);
        
    
            // セッションにフォームデータを保存
    $request->session()->flash('dive_date', $request->input('dive_date'));
    $request->session()->flash('experience_number', $request->input('experience_number'));
    $request->session()->flash('dive_location', $request->input('dive_location'));
    // 他のフィールドも必要に応じてセッションに保存

    // 更新処理は行わず、リダイレクトしてフォームに入力されたデータを表示
    return redirect()->back()->with('status', 'データが更新されました');
}
    public function destroy($id)
    {
        $log = Log::findOrFail($id);

        // 画像ファイルの削除
        if ($log->photo_path) {
            \Storage::disk('public')->delete($log->photo_path);
        }

        // バディ署名の削除
        if ($log->buddy_signature) {
            \Storage::disk('public')->delete($log->buddy_signature);
        }

        // インストラクター署名の削除
        if ($log->instructor_signature) {
            \Storage::disk('public')->delete($log->instructor_signature);
        }

        $log->delete();
        return redirect()->route('logs.index');
    }

    private function saveSignature($signatureData, $prefix)
    {
        // データをカンマで分割
        $data = explode(',', $signatureData);
        
        // 分割結果に適切な要素が含まれているか確認
        if (isset($data[1])) {
            // 画像データをデコード
            $imageData = base64_decode($data[1]);
    
            // 保存パスを設定
            $filePath = 'signatures/' . $prefix . '_' . time() . '.png';
    
            // 画像データをファイルに保存
            file_put_contents(public_path('storage/' . $filePath), $imageData);
    
            return $filePath;
        } else {
            // キーが存在しない場合の処理（例: ログにエラーメッセージを記録するなど）
            \Log::error('Signature data is invalid or missing.');
            return null;
        }
    }
}