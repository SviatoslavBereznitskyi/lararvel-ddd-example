<?php

declare(strict_types=1);

namespace App\Models\Transformers;

use App\Models\Order\Entities\Order\Order;
use League\Fractal\TransformerAbstract;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class OrderTransformer
 */
class OrderTransformer extends TransformerAbstract
{
    /**
     * @var SerializerInterface|NormalizerInterface
     */
    private SerializerInterface $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    public function transform(Order $company): array
    {
        $dto = new Dto\Order();

        $dto->id         = $company->getId()->getValue();

        /** @var NormalizerInterface $normalizer */
        $normalizer = $this->serializer;

        /** @var array $data */
        $data = $normalizer->normalize($dto);

        return $data;
    }
}
