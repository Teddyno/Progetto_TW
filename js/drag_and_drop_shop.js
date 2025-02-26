const fotoArea = document.getElementById('foto-area');
const Input = document.getElementById('foto');
const fileList = document.getElementById('file-list');
const bottone = document.getElementById('bottone-aggiungi');

let fileArray;

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
    fileArray = Array.from(file);
    fileList.innerHTML = '';
    fileArray.forEach((file) => {
        const p = document.createElement('p');
        p.textContent = file.name;
        fileList.appendChild(p);
    });
}

function uploadFiles() {
    const formData = new FormData();

    fileArray.forEach((file, index) => {
        formData.append('file' + index, file);
    });

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

