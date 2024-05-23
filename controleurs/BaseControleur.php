<?php

/**
 * Un contrôleur est responsable de gérer un ensemble d'actions qui ont un
 * lien étroit entre elles. Une action == une méthode.
 * 
 * Ex: Gestion des inscriptions, gestion de l'authentification, etc.
 * 
 * Un controleur doit obligatoirement implémenter
 * une action dite par défaut : "defaut()".
 * 
 * À la fin de l'exécution d'une action, 
 * le controleur doit générer une vue et l'afficher.
 */
abstract class BaseControleur
{
    const SEUIL_INACTIVITE = 300; // 5 minutes.

    /**
     * Configuration qui permettra de construire les DAO nécessaires
     */
    protected ConfigDao $configDao;

    /**
     * Constructeur 
     * 
     * @param ConfigDao $configDao La configuration pour construire des DAO
     */
    function __construct(ConfigDao $configDao)
    {
        $this->configDao = $configDao;
        if (session_status() !== PHP_SESSION_ACTIVE) session_start();
        $this->mettreAjourTempsActivite();
    }

    /**
     * Cette méthode permet de mettre à jour le temps de la dernière activité de l'utilisateur.
     * Si un utilisateur est connecté et que le temps d'inactivité est dépassé, 
     * la session est détruite et l'utilisateur est redirigé vers la page de connexion.
     * Si aucun utilisateur est connecté, elle ne fait rien.
     */
    private function mettreAjourTempsActivite(): void
    {
        if ($this->getUtilisateurConnecte() != null)
        {
            // S'il est connecté, il ne faut pas qu'il ait dépassé le temps d'inactivité
            if (time() - $_SESSION['derniereActivite'] < self::SEUIL_INACTIVITE)
            {
                // On met à jour le temps de sa dernière activité
                $_SESSION['derniereActivite'] = time();
            }
            // Inactif depuis trop longtemps, on déconnecte et on redirige vers la page de connexion
            else
            {
                $this->detruireSession();
                $vue = new CreateurVue('vues/connexion.phtml');
                $vue->assigner("erreurs", array("Votre session n'est plus valide. Veuillez-vous reconnecter."));
                echo $vue->generer();
                exit(); // Très important afin d'éviter que l'exécution continue
            }
        }
    }

    /**
     * Cette méthode permet de récupérer l'utilisateur connecté dans $_SESSION. 
     * Renvoie null si aucun utilisateur n'est connecté.
     */
    protected function getUtilisateurConnecte(): ?Utilisateur
    {
        // On vérifie si l'utilisateur est connecté en regardant dans $_SESSION
        if (isset($_SESSION['utilisateurConnecte']))
        {
            // On retourne l'utilisateur connecté
            return $_SESSION['utilisateurConnecte'];
        }

        // On renvoie null si la session ne contient aucun utilisateur
        return null;
    }

    /**
     * Cette méthode permet de détruire la session.
     * Elle vide la variable $_SESSION et détruit la session côté serveur.
     * Également, elle supprime le cookie côté client.
     */
    protected function detruireSession(): void
    {
        // On vide la variable $_SESSION
        $_SESSION = array();

        // On détruit le cookie côté client
        if (ini_get("session.use_cookies"))
        {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 60,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // On détruit complètement la session côté serveur
        session_destroy();
    }

    /**
     * Action par défaut du contrôleur.
     */
    abstract function defaut(): void;
}
