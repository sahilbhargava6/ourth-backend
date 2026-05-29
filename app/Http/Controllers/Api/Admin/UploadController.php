<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    /**
     * POST /api/v1/admin/upload-image
     * Admin — upload an image file and return its public URL.
     */
    public function image(Request $request): JsonResponse
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $path = $request->file('image')->store('uploads', config('filesystems.cloud', 'public'));

        $url = config('filesystems.cloud') === 's3'
            ? Storage::disk('s3')->url($path)
            : asset('storage/'.$path);

        return response()->json([
            'success' => true,
            'url' => $url,
        ]);
    }
}
