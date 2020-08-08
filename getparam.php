<?php
include "connect.php";
$id = $_POST["id"];
//$id = 1;

$cat="";
$all=array();

$query="SELECT * FROM tbl_product WHERE id=:id ";
$res=$connect->prepare($query);
$res->bindParam(":id",$id);
$res->execute();

while($row=$res->fetch(PDO::FETCH_ASSOC)){
    $cat = $row["cat"];
}


$query2="SELECT * FROM tbl_comment_param WHERE idcategory=:cat ";
$res2=$connect->prepare($query2);
$res2->bindParam(":cat",$cat);
$res2->execute();

$paramtitle = array();

while($row2=$res2->fetch(PDO::FETCH_ASSOC)){
    $paramtitle[] = $row2["title"];
}

$all["title"] = $paramtitle;

echo json_encode($all);