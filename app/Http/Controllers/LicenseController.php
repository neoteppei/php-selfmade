<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Models\LicenseImage;

class LicenseController extends Controller
{
    public function create()
    {
        return view('licenses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_name' => 'required|string|max:255',
            'license_images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $license = new License();
        $license->license_name = $request->input('license_name');
        $license->save();

        if ($request->hasFile('license_images')) {
            foreach ($request->file('license_images') as $image) {
                $path = $image->store('licenses', 'public');
                LicenseImage::create([
                    'license_id' => $license->id,
                    'image_path' => $path,
                ]);
            }
        }

        return view('licenses.create', ['license' => $license])->with('success', 'License added successfully!');
    }

    public function destroyImage($id)
    {
        $image = LicenseImage::findOrFail($id);
        $path = $image->image_path;
        $image->delete();
        if (file_exists(public_path('storage/' . $path))) {
            unlink(public_path('storage/' . $path));
        }
        return redirect()->back()->with('success', 'Image deleted successfully!');
    }
}