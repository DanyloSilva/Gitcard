<?php

require '../vendor/autoload.php';

$mongo = new MongoDB\Client("mongodb://localhost:27017");
$aa=false;
if(isset($_POST['nome'])){

$_POST['nome']=strtoupper($_POST['nome']);

$db = $mongo->bd2;
$col = $db->pessoa;
$rows = $col->find();
 echo "<center><h1>Resultado de pesquisa de nomes com o '".$_POST['nome']."'</h1></center><hr>";
echo"

  <center>
  <table border = '1'>
  <tr>
    <th>Nome</th>
    <th>Nascimento</th>
    <th>Saldo</th>
  </tr>

 
  
  
  ";
 foreach($rows as $obj){

 $tags = $obj['nome'];
$termo = $_POST['nome'];

$pattern = '/' . $termo . '/';//Padrão a ser encontrado na string $tags
if (preg_match($pattern, $tags)) {
  
echo"
  <tr>
    <td><a href='dados/?cpf=".$obj['cpf']."'>".$obj['nome']."</a></td>
    <td>".$obj['nascimento']."</td>
    <td>R$ ".$obj['saldo']."</td>
  </tr>
  
  ";




} else {
  
}


 
 }


 echo"
 

  </table>

  </center>
  
  
  ";


exit();
}

echo "<center><h1>Lista de pessoas</h1></center><hr>";


$db = $mongo->bd2;
$col = $db->pessoa;
$rows = $col->find();
 



?>

<center>
<form action="?" method="post">
  
  
 
  <label for="valor">Pesquisar por nome:</label>
  <input type="text" id='nome' name="nome">

  <input type="submit" value="buscar">
  
</form>
<table border = "1">
  <tr>
    <th>Nome</th>
    <th>Nascimento</th>
    <th>Saldo</th>
  </tr>
  <?php

  foreach ($rows as $obj) {
  

  echo"
  <tr>
    <td><a href='dados/?cpf=".$obj['cpf']."'>".$obj['nome']."</a></td>
    <td>".$obj['nascimento']."</td>
    <td>R$ ".$obj['saldo']."</td>
  </tr>
  
  ";

}
  ?>
</table>
</center>