<div id="carrello" class="carrello-popup container-carrello" style="display: none;">
    <!-- cart 
    Questo script gestisce la funzionalità del carrello, consentendo agli utenti di visualizzare, aggiornare e acquistare gli articoli nel loro carrello.
    I dati del carrello sono memorizzati nei cookie e gestiti utilizzando PHP e JavaScript.
    -->
    
    <table id="carrello-tbl" style="border-spacing: 18px;">
        <div class="titolo-carrello">
            <h1>Carrello</h1>
        </div>
        <div id="remove-popup">
            <!-- Pulsante di chiusura per il popup del carrello. Utilizza metodo openCart presente nel file topmenu.php -->
            <button onclick="openCart()" class="bottone-chiusura-carrello">X</button>
        </div>
        <tbody>
            <?php
            if (isset($_COOKIE['cart'])) {
                $carrello = json_decode($_COOKIE['cart'], true);
                $tot = 0;
                foreach ($carrello as $key => $value) {
                    $tot += $value['prezzo'] * $value['quantita'];

                    echo"<tr id='prodotto-" . $value['idprodotto'] . "'  data-prezzo='".$value['prezzo']."'  quantita='".$value['quantita']."'>
                            <td colspan='2'>
                                <div class='container-prodotto-carrello'>
                                    <div class='immagine-prodotto-carrello'>
                                        <img src=".$value['fotopath']." class='imm-prodotto-carr'>
                                    </div>
                                    <div class='nome-prodotto-carrello'>
                                        ".$value['nome']."
                                    </div>
                                    <div class='prezzo-prodotto-carrello'>
                                        ".$value['prezzo']."€
                                    </div>
                                    <div id='prodotto-quantita-" . $value['idprodotto'] . "' class='quantità-prodotto-carrello'>
                                        x".$value['quantita']."
                                    </div>
                                    <div class='rimuovi-prodotto-carrello'>
                                        <button class='remove-button' onclick='ajax_remove_cart(" . $value['idprodotto'] . ")'><img src=images/remove.png></button>
                                    </div>
                                </div>
                            </td>
                        </tr>";
                }
                if ($tot == 0) {
                    echo "<tr id='row-choose'><td>Carrello vuoto, vai allo shop</td></tr>";
                }
            } else {
                echo "<tr id='row-choose'><td>Carrello vuoto, vai allo shop</td></tr>";
            }
            ?>
        </tbody>
        <tfoot id="tfoot"
            <?php
            if (empty($carrello)) {
                echo "style='display:none;'";
            } else {
                echo 'style="display: table-footer-group;"';
            }   ?>> <!--Chiudo tag tfoot --> 
            <tr id='riga-finale'>
                <td id='totale-carrello'>
                    <?php
                    if (isset($carrello)) {
                        echo "Prezzo totale: " . $tot . '€';
                    } ?>
                </td>
                <td><button type='button' onclick='buyCart()' id='acquistaButton' class='acquista-button'<?php if (!isset($_SESSION['autenticato'])) {
                                                                                        echo "style='display:none;'"; //se l'utente non è loggato vede solo la lista degli elementi
                                                                                    }  ?>>Buy
                </button></td>
            <tr>
        </tfoot>
    </table>
</div>
<script>


    /**
     * Eseguito al caricamento della finestra.
     * Questa funzione viene eseguita quando la finestra del browser è completamente caricata.
     * Verifica la presenza del parametro confirmcheckout nell'URL.
     * Se il parametro è presente, chiama la funzione svuotaCarrello() per svuotare il carrello nel frontend.
     */
    window.onload = function() {
        var GET = <?php echo json_encode($_GET, JSON_HEX_TAG); ?>;
        if(GET.pagamentoEffettuato){
            gestioneAcquisti();
        } 
    };

    function gestioneAcquisti(){
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'gestioneAcquisti.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log("gestione acquisti effettuata con successo"+xhr.responseText);
            }
        };
        xhr.send('pagamentoEffettuato=' + true);
    }

    /**
     * Svuota il carrello nel frontend.
     *
     * Questa funzione aggiorna l'interfaccia utente per mostrare un carrello vuoto. 
     * Imposta il contenuto del 'tbod' della tabella del carrello per visualizzare un messaggio che invita a scegliere una nuova destinazione
     * e nasconde il 'tfoot'.
     * 
     */
    function svuotaCarrello() {
        document.getElementById('carrello-tbl').getElementsByTagName('tbody')[0].innerHTML = `
        <tr id='row-choose'><td>Carrello vuoto, vai allo shop</td></tr>`;
        document.getElementById('tfoot').style.display = 'none';
    }
    /**
     * Rimuove un elemento dal carrello utilizzando una chiamata AJAX.
     * Questa funzione invia una richiesta HTTP POST al server per rimuovere un elemento specificato dal carrello.
     * Se l'elemento viene rimosso con successo, l'interfaccia utente viene aggiornata per riflettere la modifica.
     *
     */
    function ajax_remove_cart(id) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'rimuoviProdottoCarrello.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Aggiorna l'interfaccia utente dopo aver rimosso l'elemento
                const response = JSON.parse(xhr.responseText);
                if (response.cartEmpty) {
                    svuotaCarrello();
                } else {
                    const element = document.getElementById('prodotto-' + id);
                    element.remove();
                    updateCartTotal();
                }
            }
        };
        xhr.send('id=' + id);
    }
    /**
     * Aggiorna il prezzo totale nel carrello.
     *
     * Questa funzione calcola il prezzo totale degli articoli presenti nel carrello, sommando i valori degli attributi 
     * 'data-prezzo' di ogni riga della tabella. Il prezzo totale viene poi visualizzato nell'elemento con ID total-cart.
     * 
     * La funzione viene chiamata sia da ajax_remove() che da ajax_add_cart().
     */
    function updateCartTotal() {
        let totale = calcolaTotale();
        document.getElementById('prezzo-totale').textContent = 'Prezzo totale:  ' + totale + ' $';
    }

    function calcolaTotale() {
        const righeCarrello = document.querySelectorAll('tr[data-prezzo]');
        let totale = 0;
        righeCarrello.forEach(function(row) {
            let prezzo = parseInt(row.getAttribute('data-prezzo'));
            let quantita = parseInt(row.getAttribute('quantita'));
            totale += (prezzo * quantita);
        });
        return totale;
    }
    /*
     *Gestisce il processo di acquisto.
     * Questa funzione controlla se l'utente è loggato. Se l'utente è loggato, codifica i dati del carrello in JSON e redireziona alla pagina di pagamento.
     * Se l'utente non è loggato, apre il popup di login.
     */
    function buyCart() {
        let totale = calcolaTotale();
        window.location.href = 'pagamento.php?totaleCarrello=' + totale;
    };

</script>