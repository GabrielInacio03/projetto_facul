function ClicarAqui(){
    event.preventDefault(event)
    alert("Chegou");

       
        var table = $('#lista');
        var linha = $('<div class="col-md-12" >');

        var produto = $('<div class="col-md-9">').html(
            "<label>Produto</label>"+"<select class='form-select' aria-label='Default select example' name='produtos'>"+
            +"<?php "+
                +"require_once 'banco.php';"+
                +"$sql = 'SELECT * FROM Produto WHERE Excluido = 0';"+
                +"$result = mysqli_query($conn, $sql);"+
                +"if (mysqli_num_rows($result) > 0) {"+
                    +"while ($row = mysqli_fetch_assoc($result)){"+
                        +"echo '<option>'.$row['Nome'].'</option>';"+
                    +"}"+
                +"}"+
            +"?>"+
            "</select> "
        );
        var qtd = $('<div class="col-md-2">').html("<input type='number' class='form-control'  name='qtd'>");


        console.log(produto);
        linha.append(produto);
        linha.append(qtd);        

        table.append(linha);

        console.log(linha);
}


