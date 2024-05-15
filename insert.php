<?php
include_once "funksjoner/automagic.php";
include_once "backend/submitFunctions.php";
include_once "backend/getFromDatabase.php";
include_once "getAllForms.php";

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    var_dump($_POST);
    if (!isset($_GET["row"])) {
        submitFunctions::insertIntoTable($_GET["table"], $_POST);
        echo "Lagt til";
    } else {
        submitFunctions::updateTable($_GET["table"], ["id" => $_GET["row"]], $_POST);
    }
}

$uppercase = ucfirst(str_replace("-", " ", $_GET["table"]));
$page["title"] = "Insert Into: $uppercase";

$navLinks = [
    ["link" => "index.php", "name" => "Home"],
    ["link" => "table.php?table=$_GET[table]", "name" => "Back"],
];

$page["body"] = function () {
    $tmp = getAllForms();
    if (!isset($tmp[$_GET["table"]])) {
        echo "<h1>This Form has not been implemented</h1>";
        die();
    }
    $form = $tmp[$_GET["table"]];

    if (isset($_GET["row"])) {
        $row = getFromDatabase::table($_GET["table"])[$_GET["row"]];
        $oldForm = $form;
        $form = [];

        foreach ($oldForm as $column) {
            if ($column["type"] === "checkbox" and $row[$column["name"]] === 1) {
                $form[] = $column + [ "checked" => "checked" ];
                continue;
            }
            $form[] = $column + [ "value" => $row[$column["name"]] ];
        }
    }

    echo automagic::automagicForm($form, "post", "");
};

include('template.php');
