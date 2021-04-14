
<?php
require '../../vendor/autoload.php';

echo "<center><h1>Lista dos cartoes do cpf ".$_GET['cpf']."</h1></center><hr>";

$mongo = new MongoDB\Client("mongodb://localhost:27017");


$db = $mongo->bd2;
$col = $db->card;
$rows = $col->find();
$rows = $col->find(array('cpf_uso' => $_GET['cpf']));
  echo"
  <center>
  <table border = '1'>
         
        <tr>
        <th>Codigo</th>
        <th>Valor</th>
        </tr>
      
  
  
  ";
foreach ($rows as $obj) {
echo"

<tr>
            <td>".$obj['codigo']."</td>
            <td>".$obj['valor']."</td>
         </tr>


";
//var_dump($obj);

}

?>
</table>

</center>