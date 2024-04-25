<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Course;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $article=Article::all(['title','image']);
        return response([
            'status'=>true,
            'article'=>$article,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreArticleRequest $request)
    {
        $article=Article::create([
            'title'=>$request->title,
            'Short_description'=>$request->short_description,
            'description'=>$request->description,

        ]);
        $article->addMediaFromRequest('image')->toMediaCollection();

        return response()->json([
            'status'=>'success',
            'data'=>$article,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return response()->json([
            'status'=>'success',
            'article'=>$article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        //
    }

    public function newArticle(Article $article)
    {
        $article=Article::orderby('created_at', 'desc')->get();
        return response()->json([
            'status'=>'success',
            'data'=> $article
        ]);
    }
}
