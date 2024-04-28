<?php

/**
 * Cette classe permet de générer une page HTML à partir d'un template (.phtml) tout en pouvant y injecter des variables.
 * 
 * Utilisation :
 * 1) Construire une instance en spécifiant le template html.
 * 2) Optionnellement ajouter les champs/valeurs présents dans la page html (méthode assigner()).
 * 3) Appeler generer();
 * 
 * Inspiré partiellement de : http://www.sitepoint.com/flexible-view-manipulation-1/
 */
class CreateurVue
{
    /** Le template html */
    private string $template;

    /** Les champs du template */
    private array $champs;

    /**
     * Constructeur. 
     * 
     * @param string $template Le chemin du template html à utiliser
     */
    function __construct(string $template)
    {
        $this->template = $template;
        $this->champs = array();
    }

    /**
     * Méthode permettant d'ajouter des champs après la construction de la vue.
     * 
     * @param type $champ Le nom du champ
     * @param type $valeur La valeur du champ
     */
    function assigner($champ, $valeur)
    {
        $this->champs[$champ] = $valeur;
    }

    /**
     * Méthode permettant d'ajouter plusieurs champs après la construction de la vue.
     * 
     * @param array $champs Le tableau de variables à assigner. 
     */
    function assignerPlusieurs(array $champs)
    {
        $this->champs = array_merge($this->champs, $champs);
    }

    /**
     * Méthode permettant de générer la vue.
     * 
     * @return string Le contenu html de la vue.
     */
    function generer()
    {
        // On ajoute automatiquement les variables de session aux champs
        if (session_status() === PHP_SESSION_ACTIVE) $this->assignerPlusieurs($_SESSION);

        // extract() permet de créer les variables dont les noms
        // sont les index du tableau en leur affectant la valeur
        // associée. En d'autres mots, c'est comme si les variables
        // étaient explicitement déclarées à l'extérieur du tableau.
        extract($this->champs);

        // ob_start() permet d'ouvrir un buffer (tampon) de sortie. Ce qui est 
        // mis dans le buffer de sortie (html, echo, etc.) est ce qui sera envoyé 
        // au navigateur web.
        ob_start();

        // Le fait de faire un require du template permet de l'inclure dans le
        // buffer de sortie.
        require $this->template;

        // ob_get_clean() permet d'obtenir le contenu du buffer de sortie sous 
        // forme de chaîne de caractères. Ensuite, le buffer est effacé et fermé.
        return ob_get_clean();
    }

    public function getChamps(): array
    {
        return $this->champs;
    }
}
