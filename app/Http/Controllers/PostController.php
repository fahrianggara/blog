<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:post_show', ['only' => 'index']);
        $this->middleware('permission:post_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:post_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:post_detail', ['only' => 'show']);
        $this->middleware('permission:post_delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $post)
    {
        // Get status itu ambil dari "name" di posts.index
        $statusSelected = in_array($request->get('status'), ['publish', 'draft']) ? $request->get('status') : "publish";

        $posts = $statusSelected == "publish" ? Post::publish() : Post::draft();

        if ($request->get('keyword')) {
            $posts->search($request->get('keyword'));
        }

        return view('posts.index', [
            'posts' => $posts->paginate(5)->withQueryString(),
            'statuses'  => $this->statuses(),
            'statusSelected' => $statusSelected
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create', [
            'categories' => Category::with('generation')->onlyParent()->get(),
            'statuses'   => $this->statuses(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title'         => 'required|string|max:100',
                'slug'          => 'required|string|unique:posts,slug',
                'thumbnail'     => 'required',
                'description'   => 'required|max:500',
                'content'       => 'required',
                'category'      => 'required',
                'tag'           => 'required',
                'status'        => 'required',
            ],
            [],
            $this->attributes(),
        );

        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // MEMULAI DB
        DB::beginTransaction();
        try {
            /*CREATE DATA POST*/
            $post = Post::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);
            /*KITA KONEKAN JUGA TABEL TAG DAN POST, 
            Jadi tags() dan categories() ini diambil di model Post.php*/
            $post->tags()->attach($request->tag);
            $post->categories()->attach($request->category);

            /*JIKA BERHASIL MAKA TAMPILKAN ALERT*/
            Alert::toast(trans('posts.alert.create.message.success', ['name' => $request->title]), 'success');

            // KALO BERHASIL INSERT DATA POST MAKA RETURN KE HALAMAN DASHBOARD > POSTS
            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            // KALO GAGAL DI ROLLBACK (TARIK ULANG)
            DB::rollBack();
            // JIKA ADA ERROR MAKA ALERT ERROR
            Alert::error(
                trans('posts.alert.create.title.error'),
                trans('posts.alert.create.message.error', ['error' => $th->getMessage()])
            );

            // KALO ADA GAGAL DATA YANG DIINSERT MAKA BALIK LAGI
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            // MAU GAGAL APA BENAR DICOMMIT
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        // pengulagan categori dan tag di detail post
        $categories = $post->categories;
        $tags = $post->tags;
        return view('posts.show', compact('post', 'categories', 'tags'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', [
            'post'          => $post,
            'categories'    => Category::with('generation')->onlyParent()->get(),
            'statuses'      => $this->statuses(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        /**
         * Sebelum melakukan update atau validasi kita cek(dd) dulu,
         * apakah datanya pas klik update, masuk atau tidak.
         * 
         * dd($request->all());
         * 
         */

        $validator = Validator::make(
            $request->all(),
            [
                'title'         => 'required|string|max:100',
                /**
                 * Untuk melakukan updating pada validasi unique,
                 * jangan lupa tambahkan $post->id,
                 * dan jangan lupa kita kasih koma (,) sebelum masukkan post->id nya.
                 *        kasih koma disebelah kanan slug
                 * contoh: unique:posts,slug,
                 */
                'slug'          => 'required|string|unique:posts,slug,' . $post->id,
                'thumbnail'     => 'required',
                'description'   => 'required|max:500',
                'content'       => 'required',
                'category'      => 'required',
                'tag'           => 'required',
                'status'        => 'required',
            ],
            [],
            $this->attributes(),
        );

        if ($validator->fails()) {
            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        // JIKA JUDUL TIDAK DIGANTI, MAKA TIDAK DIUPDATE
        // if ($request->content == $post->content) {
        //     Alert::toast(trans('posts.alert.update.message.warning'), 'warning');

        //     return redirect()->route('posts.index');
        // }

        DB::beginTransaction();
        try {

            $post->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'content' => $request->content,
                'status' => $request->status,
                'user_id' => Auth::user()->id,
            ]);

            /**
             * Untuk melakukan updating dibagian relasi ini ada perubahan,
             * yaitu dari $post->tags()->attach($request->tag) jadi $post->tags()->sync($request->tag);
             * attach ini buat di create dan sync ini buat di updating
             * 
             */

            $post->tags()->sync($request->tag);
            $post->categories()->sync($request->category);

            Alert::toast(trans('posts.alert.update.message.success', ['name' => $request->title]), 'success');

            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error(
                trans('posts.alert.update.title.error'),
                trans('posts.alert.update.message.error', ['error' => $th->getMessage()])
            );

            if ($request['tag']) {
                $request['tag'] = Tag::select('id', 'title')->whereIn('id', $request->tag)->get();
            }
            return redirect()->back()->withInput($request->all());
        } finally {
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post, Request $request)
    {
        DB::beginTransaction();
        try {
            /**
             * Untuk melakukan deleting, dibagian relasi ini ada perubahan,
             * yaitu dari $post->tags()->attach/sync($request->tag) jadi $post->tags()->detach();
             * attach ini buat di create, sync ini buat di updating dan detach untuk deleting,
             * hapus $request->tag/categories nya
             * 
             */

            $post->tags()->detach();
            $post->categories()->detach();

            $post->delete();

            Alert::toast(trans('posts.alert.update.message.success', ['name' => $post->title]), 'success');

            return redirect()->route('posts.index');
        } catch (\Throwable $th) {
            DB::rollBack();

            Alert::error(
                trans('posts.alert.update.title.error'),
                trans('posts.alert.update.message.error', ['error' => $th->getMessage()])
            );
        } finally {
            DB::commit();
            return redirect()->back();
        }

        return redirect()->back();
    }

    private function statuses()
    {
        return [
            'publish'   => trans('posts.form_control.select.status.option.publish'),
            'draft'     => trans('posts.form_control.select.status.option.draft'),
            // 'finished'  => trans('posts.form_control.select.status.option.finished'),
        ];
    }

    private function attributes()
    {
        return [
            'title'         => trans('posts.form_control.input.title.attribute'),
            'slug'          => trans('posts.form_control.input.slug.attribute'),
            'thumbnail'     => trans('posts.form_control.input.thumbnail.attribute'),
            'description'   => trans('posts.form_control.textarea.description.attribute'),
            'content'       => trans('posts.form_control.textarea.content.attribute'),
            'category'      => trans('posts.form_control.input.category.attribute'),
            'tag'           => trans('posts.form_control.select.tag.attribute'),
            'status'        => trans('posts.form_control.select.status.attribute'),
        ];
    }
}
