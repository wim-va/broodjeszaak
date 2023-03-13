<?php

declare(strict_types=1);
require_once "../Entities/Beleg.php";
require_once "DBConfig.php";
class BelegDAO
{
    // create
    public function createBeleg(string $belegNaam, float $belegPrijs)
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "INSERT INTO beleg(belegNaam, belegPrijs) VALUES(:belegNaam, :belegPrijs);";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([
            ":belegNaam" => $belegNaam,
            ":belegPrijs" => $belegPrijs
        ]);
        $dbh = null;
    }
    // read
    public function getAlleBeleg(): ?array
    {
        $belegs = array();
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM beleg";
        $resultSet = $dbh->query($sql);
        $dbh = null;
        foreach ($resultSet as $result) {
            $beleg = new Beleg(
                intval($result["belegId"]),
                $result["belegNaam"],
                floatval(["belegPrijs"])
            );
            array_push($belegs, $beleg);
        }
        return $belegs;
    }
    public function getBelegOpId(int $belegId): ?Beleg
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM beleg WHERE belegId = :belegId;";
        $smtm = $dbh->prepare($sql);
        $result = $smtm->execute([":belegId" => $belegId]);
        $dbh = null;
        $beleg = new Beleg(
            intval($result["belegId"]),
            $result["belegNaam"],
            floatval(["belegPrijs"])
        );
        return $beleg;
    }
    // update
    public function updateBelegNaam(int $belegId, string $belegNaam): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE beleg SET belegNaam = :belegNaam WHERE belegId = :belegId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":belegId" => $belegId, ":belegNaam" => $belegNaam]);
        $dbh = null;
    }
    public function updateBelegPrijs(int $belegId, float $belegPrijs): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE beleg SET belegPrijs = :belegPrijs WHERE belegId = :belegId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":belegId" => $belegId, ":belegPrijs" => $belegPrijs]);
        $dbh = null;
    }
    // delete
    public function deleteBeleg(int $belegId): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "DELETE FROM beleg WHERE belegId = :belegId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":belegId" => $belegId]);
        $dbh = null;
    }    // auxiliary functions
}