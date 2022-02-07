<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<div class="titulo">Inserir Registro #02</div>

<?php 
if(count($_POST) > 0) {
    $dados = $_POST;
    $erros = [];

    if(trim($dados["nome"]) === "") {
        $erros['nome'] = 'Nome é obrigatório';
    }

    if(isset($dados["nascimento"])) {
        $data = DateTime::createFromFormat(
            'd/m/Y', $dados['nascimento']);
            if(!$data) {
            $erros['nascimento'] = 'Data deve estar no padrão dd/mm/aaaa';
        }
    }

    if(!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
        $erros['email'] = 'Email inválido';
    }

    if (!filter_var($dados['site'], FILTER_VALIDATE_URL)) {
        $erros['site'] = 'Site inválido';
    }

    $filhosConfig = [
        "options" => ["min_range" => 0, "max_range" => 20]
    ];
    if (!filter_var($dados['filhos'], FILTER_VALIDATE_INT,
        $filhosConfig) && $dados['filhos'] != 0) {
        $erros['filhos'] = 'Quantidade de filhos inválida (0-20).';
    }

    $salarioConfig = ['options' => ['decimal' => ',']];
    if (!filter_var($dados['salario'],
        FILTER_VALIDATE_FLOAT, $salarioConfig)) {
        $erros['salario'] = 'Salário inválido';
    }

    if (count($erros) == 0) {
        require_once("conexao.php");

        $sql = "INSERT INTO cadastro 
        (nome, nascimento, email, site, filhos, salario)
        VALUES (?, ?, ?, ?, ?, ?)";

        $conexao = novaConexao();
        $stmt = $conexao -> prepare($sql);

        $params = [
            $dados["nome"],
            $data ? $data -> format("Y-m-d") : NULL,
            $dados["email"],
            $dados["site"],
            $dados["filhos"],
            $dados["salario"] ? str_replace(",", ".", $dados["salario"]) : NULL
        ];

        $stmt -> bind_param("ssssid", ...$params);
        $insert = $stmt -> execute();

        if ($insert) {
            unset($dados);
        }
    }
}
?>

<form action="#" method="post">
    <div class="form-row">
        <div class="form-group col-md-8">
            <label for="nome">Nome</label>
            <input type="text" 
                class="form-control <?php echo $erros['nome'] ? 'is-invalid' : ''?>"
                id="nome" name="nome" placeholder="Nome"
                value="<?php isset($dados["nome"]) ? $dados["nome"] : "" ?>">

            <div class="invalid-feedback">
                <?php echo $erros['nome'] ?>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label for="nascimento">Nascimento</label>
            <input type="text"
                class="form-control <?php echo $erros['nascimento'] ? 'is-invalid' : ''?>"
                id="nascimento" name="nascimento"
                placeholder="Nascimento"
                value="<?php isset($dados["nascimento"]) ? $dados["nascimento"] : "" ?>">
            <div class="invalid-feedback">
                <?php echo $erros['nascimento'] ?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="email">E-mail</label>
            <input type="text"
                class="form-control <?php echo $erros['email'] ? 'is-invalid' : ''?>"
                id="email" name="email" placeholder="E-mail"
                value="<?php isset($dados["email"]) ? $dados["email"] : "" ?>">
            <div class="invalid-feedback">
                <?php echo $erros['email'] ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="site">Site</label>
            <input type="text"
                class="form-control <?php echo $erros['site'] ? 'is-invalid' : ''?>"
                id="site" name="site" placeholder="Site"
                value="<?php isset($dados["site"]) ? $dados["site"] : "" ?>">
            <div class="invalid-feedback">
                <?php echo $erros['site'] ?>
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="filhos">Qtde de Filhos</label>
            <input type="number" 
                class="form-control <?php echo $erros['filhos'] ? 'is-invalid' : ''?>"
                id="filhos" name="filhos"
                placeholder="Qtde de Filhos"
                value="<?php isset($dados["filhos"]) ? $dados["filhos"] : "" ?>">
            <div class="invalid-feedback">
                <?php echo $erros['filhos'] ?>
            </div>
        </div>
        <div class="form-group col-md-6">
            <label for="salario">Salário</label>
            <input type="text"
                class="form-control <?php echo $erros['salario'] ? 'is-invalid' : ''?>"
                id="salario" name="salario"
                placeholder="Salário"
                value="<?php isset($dados["salario"]) ? $dados["salario"] : "" ?>">
            <div class="invalid-feedback">
                <?php echo $erros['salario'] ?>
            </div>
        </div>
    </div>
    <button class="btn btn-primary btn-lg">Enviar</button>
</form>