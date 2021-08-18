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
        $result = ['status' => Response::HTTP_OK];
        try {
            $dimension = $this->dimensionService->getAll();
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($dimension, $result['status']);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param App\Http\Requests\DimensionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DimensionRequest $request)
    {
        $result = ['status' => Response::HTTP_CREATED];
        try {
            $dimension = $this->dimensionService->save($request->validated()); 
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($dimension, $result['status']);        
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {               
        $result = ['status' => 200];
        try {
            $dimension = $this->dimensionService->findById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($dimension, $result['status']);
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
        $result = ['status' => Response::HTTP_OK];
        try {
            $dimension = $this->dimensionService->update($id,$request->validated());
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage()
            ];
        }
        return response()->json($dimension, $result['status']);
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
