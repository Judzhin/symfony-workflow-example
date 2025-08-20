<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\PostRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Entity\File as EmbeddedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[Vich\Uploadable]
#[ApiResource]
#[ApiFilter(OrderFilter::class, properties: [
    'id', 'title', 'publishedAt', 'createdAt', 'updatedAt'
])]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 200)]
    #[Assert\NotBlank]
    #[Assert\Length(max: 200)]
    private string $title;

    #[ORM\Column(type: Types::STRING, length: 200)]
    #[Gedmo\Slug(fields: ['title'], updatable: true)]
    private string $slug;

    const string TYPE_DRAFT = 'DRAFT';
    const string TYPE_PUBLISHED = 'PUBLISHED';
    #[ORM\Column(type: Types::STRING, length: 10, options: ['default' => self::TYPE_DRAFT])]
    private string $type = self::TYPE_DRAFT;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'posts')]
    #[Assert\NotBlank]
    private Category $category;

    #[ORM\Column(type: Types::STRING, length: 500, nullable: true)]
    #[Assert\Length(max: 500)]
    private ?string $shortDescription;

    #[ORM\Column(type: Types::TEXT)]
    private string $description;

    #[ORM\ManyToOne(targetEntity: Author::class, inversedBy: 'posts')]
    ##[ORM\JoinColumn(name: 'author_id', referencedColumnName: 'id')]
    #[Assert\NotBlank]
    private Author $author;

    /**
     * @var iterable<int, Tag>
     */
    #[ORM\ManyToMany(targetEntity: Tag::class)]
    private iterable $tags;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $publishedAt;

    #[Vich\UploadableField(mapping: 'post_poster', fileNameProperty: 'posterName', size: 'posterSize')]
    private ?File $posterFile = null;

    #[ORM\Column(nullable: true)]
    private ?string $posterName = null;

    #[ORM\Column(nullable: true)]
    private ?int $posterSize = null;

    //#[ORM\Embedded(class: EmbeddedFile::class, columnPrefix: 'poster')]
    //private ?EmbeddedFile $poster = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private \DateTimeInterface $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Post
    {
        $this->title = $title;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): Post
    {
        $this->slug = $slug;
        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Post
    {
        $this->type = $type;
        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): Post
    {
        $this->category = $category;
        return $this;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(?string $shortDescription): Post
    {
        $this->shortDescription = $shortDescription;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Post
    {
        $this->description = $description;
        return $this;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): Post
    {
        $this->author = $author;
        return $this;
    }

    public function getTags(): iterable
    {
        return $this->tags;
    }

    public function setTags(iterable $tags): Post
    {
        $this->tags = $tags;
        return $this;
    }

    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    public function setPublishedAt(?\DateTimeInterface $publishedAt): Post
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    public function getPosterFile(): ?File
    {
        return $this->posterFile;
    }

    /**
     * @param File|null $posterFile
     * @return $this
     */
    public function setPosterFile(?File $posterFile = null): Post
    {
        $this->posterFile = $posterFile;
        if (null !== $posterFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->setUpdatedAtValue();
        }
        return $this;
    }

    public function getPosterName(): ?string
    {
        return $this->posterName;
    }

    public function setPosterName(?string $posterName): Post
    {
        $this->posterName = $posterName;
        return $this;
    }

    public function getPosterSize(): ?int
    {
        return $this->posterSize;
    }

    public function setPosterSize(?int $posterSize): Post
    {
        $this->posterSize = $posterSize;
        return $this;
    }

    // public function getPoster(): ?EmbeddedFile
    // {
    //     return $this->poster;
    // }
    //
    // public function setPoster(?EmbeddedFile $poster): Post
    // {
    //     $this->poster = $poster;
    //     return $this;
    // }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): Post
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): Post
    {
        $this->setCreatedAt(new \DateTime);
        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): Post
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    #[ORM\PrePersist]
    #[ORM\PreUpdate]
    public function setUpdatedAtValue(): Post
    {
        $this->setUpdatedAt(new \DateTime);
        return $this;
    }
}
