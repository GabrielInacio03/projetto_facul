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
            if(isset($_SESSION['msg'])){
              echo $_SESSION["msg"];
              unset($_SESSION["msg"]);
            }

            
          ?>                    
          <form  method="post" id="formCadastro"  class="row g-3">
            <div class="form-group">
                <input type="hidden" name="id"  value="<?php if (isset($_SESSION["form"]["Id"])) echo $_SESSION["form"]["Id"]; ?>" class="form-control">
            </div>
            <div class="col-md-12">
                <label>Cliente</label>
                <select class="form-select" aria-label="Default select example" name="clientes" id="" >
                    <?php 
                    
                    require_once 'banco.php';
                    $sql = 'SELECT * FROM Cliente WHERE Excluido = 0';
                    $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)){
                            echo '<option>'.$row['Nome'].'</option>';
                        }
                    }
                    ?>
                </select>
            </div>  
            <div id="example-select">
              <select multiple name="native-select" placeholder="Native Select" data-search="false" data-silent-initial-value-set="true">
                  <?php 
                      
                    require_once 'banco.php';
                    $sql = 'SELECT * FROM Produto WHERE Excluido = 0';
                    $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela
    
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)){
                          echo '<input type="checkbox" id="" >'.$row['Nome'].'</option>';
                        }
                    }
                  ?>
              </select>
            </div>

            <div class="col-md-1">
                <br>
                <button class="btn btn-success btn-sm" id="mais" onclick="ClicarAqui()">+</button>
                <button class="btn btn-danger btn-sm" id="menos">-</button>
            </div>    
            
            <button type="submit" class="btn btn-success btn-sm">Salvar</button>
          </form>
        </div>
        <div class=" col-md-3"></div>
      </div>      
    </div>
  </main>
 
  <script type="text/javascript">
    VirtualSelect.init({ 
      ele: 'select' ,
      multiple: true

    });
  </script>
<?php
require_once 'Templates/footer.php';
