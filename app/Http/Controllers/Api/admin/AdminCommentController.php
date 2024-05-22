<?php

namespace App\Http\Controllers\Api\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentRequest;
use App\Models\Comment;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{

//        public function index()
//    {
//        $comments = Comment::orderBy('created_at', 'desc')->simplePaginate(15);
//        return view('admin.content.comment.index', compact('comments'));
//
//    }

    public function index()
    {
        $unSeenComments = Comment::where('seen', 0)->get();
        foreach ($unSeenComments as $unSeenComment) {
            $unSeenComment->seen = 1;
            $result = $unSeenComment->save();
        }
        $comments = Comment::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('admin.content.comment.index', compact('comments'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $comment=Comment::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'body'=>$request->body,
            'commentable_id'=> $request->commentable_id,
        'commentable_type'=>$request->commentable_type,
            ]);
        return response()->json([
            'status' => 'success',
            'data' => $comment,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Comment $comment)
    {
        return view('admin.content.comment.show', compact('comment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function status(Comment $comment)
    {

        $comment->status = $comment->status == 0 ? 1 : 0;
        $result = $comment->save();
        if ($result) {
            if ($comment->status == 0) {
                return response()->json(['status' => true, 'checked' => false]);
            } else {
                return response()->json(['status' => true, 'checked' => true]);
            }
        } else {
            return response()->json(['status' => false]);
        }

    }


    public function answer(CommentRequest $request, Comment $comment)
    {
        if ($comment->parent == null) {
            $inputs = $request->all();
            $inputs['name'] = auth()->user();
            $inputs['parent_id'] = $comment->id;
            $inputs['commentable_id'] = $comment->commentable_id;
            $inputs['commentable_type'] = $comment->commentable_type;
            $inputs['answered'] = 1;

            $comment = Comment::create($inputs);
            return response()->json([
                'status' =>true,
                'message' =>'پاسخ ثبت شد',
                'data'=>'$comment',
            ]);

        }
        else{
            return response()->json([
                'status' =>false,
                'message' =>'خطا'
            ]);
        }
    }



}
