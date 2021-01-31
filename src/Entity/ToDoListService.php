<?php

namespace App\Entity;

use App\Repository\ToDoListServiceRepository;
use App\Service\MailerService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;



use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ToDoListServiceRepository::class)
 */
class ToDoListService 
{
    protected  $mailer;
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Item::class, mappedBy="toDoListService")
     */
    private $item;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    public function __construct(MailerInterface $mailer)
    {
        $this->item = new ArrayCollection();
        // $this->date = new \DateTime('now');
        $this->mailer = $mailer;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Item[]
     */
    public function getItem(): Collection
    {
        return $this->item;
    }

    public function addItem(Item $item): self
    {
        switch ($this->item) {
            case $this->item->contains($item):
                throw new \LogicException('Un item contient un name (unique)');
                break;
            case count($this->item) > 10:
                throw new \LogicException('Une ToDoList peut contenir de 0 à 10 items');
                break;
            case count($this->item) == 8:
                $email = (new Email())
                ->from('hello@example.com')
                ->to('you@example.com')
                ->subject('Time for Symfony Mailer!')
                ->text('Sending emails is fun again!')
                ->html('<p>See Twig integration for better HTML integration!</p>');
                $this->mailer->send($email);
                throw new \LogicException('Vous ne peux plus qu’ajouter 2 items');
                break;
                default:
                $this->item[] = $item;
                $item->setToDoListService($this);
                return $this;

        }

    }
    public function removeItem(Item $item): self
    {
        if ($this->item->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getToDoListService() === $this) {
                $item->setToDoListService(null);
            }
        }

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}
