<?php

declare(strict_types=1);
require_once "../Entities/Klant.php";
require_once "DBConfig.php";
class KlantDAO
{
    // create
    public function createKlant(string $voornaam, string $achternaam, string $email, string $paswoord)
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "INSERT INTO klant(klantVoornaam, klantAchternaam, klantEmail, klantPaswoord) VALUES(:klantVoornaam, :klantAchternaam, :klantEmail, :klantPaswoord);";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([
            ":klantVoornaam" => $voornaam,
            ":klantAchternaam" => $achternaam,
            ":klantEmail" => $email,
            ":klantPaswoord" => password_hash($paswoord, PASSWORD_DEFAULT)
        ]);
    }
    // read
    public function controleerKlantData(string $email, string $paswoord): ?int
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM klant WHERE klantEmail = :klantEmail";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":klantEmail" => $email]);
        $result = $smtm->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        if ($result) {
            $id = $result["klantId"];
            $voornaam = $result["klantVoornaam"];
            $achternaam = $result["klantAchternaam"];
            $emailDB = $result["klantEmail"];
            $passHashed = $result["klantPaswoord"];
            if ($email === $emailDB && password_verify($paswoord, $passHashed)) {
                return $id;
            }
        }
        return null;
    }
    public function getKlantOpId(int $id): ?int
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM klant WHERE klantId = :klantId";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":klantId" => $id]);
        $result = $smtm->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        if ($result) {
            $id = $result["klantId"];
            return $id;
        }
        return null;
    }
    public function getKlantOpEmail(string $email): bool
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "SELECT * FROM klant WHERE klantEmail = :klantEmail";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":klantEmail" => $email]);
        $result = $smtm->fetch(PDO::FETCH_ASSOC);
        $dbh = null;
        if ($result) {
            return true;
        }
        return false;
    }
    // update
    public function updateKlantGegevens(int $id, string $voornaam, string $achternaam, string $email): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE klant SET klantVoornaam = :klantVoornaam, klantAchternaam = :klantAchternaam, klantEmail = :klantEmail WHERE klantId = :klantId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([
            ":klantId" => $id,
            ":klantVoornaam" => $voornaam,
            ":klantAchternaam" => $achternaam,
            ":klantEmail" => $email
        ]);
        $dbh = null;
    }
    public function updatePaswoord(int $id, string $paswoord): void
    {
        $paswoordHash = password_hash($paswoord, PASSWORD_DEFAULT);
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "UPDATE klant SET klantPaswoord = :klantPaswoord WHERE klantId = :klantId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([
            ":klantId" => $id,
            ":klantPaswoord" => $paswoordHash
        ]);
        $dbh = null;
    }
    // delete
    public function deleteKlant(int $id): void
    {
        $dbh = new PDO(DBConfig::$DB_CONN, DBConfig::$DB_USER, DBConfig::$DB_PASS);
        $sql = "DELETE FROM klant WHERE klantId = :klantId;";
        $smtm = $dbh->prepare($sql);
        $smtm->execute([":klantId" => $id]);
        $dbh = null;
    }
    // auxiliary functions
}