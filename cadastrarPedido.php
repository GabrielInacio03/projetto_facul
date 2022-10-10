<?php
session_start();
require_once 'Templates/header.php';
include_once 'Funcoes/sanitizar.php';
require_once 'banco.php';
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
        <form action="Funcoes/salvarPedido.php" method="post" id="formCadastro" class="row g-3">
          <div class="form-group">
            <input type="hidden" name="id" value="<?php if (isset($_SESSION["form"]["Id"])) echo $_SESSION["form"]["Id"]; ?>" class="form-control">
          </div>
          <div id="divCliente" class="col-md-12">
            <label>Cliente</label>
            <select class="form-select" aria-label="Default select example" name="clientes" id="slctCliente">
              <?php
              require_once 'banco.php';
              $sql = 'SELECT * FROM Cliente WHERE Excluido = 0';
              $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<option value=\"{$row['Id']}\">{$row['Nome']}</option>";
                }
              }
              ?>
            </select>
          </div>
          <div id="itensDoPedido">
          </div>
          <button class="btn btn-primary" id="btnNovoProduto" type="button">Adicionar produto</button>
          <button id="btnSalvar" class="btn btn-success btn-sm" type="button">Salvar</button>
        </form>
      </div>
      <div class=" col-md-3"></div>
    </div>
  </div>
  <input type="hidden" id="PedidoId">
</main>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

    <?php
      $dados = sanitizar($_GET); //Sanitização 
      // var_dump($dados);
      $pedido = 'false';
      if (count($dados) > 0) {
        $pedido = $dados['id'];
        $sql = "SELECT * FROM trabalho.itempedido where idPedido= {$dados['id']}";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo 'let itensPedido = [';
          while ($row = $result->fetch_assoc()) { // output data of each row
            // var_dump($row);
            echo "{id: {$row['IdProduto']} , valorUnitario: '{$row['Qtd']}'} ,"; //``;
          }
          echo '];';
          echo "$(itensPedido).each(( index, value ) => {
            console.log(value);
            NovoItem(value);
          });";
        } 
      } 
      echo "\n var idPedido = {$pedido}; \n"; 
    ?> 
    $("#PedidoId").val(idPedido); 

    // code here<div class="row" id="example-select">
    $('#btnNovoProduto').click(function() {
      NovoItem();
    });

    $('#formCadastro').on("click", ".excluir", function() {
      //$(this).closest('.PedidoItem').remove(); 
      console.log("dsfdf");
      $(this).closest('.PedidoItem').empty();
    });


    $('#btnSalvar').click(function() {

      if ($('#formCadastro').valid()) {

        let arrayitens = [];
        $('.slctProduto').each(function(i, obj) {
          let select = JSON.parse($(obj).find(":selected").attr("data-value"));
          let qtd = $(obj).closest('.PedidoItem').children('.divQtd').children('input').val();
          let item = {
            prodId: select.id,
            valorUn: select.valorUn,
            prodQtd: qtd
          };
          arrayitens.push(item);
        });

        if ($("#PedidoId").val() > 0 ) {
          $.post("Funcoes/atualizarPedido.php", {
            pedidoId: $("#PedidoId").val(),
            clienteId: $('#slctCliente').val(),
            arrayProdutos: arrayitens
          }).done(function(data) {
            console.log(data);
            alert("Pedido Salvo!");
            $('.PedidoItem').remove();
            location.href = 'pedido.php';
          }).fail(function(data) {
            alert(data.statusText);
          });
        } else {
          $.post("Funcoes/salvarPedido.php", {
            clienteId: $('#slctCliente').val(),
            arrayProdutos: arrayitens
          }).done(function(data) {
            console.log(data);
            alert("Pedido Registrado!");
            $('.PedidoItem').remove();
            location.href = 'pedido.php';
          }).fail(function(data) {
            alert(data.statusText);
          });
        }
        atualizarPedido
      }
    });

  });

  function NovoItem(itemObj) {
    let random = Math.floor((Math.random() * 1000) + 1);
    let itemPedido = `
      <div class="row PedidoItem">
        <div class="col-lg-5 col-md-5 divProd">
          <label>Produto</label>
          <select class="form-select slctProduto" aria-label="Default select example" name="produto${random}" id="produto${random}">
            <?php
            // require_once 'banco.php';
            $sql = 'SELECT * FROM Produto WHERE Excluido = 0';
            $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value=\"{$row['Id']}\" data-value='{\"id\": {$row['Id']}, \"valorUn\": {$row['Preco']}}'> {$row['Nome']}</option>";
              }
            }
            ?>
          </select>
        </div>
        <div class="col-lg-6 col-md-6 divQtd">
          <br>
          <label>Quantidade</label>
          <input name="qtd${random}" id="qtd${random}" type="number" value="0"  min="1" >
        </div>
        <div class="col-lg-1 col-md-1">
          <br>
          <button class="btn btn-danger excluir" type="button">Excluir</button>
        </div>
      </div>
    `;

    $('#itensDoPedido').append(itemPedido);
    // $('#divCliente').after(itemPedido);

    if (itemObj) {
      $(`#produto${random}`).val(itemObj.id);
      $(`#qtd${random}`).val(itemObj.valorUnitario);
    }
  }
</script>
<?php
require_once 'Templates/footer.php';
?>