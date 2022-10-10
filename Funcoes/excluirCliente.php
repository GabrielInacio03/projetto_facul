<?php
  session_start();
  include_once 'sanitizar.php';

 $dados = sanitizar($_GET); //Sanitização 
 $idcliente = $dados['id'];


  require_once '../banco.php';

  $sql = "UPDATE Cliente SET Excluido = 1 WHERE id={$idcliente}";
  $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela


  header("Location:../cliente.php");

?>


