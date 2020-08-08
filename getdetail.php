<?php
include "connect.php";
$id = $_POST["id2"];//in aval id boode vaali chon az samt android id2 kardim pas inja ham id2 qarar dadim (BAYAD TEST beshe)
$query = "SELECT * FROM tbl_gallery WHERE idproduct=:id";
$res = $connect->prepare($query);
$res->bindParam(":id", $id);
$res->execute();
$pics = array();

while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
    $record = array();
    $record["pic"] = $row["img"];
    $pics[] = $record;

}

echo json_encode($pics);


