<?php
session_start();
include_once 'sanitizar.php';
require_once '../banco.php';
//Sanitização dos dados do Formulário
$dadosform =  $_POST; //sanitizar($_POST);

echo "cliente";
print_r($_POST['clienteId']);
echo "\n";
echo "\n";
echo "produtos";
print_r($_POST['arrayProdutos']);

$errovalidacao = false;
//Aplicar a Validação dos Dados segundo as regras de negócio

// if(empty($dadosform['clienteId']) || empty($dadosform['arrayProdutos']) ){
//   // $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos.</div>';
//   // $_SESSION['erropreco'] = 'Este campo deve ser preemchido';
//   $errovalidacao = true;
// }

// if (isset($_SESSION['form'])){
//   unset($_SESSION['form']); //Limpa os dados do formulário se guardados anteriormente
// }

// if ($errovalidacao){  //Houve erro na validacao
//   //Guarda os dados do POST na Session para reapresentar os dados
//   $_SESSION['form'] = $dadosform;
//   header("Location:../cadastrarPedido.php"); //Retorna ao Formulário
//   die();//Isso é necessário senão ele vai continuar e cadastrar o produto!!!
// }

//Altera a codificação de caracteres para utf8

if (empty($dadosform['clienteId']) || empty($dadosform['arrayProdutos'])) {
  // $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos.</div>';
  // $_SESSION['erropreco'] = 'Este campo deve ser preemchido';
  // $errovalidacao = true;
  header("HTTP/1.1 500 Lista de compras vazia!"); 
  die();
}


if (isset($dadosform['id'])) {
  $id = $dadosform['id'];
} else {
  $id = 0;
}


$conn->set_charset("utf8");
$sql = "INSERT INTO pedido(IdCliente, Total, Excluido) VALUES('{$dadosform['clienteId']}','0', '0')";
// $result = mysqli_query($conn, $sql); 
if ($conn->query($sql) === TRUE) {
  $pedidoId = $conn->insert_id;
  echo "New record created successfully. Last inserted ID is: " . $pedidoId;
}
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


  if ($id == 0) {
    $sql = "INSERT INTO itempedido( IdPedido, IdProduto, ValorUnitario, Qtd, Excluido) 
      VALUES('$item->IdPedido','$item->prodId','$item->valorUn','$item->prodQtd', '0')";
    $conn->query($sql);
    // $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

    // if(mysqli_affected_rows($conn) != 0){
    //   $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produto Cadastrado com Sucesso.</div>';
    // }else{
    //   $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar Produto no Banco!</div>';
    // } 
    // }

    //Retorna ao Formulário para mostrar a mensagem de Sucesso ou Erro
    // header("Location:../cadastrarPedido.php");
  }
}


$sql = "SELECT SUM(Qtd) as Total FROM trabalho.itempedido where idPedido = $pedidoId";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {// output data of each row
    $total = $row["Total"];
  }
}

echo "TOTAL DA COMPRA $total";

$sql = "UPDATE trabalho.pedido SET Total = $total WHERE id=$pedidoId";
$conn->query($sql);

 

$conn->close(); //Fecha a conexão com o Banco


  //else{
  
  //   $sql = "UPDATE Produto SET nome='".$dadosform["nome"]."',descricao='".$dadosform["descricao"]."',preco='".$dadosform["preco"]."' WHERE id='".$id."'";
  //   $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
    
  //   if(mysqli_affected_rows($conn) != 0){
  //     $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produtoo editado com Sucesso.</div>';
  //   }else{
  //     $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao editar Pedido no Banco!</div>';
  //   }
    
  //   $conn->close(); //Fecha a conexão com o Banco
  //   echo $id;
  //   //Retorna ao Formulário para mostrar a mensagem de Sucesso ou Erro
  //   header("Location:../cadastrarPedido.php");
  // }
