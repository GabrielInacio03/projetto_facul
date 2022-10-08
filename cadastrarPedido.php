<?php
session_start();
require_once 'Templates/header.php';
?>


<script src="assets/js/jquery.js"></script>
<script src="assets/js/pedido.js"></script>
<main role="main" class="flex-shrink-0">
  <div class="container">
    <div class="row">
      <div class="col-md-3"></div>
      <div class="col-md-12">
        <h1 class="mt-2">Cadastro de Pedido</h1>
        <?php //Mensagens de Erro ou Sucesso na execução das funções              
        if (isset($_SESSION['msg'])) {
          echo $_SESSION["msg"];
          unset($_SESSION["msg"]);
        }


        ?>
        <form method="post" id="formCadastro" class="row g-3">
          <div class="form-group">
            <input type="hidden" name="id" value="<?php if (isset($_SESSION["form"]["Id"])) echo $_SESSION["form"]["Id"]; ?>" class="form-control">
          </div>
          <div id="divCliente" class="col-md-12">
            <label>Cliente</label>
            <select class="form-select" aria-label="Default select example" name="clientes" id="">
              <?php
              require_once 'banco.php';
              $sql = 'SELECT * FROM Cliente WHERE Excluido = 0';
              $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option>' . $row['Nome'] . '</option>';
                }
              }
              ?>
            </select>
          </div>
          
          <button class="btn btn-primary" id="btnNovoProduto" type="button">Adicionar produto</button>
          <button type="submit" class="btn btn-success btn-sm">Salvar</button>
        </form>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
</main>
<script type="text/javascript">
  <?php
  require_once 'banco.php';
  $sql = 'SELECT * FROM Produto WHERE Excluido = 0';
  $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
  echo 'var produtos = [';
  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      echo "{id: {$row['Id']} , nome: '{$row['Nome']}'} ,"; //``;
    }
  }
  echo '];';
  ?>
  $(document).ready(function() {
    // code here<div class="row" id="example-select">
    $('#btnNovoProduto').click(function() {
      NovoItem();
    });

    $('#formCadastro').on("click", ".excluir", function() {
      //$(this).closest('.PedidoItem').remove(); 
      console.log("dsfdf");
      $(this).closest('.PedidoItem').empty(); 
    });

    $('.PedidoItem').on('click', '.excluir', function () {
      console.log("caiu no segundo exemplo");
      $(this).remove(); 
    });
    
    $('.collection').on('click', '.material-icons', function () {
      console.log("aaaaaaaa");
      $(this).closest('.collection-item').remove(); 
    });
  });
  
  function NovoItem() { 
    var itemPedido = `
      <div class="row PedidoItem">
        <div class="col-lg-7 col-md-7">
          <label>Produto</label>
          <select class="form-select" aria-label="Default select example" name="produto" id="">
            <?php
              require_once 'banco.php';
              $sql = 'SELECT * FROM Produto WHERE Excluido = 0';
              $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value=\"{$row['Id']}\"> {$row['Nome']}</option>";
                }
              }
            ?>
          </select>
        </div>
        <div class="col-lg-4 col-md-4">
          <br>
          <label>Quantidade</label>
          <input name="" id="" type="number" value="0">
        </div>
        <div class="col-lg-1 col-md-1">
          <br>
          <button class="btn btn-danger excluir" type="button">Excluir</button>
        </div>
      </div>
    `;
    $('#divCliente').append(itemPedido);
  }

  console.log(produtos);
</script>
<?php
require_once 'Templates/footer.php';
?>