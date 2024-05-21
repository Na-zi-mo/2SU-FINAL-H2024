<?php

class UtilisateurDao extends BaseDao
{
    public function __construct(ConfigDao $config)
    {
        parent::__construct($config);
    }

    public function select(?int $id): ?Utilisateur
    {
        $connexion = $this->getConnexion();

        $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE id=:id");
        $requete->bindValue(":id", $id);
        $requete->execute();

        $utilisateur = null;
        if ($enregistrement = $requete->fetch())
        {
            $utilisateur = $this->construireUtilisateur($enregistrement);
        }

        return $utilisateur;
    }

    public function selectParNomUtilisateur(string $nomUtilisateur): ?Utilisateur
    {
        $connexion = $this->getConnexion();

        $requete = $connexion->prepare("SELECT * FROM utilisateur WHERE nom_utilisateur=:nom_utilisateur");
        $requete->bindValue(":nom_utilisateur", $nomUtilisateur);
        $requete->execute();

        $utilisateur = null;
        if ($enregistrement = $requete->fetch())
        {
            $utilisateur = $this->construireUtilisateur($enregistrement);
        }

        return $utilisateur;
    }

    public function insert(Utilisateur $utilisateur): void
    {
        $connexion = $this->getConnexion();
        try
        {
            $connexion->beginTransaction();

            $requete = $connexion->prepare("INSERT INTO utilisateur(bio, localisation, url_site, nom_utilisateur, hash, date_creation, url_avatar) VALUES(:bio, :localisation, :url_site, :nom_utilisateur, :hash, NOW(), :url_avatar)");
            $requete->bindValue(":bio", $utilisateur->getBio());
            $requete->bindValue(":localisation", $utilisateur->getLocalisation());
            $requete->bindValue(":url_site", $utilisateur->getUrlSite());
            $requete->bindValue(":nom_utilisateur", $utilisateur->getNomUtilisateur());
            $requete->bindValue(":hash", $utilisateur->getHash());
            $requete->bindValue(":url_avatar", $utilisateur->getUrlAvatar());
            $requete->execute();

            $id = $connexion->lastInsertId();

            $connexion->commit();

            $utilisateur->setId($id);
        }
        catch (PDOException $e)
        {
            $connexion->rollBack();
            throw $e;
        }
    }
    private function construireUtilisateur($enregistrement): ?Utilisateur
    {
        return new Utilisateur(
            $enregistrement['bio'],
            $enregistrement['localisation'],
            $enregistrement['nom_utilisateur'],
            $enregistrement['hash'],
            $enregistrement['url_site'],
            $enregistrement['url_avatar'],
            new DateTime($enregistrement['date_creation']),
            $enregistrement['id']
        );
    }
}
