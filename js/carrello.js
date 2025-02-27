
/**
 * Aggiunge un elemento al carrello utilizzando una chiamata AJAX.
 *
 * Questa funzione invia una richiesta HTTP POST al server per aggiungere un elemento specificato al carrello.
 * Se l'elemento viene aggiunto con successo, l'interfaccia utente viene aggiornata per riflettere la modifica.
 *
 */
function ajaxAggiuntaCarrello(id, nome, prezzo, fotopath) {
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'aggiuntaCarrello.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            // Aggiorna il conteggio totale del carrello o mostra una notifica
            updateCartAdd(id, nome, prezzo, fotopath);
        }
    };
    xhr.send('id=' + id);
}
/**
 * Aggiunge una nuova riga al carrello e aggiorna l'interfaccia utente.
 *
 * Questa funzione aggiunge un nuovo elemento al carrello nel frontend. 
 * Se la riga di scelta è presente, viene rimossa e viene aggiunta una nuova riga per il nuovo elemento.
 * Aggiorna anche il totale del carrello.
 *
 */
function updateCartAdd(id, nome, prezzo, fotopath) {
    //Se l'utente preme per la prima volta il button per l'aggiunta deve esser mostrato il footer della table
    let tfoot = document.getElementById('tfoot');
    tfoot.style.display='table-footer-group';
    tbody = document.getElementById('carrello-tbl').getElementsByTagName('tbody')[0];
    thead = document.getElementById('carrello-tbl').getElementsByTagName('thead')[0];
    if (tbody) {
        const rowChoose = document.getElementById('row-choose');
        //var verifica = document.getElementById('prodotto-' + id);
        const riga = createRow(id, nome, prezzo, fotopath);
        if (rowChoose) {
            //Se l'elemento 'rowChoose' è presente significa che il carrello non ha elementi, per 
            //cui si elimina la riga che invita a scegliere nuove destinazioni aggiungendo il nuovo elemento
            rowChoose.remove();
            tbody.appendChild(riga);
            tbody = document.getElementById('carrello-tbl').getElementsByTagName('tfoot')['0'].style.display = '';
            riga.style.display = '';
            //Funzione definita nel file cart.php
        } else {
            //se verifica è true cioe l'elemnto gia è contenuto nel carrello allora non fa nulla;
            //if (!verifica) {
                tbody.appendChild(riga);
                tbody = document.getElementById('carrello-tbl').getElementsByTagName('tfoot')['0'].style.display = '';
                riga.style.display = '';
            //}
        }
        
    } 
    updateCartTotal(); 
}

function updateCartTotal() {
    const righeCart = document.querySelectorAll('tr[data-prezzo]');
    let total = 0;
    righeCart.forEach(function(row) {
        total += parseFloat(row.getAttribute('data-prezzo'));
    });
    document.getElementById('totale-carrello').textContent = 'Prezzo totale:  ' + total + ' $';
}

/**
* Crea una nuova riga per il carrello con le stesse caratteristiche di quelle 
* presenti nel carrello
*/

function createRow(id, nome, prezzo, fotopath) {
    const newRow = document.createElement('tr');
    newRow.id = 'prodotto-' + id;
    newRow.setAttribute('data-prezzo', prezzo);
    newRow.style.display = 'none';

        const newColumn = document.createElement('td');
        newColumn.setAttribute('colspan', '2');
        newRow.appendChild(newColumn);

        const divContainerCarrello = document.createElement('div');
        divContainerCarrello.className = 'container-prodotto-carrello';
        newColumn.appendChild(divContainerCarrello);

        const immagineProdotto = document.createElement('div');
        immagineProdotto.className = 'immagine-prodotto-carrello';
        immagineProdotto.innerHTML = '<img src="' + fotopath + '" class="imm-prodotto-carr">';
        divContainerCarrello.appendChild(immagineProdotto);

        const nomeProdotto = document.createElement('div');
        nomeProdotto.className = 'nome-prodotto-carrello';
        nomeProdotto.textContent = nome;
        divContainerCarrello.appendChild(nomeProdotto);

        const prezzoProdotto = document.createElement('div');
        prezzoProdotto.className = 'prezzo-prodotto-carrello';
        prezzoProdotto.textContent = prezzo + ' €';
        divContainerCarrello.appendChild(prezzoProdotto);

        const altroProdotto = document.createElement('div');
        altroProdotto.className = 'altro-prodotto-carrello';
        altroProdotto.textContent = 'altro';
        divContainerCarrello.appendChild(altroProdotto);

        const rimuoviProdotto = document.createElement('div');
        rimuoviProdotto.className = 'rimuovi-prodotto-carrello';
        const rimuoviProdottoBtn = document.createElement('button');
        rimuoviProdottoBtn.className = 'remove-button';
        rimuoviProdottoBtn.setAttribute('onclick', `ajax_remove_cart(${id})`);
        rimuoviProdottoBtn.innerHTML = '<img src=images/remove.png>';
        rimuoviProdotto.appendChild(rimuoviProdottoBtn);
        divContainerCarrello.appendChild(rimuoviProdotto);

        return newRow;
}