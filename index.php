<?php
if($_SERVER["REQUEST_METHOD"]=="POST"){
    // Qui l'utente ha inviato dei dati in POST CON IL FORM
    // Qui psso controllare le variabili inviate con isset
}else{
    // Qui vuol dire che faccio richiesta inGET (visualizo il form)
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        main {
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
        }
        .card {
            background-color: white;
            width: 360px;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
            text-align: left;
        }
        label {
            font-weight: 500;
        }
        input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            margin-bottom: 16px; /* Distanza verticale di 16px sotto ogni input */
            border: 1px solid #ccc;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 14px;
        }
        button {
            margin-top: 4px;
            background-color: #1F2328;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 8px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            opacity: 0.9;
        }
            <style>
        body {
            background-color: #F1F3F5;
            color: #1F2328;
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        main {
            text-align: center;
        }
        h1 {
            margin-bottom: 24px;
        }
        /* Stili della card con larghezza 360px, padding sopra e sotto di 16px */
        .card {
            width: 360px;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            box-sizing: border-box;
            text-align: center;
            border: 3px solid;
        }
        /* Classi dinamiche per i colori delle fasce */
        .card.sottopeso {
            background-color: #E3EEF9;
            border-color: #2F6FB3;
        }
        .card.normopeso {
            background-color: #E3F4E6;
            border-color: #256D34;
        }
        .card.sovrappeso {
            background-color: #FCEBD7;
            border-color: #9A4F06;
        }
        .card.obesita {
            background-color: #FBE2E2;
            border-color: #B32D2D;
        }

        .nome-utente {
            font-weight: bold;
            font-size: 18px;
            margin-bottom: 8px;
        }
        .dati-inseriti {
            font-size: 14px;
            margin-bottom: 16px;
            color: #555;
        }
        .valore-bmi {
            font-size: 48px;
            font-weight: bold;
            margin: 10px 0;
        }
        .nome-fascia {
            font-size: 16px;
            font-weight: bold;
            text-transform: uppercase;
        }
        /* Link "Calcola di nuovo" sotto la card con distanza 24px */
        .link-ritorno {
            display: block;
            margin-top: 24px;
            color: #1F2328;
            text-decoration: underline;
            font-size: 15px;
        }
        .link-ritorno:hover {
            opacity: 0.8;
        }
    </style>
    </style>
</head>
<body>
    <?php
    if($_SERVER["REQUEST_METHOD"]=="GET"){
    ?>
        <main>
            <h1>Calcola BMI</h1>
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
    }else{
    ?>
    <?php
        $nome = "";
        $peso = 0;
        $altezza_cm = 0;
        $altezza_m = 0;
        $bmi = 0;
        $classe_fascia = "";
        $colore_bordo = "";
        $colore_sfondo = "";
        $fascia = "";
        $bmi_formattato = "0.00";
        if($_SERVER["REQUEST_METHOD"]=="POST"){
            $nome = $_POST['nome'];
        $peso = $_POST['peso'];
        $altezza_cm = $_POST['altezza'];
        // Convertiamo l'altezza da centimetri a metri
        $altezza_m = $altezza_cm / 100;

        // Calcolo del BMI: peso / (altezza in metri)^2
        $bmi = $peso / ($altezza_m * $altezza_m);

        // Arrotondiamo il BMI a 2 decimali
        $bmi_formattato = number_format($bmi, 2, '.', '');

        // Determinazione della fascia e dei relativi stili CSS (sfondo e bordo)
        if ($bmi < 18.5) {
            $fascia = "SOTTOPESO";
            $classe_fascia = "sottopeso";
            $colore_sfondo = "#E3EEF9";
            $colore_bordo = "#2F6FB3";
        } elseif ($bmi >= 18.5 && $bmi <= 24.9) {
            $fascia = "NORMOPESO";
            $classe_fascia = "normopeso";
            $colore_sfondo = "#E3F4E6";
            $colore_bordo = "#256D34";
        } elseif ($bmi >= 25 && $bmi <= 29.9) {
            $fascia = "SOVRAPPESO";
            $classe_fascia = "sovrappeso";
            $colore_sfondo = "#FCEBD7";
            $colore_bordo = "#9A4F06";
        } else {
            $fascia = "OBESITÀ";
            $classe_fascia = "obesita";
            $colore_sfondo = "#FBE2E2";
            $colore_bordo = "#B32D2D";
        }
        }else{
            // Qui vuol dire che faccio richiesta inGET (visualizo il form)
        }
    ?>
        <main>
            <h1>Il tuo BMI</h1>
            
            <!-- Card con classe "card" e la classe specifica della fascia -->
            <div class="card <?php echo $classe_fascia; ?>">
                <div class="nome-utente"><?php echo $nome; ?></div>
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