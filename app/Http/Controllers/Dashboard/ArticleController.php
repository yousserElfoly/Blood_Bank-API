<?php

namespace App\Http\Controllers\Dashboard;

use App\Article;
use App\Category;
use App\Includes\AlertHelper;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {

        //create read update delete
       $this->middleware(['permission:read_articles'])->only('index');
       $this->middleware(['permission:create_articles'])->only('create');
       $this->middleware(['permission:update_articles'])->only('edit');
       $this->middleware(['permission:delete_articles'])->only('destroy');
    }

    public function index()
    {
        $articles = Article::all();
        return view('dashboard.articles.index', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.articles.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required',
            'image'            => 'required|image|mimes:png,jpg,jpeg',
            'content'          => 'required',
            'category_id'      => 'required',

        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $article = new Article();
        $article->fill($request->all());
        $image = $request->file('image')->store('article_images');
        $article->image = $image;
        $article->save();

        AlertHelper::done('تمت عمليه الحفظ بنجاح',route('dashboard.articles.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::find($id);
        return view('dashboard.articles.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        return view('dashboard.articles.edit', compact('article','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title'            => 'required',
            'image'            => 'nullable|image|mimes:png,jpg,jpeg',
            'content'          => 'required|string',
            'category_id'      => 'required',

        ]);

        if($validator->fails() != false) {
            AlertHelper::error($validator->errors());
            exit();
        }

        $article =  Article::find($id);
        $past_image = $article->image;
        $article->fill($request->all());
        if(Request('image')){
            Storage::delete($past_image);
            $article->image = $request->file('image')->store('article_images');
        }else{
            $articale->img = $past_image;
        }
        $article->save();

        AlertHelper::done('تمت عمليه التعديل بنجاح',route('dashboard.articles.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Article::findOrFail($id);
        if (!$record) {
            return response()->json([
                'status'  => 0,
                'message' => 'تعذر الحصول على البيانات'
            ]);
        }
        Storage::delete($record->image);
        $record->delete();
        return response()->json([
            'status'  => 1,
            'message' => 'تم الحذف بنجاح',
            'id'      => $id
        ]);
        // session()->flash('success', trans('site.deleted_successfully'));
    }
}
