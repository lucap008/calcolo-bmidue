<?php
// Prendo i dati direttamente dal form
$nome = $_POST['nome'];
$peso = $_POST['peso'];
$altezza_cm = $_POST['altezza'];

// Converto l'altezza da centimetri a metri
$altezza_m = $altezza_cm / 100;

// Calcolo il BMI: peso diviso altezza al quadrato
$bmi = $peso / ($altezza_m * $altezza_m);

// Scelgo la classe e il testo in base al valore del BMI
if ($bmi < 18.5) {
    $fascia_classe = "sottopeso";
    $fascia_testo = "Sottopeso";
} 
else {
    if ($bmi <= 24.9) {
        $fascia_classe = "normopeso";
        $fascia_testo = "Normopeso";
    } 
    else {
        if ($bmi <= 29.9) {
            $fascia_classe = "sovrappeso";
            $fascia_testo = "Sovrappeso";
        } 
        else {
            $fascia_classe = "obesità";
            $fascia_testo = "Obesità";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Risultato BMI</title>
    <style>
        body {
            background-color: #F1F3F5;
            color: #1F2328;
            font-family: sans-serif;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        main {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }

        .card {
            width: 360px;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
            border: 3px solid #ccc;
        }

        /* Sottopeso */
        .card.sottopeso {
            background-color: #E3EEF9;
            border-color: #2F6FB3;
        }
        .card.sottopeso .fascia {
            color: #2F6FB3;
        }

        /* Normopeso */
        .card.normopeso {
            background-color: #E3F4E6;
            border-color: #256D34;
        }
        .card.normopeso .fascia {
            color: #256D34;
        }

        /* Sovrappeso */
        .card.sovrappeso {
            background-color: #FCEBD7;
            border-color: #9A4F06;
        }
        .card.sovrappeso .fascia {
            color: #9A4F06;
        }

        /* Obesità */
        .card.obesità {
            background-color: #FBE2E2;
            border-color: #B32D2D;
        }
        .card.obesità .fascia {
            color: #B32D2D;
        }

        .valore-bmi {
            font-size: 48px;
            font-weight: bold;
            margin: 10px 0;
        }

        .info {
            margin-bottom: 8px;
            font-size: 15px;
        }

        .fascia {
            font-size: 20px;
            font-weight: bold;
            margin-top: 12px;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            color: #1F2328;
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <main>
        <h1>Risultato BMI</h1>
        
        <!-- Stampo la classe php dinamicamente nella card -->
        <div class="card <?php echo $fascia_classe; ?>">
            <div class="info"><strong>Nome:</strong> <?php echo $nome; ?></div>
            <div class="info"><strong>Peso:</strong> <?php echo $peso; ?> kg</div>
            <div class="info"><strong>Altezza:</strong> <?php echo $altezza_cm; ?> cm</div>
            
            <!-- Arrotondamento classico a 2 decimali -->
            <div class="valore-bmi"><?php echo round($bmi, 2); ?></div>
            
            <div class="fascia"><?php echo $fascia_testo; ?></div>
        </div>

        <a href="index.html">&larr; Calcola un altro BMI</a>
    </main>
</body>
</html>