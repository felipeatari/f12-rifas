<?php

namespace App\DTO;

use App\Models\Sortition;
use Illuminate\Support\Collection;

class SortitionDTO
{
    public ?int $id;
    public ?int $user_id;
    public ?string $title;
    public ?string $description;
    public ?string $slug;
    public ?float $price;
    public ?int $numbers_amount;
    public ?string $scheduled_at;
    public ?string $status;
    public ?string $image;
    private ?Collection $numbers;

    public function __construct(Sortition $data)
    {
        $this->id = $data['id'];
        $this->user_id = $data['user_id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->slug = $data['slug'];
        $this->price = $data['price'];
        $this->numbers_amount = $data['numbers_amount'];
        $this->scheduled_at = $data['scheduled_at'];
        $this->status = $data['status'];
        $this->image = $data['image'];

        $this->setNumbers($data['numbers']);
    }

    public function setNumbers(?Collection $numers = null): self
    {
        $this->numbers = $numers;
        return $this;
    }

    public function getNumbers(): Collection
    {
        return $this->numbers;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'price' => $this->price,
            'numbers_amount' => $this->numbers_amount,
            'scheduled_at' => $this->scheduled_at,
            'status' => $this->status,
            'image' => $this->image,
        ];
    }

    public static function fromModel(Sortition $data)
    {
        return new self($data);
    }
}
