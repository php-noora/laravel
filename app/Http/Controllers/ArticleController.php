<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\CategoryCourse;
use App\Models\Course;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $datas = [];
        $articles=Article::all();
        foreach($articles as $article){
            $image=$article->getMedia()->first()->getUrl();
            

            $article->update([
                'image'=>$image,
            ]);

            $data=[
                'data'=>$article,
                'image'=>$image,

            ];
            $datas [] = $data;
        }
        return response([
            'image'=>$image,
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
    public function show(Article $article,$id)
    {
        $datas = [];
        $article=Article::find($id);
        $image=$article->getMedia()->first()->getUrl();
        $data=[
            'data'=>$article,
            'image'=>$image,

        ];
        $datas [] = $data;

       return response([
       'image'=>$image,
       'article'=>$article,
         ]);


//        return response()->json([
//            'status'=>'success',
//            'article'=>$article,
//        ]);
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
    public function update(UpdateArticleRequest $request, Article $article , $id)
    {
        $article=Article::where('id', $id)->get()->first();
        $article->update([
            'title'=>$request->title,
            'Short_description'=>$request->short_description,
            'description'=>$request->description,

        ]);
        if ($request->hasFile('image')) {
            $article->media()->delete();
            $image = $article->addMediaFromRequest('image')->toMediaCollection();
            $article->update([
                'image' => $image->getUrl()
            ]);
            return response()->json([
                'status' => true,
                'message' => ' updated successfully',
                'data' => Article::find($id)
            ], 200);
        }

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article , $id)
    {
        Article::where('id', $id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'delete successfully'
        ], 200);
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
