<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];

    $stmt = $pdo->prepare("INSERT INTO clientes (nome, cpf, endereco, telefone, email) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nome, $cpf, $endereco, $telefone, $email]);

    header("Location: consulta_cliente.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Cliente</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header><h1>Adicionar Cliente</h1></header>
<nav class="navbar">
  <a href="consulta_cliente.php">Voltar</a>
</nav>
<div class="container">
  <form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" required>

    <label>CPF:</label>
    <input type="text" name="cpf" placeholder="000.000.000-00" required>

    <label>Endereço:</label>
    <textarea name="endereco" required></textarea>

    <label>Telefone:</label>
    <input type="text" name="telefone" placeholder="(00) 90000-0000">

    <label>Email:</label>
    <input type="email" name="email" placeholder="exemplo@email.com">

    <button type="submit">Salvar</button>
  </form>
</div>
</body>
</html>