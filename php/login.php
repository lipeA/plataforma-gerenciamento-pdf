<?php
session_start();

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'test';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $senha = trim($_POST['password'] ?? '');

    if (empty($login) || empty($senha)) {
        echo "<script>alert('Preencha todos os campos.'); window.location.href = '../index.html';</script>";
        exit;
    }

    $stmt = $conn->prepare("SELECT id FROM usuarios WHERE nome = ? AND senha = ?");
    $stmt->bind_param("ss", $login, $senha);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $_SESSION['usuario'] = $login;
        header('Location: ../pages/painel.php');
        exit;
    } else {
        echo "<script>alert('Usuário ou senha incorretos!'); window.location.href = '../index.html';</script>";
        exit;
    }
} else {
    header('Location: ../index.html');
    exit;
}
?>
