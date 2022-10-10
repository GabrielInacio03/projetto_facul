<?php
  session_start();
  include_once 'Funcoes/sanitizar.php';

 $dados = sanitizar($_GET); //Sanitização 
 $idproduto = $dados['id'];


  require_once 'banco.php';

  $sql = "SELECT * FROM pedido WHERE id={$idproduto}";
  $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

  if(mysqli_affected_rows($conn) != 1){ 
    die('Falha ao recuperar dados do produto');
  }

  $cliente = mysqli_fetch_assoc($result);

  $_SESSION['form'] = $cliente; 
  
  header("Location:cadastrarProduto.php");

 


