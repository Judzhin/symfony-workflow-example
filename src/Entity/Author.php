<?php

namespace App\Entity;

use App\Repository\AuthorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: AuthorRepository::class)]
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
}
