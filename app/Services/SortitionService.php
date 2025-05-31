<?php

namespace App\Services;

use App\DTO\SortitionDTO;
use App\Repositories\SortitionRepository;

class SortitionService extends Service
{
    public function __construct(
        protected SortitionRepository $sortitionRepository
    ) {}

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
        } catch (\Exception $exception) {
            return $this->exception($exception, 'Sorteios não encontrados.');
        }
    }

    public function getOne(array $filter = [], $perPage = 10, array $columns = [])
    {
        try {
            $item = $this->sortitionRepository->getOne($filter, $perPage, $columns);
            return $columns ? $item : SortitionDTO::fromModel($item);
        } catch (\Exception $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        }
    }

    public function getById(?int $id = null)
    {
        try {
            $data = $this->sortitionRepository->getById($id);
            return SortitionDTO::fromModel($data);
        } catch (\Exception $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        }
    }

    public function create(array $data)
    {
        try {
            $item = $this->sortitionRepository->create($data);
            $this->code = 201;
            return SortitionDTO::fromModel($item);
        } catch (\Exception $exception) {
            return $this->exception($exception);
        }
    }

    public function update(?int $id = null, array $data = [])
    {
        try {
            $item = $this->sortitionRepository->update($id, $data);
            return SortitionDTO::fromModel($item);
        } catch (\Exception $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        }
    }

    public function delete(?int $id = null)
    {
        try {
            $this->sortitionRepository->delete($id);
            return true;
        } catch (\Exception $exception) {
            return $this->exception($exception, 'Sorteio não encontrado.');
        }
    }
}
