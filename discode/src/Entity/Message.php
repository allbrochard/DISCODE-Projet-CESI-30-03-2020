<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date_creation;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\Column(type="boolean")
     */
    private $epingler;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Room", inversedBy="messages")
     * @ORM\JoinColumn(nullable=false)
     */
    private $room;


    public function __construct()
    {
        $this->room = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getEpingler(): ?bool
    {
        return $this->epingler;
    }

    public function setEpingler(bool $epingler): self
    {
        $this->epingler = $epingler;

        return $this;
    }

    public function getRoomId(): ?Room
    {
        return $this->room;
    }

    public function setRoomId(?Room $room): self
    {
        $this->room = $room;

        return $this;
    }

}
