<?php

class Utilisateur
{
    private int $id;
    private string $bio;
    private string $localisation;
    private string $nomUtilisateur;
    private string $hash;
    private ?string $urlSite;
    private ?string $urlAvatar;
    private ?DateTime $dateCreation;

    public function __construct(
        string $bio,
        string $localisation,
        string $nomUtilisateur,
        string $hash,
        ?string $urlSite = null,
        ?string $urlAvatar = null,
        ?DateTime $dateCreation = null,
        int $id = 0
    )
    {
        $this->setId($id);
        $this->setBio($bio);
        $this->setLocalisation($localisation);
        $this->setNomUtilisateur($nomUtilisateur);
        $this->setHash($hash);
        $this->setUrlSite($urlSite);
        $this->setUrlAvatar($urlAvatar);
        $this->setDateCreation($dateCreation);
    }

    /**
     * Get the value of id
     *
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @param int $id
     *
     * @return self
     */
    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Get the value of bio
     *
     * @return string
     */
    public function getBio(): string
    {
        return $this->bio;
    }

    /**
     * Set the value of bio
     *
     * @param string $bio
     *
     * @return self
     */
    public function setBio(string $bio): self
    {
        $bio = trim($bio);
        if (empty($bio) || strlen($bio) > 255)
            throw new Exception("La bio '$bio' doit être entre 1 et 255 caractères.");
        $this->bio = $bio;
        return $this;
    }

    /**
     * Get the value of localisation
     *
     * @return string
     */
    public function getLocalisation(): string
    {
        return $this->localisation;
    }

    /**
     * Set the value of localisation
     *
     * @param string $localisation
     *
     * @return self
     */
    public function setLocalisation(string $localisation): self
    {
        $localisation = trim($localisation);
        if (empty($localisation) || strlen($localisation) > 100)
            throw new Exception("La localisation '$localisation' doit être entre 1 et 100 caractères.");
        $this->localisation = $localisation;
        return $this;
    }

    /**
     * Get the value of nomUtilisateur
     *
     * @return string
     */
    public function getNomUtilisateur(): string
    {
        return $this->nomUtilisateur;
    }

    /**
     * Set the value of nomUtilisateur
     *
     * @param string $nomUtilisateur
     *
     * @return self
     */
    public function setNomUtilisateur(string $nomUtilisateur): self
    {
        $nomUtilisateur = trim($nomUtilisateur);
        if (empty($nomUtilisateur) || strlen($nomUtilisateur) > 50)
            throw new Exception("Le nomUtilisateur '$nomUtilisateur' doit être entre 1 et 50 caractères.");
        $this->nomUtilisateur = $nomUtilisateur;
        return $this;
    }

    /**
     * Get the value of hash
     *
     * @return string
     */
    public function getHash(): string
    {
        return $this->hash;
    }

    /**
     * Set the value of hash
     *
     * @param string $hash
     *
     * @return self
     */
    public function setHash(string $hash): self
    {
        $hash = trim($hash);
        if (empty($hash) || strlen($hash) > 255)
            throw new Exception("Le hash '$hash' doit être entre 1 et 255 caractères.");
        $this->hash = $hash;
        return $this;
    }

    /**
     * Get the value of urlSite
     *
     * @return ?string
     */
    public function getUrlSite(): ?string
    {
        return $this->urlSite;
    }

    /**
     * Set the value of urlSite
     *
     * @param ?string $urlSite
     *
     * @return self
     */
    public function setUrlSite(?string $urlSite): self
    {
        $urlSite = trim($urlSite);
        if (!empty($urlSite) && strlen($urlSite) > 255)
            throw new Exception("Le urlSite '$urlSite' doit être entre 1 et 255 caractères.");
        $this->urlSite = $urlSite;
        return $this;
    }

    /**
     * Get the value of urlAvatar
     *
     * @return ?string
     */
    public function getUrlAvatar(): ?string
    {
        return $this->urlAvatar;
    }

    /**
     * Set the value of urlAvatar
     *
     * @param ?string $urlAvatar
     *
     * @return self
     */
    public function setUrlAvatar(?string $urlAvatar): self
    {
        $urlAvatar = trim($urlAvatar);
        if (!empty($urlAvatar) && strlen($urlAvatar) > 255)
            throw new Exception("Le urlAvatar '$urlAvatar' doit être entre 1 et 255 caractères.");
        $this->urlAvatar = $urlAvatar;
        return $this;
    }

    /**
     * Get the value of dateCreation
     *
     * @return ?DateTime
     */
    public function getDateCreation(): ?DateTime
    {
        return $this->dateCreation;
    }

    /**
     * Set the value of dateCreation
     *
     * @param ?DateTime $dateCreation
     *
     * @return self
     */
    public function setDateCreation(?DateTime $dateCreation): self
    {
        $this->dateCreation = $dateCreation;
        return $this;
    }
}
