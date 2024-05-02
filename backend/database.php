<?php

class database{

   public static array $databaseInfo = [
       "servername" => "localhost",
       "username" => "root",
       "password" => "Admin",
       "dbname" => "kantine_kub",
   ];

    public static function getDatabaseConnection (): PDO | PDOException
    {
        $db = &self::$databaseInfo;

        try {
            $conn = new PDO(
                "mysql:host=" . $db["servername"] . ";".
                "dbname=" . $db["dbname"],
                $db["username"], $db["password"]
            );

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Tilkobling feilet: " . $e->getMessage();
            return $e;
        }
    }

    public static function setUpDatabase(): void
    {

        $db = database::getDatabaseConnection();

        $db->query("
        CREATE TABLE IF NOT EXISTS postnummer (
            postnummer CHAR(4) PRIMARY KEY NOT NULL ,
            poststed VARCHAR(50) NOT NULL 
        );
        ")->execute();

        $db->query("
        CREATE TABLE IF NOT EXISTS kunde (
            id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
            fornavn VARCHAR(100) NOT NULL,
            etternavn VARCHAR(100) NOT NULL,
            adresse VARCHAR(100) NOT NULL,
            postnummer CHAR(4) NOT NULL,
            mail VARCHAR(255) NOT NULL,
            telefonnummer VARCHAR(15) NOT NULL,
            kommentar VARCHAR(300) NOT NULL,
            opprettet DATETIME(2) NOT NULL  DEFAULT NOW(),
            avsluttet DATETIME(2) NULL DEFAULT NULL,
            
            
            CONSTRAINT fk_postnummer FOREIGN KEY (postnummer) REFERENCES postnummer(postnummer)
             
        );
        ")->execute();

        $db->query("
        CREATE TABLE IF NOT EXISTS prisklasser (
             id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
             prisklasse VARCHAR(40) NOT NULL,
             dognpris INT NOT NULL,
             
             fradato DATE NOT NULL,
             tildato DATE NOT NULL   
        );
        ")->execute();

        $db->query("
        CREATE TABLE IF NOT EXISTS leieplass (
             id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
             lengde INT NOT NULL,
             bredde INT NOT NULL,
             type ENUM('telt', 'campingvogn', 'bobil'),
             handikapvennlig BOOL NOT NULL,
             elektrisitet BOOL NOT NULL,
             vann BOOL NOT NULL,
             husdyr BOOL NOT NULL,
             prisklasse_id INT NOT NULL,
             kommentar VARCHAR(200) NOT NULL,
             
             CONSTRAINT fk_prisklasse FOREIGN KEY (prisklasse_id) REFERENCES prisklasser(id)
        );
        ")->execute();

        $db->query("
        CREATE TABLE IF NOT EXISTS elektrisitet (
             id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
             pris_pr_kwh INT NOT NULL,
             
             fradato DATE NOT NULL,
             tildato DATE NOT NULL   
        );
        ")->execute();
        $db->query("
        CREATE TABLE IF NOT EXISTS vann (
             id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
             pris_pr_kubikkmeter INT NOT NULL,
             
             fradato DATE NOT NULL,
             tildato DATE NOT NULL   
        );
        ")->execute();

        $db->query("
        CREATE TABLE IF NOT EXISTS leietid (
             id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
             
             kunde_id INT NOT NULL,
             leieplass_id INT NOT NULL,
             
             bilnummer CHAR(7),
             
             stromforbruk_kwh INT NOT NULL,
             strompris_id INT NOT NULL,
             strompris_total INT NOT NULL,
             
             vannforbruk_kubikkmeter INT NOT NULL,
             vannpris_id INT NOT NULL,
             vannpris_total INT NOT NULL,
             
             dogn_sum INT NOT NULL,
             totalpris INT NOT NULL,
             
             kommentar VARCHAR(255),
             
             ankomst DATE NOT NULL,
             avreise DATE NOT NULL,
             
             
             CONSTRAINT fk_strompris FOREIGN KEY (strompris_id) REFERENCES elektrisitet(id),
             CONSTRAINT fk_vannpris FOREIGN KEY (vannpris_id) REFERENCES vann(id),
             
             CONSTRAINT fk_kunde FOREIGN KEY (kunde_id) REFERENCES kunde(id),
             CONSTRAINT fk_leieplass FOREIGN KEY (leieplass_id) REFERENCES leieplass(id)
        );
        ")->execute();
    }

}