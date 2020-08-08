<?php
include "connect.php";
$email=$_POST["email"];
$count=0;
$tedad=0;

$query="SELECT * FROM tbl_basket WHERE cookie=:email ";
$result=$connect->prepare($query);
$result->bindParam(":email",$email);
$result->execute();

while($row=$result->fetch(PDO::FETCH_ASSOC)){
    if($row==false){
        echo "";
    }else{
        $tedad=$row["tedad"];
        $count=$count+$tedad;
        //echo $count;

    }

}

echo $count;

