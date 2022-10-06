<?php
session_start();
require_once 'Templates/header.php';
?>


  <main role="main" class="flex-shrink-0">
    <div class="container">        
      <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
          <h1 class="mt-2">Cadastro de Cliente</h1>
          <?php //Mensagens de Erro ou Sucesso na execução das funções              
            if(isset($_SESSION['msg'])){
              echo $_SESSION["msg"];
              unset($_SESSION["msg"]);
            }

            
          ?>                    
          <form action="Funcoes/salvarCliente.php" method="post" id="formCadastro">
            <div class="form-group">
                <input type="hidden" name="id"  value="<?php if (isset($_SESSION["form"]["Id"])) echo $_SESSION["form"]["Id"]; ?>" class="form-control">
            </div>
            <div class="form-group">
              <label for="nome">Nome</label>
              <input type="text" class="form-control"  name="nome" value="<?php if (isset($_SESSION["form"]["Nome"])) echo $_SESSION["form"]["Nome"]; ?>" required>
            </div>
            <div class="form-group">
              <label for="telefone">Telefone</label>
              <input type="text" class="form-control"  name="telefone" value="<?php if (isset($_SESSION["form"]["Telefone"])) echo $_SESSION["form"]["Telefone"]; ?>" required>
            </div>
            <div class="form-group">
              <label for="email">E-mail</label>
              <input type="text" class="form-control <?php if (isset($_SESSION["Email"])) echo 'is-invalid'; ?>" name="email" value="<?php if (isset($_SESSION["form"]["Email"])) echo $_SESSION["form"]["Email"]; ?>">             
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
