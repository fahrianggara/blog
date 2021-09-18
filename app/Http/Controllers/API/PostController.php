<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function showPosts(Request $request, Post $post)
    {
        // Get status itu ambil dari "name" di posts.index
        $statusSelected = in_array($request->get('status'), ['publish', 'draft']) ? $request->get('status') : "publish";

        $posts = $statusSelected == "publish" ? Post::publish() : Post::draft();

        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }

        return response()->json([
            'posts' => $posts->paginate(5)->withQueryString(),
            'statuses'  => $this->statuses(),
            'statusSelected' => $statusSelected
        ], 200);
    }

    private function statuses()
    {
        return [
            'publish'   => trans('posts.form_control.select.status.option.publish'),
            'draft'     => trans('posts.form_control.select.status.option.draft'),
            // 'finished'  => trans('posts.form_control.select.status.option.finished'),
        ];
    }
}
