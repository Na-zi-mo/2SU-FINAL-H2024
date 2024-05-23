<?php

class InscriptionControleur extends BaseControleur
{
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

    function consulter(): void
    {
        $vue = new CreateurVue('vues/inscription.phtml');
        echo $vue->generer();
    }

    function creerProfil(): void
    {
    }

    function defaut(): void
    {
        $this->consulter();
    }
}
