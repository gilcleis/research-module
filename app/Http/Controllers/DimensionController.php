<?php

namespace App\Http\Controllers;

use App\Http\Requests\DimensionRequest;
use App\Models\Dimension;
use App\Services\DimensionService;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class DimensionController extends Controller
{
    /**
     * @var DimensionService
     */
    protected DimensionService $dimensionService;

    /**
     *
     * @param  DimensionService  $dimensionService
     *
     */
    public function __construct(DimensionService $dimensionService)
    {
        $this->dimensionService = $dimensionService;        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dimension = $this->dimensionService->getAll();
        return response()->json($dimension, 200);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\DimensionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DimensionRequest $request)
    {
        $dimension = $this->dimensionService->save($request->validated());        
        return response()->json($dimension, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
        $dimension = $this->dimensionService->findById($id);
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
        $dimension = $this->dimensionService->update($id,$request->validated());
        return response()->json($dimension, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {       
        return $this->dimensionService->deleteById($id);
        
    }
}
