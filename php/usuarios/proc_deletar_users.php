<?php
session_start();

if (!isset($_GET['id'])) {
    echo "ID do usuário não fornecido.";
    exit;
}

$id = intval($_GET['id']);

// Conexão com o banco
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'test';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Excluir usuário
$stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Usuário excluído com sucesso.'); window.location.href = '../../pages/usuarios/listar.php';</script>";
} else {
    echo "Erro ao excluir: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
