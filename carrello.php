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
                    $tot += $value['prezzo'];

                    echo"<tr id='prodotto-" . $value['idprodotto'] . "' data-prezzo='" . $value['prezzo'] . "' class='riga-carrello'>
                            <td rowspan='2' >
                                <img src=".$value['fotopath']." class='immagine-prodotto-carrello'>
                            </td>
                            <td colspan='2' class= 'nome-prodotto'>
                                ".$value['nome']."
                            </td>
                            <td rowspan='2'>
                                <button class='removeButton' onclick='ajax_remove_cart(" . $value['idprodotto'] . ")'><img src=images/remove.png></button>
                            </td>
                        </tr>
                        <tr id='prodotto2-".$value['idprodotto']."' class='riga-carrello'>
                            <td>
                                ".$value['prezzo']."$
                            </td>
                            <td>
                                altro
                            </td>
                        </tr>";
                }
                if ($tot == 0) {
                    echo "<tr id='row-choose'><td colspan='4'>Carrello vuoto, vai allo shop</td></tr>";
                }
            } else {
                echo "<tr id='row-choose'><td colspan='4'>Carrello vuoto, vai allo shop</td></tr>";
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
            <tr>
                <td id='totale-carrello' colspan='5'>
                    <?php
                    if (isset($carrello)) {
                        echo "Prezzo totale: " . $tot . '$';
                    } ?>
                </td>
                <td><button type='button' onclick='buyCart()' id='acquistaButton' <?php if (!isset($_SESSION['autenticato'])) {
                                                                                        echo "style='display:none;'"; //se l'utente non è loggato vede solo la lista degli elementi
                                                                                    }  ?>>Buy
                    </button>
                </td>
            </tr>
        </tfoot>
    </table>
</div>
<script>


    /**
     * Eseguito al caricamento della finestra.
     * Questa funzione viene eseguita quando la finestra del browser è completamente caricata.
     * Verifica la presenza del parametro confirmcheckout nell'URL.
     * Se il parametro è presente, chiama la funzione svuotaCarrelloFrontend() per svuotare il carrello nel frontend.
     */
    window.onload = function() {
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('confirmcheckout')) {
            svuotaCarrelloFrontend();
        }
    };
    /**
     * Svuota il carrello nel frontend.
     *
     * Questa funzione aggiorna l'interfaccia utente per mostrare un carrello vuoto. 
     * Imposta il contenuto del 'tbod' della tabella del carrello per visualizzare un messaggio che invita a scegliere una nuova destinazione
     * e nasconde il 'tfoot'.
     * 
     */
    function svuotaCarrelloFrontend() {
        document.getElementById('carrello-tbl').getElementsByTagName('tbody')[0].innerHTML = `
        <tr id='row-choose'><td colspan='4'>Carrello vuoto, vai allo shop</td></tr>`;
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
                    svuotaCarrelloFrontend();
                } else {
                    const itemElement = document.getElementById('prodotto-' + id);
                    itemElement.remove();
                    const itemElement2 = document.getElementById('prodotto2-' + id);
                    itemElement2.remove();
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
        const righeCart = document.querySelectorAll('tr[data-prezzo]');
        let total = 0;
        righeCart.forEach(function(row) {
            total += parseFloat(row.getAttribute('data-prezzo'));
        });
        document.getElementById('prezzo-totale').textContent = 'Prezzo totale:  ' + total + ' $';
    }
        /*
     *Gestisce il processo di acquisto.
     * Questa funzione controlla se l'utente è loggato. Se l'utente è loggato, codifica i dati del carrello in JSON e redireziona alla pagina di pagamento.
     * Se l'utente non è loggato, apre il popup di login.
     */
    function buyCart() {
        const cart = <?php echo json_encode($carrello); ?>; // passo all'URL il carrello codificato in JSON
        const encodedCart = encodeURIComponent(JSON.stringify(cart));
        window.location.href = '../src/components/Stripe/Checkout.php?cart=' + encodedCart;
    };

</script>