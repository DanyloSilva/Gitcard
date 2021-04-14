<?php
if(isset($_POST['cpf'])){
if($_POST['cpf']==""||$_POST['nome']==""||$_POST['dt']==""){
echo"<center><p style='color:red'>Algo está em branco</p></center>";
echo'<meta http-equiv="refresh" content="15">';
exit();
}



require '../vendor/autoload.php';
$client = new MongoDB\Client("mongodb://localhost:27017");


$collection = $client->bd2->pessoa;

$db = $client->bd2;
$col = $db->pessoa;
$rows = $col->find();
$rows = $col->find(array('cpf' => $_POST['cpf']));
  
foreach ($rows as $obj) {

echo"<center><p style='color:red'>esse cpf ja esta cadastrado</p></center>";
exit();
  
}

$_POST['nome']=strtoupper($_POST['nome']);
        
       
        $result = $collection->insertOne([
    'nome' => $_POST['nome'],
    'cpf' => $_POST['cpf'],
    'nascimento' =>$_POST['dt'],
    'saldo'=>0
]);

echo"<center><p style='color:red'>Algo FOI CADASTRADO</p></center>";
exit();
}
echo "<center><h1>Cadastrar Pessoa</h1></center><hr>";

?>
<center>
<script type="text/javascript" src="js/jquery-1.2.6.pack.js"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.1.4.pack.js"/></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#cpf").mask("999.999.999-99");
		$("#dt").mask("99/99/9999");
	});
</script>

<form action="?" method="post">
  
  
  <label for="autor">CPF:</label><br>
  <input type="text" id='cpf'  name="cpf"><br>
  <label for="valor">Nome:</label><br>
  <input type="text"  name="nome"><br>
  <label for="valor">Data de nascimento:</label><br>
  <input type="text" id='dt' name="dt">
  <br><br><br>
  <input type="submit" value="Criar pessoa">
  
</form>

</center>