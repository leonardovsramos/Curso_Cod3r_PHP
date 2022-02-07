<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<div class="titulo">Consultar Registros</div>

<?php

require_once("conexao.php");

$sql = "SELECT id, nome, nascimento, email FROM cadastro";

$conexao = novaConexao();
$resultado = $conexao -> query($sql);

$registros = [];

if ($resultado -> num_rows > 0) {
    while($row = $resultado -> fetch_assoc()) {
        $registros[] = $row;
    }
} elseif ($conexao -> error) {
    echo "Erro: " . $conexao -> error;
}

echo "<pre>";
print_r($registros);
echo "</pre>";

$conexao -> close();
?>

<table class="table table-hover table-striped table-bordered">
    <thead>
        <th>Código</th>
        <th>Nome</th>
        <th>Nascimento</th>
        <th>E-mail</th>
    </thead>

    <tbody>
        <?php foreach($registros as $registro): ?>
            <tr>
                <td><?php echo $registro["id"] ?></td>
                <td><?php echo $registro["nome"] ?></td>
                <td><?php echo date("d/m/Y", strtotime($registro["nascimento"])) ?></td>
                <td><?php echo  $registro["email"] ?></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<style>
    table > * {
        font-size: 1.25rem;
    }
</style>