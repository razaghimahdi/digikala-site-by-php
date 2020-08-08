<?php
include "connect.php";

$id = $_POST["id"];
//$id = 1;
//echo "your id is: ".$id;

$sql = "SELECT * FROM tbl_product WHERE id=:id";
$res = $connect->prepare($sql);
$res->bindParam(":id", $id);
$res->execute();
$fanni = array();

while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

    $record = array();
    $proid=array();
    $protitle=array();
    $provalue=array();
    $val=array();

    $record["title"] = $row["title"];
    $record["cat"] = $row["cat"];

    /*  echo $row["title"];
      echo "<br>";
      echo $row["cat"];*/

}

$query = "SELECT * FROM tbl_attr WHERE idcategory=:cat";
$res2 = $connect->prepare($query);
$res2->bindParam(":cat", $record["cat"]);
$res2->execute();

while ($row2 = $res2->fetch(PDO::FETCH_ASSOC)) {

    $proid[]=$row2["id"];
    $protitle[]=$row2["title"];

}


foreach ($proid as $key=>$value){

    $query2="SELECT * FROM tbl_product_attr WHERE idproduct=:id AND idattr=:idattr";
    $res3=$connect->prepare($query2);
    $res3->bindParam(":id",$id);
    $res3->bindParam(":idattr",$value);
    $res3->execute();

    while($row3=$res3->fetch(PDO::FETCH_ASSOC)){
        $provalue[]=$row3["idval"];
    }
}


foreach ($provalue as $key=>$value){

    $query4="SELECT * FROM tbl_attr_val WHERE id=:provalue";
    $res4=$connect->prepare($query4);
    $res4->bindParam(":provalue",$value);
    $res4->execute();

    while($row4=$res4->fetch(PDO::FETCH_ASSOC)){
        $val[]=$row4["val"];
    }
}

/*
print_r($provalue);
print_r($val);
*/
/*
print_r($proid);
print_r($protitle);
print_r($record);
print_r($fanni);
*/



//$record["proid"]=$proid;
$record["protitle"]=$protitle;
$record["val"]=$val;

$fanni[]=$record;

//print_r($fanni);


echo json_encode($fanni);


