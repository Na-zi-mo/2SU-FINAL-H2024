document.addEventListener("DOMContentLoaded", () => {
    const formulaire = document.querySelector("#formulaire-inscription");
    formulaire.addEventListener("submit", validerFormulaireAvantEnvoi);
});

function validerFormulaireAvantEnvoi(event) {
    const motDePasse = document.querySelector("#mot-de-passe-id");
    const confirmationMotDePasse = document.querySelector("#confirmation-mot-de-passe-id");
    let erreur = false;
    if (motDePasse.value != confirmationMotDePasse.value) {
        motDePasse.style.color = "red";
        confirmationMotDePasse.style.color = "red";
        erreur = true;
    } else {
        motDePasse.style.color = "";
        confirmationMotDePasse.style.color = "";
    }
    if (erreur) {
        event.preventDefault();
    }
}