function aggiuntaOrari(idpersonal,idCorso){
    const tr = document.getElementById("aggiunta-orario-"+idpersonal);
    const td = document.getElementById("aggiunta-orario-td-"+idpersonal);
    td.remove();

    const nuovaRiga = creaRigaScelta(idpersonal);
    tr.appendChild(nuovaRiga);
}

function addOrario(form,idPersonal){

    const giorno = form.giorno.value;
    const orarioInizio = form.orarioInizio.value;
    const orarioFine = form.orarioFine.value;
    
    const xhr = new XMLHttpRequest();
        xhr.open('POST', 'aggiuntaOrario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                idcorso = parseInt(xhr.responseText);
                const tabella = document.getElementById("tabella-orari-"+idPersonal);
                const rigaNessun = document.getElementById("riga-nessun-corso-"+idPersonal);
                if(rigaNessun){
                    rigaNessun.remove();
                }
                const nuovaRiga = tabella.insertRow(1);
                nuovaRiga.id = 'riga-corso-'+idcorso+'';
                nuovaRiga.innerHTML = '<td>'+giorno+'</td><td>'+orarioInizio+' - '+orarioFine+'<button class=\'bottone-elimina-orario\' onclick=\'removeOrario('+idPersonal+','+idcorso+')\'>-</button></td>';
                setBottoneBase(idPersonal);
            }
        };
        xhr.send('id='+ idPersonal+'&giorno='+giorno+'&orarioInizio='+orarioInizio+'&orarioFine='+orarioFine);
}

function setBottoneBase(idPersonal){
    const td = document.getElementById("aggiunta-orario-td-"+idPersonal);
    td.innerHTML="<button class='bottone-aggiungi-orario'>Aggiungi Orario</button>";
    td.setAttribute('onclick','aggiuntaOrari('+idPersonal+')');
}


function creaRigaScelta(idpersonal){
    const nuovaRiga = document.createElement("td");
    nuovaRiga.id = 'aggiunta-orario-td-'+idpersonal;
    nuovaRiga.setAttribute('colspan', '2');

        const form = document.createElement("form");
        form.setAttribute('action', 'javascript:;');
        form.setAttribute('onsubmit', 'addOrario(this,'+idpersonal+')');
        nuovaRiga.appendChild(form);

            const inputGiorni = document.createElement("select");
            inputGiorni.id = 'giorno';
            inputGiorni.setAttribute('name', 'giorno');
            form.appendChild(inputGiorni);

                // for per inserire tutte le option di select
                const giorni = ['lunedi', 'martedi', 'mercoledi', 'giovedi', 'venerdi', 'sabato', 'domenica'];
                for (const giorno of giorni) {
                    const option = document.createElement("option");
                    option.setAttribute('value', giorno);
                    option.textContent = giorno;
                    inputGiorni.appendChild(option);
                }

            const inputOrarioInizio = document.createElement("select");
            inputOrarioInizio.id = 'orarioInizio';
            inputOrarioInizio.setAttribute('name', 'orarioInizio');
            form.appendChild(inputOrarioInizio);

                // for per inserire tutte le option di select con orari dalle 8:00 alle 19:00
                for (let ora = 8; ora <= 19; ora++) {
                    const option = document.createElement("option");
                    option.setAttribute('value', ora + ":00");
                    option.textContent = ora + ":00";
                    inputOrarioInizio.appendChild(option);
                }

            const inputOrarioFine = document.createElement("select");
            inputOrarioFine.id = 'orarioFine';
            inputOrarioFine.setAttribute('name', 'orarioFine');
            form.appendChild(inputOrarioFine);

            // for per inserire tutte le option di select con orari dalle 8:00 alle 19:00
            for (let ora = 9; ora <= 20; ora++) {
                const option = document.createElement("option");
                option.setAttribute('value', ora + ":00");
                option.textContent = ora + ":00";
                inputOrarioFine.appendChild(option);
            }

            const btnInvio = document.createElement("input");
            btnInvio.id = 'btnInvio';
            btnInvio.setAttribute('type', 'submit');
            btnInvio.setAttribute('value', '+');
            form.appendChild(btnInvio);

    return nuovaRiga;
}

function removeOrario(idpersonal,idcorso){
    const xhr = new XMLHttpRequest();
        xhr.open('POST', 'eliminaOrario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                const rigaEliminata = document.getElementById("riga-corso-"+idcorso);
                if(parseInt(xhr.responseText) == 0)
                {
                    rigaEliminata.id = 'riga-nessun-corso-'+idpersonal;
                    rigaEliminata.innerHTML = "<td colspan='2'>Nessun corso disponibile</td>";
                }
                else{
                    rigaEliminata.remove();
                }
            }
        };
        xhr.send('idcorso='+ idcorso+'&idpersonal='+ idpersonal);
}
