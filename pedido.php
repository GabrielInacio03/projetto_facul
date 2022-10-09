<?php
    require_once 'Templates/header.php';
?>
<main role="main" class="flex-shrink-0">
  <div class="container">
    <br>
    <a href="cadastrarPedido.php" class="btn btn-success">Novo</a>
    <br>
    <h1 class="mt-2">Listagem de Pedidos</h1>
    <?php
        require_once 'banco.php';
        $sql = 'SELECT pedido.id, cliente.nome, pedido.total FROM pedido
        inner join cliente on
        cliente.id = pedido.IdCliente
        WHERE pedido.Excluido = 0';
        $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
        
        if (mysqli_num_rows($result) > 0) {
            echo '<div class="table-responsive">';
            echo '  <table class="table table-bordered table-hover table-sm">';
            echo '    <thead >';
            echo '      <tr style="background-color: #bee5eb;">';
            echo '        <th class="info">Id do Pedido</th>';
            echo '        <th class="info">Nome do Cliente</th>';
            echo '        <th class="info">Total</th>';  
            echo '        <th class="info"></th>';
            echo '      </tr>';
            echo '    </thead>';
            echo '    <tbody>'; 
            while ($row = mysqli_fetch_assoc($result)){
              echo '<tr>'; 
              echo '  <td>'.$row['id'].'</td>';
              echo '  <td>'.$row['nome'].'</td>';
              echo '  <td>'.$row['total'].'</td>'; 
              echo	'	<td>	<a	href="editarPedido.php?id='.$row['id'].'"	class="btn	btn-info	btn-sm">Editar</a>
              <a	href="Funcoes/excluirPedido.php?id='.$row['id'].'"	class="btn	btn-info	btn-sm">Excluir</a>';              
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

<script type="text/javascript">
 $('#formCadastro').on("click", ".excluir", function() {
      //$(this).closest('.PedidoItem').remove(); 
      console.log("dsfdf");
      $(this).closest('.PedidoItem').empty();
    });
</script>

<?php
require_once 'Templates/footer.php';
?>