<?php

namespace App\Http\Controllers;

use App\Http\Requests\DimensionRequest;
use App\Models\Dimension;
use Illuminate\Http\Response;

class DimensionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dimensions = Dimension::orderBy('id','desc')->paginate(6);        
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
        $dimension = Dimension::find($id);
        $dimension->delete();
        return response()->noContent();       
    }
}
