<?php
$errore = "";
$nome = "";
$peso = "";
$altezza_cm = "";
$bmi = 0;
$fascia = "";
$classe_fascia = "";
$colore_bordo = "";
$bmi_formattato = "0.00";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Controlliamo se i campi sono vuoti
    // 2. Controlliamo se peso o altezza sono negativi o uguali a zero
    if ($_POST['peso'] <= 0 || $_POST['altezza'] <= 0) {
        $errore = "Peso e altezza non possono essere negativi o uguali a zero";
    } else {
        $nome = $_POST['nome'];
        $peso = $_POST['peso'];
        $altezza_cm = $_POST['altezza'];
        
        // Conversione altezza da cm a metri
        $altezza_m = $altezza_cm / 100;

        // Calcolo del BMI
        $bmi = $peso / ($altezza_m * $altezza_m);

        // Arrotondamento a 2 decimali
        $bmi_formattato = number_format($bmi, 2, '.', '');

        // Determinazione della fascia
        if ($bmi < 18.5) {
            $fascia = "SOTTOPESO";
            $classe_fascia = "sottopeso";
            $colore_bordo = "#2F6FB3";
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $fascia = "NORMOPESO";
            $classe_fascia = "normopeso";
            $colore_bordo = "#256D34";
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $fascia = "SOVRAPPESO";
            $classe_fascia = "sovrappeso";
            $colore_bordo = "#9A4F06";
        } else {
            $fascia = "OBESITÀ";
            $classe_fascia = "obesita";
            $colore_bordo = "#B32D2D";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calcola BMI</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "GET" || !empty($errore)) { 
    ?>
        <main>
            <h1>Calcola BMI</h1>
            
            <?php 
            if (!empty($errore)) { 
            ?>
                <div class="box-errore">
                    <strong>Errore:</strong> 
                    <?php 
                    echo $errore; 
                    ?>
                </div>
            <?php 
            } 
            ?>

            <div class="card">
                <form method="post" action="index.php">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" value="Luca" required>
                    
                    <label for="peso">Peso (kg)</label>
                    <input type="number" id="peso" name="peso" value="70" step="any" required>
                    
                    <label for="altezza">Altezza (cm)</label>
                    <input type="number" id="altezza" name="altezza" value="178" step="any" required>
                    
                    <button type="submit">Calcola</button>
                </form>
            </div>
        </main>
    <?php 
    } else { 
    ?>
        <main>
            <h1>Il tuo BMI</h1>
            
            <div class="card <?php echo $classe_fascia; ?>">
                <div class="nome-utente"><?php echo htmlspecialchars($nome); ?></div>
                <div class="dati-inseriti">Peso: <?php echo $peso; ?>kg · Altezza: <?php echo $altezza_cm; ?>cm</div>
                <div class="valore-bmi"><?php echo $bmi_formattato; ?></div>
                <div class="nome-fascia" style="color: <?php echo $colore_bordo; ?>;">
                    <?php echo $fascia; ?>
                </div>
            </div>

            <a class="link-ritorno" href="index.php">Calcola di nuovo</a>
        </main>
    <?php 
    } 
    ?>
</body>
</html>