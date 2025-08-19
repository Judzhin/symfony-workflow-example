<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\AuthorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
#[ApiResource]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    #[ORM\Column(type: Types::STRING, length: 100)]
    private string $name;

    #[ORM\Column(type: Types::STRING, length: 200)]
    #[Gedmo\Slug(fields: ['name'], updatable: true, unique: true)]
    private string $slug;

    #[ORM\Column(type: Types::STRING, length: 50)]
    private string $shortDescription;

    #[ORM\Column(type: Types::STRING, length: 200, nullable: true)]
    private ?string $description;

    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'author')]
    private iterable $posts;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Author
    {
        $this->name = $name;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): Author
    {
        $this->slug = $slug;
        return $this;
    }

    public function getShortDescription(): string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): Author
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): Author
    {
        $this->description = $description;
        return $this;
    }

    public function getPosts(): iterable
    {
        return $this->posts;
    }

    public function setPosts(iterable $posts): Author
    {
        $this->posts = $posts;
        return $this;
    }
}
