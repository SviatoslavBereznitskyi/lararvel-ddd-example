<?php

declare(strict_types=1);

namespace App\Models\Order\UseCases\Order\Delete;

use App\Models\Order\Entities\Order\Id;

/**
 * Class Command
 */
class Command
{
    public Id $id;

    /**
     * Command constructor.
     * @param Id $id
     */
    public function __construct(Id $id)
    {
        $this->id = $id;
    }
}
