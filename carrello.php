<div id="carrello" class="carrello-popup container-carrello" style="display: none;">
    <table id="carrello-tbl" style="border-spacing: 18px;">
        <div class="titolo-carrello">
            <h1>Carrello</h1>
        </div>
        <div id="remove-popup">
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
            }   ?>>
            <tr id='riga-finale'>
                <td id='totale-carrello'>
                    <?php
                    if (isset($carrello)) {
                        echo "Prezzo totale: " . $tot . '€';
                        if(!$accesso){
                            echo "<div id='container-accesso-carrello'><a href='login.php' id='testo-accesso-carrello'>accedi per completare l'acquisto</a></div>";
                        }
                    } ?>
                </td>
                <td><button type='button' onclick='buyCart()' id='acquistaButton' class='acquista-button'<?php if (!isset($_SESSION['autenticato'])) {
                                                                                        echo "style='display:none;'"; //se l'utente non è loggato vede solo la lista degli elementi
                                                                                    }  ?>>Acquista
                </button></td>
            <tr>
        </tfoot>
    </table>
</div>
<script>


    window.onload = function() {
        var GET = <?php echo json_encode($_GET, JSON_HEX_TAG); ?>;
        if(GET.pagamentoEffettuato){
            svuotaCarrello();
        } 
    };

    function svuotaCarrello() {
        document.getElementById('carrello-tbl').getElementsByTagName('tbody')[0].innerHTML = `
        <tr id='row-choose'><td>Carrello vuoto, vai allo shop</td></tr>`;
        document.getElementById('tfoot').style.display = 'none';
    }

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

    function buyCart() {
        let totale = calcolaTotale();
        window.location.href = 'pagamento.php?totaleCarrello=' + totale;
    };

</script>