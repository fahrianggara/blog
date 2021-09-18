<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function showCategories(Request $request)
    {
        $categories = Category::with('generation');

        // PENGECEKAN SEARCH
        if ($request->has('keyword') && trim($request->keyword)) {
            /* Jika pencarian berdasarkan keyword maka 
            tampilkan pencariannya berdasarkan keywordnya*/
            $categories->search($request->keyword);
        } else {
            // Dan jika tidak ada pencarian, maka semua list ketegori tampilkan
            $categories->onlyParent();
        }

        return response()->json([
            'message' => 'success',
            'categories' => $categories->paginate(5)
                ->appends(['keyword' => $request->get('keyword')])
        ], 200);
    }
}
