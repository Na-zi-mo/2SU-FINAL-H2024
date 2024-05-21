<?php

class DefautControleur extends BaseControleur
{
    // function __construct(ConfigDao $configDao)
    // {
    //     parent::__construct($configDao);
    // }

    // function accueil(array $erreurs = []): void
    // {
    //     $vue = new CreateurVue('vues/accueil.phtml');
    //     echo $vue->generer();
    // }

    // function defaut(): void
    // {
    //     $this->accueil();
    // }

    private ShweetDao $shweetDao;
    private UtilisateurDao $utilisateurDao;

    function __construct(ConfigDao $configDao)
    {
        parent::__construct($configDao);
        $utilisateurConnecte = $this->getUtilisateurConnecte();
        // if (!isset($utilisateurConnecte))
        // {
        //     $vue = new CreateurVue('vues/interdit.phtml');
        //     echo $vue->generer();
        //     exit();
        // }
        $this->shweetDao = new ShweetDao($configDao);
        $this->utilisateurDao = new UtilisateurDao($configDao);
    }

    // function consulter(): void
    // {
    // }

    function lister(): void
    {
        $vue = new CreateurVue('vues/accueil.phtml');
        $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
        // $vue->assignerPlusieurs($this->shweetDao->selectDerniersShweetsParents());
        echo $vue->generer();
    }

    function defaut(): void
    {
        $this->lister();
    }
}
