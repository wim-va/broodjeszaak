<?php

declare(strict_types=1);
require_once "../Entities/Saus.php";
require_once "DBConfig.php";
class SausDAO
{
    // create
    public function createSaus(string $sausNaam, float $sausPrijs)
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "INSERT INTO saus(sausNaam, sausPrijs) VALUES(:sausNaam, :sausPrijs);";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([
            ":sausNaam" => $sausNaam,
            ":sausPrijs" => $sausPrijs
        ]);
        $dbh = null;
    }
    // read
    public function getAlleSauzen(): ?array
    {
        $sauzen = array();
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM saus";
        $resultSet = $dbh->query($sql);
        $dbh = null;
        foreach ($resultSet as $result) {
            $saus = new Saus(
                intval($result["sausId"]),
                $result["sausNaam"],
                floatval(["sausPrijs"])
            );
            array_push($sauzen, $saus);
        }
        return $sauzen;
    }
    public function getSausOpId(int $sausId): ?Saus
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM saus WHERE sausId = :sausId;";
        $smtm = $dbh->prepare($sql);
        $result = $smtm->execute([":sausId" => $sausId]);
        $dbh = null;
        $saus = new Saus(
            intval($result["sausId"]),
            $result["sausNaam"],
            floatval(["sausPrijs"])
        );
        return $saus;
    }
    // update
    public function updateSausNaam(int $sausId, string $sausNaam): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE saus SET sausNaam = :sausNaam WHERE sausId = :sausId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":sausId" => $sausId, ":sausNaam" => $sausNaam]);
        $dbh = null;
    }
    public function updateSausPrijs(int $sausId, float $sausPrijs): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE saus SET sausPrijs = :sausPrijs WHERE sausId = :sausId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":sausId" => $sausId, ":sausPrijs" => $sausPrijs]);
        $dbh = null;
    }
    // delete
    public function deleteSaus(int $sausId): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "DELETE FROM saus WHERE sausId = :sausId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":sausId" => $sausId]);
        $dbh = null;
    }
}