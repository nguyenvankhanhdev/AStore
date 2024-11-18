<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\VariantColors;
use Illuminate\Http\Request;

class VariantColorsController extends Controller
{

    public function getVariantColorId(Request $request)
    {
        \Log::info('Request Data:', $request->all()); // Log toàn bộ request
        $validated = $request->validate([
            'variant_id' => 'required|exists:product_variants,id',
            'color_id' => 'required|exists:color_products,id',
        ]);

        $variantColor = VariantColors::where('variant_id', $validated['variant_id'])
            ->where('color_id', $validated['color_id'])
            ->first();

        if (!$variantColor) {
            return response()->json([
                'status' => 'error',
                'message' => 'Không tìm thấy sản phẩm tương ứng!'
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'variant_color_id' => $variantColor->id
        ]);
    }
}
