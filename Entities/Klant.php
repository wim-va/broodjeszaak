<?php

declare(strict_types=1);
require_once "../Entities/Bestelling.php";
class Klant
{
    private int $id;
    private string $voornaam;
    private string $achternaam;
    private string $email;
    private string $paswoord;
    public function __construct(int $id, string $voornaam, string $achternaam, string $email, string $paswoord)
    {
        $this->id = $id;
        $this->voornaam = $voornaam;
        $this->achternaam = $achternaam;
        $this->email = $email;
        $this->paswoord = $paswoord;
    }
    // getters
    public function getId(): int
    {
        return $this->id;
    }
    public function getVoornaam(): string
    {
        return $this->voornaam;
    }
    public function getAchternaam(): string
    {
        return $this->achternaam;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getPaswoord(): string
    {
        return $this->paswoord;
    }
    // setters
    public function setId(int $id): void
    {
        $this->id = $id;
    }
    public function setVoornaam(string $voornaam): void
    {
        $this->voornaam = $voornaam;
    }
    public function setAchternaam(string $achternaam): void
    {
        $this->achternaam = $achternaam;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }
    public function setPaswoord(string $paswoord): void
    {
        $this->paswoord = $paswoord;
    }
}