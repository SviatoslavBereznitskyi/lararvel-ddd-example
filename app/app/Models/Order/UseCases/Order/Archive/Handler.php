<?php

declare(strict_types=1);

namespace App\Models\Order\UseCases\Order\Archive;

use App\Company\Entity\Company\OrderRepository;
use App\Models\Order\Entities\Order\Id;
use App\Models\Order\Entities\Order\Order;
use App\Services\Flusher;

/**
 * Class Handler
 */
class Handler
{
    private Flusher $flusher;
    private OrderRepository $orders;

    public function __construct(Flusher $flusher, OrderRepository $orders)
    {
        $this->flusher = $flusher;
        $this->orders = $orders;
    }

    public function handle(Command $command): void
    {
        $order = $this->orders->get(new Id($command->id));

        $order->archive();

        $this->flusher->flush();
    }
}
