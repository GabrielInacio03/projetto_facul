<?php
      //Credenciais para conexão com o Banco
      $dbhost = 'localhost:3306';
      $dbuser = 'root';
      $dbpass = 'root';
      $dbname = 'trabalho';
      
      //Abre conexão com o MySQL   
      $conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   
      if(!$conn ){
        die('Falha ao conectar com o MySQL: ' . mysqli_connect_error());
      }
     // echo '<br>Conexão ao Banco realizada com Sucesso.';

      
    ?>      

