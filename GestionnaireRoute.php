<?php

/**
 * Gestionnaire des requêtes HTTP.
 * 
 * Cette classe reçoit la requête HTTP. En fonction des paramètres 'ctrl' et 'action' présents dans GET/POST, 
 * elle redirige le traitement vers le contrôleur approprié.
 */
class GestionnaireRoute
{
    private string $ctrlParDefaut;
    private ConfigDao $configDao;

    /**
     * @param string $ctrlParDefaut Contrôleur à utiliser par défaut si le  
     *                              paramètre "ctrl" présent dans GET/POST n'existe pas.
     *                              L'action par défaut de ce contrôleur sera appelée.
     * @param ConfigDao $configDao La config à utiliser lors de la construction d'un contrôleur.
     */
    function __construct(string $ctrlParDefaut, ConfigDao $configDao)
    {
        $this->ctrlParDefaut = $ctrlParDefaut;
        $this->configDao = $configDao;
    }


    /**
     * Méthode pour traiter la requête HTTP.
     * 
     * @throws Exception Aucun contrôleur n'existe (même celui par défaut). Ne devrait jamais arriver. 
     */
    function traiterRequeteHttp()
    {
        // À priori, le contrôleur par défaut est celui à utiliser.
        $nomClasseCtrl = $this->ctrlParDefaut;

        // Nous récupérons le paramètre "ctrl" de GET/POST
        if (isset($_REQUEST['ctrl']))
        {
            // Nous construisons le nom de la classe du contrôleur.
            // Note 1: Le tableau $_REQUEST rassemble autant les paramètres $_GET et $_POST
            // Note 2: ucfirst() met en majuscule la première lettre du mot
            $nomClasseCtrl = ucfirst(filter_var($_REQUEST['ctrl'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)) . 'Controleur';

            // On vérifie si le contrôleur existe, sinon on se rabat sur celui par défaut.
            if (!class_exists($nomClasseCtrl)) $nomClasseCtrl = $this->ctrlParDefaut;
        }

        // Nous en construisons une instance du contrôleur
        $controleur = new $nomClasseCtrl($this->configDao);

        // À priori, on met l'action à appeler auprès du contrôleur à celle par défaut
        $nomMethode = 'defaut';

        // Nous récupérons l'action à exécuter de la requête HTTP
        if (isset($_REQUEST['action']))
        {
            $nomMethode = filter_var($_REQUEST['action'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // On vérifie si l'action (méthode) existe dans le contrôleur, sinon on se rabat sur celle par défaut
            if (!method_exists($controleur, $nomMethode)) $nomMethode = 'defaut';
        }

        // Nous sommes 100% certain que le contrôleur et l'action existent (à moins d'une erreur de programmation!).
        // On appelle la méthode du contrôleur pour qu'il puisse traiter la requête.
        call_user_func(array($controleur, $nomMethode));
    }
}
