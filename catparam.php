<?php
include "connect.php";

$cat = $_POST["id"];
//$cat =4;

$cats = array();
$all = array();



$query = "SELECT * FROM tbl_cat_param WHERE cat=:cat";
$res = $connect->prepare($query);
$res->bindParam(":cat", $cat);
$res->execute();

while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $cats[] = $row["title"];
}

$all["title"]=$cats;

echo json_encode($all);

