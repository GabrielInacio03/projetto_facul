<?php
  session_start();
  include_once 'Funcoes/sanitizar.php';

 $dados = sanitizar($_GET); //Sanitização 
 $idcliente = $dados['id'];


  require_once 'banco.php';

  $sql = "SELECT * FROM Cliente WHERE id={$idcliente}";
  $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

  if(mysqli_affected_rows($conn) != 1){ 
    die('Falha ao recuperar dados do cliente');
  }

  $cliente = mysqli_fetch_assoc($result);

  $_SESSION['form'] = $cliente; 
  
  header("Location:cadastrarCliente.php");

 


