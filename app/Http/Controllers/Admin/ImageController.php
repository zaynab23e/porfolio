<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Http\Requests\admin\store;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'title' => 'required|string|max:255',
            'path' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        Image::create($validateData);

        return redirect()->route('images.index')->with('success', 'تم حفظ الصورة بنجاح');
    }

    public function index()
    {
        $images = Image::select('id', 'title', 'path')->get();
        return view('dashboard', compact('images'));
    }

    public function indexApi()
    {
        $images = Image::select('id', 'title', 'path')->get();
        return response()->json(['message' => $images], 200);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete(ltrim($image->path, '/'));
        $image->delete();

        return redirect()->route('images.index')->with('success', 'تم حذف الصورة بنجاح');
    }
    
    public function destroyApi($id)
    {
        $image = Image::findOrFail($id);
        Storage::disk('public')->delete(ltrim($image->path, '/'));
        $image->delete();

        return response()->json(['message' => 'تم حذف الصورة بنجاح'], 200);
    }
}