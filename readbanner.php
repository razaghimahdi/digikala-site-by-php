<?php

include "connect.php";
$query = "SELECT * FROM tbl_banner";
$res = $connect->prepare($query);
$res->execute();
$products = array();

while ($row = $res->fetch(PDO::FETCH_ASSOC)) {//میخوایم که ستون های تیبل product  رو بریزیم تو ارایه ای به اسم products و چون تعداد زیادی داده داریم از حلقه استفاده میکنیم
    $record = array();
    $record["id"] = $row["id"];
    $record["pic"] = $row["name"];

    $products[] = $record;
}

echo  json_encode($products);