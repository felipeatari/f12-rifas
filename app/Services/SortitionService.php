<?php

namespace App\Services;

use App\DTO\SortitionDTO;
use App\Repositories\SortitionRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SortitionService extends Service
{
    public function __construct(
        protected SortitionRepository $sortitionRepository
    )
    {
    }

    protected function repository(): mixed
    {
        return $this->sortitionRepository;
    }

    public function getAll(array $filter = [], $perPage = 10, array $columns = [])
    {
        try {
            $data = $this->sortitionRepository->getAll($filter, $perPage, $columns);

            if (! $columns) {
                $items = $data->getCollection()->map(fn($model) => SortitionDTO::fromModel($model));
                $data->setCollection($items);
            }

            return $data;
        } catch (ModelNotFoundException $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        } catch (Exception $exception) {
            return $this->exception($exception);
        }
    }

    public function getOne(array $filter = [], $perPage = 10, array $columns = [])
    {
        try {
            $item = $this->sortitionRepository->getOne($filter, $perPage, $columns);

            if (!$columns) {
                $item = SortitionDTO::fromModel($item);
            }

            return $item;
        } catch (ModelNotFoundException $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        } catch (Exception $exception) {
            return $this->exception($exception);
        }
    }

    public function getById(?int $id = null)
    {
        try {
            $data = $this->sortitionRepository->getById($id);
            return SortitionDTO::fromModel($data);
        } catch (ModelNotFoundException $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        } catch (Exception $exception) {
            return $this->exception($exception);
        }
    }

    public function create(array $data)
    {
        try {
            $item = $this->sortitionRepository->create($data);
            $this->code = 201;
            return SortitionDTO::fromModel($item);
        } catch (ModelNotFoundException $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        } catch (Exception $exception) {
            return $this->exception($exception);
        }
    }

    public function update(?int $id = null, array $data = [])
    {
        try {
            $item = $this->sortitionRepository->update($id, $data);
            return SortitionDTO::fromModel($item);
        } catch (ModelNotFoundException $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        } catch (Exception $exception) {
            return $this->exception($exception);
        }
    }

    public function delete(?int $id = null)
    {
        try {
            $this->sortitionRepository->delete($id);
            return true;
        } catch (ModelNotFoundException $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        } catch (Exception $exception) {
            return $this->exception($exception);
        }
    }
}
