<?php
include "connect.php";
$query = "SELECT * FROM tbl_product WHERE special=1 LIMIT 5";
$res = $connect->prepare($query);
$res->execute();
$products = array();

while ($row = $res->fetch(PDO::FETCH_ASSOC)) {//میخوایم که ستون های تیبل product  رو بریزیم تو ارایه ای به اسم products و چون تعداد زیادی داده داریم از حلقه استفاده میکنیم
    $record = array();
    $record["id"] = $row["id"];
    $record["title"] = $row["title"];
    $record["price"] = $row["price"];
    $record["pprice"] = $row["prevprice"];


    $sql = "SELECT * FROM tbl_gallery WHERE idproduct = :id";//میخوایم که عکس وسایل رو هم قرار بدیم ولی عکسا توی تیبل دیگه ای هستن پس باید idproduct  رو با id داده ی ای که میخوایم نشون بدیم بچسبونیم
    $res2 = $connect->prepare($sql);
    $res2->bindParam(":id", $record["id"]);//چون نمیدونیم اون ایدی که قراره برابر کنیم کدومه پس از با استفاده از bindparam بهم میچسبونیمش
    $res2->execute();
    $row2 = $res2->fetch(PDO::FETCH_ASSOC);
    $record["pic"]=$row2["img"];

    $products[] = $record;

}

echo  json_encode($products);