<?php


    namespace App\Repositories;


use App\Models\Question;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\QueryException;


class QuestionRepository
    {
        protected Question $question;

        /**
         * QuestionRepository constructor.
         *
         * @param  Question  $question
         */
        public function __construct(Question $question)
        {
            $this->question = $question;
        }


        /**
         * @return Question[]
         */
        public function getAll()
        {
            return $this->question->with('dimension')->when(request('dimension_id', '') != '', function ($query) {
                        $query->where('dimension_id', request('dimension_id'));
                    })->orderBy('id','desc')->paginate(6);;
        }

        /**
         * @param $id
         *
         * @return Question[]|Collection
         */
        public function getById($id)
        {
            return $this->question->where('id', $id)->get();
        }

        /**
         * @param $id
         *
         * @return Question|null
         */
        public function findById($id): ?Question
        {
            return $this->question->find($id);
        }

        /**
         * @param $data
         *
         * @return Question
         */
        public function save($data)
        {
            /** @var Question $model */
            $model = new $this->question;

            $model->fill($data);
            $model->save();

            return $model->fresh();

        }

        /**
         * @param $data
         * @param $id
         *
         * @return Question
         */
        public function update($id,$data): Question
        {
            $model = $this->question->find($id);
            $model->fill($data);
            $model->update();
            return $model;
        }

        /**
         * @param $id
         *
         * @return Question
         * @throws Exception
         */
        public function delete($id)
        {
            $model = $this->question->find($id);
            $model->delete();
            return $model;

        }

        public function statusUpdate($id,$data)
        {
            $model = $this->question->find($id);
            $data->validate([
                'status'    => 'required|in:A,I',            
            ]);
            $model->fill($data);
            $model->update();
            return $model;
        }


    }