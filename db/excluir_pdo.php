<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

<div class="titulo">PDO: Excluir</div>

<?php 

require_once "conexao_pdo.php";

$conexao = novaConexao();

$sql = "SELECT id, nome, nascimento, email FROM cadastro";

$stmt = $conexao -> prepare($sql);

if ($stmt -> execute()) {
    $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($resultado);
    echo "</pre>";
} else {
    echo "Código: " . $stmt -> errorCode() . "<br>";

    echo "<pre>";
    print_r($stmt -> errorInfo());
    echo "</pre>";
}

$conexao = NULL;

?>


<table class="table table-hover table-striped table-bordered">
    <thead>
        <th>Código</th>
        <th>Nome</th>
        <th>Nascimento</th>
        <th>E-mail</th>
    </thead>

    <tbody>
        <?php foreach($resultado as $index): ?>
            <?php foreach ($index as $chave => $valor): ?>
                <tr>
                    <td><?php echo $chave ?></td>
                    <td><?php echo $chave ?></td>
                    <td><?php echo date("d/m/Y", strtotime($registro["nascimento"])) ?></td>
                    <td><?php echo  $registro["email"] ?></td>
                </tr>
            <?php endforeach ?>
        <?php endforeach ?>
    </tbody>
</table>

<style>
    table > * {
        font-size: 1.25rem;
    }
</style>