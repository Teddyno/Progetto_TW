<?php
// Verifica se sono stati inviati file
if (!empty($_FILES)) {
    $uploads_dir = "images/personaltrainer/"; // Directory di destinazione per i file caricati

    // Crea la directory se non esiste
    if (!is_dir($uploads_dir)) {
        mkdir($uploads_dir, 0777, true);
    }

    // Cicla su tutti i file caricati
    foreach ($_FILES as $key => $file) {
        $tmp_name = $file['tmp_name'];
        $name = basename($file['name']);
        // Nuovo percorso in cui verrà salvato il filer
        $path =  $uploads_dir . $name;
        $car = move_uploaded_file($tmp_name,$path);

        if (!$car) {
            echo "Errore nel caricamento del file $name.";
        }
    }
} else {
    echo "Nessun file caricato.";
}
?>
