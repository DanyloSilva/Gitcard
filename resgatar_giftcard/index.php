<?php
if(isset($_POST['cpf'])){
if($_POST['cpf']==""||$_POST['code']==""){
echo"<center><p style='color:red'>Algo está em branco</p></center>";
echo'<meta http-equiv="refresh" content="15">';
exit();
}



require '../vendor/autoload.php';

$mongo = new MongoDB\Client("mongodb://localhost:27017");

//var_dump($_POST);echo'<hr>';
        
$db = $mongo->bd2;
$col = $db->pessoa;
$rows = $col->find();
$rows = $col->find(array('cpf' => $_POST['cpf']));
  $d=false;
foreach ($rows as $obj) {
$saldo_atual=$obj['saldo'];
$d=true;
}

if(!$d){
echo"<center><p style='color:red'>Essa pessoa não está cadastrada!</p></center>";
echo'<meta http-equiv="refresh" content="15">';
exit();
}

$db = $mongo->bd2;
$col = $db->card;
$rows = $col->find();
$rows = $col->find(array('codigo' => $_POST['code']));
  
foreach ($rows as $obj) {
//echo $obj['codigo'];

if($obj['cpf_uso']==0){

$saldo_atual=$saldo_atual+$obj['valor'];
$time=time();
$collection = $mongo->bd2->card;     
  $updateResult = $collection->updateOne(
[ 'codigo' => $obj['codigo'] ],
[ '$set' => [ 'cpf_uso' => $_POST['cpf'],'data_uso'=>$time ]]
);

$collection = $mongo->bd2->pessoa;     
  $updateResult = $collection->updateOne(
[ 'cpf' => $_POST['cpf'] ],
[ '$set' => [ 'saldo' => $saldo_atual ]]
);

echo"<center><p style='color:red'>GIFTCARD RESGATADO</p></center>";
echo'<meta http-equiv="refresh" content="15">';
exit();


}else{
echo"<center><p style='color:red'>Esse codigo já foi usado</p></center>";
echo'<meta http-equiv="refresh" content="15">';
exit();

}
exit();

}


   exit();    
 
}
echo "<center><h1>Resgatar Codigo</h1></center><hr>";

?>
<center>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"/></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cpf").mask("999.999.999-99");
	});
</script>

<form action="?" method="post">
  
  
  <label for="autor">CPF:</label><br>
  <input type="text" id='cpf'  name="cpf"><br>
  <label for="valor">Codigo:</label><br>
  <input type="text" id='code' name="code">
  <br><br><br>
  <input type="submit" value="Resgatar">
  
</form>

</center>