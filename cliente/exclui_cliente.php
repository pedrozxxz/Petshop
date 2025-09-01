<?php
$pdo = new PDO("mysql:host=localhost;dbname=db_petshop;charset=utf8", "root", "");
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$id = $_GET['id'] ?? null;

if ($id) {
    try {
        // 1️⃣ Excluir agendamentos dos animais do cliente
        $stmt = $pdo->prepare("
            DELETE ag
            FROM agendamentos ag
            JOIN animais a ON ag.id_animal = a.id_animal
            WHERE a.id_cliente = ?
        ");
        $stmt->execute([$id]);

        // 2️⃣ Excluir animais do cliente
        $stmt = $pdo->prepare("DELETE FROM animais WHERE id_cliente=?");
        $stmt->execute([$id]);

        // 3️⃣ Excluir cliente
        $stmt = $pdo->prepare("DELETE FROM clientes WHERE id_cliente=?");
        $stmt->execute([$id]);

    } catch (PDOException $e) {
        die("Erro ao excluir cliente e dependências: " . $e->getMessage());
    }
}

header("Location: consulta_cliente.php");
exit;
?>