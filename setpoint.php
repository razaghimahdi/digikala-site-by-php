<?php
include "connect.php";

$param = $_POST["parameter"];
$email = $_POST["user"];
$id = $_POST["id"];
//echo $param;
$ser = (explode(",", $param));
$comment= serialize($ser);
//echo serialize($ser)." ".$user."  ".$id;

$user = "";
$confirm = 0;

$query = "SELECT * FROM tbl_user WHERE email=:email";
$res=$connect->prepare($query);
$res->bindParam(":email",$email);
$res->execute();

while($row=$res->fetch(PDO::FETCH_ASSOC)){
    $user = $row["id"];
}

$query2 = "INSERT INTO tbl_comment (idproduct, param, user, confirm) VALUES (:id, :param, :user, :confirm)";
$res2 = $connect-> prepare($query2);
$res2->bindParam(":id", $id);
$res2->bindParam(":param", $comment);
$res2->bindParam(":user", $user);
$res2->bindParam(":confirm", $confirm);
$res2->execute();

echo "نظر شما با موفقیت ثبت شد.";

