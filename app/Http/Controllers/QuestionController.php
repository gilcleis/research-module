<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       return  Question::when(request('category_id', '') != '', function ($query) {
            $query->where('category_id', request('category_id'));
        })->paginate(6);
    }

  

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        $question = new Question($request->all());
        $question->save();

        return response()->json('Product created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        return response($question->jsonSerialize(), Response::HTTP_OK);
    }

  
    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  App\Http\Requests\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id,QuestionRequest $request)
    {
        $question = Question::find($id);
        $question->update($request->all());
        return response(null, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::find($id);
        $question->delete();
        return response()->noContent();
    }
}
