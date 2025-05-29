<?php

namespace App\Services;

use App\DTO\SortitionDTO;
use App\Repositories\SortitionRepository;
use Error;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SortitionService
{
    public function __construct(
        protected SortitionRepository $sortitionRepository,
        private string $status = 'success',
        private string $message = '',
        private mixed $code = 200,
    ) {}

    public function getAll(array $filter = [], $perPage = 10, array $columns = [])
    {
        try {
            $data = $this->sortitionRepository->getAll($filter, $perPage, $columns);

            if (! $columns) {
                $items = $data->getCollection()->map(fn($sortition) => SortitionDTO::fromModel($sortition));

                $data->setCollection($items);
            }

            return $data;
        } catch (ModelNotFoundException $exception) {
            $this->status = 'error';
            $this->code = 404;
            $this->message = 'Sorteios não encontrados.';
        } catch (Exception $exception) {
            $this->status = 'error';
            $this->code = $exception->getCode();
            $this->message = $exception->getMessage();
        }

        return null;
    }

    public function getOne(array $filter = [], $perPage = 10, array $columns = [])
    {
        try {
            $item = $this->sortitionRepository->getOne($filter, $perPage, $columns);

            if (! $columns) {
                if ($item) $item = SortitionDTO::fromModel($item);
            }

            return $item;
        } catch (ModelNotFoundException $exception) {
            $this->status = 'error';
            $this->code = 404;
            $this->message = 'Sorteio não encontrado.';
        } catch (Exception $exception) {
            $this->status = 'error';
            $this->code = $exception->getCode();
            $this->message = $exception->getMessage();
        }

        return null;
    }

    public function getById(?int $id = null)
    {
        try {
            $data = $this->sortitionRepository->getById($id);
            $item = SortitionDTO::fromModel($data);

            return $item;
        } catch (ModelNotFoundException $exception) {
            $this->status = 'error';
            $this->code = 404;
            $this->message = 'Sorteio não encontrado.';
        } catch (Exception $exception) {
            $this->status = 'error';
            $this->code = $exception->getCode();
            $this->message = $exception->getMessage();
        }

        return null;
    }

    public function create(array $data)
    {
        try {
            $data = $this->sortitionRepository->create($data);
            $item = SortitionDTO::fromModel($data);

            $this->code = 201;

            return $item;
        } catch (Exception $exception) {
            $this->status = 'error';
            $this->code = $exception->getCode();
            $this->message = $exception->getMessage();
        }

        return null;
    }

    public function update(?int $id = null, array $data = [])
    {
        try {
            $data = $this->sortitionRepository->update($id, $data);
            $item = SortitionDTO::fromModel($data);

            return $item;
        } catch (ModelNotFoundException $exception) {
            $this->status = 'error';
            $this->code = 404;
            $this->message = 'Sorteio não encontrado.';
        } catch (Exception $exception) {
            $this->status = 'error';
            $this->code = $exception->getCode();
            $this->message = $exception->getMessage();
        }

        return null;
    }

    public function delete(?int $id = null)
    {
        try {
            $this->sortitionRepository->delete($id);

            return true;
        } catch (ModelNotFoundException $exception) {
            $this->status = 'error';
            $this->code = 404;
            $this->message = 'Sorteio não encontrado.';
        } catch (Exception $exception) {
            $this->status = 'error';
            $this->code = $exception->getCode();
            $this->message = $exception->getMessage();
        }

        return null;
    }

    public function status()
    {
        return $this->status;
    }

    public function code()
    {
        return $this->code;
    }

    public function message()
    {
        return $this->message;
    }
}
