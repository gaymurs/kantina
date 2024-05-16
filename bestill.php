<?php
session_start();

$page["title"] = "Bestilling";

$page["body"] = function () {
    include_once "backend/submitFunctions.php";
    if (!isset($_GET["row"])) {
    header("Location: index.php");
    die();
    }

    if (isset($_GET["anntall"])) {
        if (!isset($_SESSION["handlekurv"])) $_SESSION["handlekurv"] = [];
        $_SESSION["handlekurv"][] = [
            "meny_id" => $_GET["row"],
            "anntall" => $_GET["anntall"],
        ];
    echo "Bestilling lagt til handlekurven";
    }

    ?>
    <form action="" method="get">
        <input type="hidden" name="row" value="<?php echo $_GET["row"]; ?>">
        <label for="anntall">Antall</label>
        <input type="number" id="anntall" name="anntall" value="1">
        <button type="submit">Bestill</button>
    </form>
<?php };

include('template.php');
