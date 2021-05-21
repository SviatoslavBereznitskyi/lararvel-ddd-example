<?php

namespace App\Http\Controllers;

use App\Company\Entity\Company\OrderRepository;
use App\Http\Api\v1\ApiResponse;
use App\Models\Order\Entities\Order\Id;
use App\Models\Order\UseCases\Order;
use App\Models\Transformers\OrderTransformer;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceAbstract;
use Symfony\Component\HttpFoundation\Response;


class OrderController extends Controller
{
    public function create(Order\Create\Request $request, Order\Create\Handler $handler, Manager $fractal, OrderRepository $orders)
    {
        $id = Id::generate();

        $command = new Order\Create\Command($id, $request->descriprion, $request->name);

        $handler->handle($command);

        $order = $orders->get($id);

        $resource = new Item($order, OrderTransformer::class);
        return new ApiResponse(
            'Created',
            $fractal->createData($resource)->toArray()['data'],
            [],
            Response::HTTP_CREATED
        );
    }

    public function delete(string $id, Order\Delete\Handler $handler, OrderRepository $orders)
    {
        $command = new Order\Delete\Command(new Id($id));

        $handler->handle($command);

        return new ApiResponse(
            'Deleted',
            null,
            [],
            Response::HTTP_NO_CONTENT
        );
    }

    public function archive(string $id, Order\Archive\Handler $handler, Manager $fractal, OrderRepository $orders)
    {
        $id = new Id($id);

        $command = new Order\Archive\Command(new Id($id));

        $handler->handle($command);

        $order = $orders->get($id);

        $resource = new Item($order, OrderTransformer::class);
        return new ApiResponse(
            'Archived',
            $fractal->createData($resource)->toArray()['data'],
            [],
            Response::HTTP_CREATED
        );
    }

}
