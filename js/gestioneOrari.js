function aggiuntaOrari(id){
    const tr = document.getElementById("aggiunta-orario-"+id);
    const td = document.getElementById("aggiunta-orario-td-"+id);
    td.remove();

    const nuovaRiga = creaRigaScelta(id);
    tr.appendChild(nuovaRiga);
}

function addOrario(form,id){

    const giorno = form.giorno.value;
    const orarioInizio = form.orarioInizio.value;
    const orarioFine = form.orarioFine.value;
    
    const xhr = new XMLHttpRequest();
        xhr.open('POST', 'aggiuntaOrario.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                console.log(xhr.responseText);
                const tabella = document.getElementById("tabella-orari-"+id);
                const rigaNessun = document.getElementById("riga-nessun-corso-"+id);
                if(rigaNessun){
                    rigaNessun.remove();
                }
                const nuovaRiga = tabella.insertRow(1);
                nuovaRiga.innerHTML = '<td>'+giorno+'</td><td>'+orarioInizio+' - '+orarioFine+'</td>';
                setBottoneBase(id);
            }
        };
        xhr.send('id='+ id+'&giorno='+giorno+'&orarioInizio='+orarioInizio+'&orarioFine='+orarioFine);
}
function setBottoneBase(id){
    const td = document.getElementById("aggiunta-orario-td-"+id);
    td.innerHTML='<button>Aggiungi Orario</button>';
    td.setAttribute('onclick','aggiuntaOrari('+id+')');
}


function creaRigaScelta(id){
    const nuovaRiga = document.createElement("td");
    nuovaRiga.id = 'aggiunta-orario-td-'+id;
    nuovaRiga.setAttribute('colspan', '2');

        const form = document.createElement("form");
        form.setAttribute('action', 'javascript:;');
        form.setAttribute('onsubmit', 'addOrario(this,'+id+')');
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