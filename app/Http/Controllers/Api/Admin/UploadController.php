<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

        $path = $request->file('image')->store('uploads', 'public');

        return response()->json([
            'success' => true,
            'url' => asset('storage/'.$path),
        ]);
    }
}
