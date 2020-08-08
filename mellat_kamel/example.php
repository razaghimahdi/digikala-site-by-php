<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>

</head>

<body>
	
	
<?php
include "all.php";
$mellat=new mellat();
$refid=$mellat->bpPay(1000);
//echo $refid;

?>

<script>

function pay(refid){

    var form = document.createElement("form");
    form.setAttribute("method", "POST");
    form.setAttribute("action", "https://bpm.shaparak.ir/pgwchannel/startpay.mellat");
    form.setAttribute("target", "_self");
    var hiddenField = document.createElement("input");
    hiddenField.setAttribute("name", "RefId");
    hiddenField.setAttribute("value",refid);
    form.appendChild(hiddenField);
    document.body.appendChild(form);
    form.submit();
  document.body.removeChild(form);
}
pay("<?php echo $refid; ?>");
</script>
	
	</body>
</html>