<?php
  session_start();
  include_once 'sanitizar.php';

 $dados = sanitizar($_GET); //Sanitização 
 $idPedido = $dados['id'];
  require_once '../banco.php';


  $sql = "UPDATE Pedido SET Excluido = 1 WHERE id={$idPedido}";
  $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

  header("Location:../pedido.php");

?> 


