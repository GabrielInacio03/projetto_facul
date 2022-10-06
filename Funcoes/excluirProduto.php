<?php
  session_start();
  include_once 'sanitizar.php';

 $dados = sanitizar($_GET); //Sanitização 
 $idproduto = $dados['id'];


  require_once '../banco.php';

  $sql = "UPDATE Produto SET Excluido = 1 WHERE id={$idproduto}";
  $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela


  header("Location:../produto.php");

 


