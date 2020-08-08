<?php
include "connect.php";

$query = "SELECT * FROM tbl_category";
$res = $connect->prepare($query);
$res->execute();
$cats = array();
$picurl = array();
$title = array();
$id = array();

while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $title[] = $row["title"];
    $picurl[] = $row["picurl"];
    $id[] = $row["id"];
}

$cats["title"] = $title;
$cats["picurl"] = $picurl;
$cats["id"] = $id;



echo json_encode($cats);
//print_r($cats);

