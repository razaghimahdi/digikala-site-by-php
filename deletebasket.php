<?php

include "connect.php";
$id = $_POST["id"];
$email = $_POST["email"];

$query4 = "DELETE FROM tbl_basket WHERE id = :id";
$res4 = $connect->prepare($query4);
$res4->bindParam(":id", $id);
$res4->execute();


$basket = array();
$record = array();

$query="SELECT * FROM tbl_basket WHERE cookie=:email ";
$result=$connect->prepare($query);
$result->bindParam(":email",$email);
$result->execute();

while($row=$result->fetch(PDO::FETCH_ASSOC)){
    $record["count"] = $row["tedad"];
    $id = $row["idproduct"];
    $record["idbasket"] = $row["id"];

    $query2="SELECT * FROM tbl_product WHERE id=:id ";
    $res2=$connect->prepare($query2);
    $res2->bindParam(":id",$id);
    $res2->execute();
    $row2=$res2->fetch(PDO::FETCH_ASSOC);

    $record["title"] = $row2["title"];
    $record["color"] = $row2["colors"];
    $record["gaurantee"] = $row2["garantee"];
    $record["price"] = $row2["price"];
    $record["finalprice"] = $record["price"]*$record["count"];


    $query3="SELECT * FROM tbl_gallery WHERE idproduct=:id ";
    $res3=$connect->prepare($query3);
    $res3->bindParam(":id",$id);
    $res3->execute();
    $row3=$res3->fetch(PDO::FETCH_ASSOC);

    $record["img"] = $row3["img"];

    $basket[]=$record;


}

echo json_encode($basket);
