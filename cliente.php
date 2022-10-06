<?php
    require_once 'Templates/header.php';
?>

<main role="main" class="flex-shrink-0">
  <div class="container">
    <br>
    <a href="cadastrarCliente.php" class="btn btn-success">Novo</a>
    <br>
    <h1 class="mt-2">Listagem de Clientes</h1>
    <?php
        require_once 'banco.php';
        $sql = 'SELECT * FROM Cliente WHERE Excluido = 0';
        $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="table-responsive">';
            echo '  <table class="table table-bordered table-hover table-sm">';
            echo '    <thead >';
            echo '      <tr style="background-color: #bee5eb;">';
            echo '        <th class="info">Id</th>';
            echo '        <th class="info">Nome</th>';
            echo '        <th class="info">Telefone</th>';
            echo '        <th class="info">Email</th>'; 
            echo '        <th class="info"></th>';
            echo '        <th class="info"></th>';
            echo '      </tr>';
            echo '    </thead>';
            echo '    <tbody>';
            while ($row = mysqli_fetch_assoc($result)){
              echo '<tr>'; 
              echo '  <td>'.$row['Id'].'</td>';
              echo '  <td>'.$row['Nome'].'</td>';
              echo '  <td>'.$row['Telefone'].'</td>';
              echo '  <td>'.$row['Email'].'</td>';
              echo	'	<td>	<a	href="editarCliente.php?id='.$row['Id'].'"	class="btn	btn-info	btn-sm">Editar</a>';
              echo	'	<td>	<a	href="Funcoes/excluirCliente.php?id='.$row['Id'].'"	class="btn	btn-info	btn-sm">Excluir</a>';
              echo '</tr>';
    
            }
            echo '    </tbody>';
            echo '  </table>';
            echo '</div>';
          }else {
            echo "Nenhum Cliente Encontrado.";
          }
    
    ?>      

  </div>
</main>

<?php
require_once 'Templates/footer.php';
