<?php

namespace App\Entity;

use App\Repository\FeedItemRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FeedItemRepository::class)
 */
class FeedItem
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $comments;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $enclosure;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $guid;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $pubDate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $source;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(?string $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getComments(): ?string
    {
        return $this->comments;
    }

    public function setComments(?string $comments): self
    {
        $this->comments = $comments;

        return $this;
    }

    public function getEnclosure(): ?string
    {
        return $this->enclosure;
    }

    public function setEnclosure(?string $enclosure): self
    {
        $this->enclosure = $enclosure;

        return $this;
    }

    public function getGuid(): ?string
    {
        return $this->guid;
    }

    public function setGuid(?string $guid): self
    {
        $this->guid = $guid;

        return $this;
    }

    public function getPubDate(): ?\DateTimeInterface
    {
        // return $this->pubDate->format('D, d M Y H:i:s T');
        return $this->pubDate;
    }

    public function setPubDate(?\DateTimeInterface $pubDate): self
    {
        $this->pubDate = $pubDate;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(?string $source): self
    {
        $this->source = $source;

        return $this;
    }
}
