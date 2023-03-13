<?php

declare(strict_types=1);
require_once "Entities/Bestelling.php";
require_once "DBConfig.php";
class BestellingDAO
{
    // create
    public function createBestelling(int $beleg, int $formaat, int $saus, int $soort, int $id): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "INSERT INTO bestelling(belegId, formaatId, sausId, soortId, klantId, datum) VALUES(:belegId, :formaatId, :sausId, :soortId, :klantId, :datum);";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([
            ":belegId" => $beleg,
            ":formaatId" => $formaat,
            ":sausId" => $saus,
            ":soortId" => $soort,
            ":klantId" => $id,
            ":datum" => date('j/m/Y')
        ]);
    }
    // read
    public function getAllBestellingen(): array
    {
        $bestellingen = array();
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM bestelling;";
        $resultSet = $dbh->query($sql);
        foreach ($resultSet as $result) {
            $bestelling = new Bestelling(
                $result["bestelling"],
                $result["belegId"],
                $result["formaatId"],
                $result["sausId"],
                $result["soortId"],
                $result["klantId"],
                $result["datum"]
            );
            array_push($bestellingen, $bestelling);
        }
        return $bestellingen;
    }
    public function getBestellingenKlant(int $klantId): ?array
    {
        $bestellingen = array();
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM bestelling WHERE klantId = :klantId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":klantId" => $klantId]);
        $resultSet = $smtm->fetchAll(PDO::FETCH_ASSOC);
        foreach ($resultSet as $result) {
            $bestelling = new Bestelling(
                $result["bestelling"],
                $result["belegId"],
                $result["formaatId"],
                $result["sausId"],
                $result["soortId"],
                $result["klantId"],
                $result["datum"]
            );

            array_push($bestellingen, $bestelling);
        }
        return $bestellingen;
    }
    public function getBestellingOpId(int $bestellingId): ?Bestelling
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM bestelling WHERE bestelling = :bestellingId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":bestellingId" => $bestellingId]);
        $result = $smtm->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        $bestelling = new Bestelling(
            intval($result["bestellingId"]),
            intval($result["belegId"]),
            intval($result["formaatId"]),
            intval($result["sausId"]),
            intval($result["soortId"]),
            intval($result["klantId"]),
            $result["datum"]
        );
        return $bestelling;
    }
    // update
    // delete
    public function deleteBestelling(int $bestellingId): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "DELETE FROM bestelling WHERE bestellingId = :bestellingId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":bestellingId" => $bestellingId]);
        $dbh = null;
    }
}