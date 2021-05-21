<?php

declare(strict_types=1);

namespace App\Models\Order\Entities\Item;

use App\Models\Order\Entities\Order\Order;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\HasLifecycleCallbacks
 * @ORM\Table(name="order_item")
 */
class Item
{
    /**
     * @ORM\Column(type="order_item_id")
     * @ORM\Id
     */
    private Id $id;

    /**
     * @ORM\Column(type="string")
     */
    private string $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Models\Order\Entities\Order\Order", inversedBy="items")
     * @ORM\JoinColumn(name="order_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private Order $order;

    /**
     * Item constructor.
     * @param Order $order
     * @param Id $id
     * @param string $name
     */
    public function __construct(
        Order $order,
        Id $id,
        string $name
    ) {
        $this->id             = $id;
        $this->name           = $name;
        $this->order          = $order;
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
     * @return Order
     */
    public function getOrder(): Order
    {
        return $this->order;
    }
}
