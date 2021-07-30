<?php


    namespace App\Repositories;


use App\Models\Dimension;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;

class DimensionRepository
    {
        protected Dimension $dimension;

        /**
         * DimensionRepository constructor.
         *
         * @param  Dimension  $dimension
         */
        public function __construct(Dimension $dimension)
        {
            $this->dimension = $dimension;
        }


        /**
         * @return Dimension[]
         */
        public function getAll()
        {
            return $this->dimension->orderBy('name', 'asc')->paginate(6);
        }

        /**
         * @param $id
         *
         * @return Dimension[]|Collection
         */
        public function getById($id)
        {
            return $this->dimension->where('id', $id)->get();
        }

        /**
         * @param $id
         *
         * @return Dimension|null
         */
        public function findById($id): ?Dimension
        {
            return $this->dimension->find($id);
        }

        /**
         * @param $data
         *
         * @return Dimension
         */
        public function save($data)
        {
            /** @var Dimension $model */
            $model = new $this->dimension;

            $model->fill($data);
            $model->save();

            return $model->fresh();

        }

        /**
         * @param $data
         * @param $id
         *
         * @return Dimension
         */
        public function update($id,$data): Dimension
        {
            $model = $this->dimension->find($id);
            $model->fill($data);
            $model->update();
            return $model;
        }

        /**
         * @param $id
         *
         * @return Dimension
         * @throws Exception
         */
        public function delete($id)
        {
            // $model = $this->dimension->find($id);
            // $model->delete();
            // return $model;

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
            //return $e;  
            return response()->json(['error' => 'Não pode excluir uma dimensão que esteja vinculada á uma pergunta.'], 404);          
        }        
        return response(null, Response::HTTP_OK);
        }


    }