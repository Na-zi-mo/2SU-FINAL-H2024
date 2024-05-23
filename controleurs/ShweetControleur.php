<?php
class ShweetControleur extends BaseControleur
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

    // function consulter(): void
    // {
    // }

    function shweetter(): void
    {
        $utilisateurConnecte = $this->getUtilisateurConnecte();
        if (isset($_POST['texte']) && !empty($_POST['texte']))
        {
            $texte = htmlspecialchars($_POST['texte']);

            $newShweet = new Shweet($texte, $utilisateurConnecte->getId(), $utilisateurConnecte);

            $this->shweetDao->insert($newShweet);

            $vue = new CreateurVue('vues/profil.phtml');
            $vue->assigner('utilisateur', $utilisateurConnecte);
            $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents($utilisateurConnecte->getId()));
            echo $vue->generer();
        }
        else
        {
            $erreurs[] = "Un shweet doit posséder entre 1 et 255 caractères.";
            $vue = new CreateurVue('vues/profil.phtml');
            $vue->assigner('utilisateur', $utilisateurConnecte);
            $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents($utilisateurConnecte->getId()));
            $vue->assigner('erreurs', $erreurs);
            echo $vue->generer();
        }
    }

    function lister(): void
    {
        $vue = new CreateurVue('vues/accueil.phtml');
        // $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
        $vue->assignerPlusieurs($this->shweetDao->selectDerniersShweetsParents());
        echo $vue->generer();
    }

    function supprimer(): void
    {
        $utilisateurConnecte = $this->getUtilisateurConnecte();
        if (isset($_POST['shweet-id']))
        {

            $shweet = $this->shweetDao->select($_POST['shweet-id']);
            if ($utilisateurConnecte->getId() == $shweet->getAuteurId())
            {
                if (isset($_POST['profil-origine-id']))
                {
                    $vue = new CreateurVue('vues/profil.phtml');

                    $shweet = $this->shweetDao->select($_POST['shweet-id']);

                    $currentUser = null;
                    if (is_null($shweet->getParentId()))
                    {
                        $currentUser = $this->utilisateurDao->select($shweet->getAuteurId());
                    }
                    else
                    {
                        $currentUser = $this->utilisateurDao->select($shweet->getParentId()?->getAuteurId());
                    }

                    $this->shweetDao->delete($_POST['shweet-id']);
                    $vue->assigner('utilisateur', $currentUser);
                    $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents($currentUser->getId()));
                    echo $vue->generer();
                }
                else
                {
                    $vue = new CreateurVue('vues/accueil.phtml');
                    $this->shweetDao->delete($_POST['shweet-id']);
                    $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
                    echo $vue->generer();
                }
            }
            else
            {
                $erreurs[] = "Il faut être auteur d'un shweet pour pouvoir le supprimer.";
                $vue = new CreateurVue('vues/profil.phtml');
                $vue->assigner('utilisateur', $utilisateurConnecte);
                $vue->assigner('erreurs', $erreurs);
                echo $vue->generer();
            }
        }
        else
        {
            $erreurs[] = "Un shweet doit être choisi pour être supprimé.";
            $vue = new CreateurVue('vues/profil.phtml');
            $vue->assigner('utilisateur', $utilisateurConnecte);
            $vue->assigner('erreurs', $erreurs);
            echo $vue->generer();
        }
    }

    function defaut(): void
    {
        // $this->__construct($configDao);
    }
}
