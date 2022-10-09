<?php
session_start();
include_once 'sanitizar.php';
require_once '../banco.php';
//Sanitização dos dados do Formulário
$dadosform =  $_POST; //sanitizar($_POST);
 
print_r($dadosform['pedidoId']);

$errovalidacao = false;
//Aplicar a Validação dos Dados segundo as regras de negócio
   
//Altera a codificação de caracteres para utf8


if (empty($dadosform['pedidoId']) ||
empty($dadosform['clienteId']) || empty($dadosform['arrayProdutos'])) {
  // $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos.</div>';
  // $_SESSION['erropreco'] = 'Este campo deve ser preemchido';
  // $errovalidacao = true;
  header("HTTP/1.1 500 Lista de compras vazia!"); 
  die();
}

$conn->autocommit(FALSE);

$conn->set_charset("utf8");

$sql = "DELETE FROM trabalho.itempedido WHERE idPedido = {$dadosform['pedidoId']}";

$conn->query($sql);

$pedidoId = $dadosform['pedidoId'];
// $last_id = mysqli_insert_id($conn); 

mysqli_affected_rows($conn);
// $conn->autocommit(FALSE);
// $conn->commit();
//Fecha a conexão com o Banco

class ItemPedido
{
  // Properties
  public $IdPedido;
  public $prodId;
  public $valorUn;
  public $prodQtd;
}

foreach ($dadosform['arrayProdutos'] as $arr) {
  // var_dump($arr);

  $item =  new ItemPedido();
  $item->IdPedido = $pedidoId;
  $item->prodId = $arr["prodId"];
  $item->valorUn = $arr["valorUn"];
  $item->prodQtd = $arr["prodQtd"];
 
  var_dump($item);

 
  $sql = "INSERT INTO itempedido( IdPedido, IdProduto, ValorUnitario, Qtd, Excluido) 
    VALUES('$item->IdPedido','$item->prodId','$item->valorUn','$item->prodQtd', '0')";
  $conn->query($sql);  
}


$sql = "SELECT SUM(ValorUnitario*Qtd) as Total FROM trabalho.itempedido where idPedido = $pedidoId";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {// output data of each row
    $total = $row["Total"];
  }
}

echo "TOTAL DA COMPRA $total";

$sql = "UPDATE trabalho.pedido SET Total = $total WHERE id=$pedidoId";
$conn->query($sql);

 

$conn->commit();  
$conn->close(); //Fecha a conexão com o Banco
