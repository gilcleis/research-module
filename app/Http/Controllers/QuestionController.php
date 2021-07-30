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
       return  Question::with('dimension')->when(request('dimension_id', '') != '', function ($query) {
            $query->where('dimension_id', request('dimension_id'));
        })->orderBy('id','desc')->paginate(6);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {   
        try{     
        $question = new Question($request->all());
        $question->save();
        } catch (Exception $e) {
            return response()->json(['error' => 'Erro ao cadastrar.'], 400); 
        }

        return response($question->jsonSerialize(), Response::HTTP_OK);
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
        // $question = Question::find($id);
        // $question->update($request->all());
        // return response(null, Response::HTTP_OK);

        try{     
            $question = Question::find($id);
            $question->update($request->all());
            } catch (Exception $e) {
                return response()->json(['error' => 'Erro ao atualizar.'], 400); 
            }
    
        return response($question->jsonSerialize(), Response::HTTP_OK);
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

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  App\Http\Requests\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function statusUpdate($id,Request $request)
    {
        
        $question = Question::find($id);
        $request->validate([
            'status'    => 'required|in:A,I',            
        ]);
        $question->update($request->all());
        return response(null, Response::HTTP_OK);
        
    }
}
