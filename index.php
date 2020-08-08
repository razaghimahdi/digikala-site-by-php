<?php

include "connect.php";

$email=$_POST["email"];
$pass=$_POST["pass"];

$query="SELECT * FROM tbl_user WHERE email=:email AND password=:pass";//in 2noqte ha baraye inke iz PDO estefadeh krdim va PDO amniat code haro mibare bala va baad in ke 2noqte mizarim majborim ke on haro bind knim
$result = $connect->prepare($query);//vli aval query ra amade mikonim
$result->bindParam(":email",$email);//baad bayad bind knim va behesh befahmonim ke $email hamoon emaile
$result->bindParam(":pass",$pass);
$result->execute();
$row=$result->fetch(PDO::FETCH_ASSOC);//baad inke ma result ro ejra krdim hala bayad on ro bekhonim ba estefadeh az FETCH_ASSOC
if ($row==false){
    echo "not exist";
}else{
    echo $row["email"];
}

