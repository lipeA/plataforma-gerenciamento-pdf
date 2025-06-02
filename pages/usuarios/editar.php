<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: index.php');
    exit;
}

// Buscar usuário do banco
$usuario = ['id' => $id, 'nome' => 'Alice Silva', 'email' => 'alice@example.com'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Editar Usuário - Gerenciador de PDF</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f4f7fc;
            color: #333;
            margin: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: #1e40af;
            color: #fff;
            padding: 24px 16px;
            text-align: center;
            box-shadow: 0 2px 8px rgb(30 64 175 / 0.3);
        }
        header h1 {
            font-weight: 600;
            font-size: 1.8rem;
        }
        header p {
            font-weight: 400;
            opacity: 0.85;
            margin-top: 6px;
        }
        main {
            flex: 1;
            max-width: 600px;
            width: 100%;
            margin: 32px auto;
            background: #fff;
            padding: 32px 24px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgb(0 0 0 / 0.07);
        }
        h2 {
            color: #1e40af;
            font-weight: 600;
            margin-bottom: 24px;
            border-bottom: 3px solid #3b82f6;
            padding-bottom: 8px;
        }
        form {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #374151;
        }
        input[type="text"], input[type="email"] {
            padding: 10px;
            border: 2px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
        }
        button {
            padding: 14px 0;
            background-color: #3b82f6;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            color: white;
            font-size: 1.1rem;
            cursor: pointer;
            box-shadow: 0 6px 18px rgb(59 130 246 / 0.4);
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #2563eb;
        }
        .back-link {
            display: inline-block;
            margin-top: 24px;
            color: #1e40af;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.3s ease;
        }
        .back-link:hover {
            color: #3b82f6;
        }
    </style>
</head>
<body>

<header>
    <h1>Gerenciador de PDF</h1>
    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
</header>

<main>
    <h2>Editar Usuário</h2>
    <form action="editar_action.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($usuario['id']); ?>" />

        <label for="nome">Nome Completo</label>
        <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required />

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required />

        <button type="submit">Salvar Alterações</button>
    </form>

    <a href="../painel.php" class="back-link">← Voltar à lista de usuários</a>
</main>

</body>
</html>
