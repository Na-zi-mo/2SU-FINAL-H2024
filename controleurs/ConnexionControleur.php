<?php

class ConnexionControleur extends BaseControleur
{
    private UtilisateurDao $utilisateurDao;
    private ShweetDao $shweetDao;

    function __construct(ConfigDao $configDao)
    {
        parent::__construct($configDao);
        $this->shweetDao = new ShweetDao($configDao);
        $this->utilisateurDao = new UtilisateurDao($configDao);
    }

    function consulter(): void
    {
        $vue = new CreateurVue('vues/connexion.phtml');
        echo $vue->generer();
    }

    function connecter(): void
    {
        $erreurs = [];

        $nomUtilisateur = $_POST['nom-utilisateur'];
        $motDePasse = $_POST['mot-de-passe'];

        $u = $this->utilisateurDao->selectParNomUtilisateur($nomUtilisateur);

        if ($u && password_verify($motDePasse, $u->getHash()))
        {
            $_SESSION['utilisateurConnecte'] = $u;
            $_SESSION['derniereActivite'] = time();

            $vue = new CreateurVue('vues/profil.phtml');
            $vue->assigner('utilisateur', $u);
            $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents($u->getId()));
            $vue->assigner('erreurs', $erreurs);
            echo $vue->generer();
        }
        else
        {
            $erreurs[] = "Nom d'utilisateur ou mot de passe invalide";
            $vue = new CreateurVue('vues/connexion.phtml');
            $vue->assigner('erreurs', $erreurs);
            echo $vue->generer();
        }
    }

    function deconnecter(): void
    {
        $this->detruireSession();
        $vue = new CreateurVue('vues/connexion.phtml');
        $vue->assigner('info', "Utilisateur déconnecté avec succès");
        echo $vue->generer();
    }

    function defaut(): void
    {
        $this->consulter();
    }
}
