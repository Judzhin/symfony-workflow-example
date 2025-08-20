<?php

namespace App\Entity;

use ApiPlatform\Metadata as AP;
use App\Repository\CategoryRepository;
use App\Serializer\SerializationGroups;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[AP\ApiResource(
//    formats: [
//        'xml',
//        'jsonld',
//        'csv' => ['text/csv']
//    ]
//    normalizationContext: ['groups' => [SerializationGroups::CATEGORY_READ]],
)]
#[AP\GetCollection(normalizationContext: ['groups' => [
    SerializationGroups::BASE_READ->name
]])]
#[AP\Get(normalizationContext: ['groups' => [
//    SerializationGroups::BASE_READ->name
]])]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups([SerializationGroups::BASE_READ->name])]
    private ?int $id = null;

    #[ORM\Column(type: Types::STRING, length: 50)]
    #[Groups([SerializationGroups::BASE_READ->name])]
    private string $title;

    #[ORM\Column(type: Types::STRING, length: 200)]
    #[Gedmo\Slug(fields: ['title'], updatable: true)]
    private string $slug;

    /**
     * @var iterable<int, Post>
     */
    #[ORM\OneToMany(targetEntity: Post::class, mappedBy: 'category')]
    private iterable $posts;

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

    public function setTitle(string $title): Category
    {
        $this->title = $title;
        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): Category
    {
        $this->slug = $slug;
        return $this;
    }

    public function getPosts(): iterable
    {
        return $this->posts;
    }

    public function setPosts(iterable $posts): Category
    {
        $this->posts = $posts;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): Category
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    #[ORM\PrePersist]
    public function setCreatedAtValue(): Category
    {
        $this->setCreatedAt(new \DateTime);
        $this->setUpdatedAt($this->getCreatedAt());
        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): Category
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * @return $this
     */
    public function setUpdatedAtValue(): Category
    {
        $this->setUpdatedAt(new \DateTime);
        return $this;
    }
}
