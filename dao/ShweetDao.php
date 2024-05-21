<?php

class ShweetDao extends BaseDao
{
    private UtilisateurDao $utilisateurDao;

    public function __construct(ConfigDao $config)
    {
        parent::__construct($config);
        $this->utilisateurDao = new UtilisateurDao($config);
    }

    public function select(?int $id): ?Shweet
    {
        $connexion = $this->getConnexion();

        $requete = $connexion->prepare("SELECT * FROM shweet WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();

        $shweet = null;
        if ($enregistrement = $requete->fetch())
        {
            $shweet = $this->construireShweet($enregistrement);
            $shweet->setAuteur($this->utilisateurDao->select($shweet->getAuteurId()));

            if (is_null($shweet->getParentId()))
            {
                $shweet->setEnfants($this->loadEnfants($shweet->getParentId()));
            }
        }
        return $shweet;
    }


    public function selectDerniersShweetsParents(int $limite = 20, int $auteurId = 0): array
    {
        $connexion = $this->getConnexion();

        $requete = null;

        if ($auteurId == 0)
        {
            $requete = $connexion->prepare("SELECT * FROM shweet WHERE parent_id IS NULL ORDER BY date_creation DESC LIMIT 20");
            // $requete->bindValue(":limite", $limite);
            $requete->execute();
        }
        else
        {
            $requete = $connexion->prepare("SELECT * FROM shweet WHERE( auteur_id=:auteur_id AND parent_id IS NULL) ORDER BY date_creation DESC LIMIT :limite");
            $requete->bindValue(":auteur_id", $auteurId);
            $requete->bindValue(":limite", $limite);
            $requete->execute();
        }

        // $requete->execute();

        $shweets = [];
        while ($enregistrement = $requete->fetch())
        {
            $shweet = $this->construireShweet($enregistrement);
            $shweet->setAuteur($this->utilisateurDao->select($shweet->getAuteurId()));
            $shweet->setEnfants($this->loadEnfants($shweet->getId()));

            $shweets[] = $shweet;
        }
        return $shweets;
    }

    public function insert(Shweet $shweet): void
    {
        $connexion = $this->getConnexion();
        try
        {
            $connexion->beginTransaction();

            $requete = $connexion->prepare("INSERT INTO shweet(texte, date_creation, auteur_id, parent_id) VALUES(:texte, NOW(), :auteur_id, :parent_id)");
            $requete->bindValue(":texte", $shweet->getTexte());
            $requete->bindValue(":auteur_id", $shweet->getAuteurId());
            $requete->bindValue(":parent_id", $shweet->getParentId());
            $requete->execute();

            $id = $connexion->lastInsertId();

            $connexion->commit();

            $shweet->setId($id);
        }
        catch (PDOException $e)
        {
            $connexion->rollBack();
            throw $e;
        }
    }

    public function delete(int $id): void
    {
        $connexion = $this->getConnexion();
        try
        {
            $connexion->beginTransaction();

            $requete = $connexion->prepare("DELETE FROM shweet WHERE id=:id");
            $requete->bindValue(":id", $id);
            $requete->execute();

            $connexion->commit();
        }
        catch (PDOException $e)
        {
            $connexion->rollBack();
            throw $e;
        }
    }

    private function loadEnfants(int $parentId): ?array
    {
        $connexion = $this->getConnexion();

        $requete = $connexion->prepare("SELECT * FROM shweet WHERE parent_id=:parent_id");
        $requete->bindValue(":parent_id", $parentId);
        $requete->execute();

        $shweetsEnfants = [];
        while ($enregistrement = $requete->fetch())
        {
            $shweet = $this->construireShweet($enregistrement);
            $shweet->setAuteur($this->utilisateurDao->select($shweet->getAuteurId()));

            $shweetsEnfants[] = $shweet;
        }
        return $shweetsEnfants;
    }

    private function construireShweet($enregistrement): ?Shweet
    {
        return new Shweet(
            $enregistrement['texte'],
            $enregistrement['auteur_id'],
            null,
            new DateTime($enregistrement['date_creation']),
            $enregistrement['parent_id'],
            array(),
            $enregistrement['id']
        );
    }
}
