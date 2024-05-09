<?php

class Shweet
{
    private int $id;
    private string $texte;
    private int $auteurId;
    private ?Utilisateur $auteur;
    private ?DateTime $dateCreation;
    private ?int $parentId;
    private ?Shweet $parent;
    private array $enfants;

    public function __construct(
        string $texte,
        int $auteurId,
        ?Utilisateur $auteur,
        DateTime $dateCreation = null,
        ?int $parentId = null,
        ?array $enfant = array(),
        int $id = 0
    )
    {
        $this->setId($id);
        $this->setTexte($texte);
        $this->setAuteurId($auteurId);
        $this->setAuteur($auteur);
        $this->setDateCreation($dateCreation);
        $this->setParentId($parentId);
        $this->setParent(null);
        $this->setEnfants($enfant);
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
     * Get the value of texte
     *
     * @return string
     */
    public function getTexte(): string
    {
        return $this->texte;
    }

    /**
     * Set the value of texte
     *
     * @param string $texte
     *
     * @return self
     */
    public function setTexte(string $texte): self
    {
        $texte = trim($texte);
        if (empty($texte) || strlen($texte) > 255)
            throw new Exception("Le texte '$texte' doit être entre 1 et 255 caractères.");
        $this->texte = $texte;
        return $this;
    }

    /**
     * Get the value of auteurId
     *
     * @return int
     */
    public function getAuteurId(): int
    {
        return $this->auteurId;
    }

    /**
     * Set the value of auteurId
     *
     * @param int $auteurId
     *
     * @return self
     */
    public function setAuteurId(int $auteurId): self
    {
        $this->auteurId = $auteurId;
        return $this;
    }

    /**
     * Get the value of auteur
     *
     * @return ?Utilisateur
     */
    public function getAuteur(): ?Utilisateur
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     *
     * @param ?Utilisateur $auteur
     *
     * @return self
     */
    public function setAuteur(?Utilisateur $auteur): self
    {
        $this->auteur = $auteur;
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

    /**
     * Get the value of parentId
     *
     * @return ?int
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * Set the value of parentId
     *
     * @param ?int $parentId
     *
     * @return self
     */
    public function setParentId(?int $parentId): self
    {
        $this->parentId = $parentId;
        return $this;
    }

    /**
     * Get the value of parent
     *
     * @return ?Shweet
     */
    public function getParent(): ?Shweet
    {
        return $this->parent;
    }

    /**
     * Set the value of parent
     *
     * @param ?Shweet $parent
     *
     * @return self
     */
    public function setParent(?Shweet $parent): self
    {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get the value of enfants
     *
     * @return array
     */
    public function getEnfants(): array
    {
        return $this->enfants;
    }

    /**
     * Set the value of enfants
     *
     * @param array $enfants
     *
     * @return self
     */
    public function setEnfants(array $enfants): self
    {
        $this->enfants = $enfants;
        return $this;
    }
}
