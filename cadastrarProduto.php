<?php
session_start();
require_once 'Templates/header.php';
?>


  <main role="main" class="flex-shrink-0">
    <div class="container">        
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <h1 class="mt-2">Cadastro de Produto</h1>
          <?php //Mensagens de Erro ou Sucesso na execução das funções              
            if(isset($_SESSION['msg'])){
              echo $_SESSION["msg"];
              unset($_SESSION["msg"]);
            }

            
          ?>                    
          <form action="Funcoes/salvarProduto.php" method="post" id="formCadastro">
            <div class="form-group">
                <input type="hidden" name="id"  value="<?php if (isset($_SESSION["form"]["Id"])) echo $_SESSION["form"]["Id"]; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" class="form-control"  name="nome" value="<?php if (isset($_SESSION["form"]["Nome"])) echo $_SESSION["form"]["Nome"]; ?>" required>
            </div>
            <div class="form-group">
              <label for="descricao">Descrição</label>
              <input type="text" class="form-control"  name="descricao" value="<?php if (isset($_SESSION["form"]["Descricao"])) echo $_SESSION["form"]["Descricao"]; ?>" required>
            </div>
            <div class="form-group">
              <label for="preco">Preço</label>
              <input type="text" class="form-control <?php if (isset($_SESSION["Preco"])) echo 'is-invalid'; ?>" name="preco" value="<?php if (isset($_SESSION["form"]["Preco"])) echo $_SESSION["form"]["Preco"]; ?>">             
            </div>
           
            <button type="submit" class="btn btn-success btn-sm">Salvar</button>
          </form>
        </div>
        <div class=" col-md-3"></div>
      </div>      
    </div>
  </main>

<?php
require_once 'Templates/footer.php';
