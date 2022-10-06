<?php                     
    require_once '../banco.php';
    $sql = 'SELECT * FROM Produto WHERE Excluido = 0';
    $result = mysqli_query($conn, $sql); //A query seleciona as linhas da Tabela

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)){
            echo $row['Nome'].'<input class="custom-control-input" name="prod[]" id="prod[]" value="'.$row['Id'].'" type="checkbox">';
        }
    }
?>