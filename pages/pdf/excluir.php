<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
    exit;
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header('Location: ../index.php');
    exit;
}

// Aqui buscar info do PDF para mostrar na confirmação, por exemplo nome do arquivo
$pdf = ['nome' => 'Documento A.pdf'];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Excluir PDF - Gerenciador de PDF</title>
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
            max-width: 480px;
            margin: 32px auto;
            background: #fff;
            padding: 32px 24px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgb(0 0 0 / 0.07);
            text-align: center;
        }
        h2 {
            color: #ef4444;
            font-weight: 700;
            margin-bottom: 24px;
            border-bottom: 3px solid #ef4444;
            padding-bottom: 8px;
        }
        p {
            font-size: 1.1rem;
            margin-bottom: 32px;
            color: #555;
        }
        form {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        button {
            padding: 14px 32px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            border: none;
            box-shadow: 0 6px 18px rgb(239 68 68 / 0.4);
            transition: background-color 0.3s ease;
        }
        .btn-confirm {
            background-color: #ef4444;
            color: white;
        }
        .btn-confirm:hover {
            background-color: #b91c1c;
        }
        .btn-cancel {
            background-color: #cbd5e1;
            color: #333;
        }
        .btn-cancel:hover {
            background-color: #94a3b8;
            color: white;
        }
        a.back-link {
            display: inline-block;
            margin-top: 24px;
            color: #1e40af;
            text-decoration: none;
            font-weight: 600;
            font-size: 1rem;
            transition: color 0.3s ease;
        }
        a.back-link:hover {
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
    <h2>Confirmar Exclusão</h2>
    <p>Tem certeza que deseja excluir o arquivo <strong><?php echo htmlspecialchars($pdf['nome']); ?></strong>?</p>

    <form action="excluir_action.php" method="POST">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>" />
        <button type="submit" class="btn-confirm">Sim, Excluir</button>
        <a href="../pdfs/visualizar.php" class="btn-cancel">Cancelar</a>
    </form>
</main>

</body>
</html>
S