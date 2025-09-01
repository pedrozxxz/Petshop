<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// Join para trazer dono do animal
$sql = "SELECT a.id_animal, a.nome AS animal, a.raca, c.nome AS dono
        FROM animais a
        JOIN clientes c ON a.id_cliente = c.id_cliente
        ORDER BY a.id_animal";
$stmt = $pdo->query($sql);
$animais = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Animais</title>
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
  <h1>Animais Cadastrados 🐾</h1>
</header>
<div class="container">
  <a class="btn" style="background:#16a34a" href="adiciona_animal.php">+ Adicionar Animal</a>
  <table class="table">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Raça</th>
      <th>Dono</th>
      <th>Ações</th>
    </tr>
    <?php foreach ($animais as $a): ?>
      <tr>
        <td><?= htmlspecialchars($a['id_animal']) ?></td>
        <td><?= htmlspecialchars($a['animal']) ?></td>
        <td><?= htmlspecialchars($a['raca']) ?></td>
        <td><?= htmlspecialchars($a['dono']) ?></td>
        <td>
          <a class="btn" href="edita_animal.php?id=<?= $a['id_animal'] ?>">Editar</a>
          <a class="btn" style="background:#dc2626" 
             href="exclui_animal.php?id=<?= $a['id_animal'] ?>" 
             onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </table>
</div>
</body>
</html>