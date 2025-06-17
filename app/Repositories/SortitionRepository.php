<?php

namespace App\Repositories;

use App\Models\Sortition;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class SortitionRepository
{
    private array $allowed = ['id', 'user_id', 'title', 'slug', 'scheduled_at', 'status'];

    public function applyFilters($query, array $filters = [])
    {
        foreach ($filters as $key => $value):
            if (!in_array($key, $this->allowed) or is_null($value)) continue;

            if (is_array($value)) {
                $query->whereIn($key, $value);

                continue;
            }

            if (is_null($value)) continue;

            match ($key) {
                'title' => $query->where('title', 'like', "%$value%"),
                'slug' => $query->where('slug', $value),
                'scheduled_at' => $query->whereDate('scheduled_at', $value),
                'status' => $query->where('status', $value),
                default => $query->where($key, $value),
            };
        endforeach;

        return $query->orderByDesc('id');
    }

    public function getAll(array $filters = [], $perPage = 10, $columns = [])
    {
        try {
            $query = Sortition::query();
            $query = $this->applyFilters($query, $filters);

            if (! $columns) $columns = ['*'];

            $data = $query->paginate($perPage, $columns, 'pagina');

            if (! $data->count()) throw new ModelNotFoundException('Not Found.', 404);

            return $data;
        } catch (ModelNotFoundException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getOne(array $filters = [], $perPage = 10, $columns = [])
    {
        try {
            $query = Sortition::query();
            $query = $this->applyFilters($query, $filters, $this->allowed);

            if (! $columns) $columns = ['*'];

            $query->select($columns);

            $data = $query->first();

            if (! $data) throw new ModelNotFoundException('Not Found.', 404);

            return $data;
        } catch (ModelNotFoundException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getById($id)
    {
        try {
            return Sortition::findOrFail($id);
        } catch (ModelNotFoundException $exception) {
            throw $exception;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function create(array $data)
    {
        DB::beginTransaction();

        try {
            $sortition = Sortition::updateOrCreate($data);

            DB::commit();

            return $sortition;
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function update($id, array $data)
    {
        DB::beginTransaction();

        try {
            $sortition = Sortition::findOrFail($id);
            $sortition->update($data);

            DB::commit();

            return $sortition;
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();

            throw $exception;
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }

    }

    public function delete($id)
    {
        DB::beginTransaction();

        try {
            $sortition = $this->findById($id);
            $sortition->delete();

            DB::commit();

            return $sortition ;
        } catch (ModelNotFoundException $exception) {
            DB::rollBack();

            throw $exception;
        } catch (Exception $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
