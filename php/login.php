<?php
header('Content-Type: text/html; charset=UTF-8');
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
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    // Converte a senha para inteiro
    $password_int = (int)$password;

    // Consulta o banco de dados
    $stmt = $conn->prepare("SELECT id FROM users WHERE userName = ? AND password = ?");
    $stmt->bind_param("si", $login, $password_int);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $_SESSION['usuario'] = $login;
        header('Location: ../pages/painel.php');
        exit;
    } else {
        echo "<script>
            alert('Usuário ou senha incorretos!');
            window.location.href = '../index.html';
        </script>";
        exit;
    }
} else {
    header('Location: ../index.html');
    exit;
}
?>
