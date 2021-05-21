<?php

declare(strict_types=1);

namespace App\Company\Entity\Company;

use App\Http\Api\v1\ResponseFactory;
use App\Models\Order\Entities\Order\Id;
use App\Models\Order\Entities\Order\Order;
use App\Models\Order\Entities\Order\Status;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use DomainException;

/**
 * Class OrderRepository
 */
class OrderRepository
{
    /**
     * @var EntityManagerInterface
     */
    private EntityManagerInterface $em;

    /**
     * @var EntityRepository|\Doctrine\Persistence\ObjectRepository
     */
    private EntityRepository $repo;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repo = $em->getRepository(Order::class);
    }

    public function get(Id $id): Order
    {
        if (!$order = $this->repo->find($id->getValue())) {
            throw new DomainException('Order is not found.', ResponseFactory::ORDER_NOT_FOUND);
        }
        /** @var Order $order */
        return $order;
    }

    public function getArchived(Id $id): Order
    {
        if (!$order = $this->repo->findOneBy(['id' => $id->getValue(), 'status' => Status::ARCHIVE])) {
            throw new DomainException(
                ResponseFactory::getMessage(ResponseFactory::ORDER_NOT_FOUND),
                ResponseFactory::ORDER_NOT_FOUND
            );
        }
        /** @var Order $order */
        return $order;
    }

    public function add(Order $order): void
    {
        $this->em->persist($order);
    }

    public function remove(Order $order): void
    {
        $this->em->remove($order);
    }
}
