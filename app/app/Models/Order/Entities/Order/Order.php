<?php

declare(strict_types=1);

namespace App\Models\Order\Entities\Order;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DomainException;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="order")
 */
class Order
{
    /**
     * @ORM\Column(type="order_id")
     * @ORM\Id
     */
    private Id $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\Column(type="order_status", length=16)
     */
    private Status $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private ?string $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Models\Order\Entities\Itme", mappedBy="order")
     */
    private Collection $items;

    public function __construct(
        Id $id,
        string $name,
        string $description
    ) {
        $this->id             = $id;
        $this->name           = $name;
        $this->description    = $description;
        $this->status         = Status::active();
        $this->items          = new ArrayCollection();
    }

    /**
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Status
     */
    public function getStatus(): Status
    {
        return $this->status;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }
    /**
     * @return string
     */
    public function getSpecialization(): ?string
    {
        return $this->specialization;
    }

    /**
     * @return ArrayCollection
     */
    public function getItems()
    {
        return $this->items;
    }

    public function activate(): void
    {
        if (!$this->isActive()) {
            throw new DomainException('Order is active.');
        }

        $this->status = Status::active();
    }

    public function archive(): void
    {
        if (!$this->isArchived()) {
            throw new DomainException('Order is archived.');
        }

        $this->status = Status::archive();
    }

    public function isActive(): bool
    {
        return $this->status->isActive();
    }

    public function isArchived(): bool
    {
        return $this->status->isArchived();
    }
}
