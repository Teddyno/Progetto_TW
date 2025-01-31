const codiceSconto = document.getElementById("codice-sconto");

codiceSconto.addEventListener("click", () => {
    const codice = "PAGURO2024";
    navigator.clipboard.writeText(codice);
    alert("Codice copiato negli appunti");
    });