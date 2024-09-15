<?php

namespace App\Entity;
use App\Entity\Oficio;
use App\Entity\Delegacion;
use App\Repository\RegistroRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistroRepository::class)]
class Registro
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $dni = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $workAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $payment = null;

    #[ORM\Column(length: 255)]
    private ?string $time = null;

    #[ORM\Column]
    private ?bool $certification = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $institution = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $recomendation = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $images = null;

    #[ORM\ManyToOne(inversedBy: 'registros')]
    #[ORM\JoinColumn(nullable: false)]
    private ?oficio $oficio = null;

    /**
     * @var Collection<int, delegacion>
     */
    #[ORM\ManyToMany(targetEntity: delegacion::class, inversedBy: 'registros')]
    private Collection $delegacion;

    /**
     * @var Collection<int, Comment>
     */
    #[ORM\OneToMany(targetEntity: Comment::class, mappedBy: 'registro')]
    private Collection $comments;

    public function __construct()
    {
        $this->delegacion = new ArrayCollection();
        $this->comments = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getDni(): ?string
    {
        return $this->dni;
    }

    public function setDni(string $dni): static
    {
        $this->dni = $dni;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getWorkAddress(): ?string
    {
        return $this->workAddress;
    }

    public function setWorkAddress(?string $workAddress): static
    {
        $this->workAddress = $workAddress;

        return $this;
    }

    public function getPayment(): ?string
    {
        return $this->payment;
    }

    public function setPayment(string $payment): static
    {
        $this->payment = $payment;

        return $this;
    }

    public function getTime(): ?string
    {
        return $this->time;
    }

    public function setTime(string $time): static
    {
        $this->time = $time;

        return $this;
    }

    public function isCertification(): ?bool
    {
        return $this->certification;
    }

    public function setCertification(bool $certification): static
    {
        $this->certification = $certification;

        return $this;
    }

    public function getInstitution(): ?string
    {
        return $this->institution;
    }

    public function setInstitution(?string $institution): static
    {
        $this->institution = $institution;

        return $this;
    }

    public function getRecomendation(): ?string
    {
        return $this->recomendation;
    }

    public function setRecomendation(?string $recomendation): static
    {
        $this->recomendation = $recomendation;

        return $this;
    }

    public function getImages(): ?string
    {
        return $this->images;
    }

    public function setImages(?string $images): static
    {
        $this->images = $images;

        return $this;
    }

    public function getOficio(): ?oficio
    {
        return $this->oficio;
    }

    public function setOficio(?oficio $oficio): static
    {
        $this->oficio = $oficio;

        return $this;
    }

    /**
     * @return Collection<int, delegacion>
     */
    public function getDelegacion(): Collection
    {
        return $this->delegacion;
    }

    public function addDelegacion(delegacion $delegacion): static
    {
        if (!$this->delegacion->contains($delegacion)) {
            $this->delegacion->add($delegacion);
        }

        return $this;
    }

    public function removeDelegacion(delegacion $delegacion): static
    {
        $this->delegacion->removeElement($delegacion);

        return $this;
    }

    /**
     * @return Collection<int, Comment>
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): static
    {
        if (!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setRegistro($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): static
    {
        if ($this->comments->removeElement($comment)) {
            // set the owning side to null (unless already changed)
            if ($comment->getRegistro() === $this) {
                $comment->setRegistro(null);
            }
        }

        return $this;
    }
}
