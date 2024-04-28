<?php

class DefautControleur extends BaseControleur
{
    function __construct(ConfigDao $configDao)
    {
        parent::__construct($configDao);
    }

    function accueil(array $erreurs = []): void
    {
        $vue = new CreateurVue('vues/accueil.phtml');
        echo $vue->generer();
    }

    function defaut(): void
    {
        $this->accueil();
    }
}
