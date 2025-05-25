<?php

namespace App\DTO;

use App\Models\Sortition;

class SortitionDTO
{
    public ?int $id;
    public ?string $title;
    public ?string $description;
    public ?string $slug;
    public ?float $price;
    public ?int $numbers;
    public ?string $date;
    public ?string $status;
    public ?string $image;

    public function __construct(Sortition $data)
    {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->slug = $data['slug'];
        $this->price = $data['price'];
        $this->numbers = $data['numbers'];
        $this->date = $data['date'];
        $this->status = $data['status'];
        $this->image = $data['image'];
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'slug' => $this->slug,
            'price' => $this->price,
            'numbers' => $this->numbers,
            'date' => $this->date,
            'status' => $this->status,
            'image' => $this->image,
        ];
    }

    public static function fromModel(Sortition $data)
    {
        return new self($data);
    }
}
