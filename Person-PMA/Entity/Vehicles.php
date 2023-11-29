<?php

namespace App\Entity;

class Vehicles implements \JsonSerializable
{
    private string $brand;
    private string $model;
    private int $type;

    public function jsonSerialize(): object
    {
        return (object)get_object_vars($this);
    }

    public function getBrand(): string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    public function getModel(): string
    {
        return $this->model;
    }

    public function setModel(string $model): void
    {
        $this->model = $model;
    }

    public function getType(): int
    {
        return $this->type;
    }

    public function setType(int $Type): void
    {
        $this->type = $Type;
    }
}

