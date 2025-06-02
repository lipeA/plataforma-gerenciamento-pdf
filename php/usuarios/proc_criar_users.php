<?php
session_start();

// Conexão com o banco de dados
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'test';

$conn = new mysqli($host, $user, $pass, $db);

// Verifica a conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Recebendo os dados do formulário
$nome = trim($_POST['nome'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

// Validação básica
if (empty($nome) || empty($email) || empty($senha)) {
    echo "Por favor, preencha todos os campos obrigatórios.";
    exit;
}

// Verifica se o e-mail já existe
$stmt_verifica = $conn->prepare("SELECT id FROM usuarios WHERE email = ?");
$stmt_verifica->bind_param("s", $email);
$stmt_verifica->execute();
$stmt_verifica->store_result();

if ($stmt_verifica->num_rows > 0) {
    echo "<script>
        alert('Este e-mail já está cadastrado.');
        history.back();
    </script>";
    $stmt_verifica->close();
    $conn->close();
    exit;
}
$stmt_verifica->close();

// Criptografando a senha
$senha_hash = password_hash($senha, PASSWORD_DEFAULT);

// Inserindo no banco
$stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
if (!$stmt) {
    die("Erro ao preparar statement: " . $conn->error);
}

$stmt->bind_param("sss", $nome, $email, $senha_hash);
if ($stmt->execute()) {
    echo "<script>
        alert('Usuário criado com sucesso!');
        window.location.href = '../../pages/usuarios/listar.php';
    </script>";
    exit;
} else {
    echo "Erro ao inserir usuário: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
