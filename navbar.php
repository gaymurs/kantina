<a href="index.php">Home</a>
<?php
include_once "backend/getFromDatabase.php";
$tables = getFromDatabase::tables();

foreach ($tables as $table) {
    $uppercase = ucfirst(str_replace(["-","_"], " ", $table));

    echo "<a href='table.php?table=$table'>$uppercase</a>";
    // for some reason this is required to make a margin between the links (without css because i am lazy)
    echo "\n";
}
echo "<a href='handlekurv.php'>Handlekurv</a>";
?>