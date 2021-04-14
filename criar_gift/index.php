
<?php

require '../vendor/autoload.php';

if(isset($_POST['autor'])){
	
$mongo = new MongoDB\Client("mongodb://localhost:27017");

$db = $mongo->bd2;
$col = $db->card;
$rows = $col->find();
$rows = $col->find(array('codigo' => $_POST['gift']));
  
foreach ($rows as $obj) {
	
	echo"<center><p style='color:red'>esse codigo já existe,vou recarregar pra gerar um novo!</p></center>";
  echo'<meta http-equiv="refresh" content="15">';
  exit();
}

if($_POST['valor']<1){
	
	echo'esse valor tá estranho';
  echo'<meta http-equiv="refresh" content="15">';
	exit();
}

$client = new MongoDB\Client("mongodb://localhost:27017");

	$collection = $client->bd2->card;


$time=time();
        
       
        $result = $collection->insertOne([
    'codigo' => $_POST['gift'],
	'autor' =>$_POST['autor'],
	'valor'=>$_POST['valor'],
	'ativacao'=>0,
	'ativado_por'=>0,
	'data_ativacao'=>0,
	'data_uso'=>0,
	'cpf_uso'=>0,
	'data_criacao'=>$time
]);
	
	echo "<center><h1>GIFT CRIADO</h1></center><hr>
	<center><p style='color:red'>".$_POST['gift']."</p></center>
	";

	
	exit();
}


echo "<center><h1>Criar giftcard</h1></center><hr>";


$letras="ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$a1=$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)];
$a2=$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)];
$a3=$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)];
$a4=$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)].$letras[rand(0,strlen($letras)-1)];
$gift=$a1.'-'.$a2.'-'.$a3.'-'.$a4;


$mongo = new MongoDB\Client("mongodb://localhost:27017");

$db = $mongo->bd2;
$col = $db->card;
$rows = $col->find();
$rows = $col->find(array('codigo' => "$gift"));
  
foreach ($rows as $obj) {
	echo'esse codigo já existe,vou recarregar pra gerar um novo!';
  echo'<meta http-equiv="refresh" content="5">';
  
}


?>

<center>
<form action="?" method="post">
  <label for="autor">Autor:</label><br>
  <input type="text" value='Sistema' name="autor"><br>
  <label for="valor">Valor(R$):</label><br>
  <input type="text" value='150' name="valor"><br>
  <label for="valor">Codigo:</label><br>
  <input type="text" value='<?php echo  $gift;?>' name="gift">
  <br><br><br>
  <input type="submit" value="Criar gift">
  
</form>

</center>