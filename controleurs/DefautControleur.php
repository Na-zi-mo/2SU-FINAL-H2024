<?php

class DefautControleur extends BaseControleur
{
    private ShweetDao $shweetDao;
    private UtilisateurDao $utilisateurDao;

    function __construct(ConfigDao $configDao)
    {
        parent::__construct($configDao);
        $this->shweetDao = new ShweetDao($configDao);
        $this->utilisateurDao = new UtilisateurDao($configDao);
    }

    function afficherProfil(): void
    {
        $vue = new CreateurVue('vues/profil.phtml');

        if (is_numeric($_REQUEST['id']))
        {
            $id = $_REQUEST['id'];
            $utilisateur = $this->utilisateurDao->select($id);
            $vue->assigner('utilisateur', $utilisateur);
            $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents($utilisateur->getId()));
        }
        echo $vue->generer();
    }

    function lister(): void
    {
        $vue = new CreateurVue('vues/accueil.phtml');
        $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
        echo $vue->generer();
    }

    function defaut(): void
    {
        $this->lister();
    }
}
