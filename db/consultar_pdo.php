<div class="titulo">PDO: Consultar</div>

<?php

require_once "conexao_pdo.php";

$conexao = novaConexao();

$sql = "SELECT * FROM cadastro";

// PDO::FETCH_NUM
// PDO::FETCH_ASSOC
// PDO::FETCH_CLASS
// PDO::FETCH_BOTH
$resultado = $conexao -> query($sql) -> fetchAll(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($resultado);
echo "</pre>";

echo "<hr>";

$sql = "SELECT * FROM cadastro LIMIT :qtde OFFSET :inicio";
// $sql = "SELECT * FROM cadastro LIMIT ? OFFSET ?";

$stmt = $conexao -> prepare($sql);
$stmt -> bindValue(":qtde", 2, PDO::PARAM_INT);
$stmt -> bindValue(":inicio", 3, PDO::PARAM_INT);

// echo "<pre>";
// print_r(get_class_methods($stmt));
// echo "</pre>";

if ($stmt -> execute()) {
    $resultado = $stmt -> fetchAll(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($resultado);
    echo "<pre>";
} else {
    echo "Código: " . $stmt -> errorCode() . "<br>";

    echo "<pre>";
    print_r($stmt -> errorInfo());
    echo "</pre>";
}

echo "<hr>";

$sql = "SELECT * FROM cadastro WHERE id = :id";
$stmt = $conexao -> prepare($sql);

// if ($stmt -> execute([1])) {


// if ($stmt -> execute()) 
//$stmt -> bindValue(":id", 2, PDO::PARAM_INT);


if ($stmt -> execute([":id" => 2])) {
    $resultado = $stmt -> fetch(PDO::FETCH_ASSOC);

    echo "<pre>";
    print_r($resultado);
    echo "<pre>";
} else {
    echo "Código: " . $stmt -> errorCode() . "<br>";

    echo "<pre>";
    print_r($stmt -> errorInfo());
    echo "</pre>";
}

$conexao = NULL;

?>