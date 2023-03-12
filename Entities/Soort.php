<?php

declare(strict_types=1);
class Soort
{
    private int $id;
    private string $naam;
    private float $prijs;
    public function __construct(int $id, string $naam, float $prijs)
    {
        $this->id = $id;
        $this->naam = $naam;
        $this->prijs = $prijs;
    }
    // getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getNaam(): string
    {
        return $this->naam;
    }
    public function getPrijs(): float
    {
        return $this->prijs;
    }
    // setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setNaam(string $naam): void
    {
        $this->naam = $naam;
    }
    public function setPrijs(float $prijs): void
    {
        $this->prijs = $prijs;
    }
}
