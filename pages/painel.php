<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('Location: ../index.html');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Painel de Controle - Gerenciador de PDF</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
    <style>
        /* Reset básico */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f4f7fc;
            color: #333;
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
            margin-bottom: 6px;
        }
        header p {
            font-size: 1rem;
            font-weight: 400;
            opacity: 0.85;
        }

        main {
            flex: 1;
            max-width: 960px;
            margin: 32px auto;
            padding: 0 16px 48px;
            display: flex;
            flex-wrap: wrap;
            gap: 24px;
            justify-content: center;
        }

        .card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgb(0 0 0 / 0.05);
            padding: 24px;
            width: 280px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }
        .card:hover {
            transform: translateY(-6px);
            box-shadow: 0 10px 30px rgb(30 64 175 / 0.2);
        }

        .card h2 {
            font-weight: 600;
            font-size: 1.3rem;
            color: #1e40af;
            border-bottom: 2px solid #3b82f6;
            padding-bottom: 6px;
        }

        ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 8px;
        }

        ul li a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 16px;
            background-color: #e0e7ff;
            border-radius: 8px;
            color: #1e40af;
            font-weight: 500;
            text-decoration: none;
            box-shadow: 0 2px 6px rgb(59 130 246 / 0.2);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-size: 1rem;
        }
        ul li a:hover {
            background-color: #3b82f6;
            color: #fff;
            box-shadow: 0 6px 15px rgb(59 130 246 / 0.35);
        }

        /* Ícones simples com SVG inline */
        svg {
            width: 20px;
            height: 20px;
            fill: currentColor;
            flex-shrink: 0;
        }

        .logout {
            max-width: 960px;
            margin: 0 auto 40px;
            padding: 12px 24px;
            display: block;
            width: fit-content;
            background-color: #ef4444;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            text-decoration: none;
            box-shadow: 0 4px 14px rgb(239 68 68 / 0.4);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .logout:hover {
            background-color: #b91c1c;
            box-shadow: 0 6px 20px rgb(185 28 28 / 0.6);
        }

        /* Responsivo */
        @media (max-width: 650px) {
            main {
                flex-direction: column;
                align-items: center;
            }
            .card {
                width: 100%;
                max-width: 400px;
            }
        }
    </style>
</head>
<body>
    <header>
        <h1>Gerenciador de PDF</h1>
        <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario']); ?>!</p>
    </header>

    <main>
        <section class="card" aria-labelledby="usuarios-title">
            <h2 id="usuarios-title">Usuários</h2>
            <ul>
                <li>
                    <a href="usuarios/criar.php" aria-label="Criar Usuário">
                        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path d="M19 11h-6V5h-2v6H5v2h6v6h2v-6h6z"/>
                        </svg>
                        Criar Usuário
                    </a>
                </li>
                <li>
                    <a href="usuarios/listar.php" aria-label="Editar Usuário">
                        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04a1.003 1.003 0 0 0 0-1.42l-2.34-2.34a1.003 1.003 0 0 0-1.42 0l-1.83 1.83 3.75 3.75 1.84-1.82z"/>
                        </svg>
                        Listar Usuários
                    </a>
                </li>
            </ul>
        </section>

        <section class="card" aria-labelledby="pdf-title">
            <h2 id="pdf-title">Arquivos PDF</h2>
            <ul>
                <li>
                    <a href="pdfs/upload.php" aria-label="Upload de PDF">
                        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path d="M19 15v4H5v-4H3v4a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-4h-2zm-7-9v6l-3-3-1.41 1.41L12 17l5-5-1.41-1.41L13 12V6h-1z"/>
                        </svg>
                        Upload de PDF
                    </a>
                </li>
                <li>
                    <a href="pdfs/visualizar.php" aria-label="Visualizar PDFs">
                        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path d="M12 6a9.77 9.77 0 0 1 9 6 9.77 9.77 0 0 1-9 6 9.77 9.77 0 0 1-9-6 9.77 9.77 0 0 1 9-6zm0 10a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/>
                        </svg>
                        Visualizar PDFs
                    </a>
                </li>
                <li>
                    <a href="pdfs/excluir.php" aria-label="Excluir PDF">
                        <svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                            <path d="M16 9v10H8V9h8m-1.5-6h-5l-1 1H5v2h14V4h-4.5l-1-1z"/>
                        </svg>
                        Excluir PDF
                    </a>
                </li>
            </ul>
        </section>
    </main>

    <a href="logout.php" class="logout" role="button" aria-label="Sair do sistema">🔓 Sair</a>

</body>
</html>
