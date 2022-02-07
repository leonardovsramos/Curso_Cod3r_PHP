<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<div class="titulo">Excluir Registros #02</div>

<?php

require_once("conexao.php");

$conexao = novaConexao();
$registros = [];

if (isset($_GET["excluir"]) && $_GET["excluir"]) {
    $excluirSQL = "DELETE FROM cadastro WHERE id = ?";
    $stmt = $conexao -> prepare($excluirSQL);
    $stmt -> bind_param("i", $_GET["excluir"]);
    $stmt -> execute();
}

$sql = "SELECT id, nome, nascimento, email FROM cadastro";

$resultado = $conexao -> query($sql);

if ($resultado -> num_rows > 0) {
    echo "Conexão Bem Sucedida!";
    while ($row = $resultado -> fetch_assoc()) {
        $registros[] = $row;
    }
} elseif ($conexao -> error) {
    echo "Erro: " . $conexao -> error;
}

$conexao -> close();
?>

<table class="table table-hover table-bordered">
    <thead>
        <th>ID</th>
        <th>Nome</th>
        <th>Nascimento</th>
        <th>E-mail</th>
        <th>Acões</th>
    </thead>

    <tbody>
        <?php foreach($registros as $registro): ?>
            <tr>
                <td><?php echo $registro["id"] ?></td>
                <td><?php echo $registro["nome"] ?></td>
                <td>
                    <?php
                        echo date("d/m/Y", strtotime($registro["nascimento"])) 
                    ?>
                </td>
                <td><?php echo  $registro["email"] ?></td>
                <td>
                    <a href="/exercicio.php?dir=db&file=excluir_2&excluir=<?php echo $registro["id"]?>" class="btn btn-danger">
                        Excluir
                    </a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>


<style>
    table > * {
        font-size: 1.25rem;
    }
</style>