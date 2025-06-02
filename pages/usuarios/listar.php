<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
    exit;
}

// Simulando usuários cadastrados (substitua por busca no banco real)
$usuarios = [
    ['id' => 1, 'nome' => 'Alice Silva', 'email' => 'alice@example.com'],
    ['id' => 2, 'nome' => 'Bruno Costa', 'email' => 'bruno@example.com'],
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Gerenciar Usuários - Gerenciador de PDF</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f4f7fc;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #1e40af;
            color: white;
            padding: 24px 16px;
            text-align: center;
        }
        main {
            max-width: 720px;
            margin: 32px auto;
            padding: 0 16px;
        }
        h2 {
            color: #1e40af;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 8px;
        }
        .usuario-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            padding: 16px 20px;
            margin-bottom: 16px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.05);
        }
        .usuario-info {
            flex-grow: 1;
        }
        .usuario-nome {
            font-weight: 600;
            font-size: 1.1rem;
            color: #1e3a8a;
        }
        .usuario-email {
            font-size: 0.95rem;
            color: #4b5563;
        }
        .usuario-acoes {
            display: flex;
            gap: 12px;
        }
        .btn {
            padding: 8px 12px;
            font-weight: 600;
            font-size: 0.95rem;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s ease;
            text-decoration: none;
            display: inline-block;
        }
        .btn-editar {
            background-color: #3b82f6;
            color: white;
        }
        .btn-editar:hover {
            background-color: #2563eb;
        }
        .btn-excluir {
            background-color: #ef4444;
            color: white;
        }
        .btn-excluir:hover {
            background-color: #dc2626;
        }
        .new-user-link, .back-link {
            display: inline-block;
            margin: 24px 0 12px;
            color: #1e40af;
            font-weight: 600;
            text-decoration: none;
            font-size: 1rem;
        }
        .new-user-link:hover, .back-link:hover {
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
    <h2>Usuários</h2>
    <a href="criar.php" class="new-user-link">+ Novo Usuário</a>

    <?php if (count($usuarios) > 0): ?>
        <?php foreach ($usuarios as $user): ?>
            <div class="usuario-card">
                <div class="usuario-info">
                    <div class="usuario-nome"><?php echo htmlspecialchars($user['nome']); ?></div>
                    <div class="usuario-email"><?php echo htmlspecialchars($user['email']); ?></div>
                </div>
                <div class="usuario-acoes">
                    <a href="editar.php?id=<?php echo urlencode($user['id']); ?>" class="btn btn-editar">Editar</a>
                    <a href="excluir.php?id=<?php echo urlencode($user['id']); ?>" class="btn btn-excluir">Excluir</a>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Nenhum usuário cadastrado.</p>
    <?php endif; ?>

    <a href="../painel.php" class="back-link">← Voltar ao Painel</a>
</main>

</body>
</html>
