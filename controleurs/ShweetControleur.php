<?php
class ShweetControleur extends BaseControleur
{
    private ShweetDao $shweetDao;
    private UtilisateurDao $utilisateurDao;

    function __construct(ConfigDao $configDao)
    {
        parent::__construct($configDao);
        $this->shweetDao = new ShweetDao($configDao);
        $this->utilisateurDao = new UtilisateurDao($configDao);
    }

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
        $vue->assignerPlusieurs($this->shweetDao->selectDerniersShweetsParents());
        echo $vue->generer();
    }

    function commenter(): void
    {
        $utilisateurConnecte = $this->getUtilisateurConnecte();
        $vue = null;
        if (isset($_POST['profil-origine-id']))
        {
            $vue = new CreateurVue('vues/profil.phtml');
        }
        else
        {
            $vue = new CreateurVue('vues/accueil.phtml');
        }
        if (isset($utilisateurConnecte))
        {

            if (isset($_POST['parent-id']))
            {

                $parentId = $_POST['parent-id'];
                if (isset($_POST['texte']) && !empty($_POST['texte']))
                {
                    $shweetParent = $this->shweetDao->select($_POST['parent-id']);
                    $texte = $_POST['texte'];

                    $shweetComment =  new Shweet($texte, $utilisateurConnecte->getId(), $utilisateurConnecte, null, $parentId, $shweetParent);

                    $this->shweetDao->insert($shweetComment);

                    if (isset($_POST['profil-origine-id']))
                    {
                        $vue->assigner('utilisateur', $this->utilisateurDao->select($_POST['profil-origine-id']));
                        $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents($_POST['profil-origine-id']));
                        echo $vue->generer();
                    }
                    else
                    {
                        $vue->assigner('utilisateur', $this->utilisateurDao->select($_POST['profil-origine-id']));
                        $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
                        echo $vue->generer();
                    }
                }
                else
                {
                    $erreurs[] = "Un shweet doit posséder entre 1 et 255 caractères.";
                    $vue->assigner('utilisateur', $utilisateurConnecte);
                    $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents($utilisateurConnecte->getId()));
                    $vue->assigner('erreurs', $erreurs);
                    echo $vue->generer();
                }
            }
            else
            {
                $erreurs[] = "Un shweet doit être choisi pour être commenter.";
                $vue->assigner('utilisateur', $utilisateurConnecte);
                $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
                $vue->assigner('erreurs', $erreurs);
                echo $vue->generer();
            }
        }
        else
        {
            $erreurs[] = "Il faut être connecté pour commenter.";
            $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
            $vue->assigner('erreurs', $erreurs);
            echo $vue->generer();
        }
    }

    function supprimer(): void
    {
        $utilisateurConnecte = $this->getUtilisateurConnecte();
        $vue = null;
        if (isset($_POST['profil-origine-id']))
        {
            $vue = new CreateurVue('vues/profil.phtml');
        }
        else
        {
            $vue = new CreateurVue('vues/accueil.phtml');
        }
        if (isset($utilisateurConnecte))
        {
            if (isset($_POST['shweet-id']))
            {

                $shweet = $this->shweetDao->select($_POST['shweet-id']);
                if ($utilisateurConnecte->getId() == $shweet->getAuteurId())
                {
                    if (isset($_POST['profil-origine-id']))
                    {

                        $shweet = $this->shweetDao->select($_POST['shweet-id']);

                        $this->shweetDao->delete($_POST['shweet-id']);
                        $vue->assigner('utilisateur', $this->utilisateurDao->select($_POST['profil-origine-id']));
                        $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents($_POST['profil-origine-id']));
                        echo $vue->generer();
                    }
                    else
                    {
                        $this->shweetDao->delete($_POST['shweet-id']);
                        $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
                        echo $vue->generer();
                    }
                }
                else
                {
                    $erreurs[] = "Il faut être auteur d'un shweet pour pouvoir le supprimer.";
                    if (isset($_POST['profil-origine-id']))
                    {
                        $vue->assigner('utilisateur', $utilisateurConnecte);
                        $vue->assigner('erreurs', $erreurs);
                    }
                    else
                    {
                        $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
                        $vue->assigner('erreurs', $erreurs);
                    }
                    echo $vue->generer();
                }
            }
            else
            {
                $erreurs[] = "Un shweet doit être choisi pour être supprimé.";
                $vue->assigner('utilisateur', $utilisateurConnecte);
                $vue->assigner('erreurs', $erreurs);
                echo $vue->generer();
            }
        }
        else
        {
            $erreurs[] = "Il faut être connecté pour supprimer un shweet.";
            $vue->assigner('shweets', $this->shweetDao->selectDerniersShweetsParents());
            $vue->assigner('erreurs', $erreurs);
            echo $vue->generer();
        }
    }

    function defaut(): void
    {
    }
}
