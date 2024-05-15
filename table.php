<?php
include_once "backend/getFromDatabase.php";
include_once "funksjoner/automagic.php";
include_once "backend/submitFunctions.php";

if (!isset($_GET["table"])) {
    header("Location: index.php");
    die();
}

if (isset($_GET["row"])) {
    submitFunctions::updateTable($_GET["table"], ["id" => $_GET["row"]], [ "avsluttet" => date("Y-m-d H:i:s")]);
}

$uppercase = ucfirst(str_replace("-", " ", $_GET["table"]));
$page["title"] = "Table: $uppercase";

$navLinks = [
    ["link" => "index.php", "name" => "Home"],
    ["link" => "insert.php?table=$_GET[table]", "name" => "Insert"],
];

$page["body"] = function () {
    $primaryKey = "id";
    if ($_GET["table"] === "postnummer") $primaryKey = "postnr";
    $table = getFromDatabase::table($_GET["table"], $primaryKey);

    if (count($table) > 0) {
        foreach ($table as $key=>&$row) {
            if ($_GET["table"] === "meny") {
                $row += [
                    "rediger" => "<a href='insert.php?table=$_GET[table]&row=$key'>rediger $_GET[table]: $key</a>",
                    "bestill" => "<a href='bestill.php?row=$key'>Bestill: $key</a>",
                ];
            }
            foreach ($row as $key2=>$value) {
                if (is_null(@$row["avsluttet"]) and $key2 === "avsluttet") {
                    $row["avsluttet"] = "<a href='table.php?table=$_GET[table]&row=$key'>Avslutt: $key</a>";
                    break;
                }
            }
        }
    } else {
        $headersBefore = getFromDatabase::columns($_GET["table"]);
        $headers = [];
        $headers[] = [];
        foreach ($headersBefore as $i) $headers[0] += [
            $i => "",
        ];
        $table = $headers;
    }

    echo automagic::automagicTable($table);
};

include('template.php');
