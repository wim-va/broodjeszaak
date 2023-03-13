<?php

declare(strict_types=1);
require_once "Entities/Formaat.php";
require_once "DBConfig.php";
class FormaatDAO
{
    // create
    public function createFormaat(string $formaatNaam, float $formaatPrijs)
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "INSERT INTO formaat(formaatNaam, formaatPrijs) VALUES(:formaatNaam, :formaatPrijs);";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([
            ":formaatNaam" => $formaatNaam,
            ":formaatPrijs" => $formaatPrijs
        ]);
        $dbh = null;
    }
    // read
    public function getAlleFormaten(): ?array
    {
        $formaten = array();
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM formaat";
        $resultSet = $dbh->query($sql);
        $dbh = null;
        foreach ($resultSet as $result) {
            $formaat = new Formaat(
                intval($result["formaatId"]),
                $result["formaatNaam"],
                floatval(["formaatPrijs"])
            );
            array_push($formaten, $formaat);
        }
        return $formaten;
    }
    public function getFormaatOpId(int $formaatId): ?Formaat
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM formaat WHERE formaatId = :formaatId;";
        $smtm = $dbh->prepare($sql);
        $result = $smtm->execute([":formaatId" => $formaatId]);
        $dbh = null;
        $formaat = new Formaat(
            intval($result["formaatId"]),
            $result["formaatNaam"],
            floatval(["formaatPrijs"])
        );
        return $formaat;
    }
    // update
    public function updateFormaatNaam(int $formaatId, string $formaatNaam): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE formaat SET formaatNaam = :formaatNaam WHERE formaatId = :formaatId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":formaatId" => $formaatId, ":formaatNaam" => $formaatNaam]);
        $dbh = null;
    }
    public function updateFormaatPrijs(int $formaatId, float $formaatPrijs): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE formaat SET formaatPrijs = :formaatPrijs WHERE formaatId = :formaatId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":formaatId" => $formaatId, ":formaatPrijs" => $formaatPrijs]);
        $dbh = null;
    }
    // delete
    public function deleteFormaat(int $formaatId): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "DELETE FROM formaat WHERE formaatId = :formaatId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":formaatId" => $formaatId]);
        $dbh = null;
    } // auxiliary functions
}
