
// Elementi della pagina
const dropArea = document.getElementById('drop-area');
const fileInput = document.getElementById('foto');
const fileList = document.getElementById('file-list');
const fotopath = document.getElementById('fotopath');
const bottone = document.getElementById('bottone-aggiunta');

let fileCaricato;

// Impediamo l'azione di default per il drag and drop
dropArea.addEventListener('dragover', (e) => {
  e.preventDefault();
  dropArea.style.backgroundColor = '#e9e9e9'; // cambia colore per feedback
});

dropArea.addEventListener('dragleave', () => {
  dropArea.style.backgroundColor = '#fff'; // ripristina il colore
});

// Gestiamo il drop dei file
dropArea.addEventListener('drop', (e) => {
  e.preventDefault();
  dropArea.style.backgroundColor = '#fff';

  const file = e.dataTransfer.files;
  fotopath.value = file[0].name;
  /* configura il valore dell'attributo value dell'input nascosto
        per passare il nome del file con post ad aggiuntaTrainer.php */
  handleFiles(file);
});

// Quando un file viene selezionato tramite input file
fileInput.addEventListener('change', () => {
  const file = fileInput.files;
  handleFiles(file);
});

bottone.addEventListener('click', () => {
  uploadFiles();
});


// Funzione per mostrare i file selezionati
function handleFiles(file) {
  // Mostra il file nella lista
  fileCaricato = file[0]; // Prende solo il primo file
  fileList.innerHTML = '';
  const p = document.createElement('p');
  
  p.textContent = file[0].name;
  fileList.appendChild(p);
}

// Funzione per caricare i file sul server usando AJAX
function uploadFiles() {
  const formData = new FormData();

  formData.append('file', fileCaricato);

  // Creazione della richiesta XMLHttpRequest
  const xhr = new XMLHttpRequest();
  // Impostiamo il tipo di richiesta e l'URL del server
  xhr.open('POST', 'caricaImmagineTrainer.php', true);

  // Impostiamo la funzione di callback che verrà chiamata quando la richiesta è completata
  xhr.onload = function() {
    if (xhr.status === 200) {
      // Se la richiesta ha avuto successo
      alert('Caricamento completato');
    } else {
      // Se si è verificato un errore
      alert('Errore nel caricamento: ' + xhr.statusText);
    }
  };

  // Invio dei dati tramite AJAX
  xhr.send(formData);
}
