<?php

  session_start();
  include_once 'sanitizar.php';
  require_once '../banco.php';
  //Sanitização dos dados do Formulário
  $dadosform =  $_POST;//sanitizar($_POST);
    
  $errovalidacao = false;
  //Aplicar a Validação dos Dados segundo as regras de negócio
  if(empty($dadosform['nome']) || empty($dadosform['descricao']) || empty($dadosform['preco'])){
    $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Verifique os Campos em Vermelho.</div>';
    $_SESSION['erropreco'] = 'Este campo deve ser preemchido';
    $errovalidacao = true;
  }
   
  if (isset($_SESSION['form'])){
    unset($_SESSION['form']); //Limpa os dados do formulário se guardados anteriormente
  }
  
  if ($errovalidacao){  //Houve erro na validacao
    //Guarda os dados do POST na Session para reapresentar os dados
    $_SESSION['form'] = $dadosform;
    header("Location:../cadastrarProduto.php"); //Retorna ao Formulário
    die();//Isso é necessário senão ele vai continuar e cadastrar o produto!!!
  }

  //Altera a codificação de caracteres para utf8
  $conn -> set_charset("utf8");
  
  $nome = $dadosform["nome"]; 
  $descricao = $dadosform["descricao"];
  $preco = $dadosform["preco"];  
  $excluido = 0;  

  if(isset($dadosform['id']))
    $id = $dadosform['id'];
  else
    $id = 0;

  print_r($dadosform);
  
  if($id == 0){
    $sql = "INSERT INTO Produto(nome,descricao,preco,excluido) VALUES('$nome','$descricao','$preco','$excluido')";  
    $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
    
    if(mysqli_affected_rows($conn) != 0){
      $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produto Cadastrado com Sucesso.</div>';
    }else{
      $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao cadastrar Produto no Banco!</div>';
    }
    
    $conn->close(); //Fecha a conexão com o Banco
    
    //Retorna ao Formulário para mostrar a mensagem de Sucesso ou Erro
    header("Location:../cadastrarProduto.php");
  } else{
  
    $sql = "UPDATE Produto SET nome='".$dadosform["nome"]."',descricao='".$dadosform["descricao"]."',preco='".$dadosform["preco"]."' WHERE id='".$id."'";
    $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
    
    if(mysqli_affected_rows($conn) != 0){
      $_SESSION['msg'] = '<div class="alert alert-success" role="alert">Produtoo editado com Sucesso.</div>';
    }else{
      $_SESSION['msg'] = '<div class="alert alert-danger" role="alert">Erro ao editar Produto no Banco!</div>';
    }
    
    $conn->close(); //Fecha a conexão com o Banco
    echo $id;
    //Retorna ao Formulário para mostrar a mensagem de Sucesso ou Erro
    header("Location:../cadastrarProduto.php");
  }
  

  
