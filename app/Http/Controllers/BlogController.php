<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;

class BlogController extends Controller
{
    private $perPage = 2;

    public function home()
    {
        return view('blog.home', [
            'posts' => Post::publish()->latest()->paginate(3),
        ]);
    }

    public function showPostDetail($slug)
    {
        $post = Post::publish()->with('categories', 'tags')->where('slug', $slug)->first();
        if (!$post) {
            return redirect()->route('blog.home');
        }

        $next = Post::publish()->with('categories', 'tags')->where('slug', '>', $slug)->orderBy('slug')->first();
        $prev = Post::publish()->with('categories', 'tags')->where('slug', '<', $slug)->orderBy('slug', 'desc')->first();

        return view('blog.posts-detail', [
            'post' => $post,
            'tags' => Tag::all(),
            'categories' => Category::onlyParent()->get(),
            'next' => $next,
            'prev' => $prev,
        ]);
    }

    public function showCategories()
    {
        return view('blog.categories', [
            'categories' => Category::onlyParent()->paginate(3),
        ]);
    }

    public function showTags()
    {
        return view('blog.tags', [
            'tags' => Tag::paginate(35),
        ]);
    }

    public function searchPosts(Request $request)
    {
        // jika tidak nge-search maka tampilin halaman home
        if (!$request->get('keyword')) {
            return redirect()->route('blog.home');
        }

        // jika iya maka tampilin halaman search
        return view('blog.search-post', [
            'posts' => Post::publish()->search($request->keyword)
                ->paginate(3)->appends(['keyword' => $request->keyword]),
        ]);
    }

    public function showPostsByCategory($slug)
    {
        // detail post berdasarkan category yang statusnya publish
        $posts = Post::publish()->whereHas('categories', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->paginate(5);

        // pencarian berdasarkan slug bukan id
        $category = Category::where('slug', $slug)->first();
        // category root ini untuk menampilkan anak dari parent category
        $categoryRoot = $category->root();
        return view('blog.posts-category', [
            'posts' => $posts,
            'category' => $category,
            'categoryRoot' => $categoryRoot
        ]);
    }

    public function showPostsByTag($slug)
    {
        // detail post berdasarkan category yang statusnya publish
        $posts = Post::publish()->whereHas('tags', function ($query) use ($slug) {
            return $query->where('slug', $slug);
        })->paginate(35);

        // pencarian berdasarkan slug bukan id
        $tag = Tag::where('slug', $slug)->first();
        // category root ini untuk menampilkan anak dari parent category
        $tags = Tag::search($tag->title)->get();
        return view('blog.posts-tag', [
            'posts' => $posts,
            'tag' => $tag,
            'tags' => $tags
        ]);
    }
}
