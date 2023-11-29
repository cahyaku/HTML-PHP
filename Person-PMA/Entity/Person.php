<?php

namespace App\Entity;

class Person implements \JsonSerializable
{
    private ?int $id;
    private string $nik;
    private string $name;
    private string $birthDate;

    private array $vehicles;

    public function jsonSerialize(): object
    {
        return (object)get_object_vars($this);
    }

    public function &getVehicles(): array
    {
        return $this->vehicles;
    }

    public function setVehicles(?array $vehicles): void
    {
        $this->vehicles = $vehicles;
    }

    public function getId(): int|null
    {
        return $this->id;
    }

    public function setId(int|null $id): void
    {
        $this->id = $id;
    }

    /**
     * Getter dan Setter untuk name
     */
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Getter dan Setter untuk NIK
     */
    public function getNik(): string
    {
        return $this->nik;
    }

    public function setNik(string $nik): void
    {
        $this->nik = $nik;
    }

    /**
     * Getter dan Setter untuk birth date
     */
    public function getBirthDate(): string
    {
        return $this->birthDate;
    }

    public function setBirthDate(string $birthDate): void
    {
        $this->birthDate = $birthDate;
    }
}