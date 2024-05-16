<?php
include_once "backend/submitFunctions.php";
session_start();

$page["title"] = "Handlekurv";

$page["body"] = function () {
    $handlekurv = &$_SESSION["handlekurv"];
    if (!isset($handlekurv) || is_null($handlekurv)) {
        echo "<h1>Handlekurven er tom</h1>";
        die();
    } else if (empty($handlekurv)) {
        echo "<h1>Handlekurven er tom</h1>";
        die();
    }

    if (isset($_POST["action"])) {
        if ($_POST["action"] == "bestill" and !empty($_POST["email"])) {
            $handlekurvId = submitFunctions::insertIntoTable("bestillinger", ["email" => $_POST["email"]]);
            foreach ($handlekurv as $item) {
                submitFunctions::insertIntoTable("bestillinger_items", $item + ["bestillinger_id" => $handlekurvId]);
            }

            $handlekurv = null;
        }
    }

    var_dump($_SESSION["handlekurv"]);
    ?>
    <form action="" method="post">
        <input type="hidden" id="action" name="action" value="bestill">
        <label for="email">E-mail</label>
        <input type="email" id="email" name="email">
        <button type="submit">Send inn bestilling</button>
    </form>

<?php };

include('template.php');
