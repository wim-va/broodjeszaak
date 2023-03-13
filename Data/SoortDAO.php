<?php

declare(strict_types=1);
require_once "../Entities/Soort.php";
require_once "DBConfig.php";
class SoortDAO
{
    // create
    public function createSoort(string $soortNaam, float $soortPrijs)
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "INSERT INTO soort(soortNaam, soortPrijs) VALUES(:soortNaam, :soortPrijs);";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([
            ":soortNaam" => $soortNaam,
            ":soortPrijs" => $soortPrijs
        ]);
        $dbh = null;
    }
    // read
    public function getAlleSoorten(): ?array
    {
        $soorten = array();
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM soort";
        $resultSet = $dbh->query($sql);
        $dbh = null;
        foreach ($resultSet as $result) {
            $soort = new Soort(
                intval($result["soortId"]),
                $result["soortNaam"],
                floatval(["soortPrijs"])
            );
            array_push($soorten, $soort);
        }
        return $soorten;
    }
    public function getSoortOpId(int $soortId): ?Soort
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM soort WHERE soortId = :soortId;";
        $smtm = $dbh->prepare($sql);
        $result = $smtm->execute([":soortId" => $soortId]);
        $dbh = null;
        $soort = new Soort(
            intval($result["soortId"]),
            $result["soortNaam"],
            floatval(["soortPrijs"])
        );
        return $soort;
    }
    // update
    public function updateSoortNaam(int $soortId, string $soortNaam): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE soort SET soortNaam = :soortNaam WHERE soortId = :soortId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":soortId" => $soortId, ":soortNaam" => $soortNaam]);
        $dbh = null;
    }
    public function updateSoortPrijs(int $soortId, float $soortPrijs): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE soort SET soortPrijs = :soortPrijs WHERE soortId = :soortId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":soortId" => $soortId, ":soortPrijs" => $soortPrijs]);
        $dbh = null;
    }
    // delete
    public function deleteSoort(int $soortId): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "DELETE FROM soort WHERE soortId = :soortId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":soortId" => $soortId]);
        $dbh = null;
    }
}