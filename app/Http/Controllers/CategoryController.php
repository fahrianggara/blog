<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    protected $cateModel;
    public function __construct()
    {
        $this->cateModel = new Category();

        $this->middleware('permission:category_show', ['only' => 'index']);
        $this->middleware('permission:category_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:category_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:category_detail', ['only' => 'show']);
        $this->middleware('permission:category_delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        return view('categories.index', [
            'categories' => $categories->paginate(2)
                ->appends(['keyword' => $request->get('keyword')]),
        ]);
    }

    public function select(Request $request)
    {
        $categories = [];
        if ($request->has('q')) {
            $search = $request->q;
            $categories = Category::select('id', 'title')->where('title', 'LIKE', "%$search%")->limit(5)->get();
        } else {
            $categories = Category::select('id', 'title')->onlyParent()->limit(5)->get();
        }

        return response()->json($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // PROSES VALIDASI KATEGORI
        $validator = Validator::make(
            $request->all(),
            [
                'title'         => 'required|string|max:50',
                'slug'          => 'required|string|unique:categories,slug',
                'thumbnail'     => 'required',
                'description'   => 'required',
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()) {
            if ($request->has('parent_category')) {
                $request['parent_category'] = Category::select('id', 'title')->find($request->parent_category);
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //dd($request->title, $request->slug, parse_url($request->thumbnail), $request->description, $request->parent_category);

        // PROSES INSERT DATA KATEGORI
        try {

            Category::create([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'parent_id' => $request->parent_category
            ]);

            // $data = [
            //     'title' => $request->title,
            //     'slug' => $request->slug,
            //     'thumbnail' => parse_url($request->thumbnail)['path'],
            //     'description' => $request->description,
            //     'parent_id' => $request->parent_category
            // ];

            // $this->cateModel->addData($data);

            Alert::toast(trans('categories.alert.create.message.success', ['name' => $request->title]), 'success');

            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            if ($request->has('parent_category')) {
                $request['parent_category'] = Category::select('id', 'title')->find($request->parent_category);
            }

            Alert::error(
                trans('categories.alert.create.title.error'),
                trans('categories.alert.create.message.error', ['error' => $th->getMessage()])
            );

            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
        // dd($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        // PROSES VALIDASI KATEGORI
        $validator = Validator::make(
            $request->all(),
            [
                'title'         => 'required|string|max:50',
                'slug'          => 'required|string|unique:categories,slug,' . $category->id,
                'thumbnail'     => 'required',
                'description'   => 'required',
            ],
            [],
            $this->attributes()
        );

        if ($validator->fails()) {
            if ($request->has('parent_category')) {
                $request['parent_category'] = Category::select('id', 'title')->find($request->parent_category);
            }
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        if ($request->description == $category->description) {
            Alert::toast(trans('categories.alert.update.message.warning'), 'warning');

            return redirect()->route('categories.index');
        }

        // PROSES UPDATED DATA KATEGORI
        try {
            $category->update([
                'title' => $request->title,
                'slug' => $request->slug,
                'thumbnail' => parse_url($request->thumbnail)['path'],
                'description' => $request->description,
                'parent_id' => $request->parent_category
            ]);

            Alert::toast(trans('categories.alert.update.message.success', ['name' => $request->title]), 'success');

            return redirect()->route('categories.index');
        } catch (\Throwable $th) {
            if ($request->has('parent_category')) {
                $request['parent_category'] = Category::select('id', 'title')->find($request->parent_category);
            }

            Alert::error(
                trans('categories.alert.update.title.error'),
                trans('categories.alert.update.message.error', ['error' => $th->getMessage()])
            );

            return redirect()->back()->withInput($request->all());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Category $category)
    {
        try {

            $category->delete();
            Alert::toast(trans('categories.alert.delete.message.success', ['name' => $category->title]), 'success');
        } catch (\Throwable $th) {
            Alert::error(
                trans('categories.alert.delete.message.error'),
                trans('categories.alert.delete.message.error', ['error' => $th->getMessage()])
            );
        }

        return redirect()->back();
    }

    private function attributes()
    {
        return [
            'title'         => trans('categories.form_control.input.title.attribute'),
            'slug'          => trans('categories.form_control.input.slug.attribute'),
            'thumbnail'     => trans('categories.form_control.input.thumbnail.attribute'),
            'description'   => trans('categories.form_control.textarea.description.attribute'),
        ];
    }
}
