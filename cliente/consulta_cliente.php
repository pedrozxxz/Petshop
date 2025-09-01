<?php
// Conexão
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// Busca clientes
$stmt = $pdo->query("SELECT * FROM clientes ORDER BY id_cliente");
$clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Clientes</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header>
    <nav class="navbar">
      <a href="../cliente/consulta_cliente.php">Clientes</a>
      <a href="../animal/consulta_animal.php">Animais</a>
      <a href="../agendamento/consulta_agenda.php">Agendamentos</a>
      <a href="../index.php">Início</a>
    </nav>
  <h1>Clientes Cadastrados 🐾</h1>
</header>
<div class="container">
  <a class="btn" style="background:#16a34a" href="adiciona_cliente.php">+ Adicionar Cliente</a>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>CPF</th>
      <th>Endereço</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($clientes as $c): ?>
      <tr>
        <td><?= htmlspecialchars($c['id_cliente']) ?></td>
        <td><?= htmlspecialchars($c['nome']) ?></td>
        <td><?= htmlspecialchars($c['cpf']) ?></td>
        <td><?= htmlspecialchars($c['endereco']) ?></td>
        <td>
          <a class="btn" href="edita_cliente.php?id=<?= $c['id_cliente'] ?>">Editar</a>
          <a class="btn" style="background:#dc2626" 
             href="exclui_cliente.php?id=<?= $c['id_cliente'] ?>" 
             onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>