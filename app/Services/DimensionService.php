<?php


    namespace App\Services;


    use App\Http\Requests\DimensionRequest;
    use App\Models\Dimension;
    use App\Repositories\DimensionRepository;
    use Exception;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use \Illuminate\Support\Facades\Validator;
    use InvalidArgumentException;
    use Throwable;


    class DimensionService
    {
        protected DimensionRepository $dimensionRepository;

        /**
         * DimensionService constructor.
         *
         * @param  DimensionRepository  $dimensionRepository
         */
        public function __construct(DimensionRepository $dimensionRepository)
        {
            $this->dimensionRepository = $dimensionRepository;
        }

        /**
         * @return Dimension[]|Collection
         */
        public function getAll()
        {
            return $this->dimensionRepository->getAll();
        }

        /**
         * @param $id
         *
         * @return Dimension|null
         */
        public function findById($id)
        {
            return $this->dimensionRepository->findById($id);
        }

        /**
         * @param $data
         *
         * @return Dimension|null
         */
        public function save($data)
        {                      
            DB::beginTransaction();
            try {
                $model = $this->dimensionRepository->save($data);
            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                throw new InvalidArgumentException('Não foi possível cadastrar o registro');
            }
            DB::commit();
            return $model;
        }

        /**
         * @param $data
         * @param $id
         *
         * @return Dimension
         * @throws Throwable
         */
        public function update($id,$data)
        {
      
            // $rules     = new DimensionRequest();
             //$validator = Validator::make($data->all(), $data->rules());
            //dd($data);
            // if ($validator->fails()) {
            //     throw new InvalidArgumentException($validator->errors()->first());
            // }
            
            DB::beginTransaction();
            try {
                $model = $this->dimensionRepository->update($id,$data);
            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                throw new InvalidArgumentException('Não foi possível atualizar o registro');
            }
            DB::commit();
            return $model;
        }

        /**
         * @param $id
         *
         * @return Dimension
         * @throws Throwable
         */
        public function deleteById($id)
        {
            DB::beginTransaction();
            try {
                $model = $this->dimensionRepository->delete($id);
            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                throw new InvalidArgumentException('Não foi possível remover o registro');
            }
            DB::commit();
            return $model;
        }

    }