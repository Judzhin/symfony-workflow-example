<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

#[ORM\Entity(repositoryClass: PostRepository::class)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 200)]
    private string $title;

    #[ORM\Column(type: Types::STRING, length: 200)]
    #[Gedmo\Slug(fields: ['title'], updatable: true)]
    private string $slug;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'posts')]
    private Category $category;

    #[ORM\Column(type: Types::STRING, length: 500, nullable: true)]
    private ?string $shortDescription;

    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'posts')]
    ##[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id')]
    private Author $author;

    /**
     * @var iterable<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class)]
    private iterable $tags;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $publishedAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $updatedAt;
}
