const fotoArea = document.getElementById('foto-area');
const Input = document.getElementById('foto');
const fileList = document.getElementById('file-list');
const fotopath = document.getElementById('fotopath');
const bottone = document.getElementById('bottone-aggiungi');

let fileCaricato;

fotoArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    fotoArea.style.background = 'e9e9e9';
});

fotoArea.addEventListener('dragleave', () => {
    fotoArea.style.background = '#fff';
});

fotoArea.addEventListener('drop', (e) => {
    e.preventDefault();
    fotoArea.style.background = '#fff';

    const file = e.dataTransfer.files;
    fotopath.value = file[0].name; 
    /* configura il valore dell'attributo value dell'input nascosto
        per passare il nome del file con post ad aggiuntaProdotto.php */
    handleFiles(file);
});

Input.addEventListener('change', () => {
    const file = Input.files;
    handleFiles(file);
});

bottone.addEventListener('click', () => {
    uploadFiles();
});

function handleFiles(file) {
    fileCaricato = file[0];
    fileList.innerHTML = '';
    const p = document.createElement('p');
    p.textContent = file[0].name;
    fileList.appendChild(p);
}

function uploadFiles() {
    const formData = new FormData();

    formData.append('file', fileCaricato);

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'caricaImmagineProdotto.php', true);

    xhr.onload = function() {
        if(xhr.status === 200) {
            alert('Caricamento avvenuto con successo');
        } else {
            alert('Errore nel caricamento: ' +xhr.statusText);
        }
    };

    xhr.send(formData);
}

