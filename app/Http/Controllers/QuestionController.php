<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class QuestionController extends Controller
{

    /**
     * @var QuestionService
     */
    protected QuestionService $questionService;

    /**
     *
     * @param  QuestionService  $questionService
     *
     */
    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $question = $this->questionService->getAll();
        return response()->json($question, 200);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\QuestionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {   
        
        return $this->questionService->save($request->validated());   
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return $this->questionService->findById($id);
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
        
        $question = $this->questionService->update($id,$request->validated());
        return response()->json($question, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        return $this->questionService->deleteById($id);
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
