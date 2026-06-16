 <!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jogo da Forca - PHP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Jogo da Forca (Server-Side)</h1>
        
        <div class="status-forca">
            <p>Vidas restantes: <strong>6</strong></p>
        </div>

        <div class="palavra-container">
            _ _ _ _ _
        </div>

        <form action="index.php" method="POST" class="teclado-container">
            <p>Escolha uma letra:</p>
            <input type="text" name="letra" id="letra-input" maxlength="1" placeholder="Ex: A" autofocus autocomplete="off">
            <button type="submit">Chutar</button>
        </form>

        <div class="mensagens">
            </div>
    </div>
</body>
</html>