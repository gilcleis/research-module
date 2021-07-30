<?php


    namespace App\Services;


    use App\Http\Requests\QuestionRequest;
    use App\Models\Question;
    use App\Repositories\QuestionRepository;
    use Exception;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Support\Facades\Log;
    use \Illuminate\Support\Facades\Validator;
    use InvalidArgumentException;
    use Throwable;


    class QuestionService
    {
        protected QuestionRepository $questionRepository;

        /**
         * QuestionService constructor.
         *
         * @param  QuestionRepository  $questionRepository
         */
        public function __construct(QuestionRepository $questionRepository)
        {
            $this->questionRepository = $questionRepository;
        }

        /**
         * @return Question[]|Collection
         */
        public function getAll()
        {
            return $this->questionRepository->getAll();
        }

        /**
         * @param $id
         *
         * @return Question|null
         */
        public function findById($id)
        {
            return $this->questionRepository->findById($id);
        }

        /**
         * @param $data
         *
         * @return Question|null
         */
        public function save($data)
        {
            $rules     = new QuestionRequest();
           
            $validator = Validator::make($data, $rules->rules());
            
            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors()->first());
            }
            return $this->questionRepository->save($data);
        }

        /**
         * @param $data
         * @param $id
         *
         * @return Question
         * @throws Throwable
         */
        public function update($id,$data)
        {
            //dd($id,$data);
            $rules     = new QuestionRequest();
            $validator = Validator::make($data, $rules->rules());

            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors()->first());
            }

            DB::beginTransaction();

            try {
                $model = $this->questionRepository->update($id,$data);

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
         * @return Question
         * @throws Throwable
         */
        public function deleteById($id)
        {

            DB::beginTransaction();

            try {
                $model = $this->questionRepository->delete($id);

            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());
                throw new InvalidArgumentException('Não foi possível remover o registro');
            }

            DB::commit();

            return $model;
        }


          /**
         * @param $data
         * @param $id
         *
         * @return Question
         * @throws Throwable
         */
        public function statusUpdate($id,$data)
        {
            
            $rules     = new QuestionRequest();
            
            $validator = Validator::make($data, $rules->rules());
            

            if ($validator->fails()) {
                throw new InvalidArgumentException($validator->errors()->first());
            }

            DB::beginTransaction();

            try {
                $model = $this->questionRepository->update($id,$data);

            } catch (Exception $e) {
                DB::rollBack();
                Log::info($e->getMessage());

                throw new InvalidArgumentException('Não foi possível atualizar o registro');
            }

            DB::commit();

            return $model;
        }

    }