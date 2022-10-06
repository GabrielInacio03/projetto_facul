<?php
    require_once 'Templates/header.php';
?>
<main role="main" class="flex-shrink-0">
  <div class="container">
    <br>
    <a href="cadastrarPedido.php" class="btn btn-success">Novo</a>
    <br>
    <h1 class="mt-2">Listagem de Produtos</h1>
    <?php
        require_once 'banco.php';
        $sql = 'SELECT * FROM Produto WHERE Excluido = 0';
        $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="table-responsive">';
            echo '  <table class="table table-bordered table-hover table-sm">';
            echo '    <thead >';
            echo '      <tr style="background-color: #bee5eb;">';
            echo '        <th class="info">Id</th>';
            echo '        <th class="info">Nome</th>';
            echo '        <th class="info">Descrição</th>';
            echo '        <th class="info">Preço</th>'; 
            echo '        <th class="info"></th>';
            echo '      </tr>';
            echo '    </thead>';
            echo '    <tbody>';
            while ($row = mysqli_fetch_assoc($result)){
              echo '<tr>'; 
              echo '  <td>'.$row['Id'].'</td>';
              echo '  <td>'.$row['Nome'].'</td>';
              echo '  <td>'.$row['Descricao'].'</td>';
              echo '  <td>R$'.$row['Preco'].'</td>';
              echo	'	<td>	<a	href="editarProduto.php?id='.$row['Id'].'"	class="btn	btn-info	btn-sm">Editar</a>
              <a	href="Funcoes/excluirProduto.php?id='.$row['Id'].'"	class="btn	btn-info	btn-sm">Excluir</a>';              
              echo '</tr>';
    
            }
            echo '    </tbody>';
            echo '  </table>';
            echo '</div>';
          }else {
            echo "Nenhum Produto Encontrado.";
          }
    
    ?>      

  </div>
</main>
<?php
require_once 'Templates/footer.php';