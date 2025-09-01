<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");

// buscar clientes
$clientes = $pdo->query("SELECT id_cliente, nome FROM clientes ORDER BY nome")->fetchAll(PDO::FETCH_ASSOC);

// buscar animais
$animais = $pdo->query("SELECT a.id_animal, a.nome AS animal, c.id_cliente, c.nome AS dono 
                        FROM animais a 
                        JOIN clientes c ON a.id_cliente = c.id_cliente 
                        ORDER BY c.nome, a.nome")->fetchAll(PDO::FETCH_ASSOC);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $procedimento = $_POST['procedimento'];
    $data_hora = $_POST['data_hora'];
    $id_cliente = $_POST['id_cliente'];
    $id_animal = $_POST['id_animal'];
    $observacoes = $_POST['observacoes'];

    // valida se o animal realmente pertence ao cliente escolhido
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM animais WHERE id_animal=? AND id_cliente=?");
    $stmt->execute([$id_animal, $id_cliente]);
    if ($stmt->fetchColumn() == 0) {
        die("⚠ O animal não pertence ao cliente selecionado!");
    }

    $stmt = $pdo->prepare("INSERT INTO agendamentos (procedimento, data_hora, id_animal, observacoes) VALUES (?, ?, ?, ?)");
    $stmt->execute([$procedimento, $data_hora, $id_animal, $observacoes]);

    header("Location: consulta_agenda.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Adicionar Agendamento</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<header><h1>Adicionar Agendamento</h1></header>
<nav class="navbar">
  <a href="consulta_agenda.php">Voltar</a>
</nav>
<div class="container">
  <form method="post">
    <label>Procedimento:</label>
    <input type="text" name="procedimento" required>

    <label>Data e Hora:</label>
    <input type="datetime-local" name="data_hora" required>

    <label>Dono:</label>
    <select name="id_cliente" required>
      <option value="">-- Selecione o dono --</option>
      <?php foreach ($clientes as $c): ?>
        <option value="<?= $c['id_cliente'] ?>"><?= htmlspecialchars($c['nome']) ?></option>
      <?php endforeach; ?>
    </select>

    <label>Animal:</label>
    <select name="id_animal" required>
      <option value="">-- Selecione o animal --</option>
      <?php foreach ($animais as $a): ?>
        <option value="<?= $a['id_animal'] ?>"><?= htmlspecialchars($a['animal']) ?> (<?= htmlspecialchars($a['dono']) ?>)</option>
      <?php endforeach; ?>
    </select>

    <label>Observações:</label>
    <textarea name="observacoes" placeholder="Ex.: cliente pediu corte especial, cuidado com alergia..."></textarea>

    <button type="submit">Salvar</button>
  </form>
</div>
</body>
</html>