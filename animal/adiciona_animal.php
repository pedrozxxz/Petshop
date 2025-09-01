<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// buscar clientes para escolher dono
$clientes = $pdo->query("SELECT id_cliente, nome FROM clientes ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $raca = $_POST['raca'];
    $id_cliente = $_POST['id_cliente'];

    $stmt = $pdo->prepare("INSERT INTO animais (nome, raca, id_cliente) VALUES (?, ?, ?)");
    $stmt->execute([$nome, $raca, $id_cliente]);

    header("Location: consulta_animal.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Animal</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header><h1>Adicionar Animal</h1></header>
<nav class="navbar">
  <a href="consulta_animal.php">Voltar</a>
</nav>
<div class="container">
  <form method="post">
    <label>Nome:</label>
    <input type="text" name="nome" required>
    <label>Raça:</label>
    <input type="text" name="raca" required>
    <label>Dono:</label>
    <select name="id_cliente" required>
      <option value="">-- Selecione --</option>
      <?php foreach ($clientes as $c): ?>
        <option value="<?= $c['id_cliente'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
      <?php endforeach; ?>
    </select>
    <button type="submit">Salvar</button>
  </form>
</div>
</body>
</html>