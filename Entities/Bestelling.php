<?php

declare(strict_types=1);
class Bestelling
{
    private int $id;
    private int $belegId;
    private int $formaatId;
    private int $sausId;
    private int $soortId;
    private int $klantId;
    private string $datum;
    public function __construct(int $id, int $belegId, int $formaatId, int $sausId, int $soortId, int $klantId, string $datum)
    {
        $this->id = $id;
        $this->belegId = $belegId;
        $this->formaatId = $formaatId;
        $this->sausId = $sausId;
        $this->soortId = $soortId;
        $this->klantId = $klantId;
        $this->datum = $datum;
    }

    // getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getBelegId(): int
    {
        return $this->belegId;
    }
    public function getFormaatId(): int
    {
        return $this->formaatId;
    }
    public function getSausId(): int
    {
        return $this->sausId;
    }
    public function getSoortId(): int
    {
        return $this->soortId;
    }
    public function getKlantId(): int
    {
        return $this->klantId;
    }
    public function getDatum(): string
    {
        return $this->datum;
    }
    // getters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setBelegId(int $belegId): void
    {
        $this->belegId = $belegId;
    }
    public function setFormaatId(int $formaatId): void
    {
        $this->formaatId = $formaatId;
    }
    public function setSausId(int $sausId): void
    {
        $this->sausId = $sausId;
    }
    public function setSoortId(int $soortId): void
    {
        $this->soortId = $soortId;
    }
    public function setKlantId(int $klantId): void
    {
        $this->klantId = $klantId;
    }
    public function setDatum(string $datum): void
    {
        $this->datum = $datum;
    }
}