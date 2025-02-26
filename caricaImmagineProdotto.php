<?php
    if(!empty($_FILES)) {
        $uploads_dir = "images/shop/";

        if(!is_dir($uploads_dir)) {
            mkdir($uploads_dir, 0777, true);
        }

        foreach($_FILES as $key => $file) {
            $temp_name = $file['$temp_name'];
            $name = basename($file['name']);

            $path = $uploads_dir . $name;
            $car = move_uploaded_file($temp_name,$path);

            if(!$car) {
                echo "Errore nel caricamento del file $name.";
            }
        } 
    } else {
        echo "Nessun file caricato.";
    }
?>