<?php

namespace App\Http\Controllers;

use App\Http\Requests\DimensionRequest;
use App\Models\Dimension;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DimensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dimensions = Dimension::orderBy('name', 'asc')->paginate(6);
        return $dimensions;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\DimensionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DimensionRequest $request)
    {
        $dimension = new Dimension([
            'name' => $request->input('name'),
        ]);
        $dimension->save();
        return response($dimension->jsonSerialize(), Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dimension = Dimension::find($id);
        return response($dimension->jsonSerialize(), Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @param  @param App\Http\Requests\DimensionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, DimensionRequest $request)
    {
        $dimension = Dimension::find($id);
        $dimension->update($request->all());
        return response($dimension, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        DB::beginTransaction();

        try {
            $dimension = Dimension::findOrFail($id); 
            $dimension->forceDelete();
            DB::rollback();
    
            $dimension = Dimension::findOrFail($id);
            $dimension->delete();
            DB::commit();

        } catch (QueryException $e) {
            DB::rollback();         
            return response()->json(['error' => 'Não pode excluir uma dimensão que 
            esteja vinculada á uma pergunta.'], 404);          
        }
        
        return response(null, Response::HTTP_OK);
    }
}
