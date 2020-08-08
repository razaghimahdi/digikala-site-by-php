<?php
include "connect.php";

$commentcount = 0;//tedad commment hai ke baraye har product sabt shode
$paramcount = 0;//tedad param haie ke har product dare yani hamon progressBar ha

$totalrating = 0;
$ratingpoint=0;



$rating=array();
$hard=array();

$plus=0;




$id = $_POST["id2"];//in aval id boode vaali chon az samt android id2 kardim pas inja ham id2 qarar dadim (BAYAD TEST beshe)
//$id=1;
$query = "SELECT * FROM tbl_product WHERE id=:id";
$res = $connect->prepare($query);
$res->bindParam(":id", $id);
$res->execute();
$pics = array();

while ($row = $res->fetch(PDO::FETCH_ASSOC)) {

    $allcomment=array();

    $comment = array();


    $param = array();//inro baraye rating misazim chon nmidonim chand satr dare

    $record = array();//in arraye tak qesmatie yni agar deqat kni engar ye satr dare
    $record["title"] = $row["title"];
    $record["intro"] = $row["introduction"];
    $record["price"] = $row["price"];


    $record["color"] = $row["colors"];
    $record["gaurantee"] = $row["garantee"];

    $sql = "SELECT * FROM tbl_color WHERE id=:id";//inha niazi b while nadaran chon fqt ye satr bishtar nadaran
    $res2 = $connect->prepare($sql);
    $res2->bindParam(":id", $record["color"]);
    $res2->execute();
    $row2 = $res2->fetch(PDO::FETCH_ASSOC);
    $record["color"] = $row2["title"];


    $sql2 = "SELECT * FROM tbl_garantee WHERE id=:id";
    $res3 = $connect->prepare($sql2);
    $res3->bindParam(":id", $record["gaurantee"]);
    $res3->execute();
    $row3 = $res3->fetch(PDO::FETCH_ASSOC);
    $record["gaurantee"] = $row3["title"];


    $record["cat"] = $row["cat"];
    $sql4 = "SELECT * FROM tbl_comment_param WHERE idcategory=:id";//inha niazi b while nadaran chon fqt ye satr bishtar nadaran
    $res4 = $connect->prepare($sql4);
    $res4->bindParam(":id", $record["cat"]);
    $res4->execute();

    //az while estefade mikonnim chon k qabla har dade ye paramet bood mesle title price desc color garantee , inha harkkodom ye paramet bodan
    // vali aln dg ye paramet nistan va chand ta hastan
    // va kheyli kholase inja andis ma khodesh ye arrayas

    while ($row4 = $res4->fetch(PDO::FETCH_ASSOC)) {
        $param[] = $row4["title"];
    }
    $record["point"] = $param;
    $paramcount = count($record["point"]);


    $sql5 = "SELECT * FROM tbl_comment WHERE idproduct=:id AND confirm=1";
    $res5 = $connect->prepare($sql5);
    $res5->bindParam(":id", $id);
    $res5->execute();
    while ($row5 = $res5->fetch(PDO::FETCH_ASSOC)) {
        $comment[] = unserialize($row5["param"]);
    }


    foreach($comment as $com){

        foreach($com as $score){
            $totalrating=$totalrating+$score;
        }

    }

    for($i=0;$i<$paramcount;$i++){
        $hard[$i]=0;
    }
//print_r($hard);


    //echo $paramcount;
    foreach($comment as $comments){
        foreach($comments as $key=>$value){
            if(isset($hard[$key])){
                $hard[$key]=$hard[$key]+$value;
            }

            //print_r($comments);
        }
    }
    //print_r($hard);


    $record["comment"]=$comment;
    $record["hard"]=$hard;
    $commentcount= count($record["comment"]);



    /*
    $record["comment"] = $comment;
    $commentcount = count($record["comment"]);

    foreach ($comment as $com){
        //ma mikhaym ke arraye haro hey beshkonim ta beresim be adad ha,
        // yni inke ma chnd ta array darim to YEK array
        // ba in kar ma on array ro az beyn bordim va on chand ta array ro keshidim biron

        //print_r($com);

        foreach ($com as $score){
            //hala ke on array asli ro az beyn bordim
            // mimone array hai ke tosh adad hast ba in kar array ro shekastim
            // va adad ro ovordim biron

            //echo  $score;

            $totalrating=$totalrating+$score;
        }
    }
*/

    $ratingpoint = $totalrating/$commentcount;
    $ratingpoint = $ratingpoint/$paramcount;
    $ratingpoint = ($ratingpoint*$paramcount)/4;
    //echo $ratingpoint;

    $record["rating"] = $ratingpoint;



    $pics[] = $record;

}

echo json_encode($pics);
/*echo "<br>";
print_r($pics);*/






