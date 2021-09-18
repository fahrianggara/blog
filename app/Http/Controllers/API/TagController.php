<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    public function showTags(Request $request)
    {
        $tags = $request->get('keyword')
            ? Tag::search($request->keyword)->paginate(10)
            : Tag::paginate(10);

        return response()->json([
            'message' => 'success',
            'tags' => $tags->appends(['keyword' => $request->keyword])
        ], 200);
    }
}
