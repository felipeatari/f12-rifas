<?php

namespace App\Services;

use App\DTO\SortitionDTO;
use App\Repositories\SortitionRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SortitionService
{
    public function __construct(
        protected SortitionRepository $sortitionRepository
    ) {}

    public function getAll(array $filter = [], $perPage = 10, array $columns = [])
    {
        try {
            $data = $this->sortitionRepository->getAll($filter, $perPage, $columns);

            if (! $columns) {
                $items = $data->getCollection()->map(fn($sortition) => SortitionDTO::fromModel($sortition));

                $data->setCollection($items);
            }

            return [
                'status' => 'success',
                'code' => 200,
                'data' => $data,
            ];
        } catch (ModelNotFoundException $exception) {
            return [
                'status' => 'error',
                'code' => 404,
                'message' => 'Sorteios não encontradas.',
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ];
        }
    }

    public function getOne(?int $id = null)
    {
        try {
            $data = $this->sortitionRepository->getOne($id);
            $item = SortitionDTO::fromModel($data);

            return [
                'status' => 'success',
                'code' => 200,
                'data' => $item
            ];
        } catch (ModelNotFoundException $exception) {
            return [
                'status' => 'error',
                'code' => 404,
                'message' => 'Sorteio não encontrada.',
            ];
        }
    }

    public function create(array $data): array
    {
        try {
            $data = $this->sortitionRepository->create($data);
            $item = SortitionDTO::fromModel($data);

            return [
                'status' => 'success',
                'code' => 201,
                'message' => 'Sorteio criado com sucesso.',
                'data' => $item
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ];
        }
    }

    public function update(?int $id = null, array $data = [])
    {
        try {
            $data = $this->sortitionRepository->update($id, $data);
            $item = SortitionDTO::fromModel($data);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'Sorteio criado com sucesso.',
                'data' => $item
            ];
        } catch (ModelNotFoundException $exception) {
            return [
                'status' => 'error',
                'code' => 404,
                'message' => 'Sorteio não encontrada.',
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ];
        }
    }

    public function delete(?int $id = null)
    {
        try {
            $this->sortitionRepository->delete($id);

            return [
                'status' => 'success',
                'code' => 200,
                'message' => 'Sorteio apagado com sucesso.',
            ];
        } catch (ModelNotFoundException $exception) {
            return [
                'status' => 'error',
                'code' => 404,
                'message' => 'Sorteio não encontrada.',
            ];
        } catch (Exception $exception) {
            return [
                'status' => 'error',
                'code' => $exception->getCode(),
                'message' => $exception->getMessage(),
            ];
        }
    }
}
