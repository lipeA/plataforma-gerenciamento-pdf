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
    <title>Upload de PDF - Gerenciador de PDF</title>
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
            margin: 32px auto;
            background: #fff;
            padding: 32px 24px;
            border-radius: 12px;
            box-shadow: 0 6px 20px rgb(0 0 0 / 0.07);
        }

