<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminPackage;

class PackageController extends Controller
{
    /**
     * POST /admin/packages
     * Create a new admin package (with optional image upload).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:120',
            'emoji'       => 'nullable|string|max:10',
            'description' => 'nullable|string|max:500',
            'base_price'  => 'nullable|numeric|min:0',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $filename  = 'pkg_admin_' . time() . '_' . preg_replace('/\s+/', '_', strtolower($validated['name'])) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/Packages'), $filename);
            $imagePath = 'images/Packages/' . $filename;
        }

        $package = AdminPackage::create([
            'name'        => $validated['name'],
            'emoji'       => $validated['emoji'] ?? '📦',
            'description' => $validated['description'] ?? '',
            'image_path'  => $imagePath,
            'base_price'  => $validated['base_price'] ?? null,
        ]);

        return response()->json([
            'success' => true,
            'package' => [
                'id'          => $package->id,
                'name'        => $package->name,
                'emoji'       => $package->emoji,
                'description' => $package->description,
                'image_url'   => $imagePath ? asset($imagePath) : null,
                'base_price'  => $package->base_price,
            ],
        ]);
    }

    /**
     * DELETE /admin/packages/{id}
     * Remove an admin-created package.
     */
    public function destroy($id)
    {
        $package = AdminPackage::findOrFail($id);

        // Delete the image file if it exists
        if ($package->image_path && file_exists(public_path($package->image_path))) {
            unlink(public_path($package->image_path));
        }

        $package->delete();

        return response()->json(['success' => true]);
    }
}
