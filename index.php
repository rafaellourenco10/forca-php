<?php
// Inicia a sessão para guardar o estado do jogo entre cada requisição da página
session_start();

// Array de palavras (Fica protegido no servidor!)
$palavras = ["SOFTWARE", "LINGUAGEM", "FRONTEND", "BACKEND", "REPOSITORIO"];

// Lógica de Inicialização / Reinício
if (!isset($_SESSION['palavra_secreta']) || isset($_POST['reiniciar'])) {
    $_SESSION['palavra_secreta'] = $palavras[array_rand($palavras)];
    $_SESSION['letras_adivinhadas'] = [];
    $_SESSION['vidas'] = 6;
    $_SESSION['mensagem'] = "";
}

// Processamento da jogada (Quando o usuário envia o formulário via POST)
if (isset($_POST['letra']) && $_SESSION['vidas'] > 0) {
    // Captura a letra, remove espaços e transforma em maiúscula
    $letra = strtoupper(trim($_POST['letra']));

    // Validação básica
    if (preg_match('/^[A-Z]$/', $letra)) {
        if (in_array($letra, $_SESSION['letras_adivinhadas'])) {
            $_SESSION['mensagem'] = "Você já tentou essa letra!";
        } else {
            $_SESSION['mensagem'] = "";
            $_SESSION['letras_adivinhadas'][] = $letra; // Adiciona a letra ao histórico

            // Se a letra não existir na palavra secreta, tira uma vida
            if (strpos($_SESSION['palavra_secreta'], $letra) === false) {
                $_SESSION['vidas']--;
            }
        }
    } else {
        $_SESSION['mensagem'] = "Por favor, digite uma letra válida do alfabeto.";
    }
}

// Montagem da palavra para exibir na tela
$palavra_montada = "";
$venceu = true;
$array_palavra = str_split($_SESSION['palavra_secreta']);

foreach ($array_palavra as $letra_secreta) {
    if (in_array($letra_secreta, $_SESSION['letras_adivinhadas'])) {
        $palavra_montada .= $letra_secreta . " ";
    } else {
        $palavra_montada .= "_ ";
        $venceu = false; // Se achou um "underline", ainda não venceu
    }
}

// Verifica condições de Fim de Jogo
$fim_de_jogo = false;
$cor_mensagem = "#333";

if ($_SESSION['vidas'] <= 0) {
    $_SESSION['mensagem'] = "Game Over! A palavra era " . $_SESSION['palavra_secreta'] . ".";
    $cor_mensagem = "red";
    $fim_de_jogo = true;
} elseif ($venceu) {
    $_SESSION['mensagem'] = "Parabéns! Você venceu!";
    $cor_mensagem = "green";
    $fim_de_jogo = true;
}
?>

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
            <p>Vidas restantes: <strong><?= $_SESSION['vidas'] ?></strong></p>
        </div>

        <div class="palavra-container">
            <?= trim($palavra_montada) ?>
        </div>

        <?php if (!$fim_de_jogo): ?>
            <form action="index.php" method="POST" class="teclado-container">
                <p>Escolha uma letra:</p>
                <input type="text" name="letra" id="letra-input" maxlength="1" autofocus autocomplete="off">
                <button type="submit">Chutar</button>
            </form>
        <?php else: ?>
            <form action="index.php" method="POST" class="teclado-container">
                <input type="hidden" name="reiniciar" value="1">
                <button type="submit" style="background-color: #007bff; margin-left: 0;">Jogar Novamente</button>
            </form>
        <?php endif; ?>

        <div class="mensagens" style="color: <?= $cor_mensagem ?>; margin-top: 15px; font-weight: bold;">
            <?= $_SESSION['mensagem'] ?>
        </div>
    </div>
</body>
</html>