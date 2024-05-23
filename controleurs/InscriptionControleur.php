<?php

class InscriptionControleur extends BaseControleur
{
    private UtilisateurDao $utilisateurDao;

    function __construct(ConfigDao $configDao)
    {
        parent::__construct($configDao);
        $this->utilisateurDao = new UtilisateurDao($configDao);
    }

    function consulter(): void
    {
        $vue = new CreateurVue('vues/inscription.phtml');
        echo $vue->generer();
    }

    function creerProfil(): void
    {
        $vue = new CreateurVue('vues/inscription.phtml');
        $erreurs = array();
        $info = "";

        $nomUtilisateur = htmlspecialchars($_POST['nom-utilisateur']);
        $motDePasse = $_POST['mot-de-passe'];
        $confirmationMotDePasse = $_POST['confirmation-mot-de-passe'];
        $bio = $_POST['bio'];
        $localisation = $_POST['localisation'];
        $urlSite = $_POST['url-site'];
        $urlAvatar = $_POST['url-avatar'];

        if (!isset($nomUtilisateur) || (strlen($nomUtilisateur) < 1 || strlen($nomUtilisateur) > 50))
        {
            $erreurs['nomUtilisateur'] = "Le nom doit contenir entre 1 et 50 caractères.";
        }

        if (!isset($motDePasse) || (strlen($motDePasse) < 5))
        {
            $erreurs['motDePasse'] = "Le mot de passe doit contenir 5 caractères minimum.";
        }
        else
        {
            if (!isset($confirmationMotDePasse))
            {
                $erreurs['motDePasse'] = "Veuillez confirmer le mot de passe.";
            }
            elseif ($confirmationMotDePasse != $motDePasse)
            {
                $erreurs['motDePasse'] = "Les deux mots de passe ne correspondent pas.";
            }
        }

        if (!isset($bio) || (strlen($bio) < 10 || strlen($bio) > 255))
        {
            $erreurs['bio'] = "La bio doit contenir entre 10 et 255 caractères.";
        }

        if (!isset($localisation) || (strlen($localisation) < 1 || strlen($localisation) > 100))
        {
            $erreurs['localisation'] = "La localisation doit contenir entre 1 et 100 caractères.";
        }

        if (!empty($urlSite) && (!filter_var($urlSite, FILTER_VALIDATE_URL) || strlen(filter_var($urlSite, FILTER_VALIDATE_URL)) > 255))
        {
            $erreurs['urlSite'] = "L url du site doit être valide et contenir 255 caractères maximum.";
        }

        if (!empty($urlAvatar) && (!filter_var($urlAvatar, FILTER_VALIDATE_URL) || strlen(filter_var($urlAvatar, FILTER_VALIDATE_URL)) > 255))
        {
            $erreurs['urlAvatar'] = "L url de l avatar doit être valide et contenir 255 caractères maximum.";
        }

        if (empty($erreurs))
        {
            $newUser = new Utilisateur($bio, $localisation, $nomUtilisateur, password_hash($motDePasse, PASSWORD_DEFAULT), $urlSite, $urlAvatar);

            try
            {
                $this->utilisateurDao->insert($newUser);
                $nomUtilisateur = "";
                $motDePasse = "";
                $confirmationMotDePasse = "";
                $bio = "";
                $localisation = "";
                $urlSite = "";
                $urlAvatar = "";
            }
            catch (Exception $ex)
            {
                $erreurs[] = $ex->getMessage();
                $vue->assigner('erreurs', $erreurs);
                echo $vue->generer();
            }

            $vue = new CreateurVue('vues/connexion.phtml');
            $info = "Inscription réussie. Veuillez vous connecter.";
            $vue->assigner('info', $info);
            echo $vue->generer();
        }
        else
        {
            $vue->assigner('erreurs', $erreurs);
            $vue->assigner('nomUtilisateur', $nomUtilisateur);
            $vue->assigner('motDePasse', $motDePasse);
            $vue->assigner('confirmationMotDePasse', $confirmationMotDePasse);
            $vue->assigner('bio', $bio);
            $vue->assigner('localisation', $localisation);
            $vue->assigner('urlSite', $urlSite);
            $vue->assigner('urlAvatar', $urlAvatar);
            echo $vue->generer();
        }
    }

    function defaut(): void
    {
        $this->consulter();
    }
}
