<?php

declare(strict_types=1);

namespace App\Models\Order\UseCases\Order\Create;

use App\Models\Order\Entities\Order\Id;

/**
 * Class Command
 */
class Command
{
    public Id $id;
    public string $description;
    public string $name;

    /**
     * Command constructor.
     * @param Id $id
     * @param string $description
     * @param string $name
     */
    public function __construct(Id $id, string $description, string $name)
    {
        $this->id = $id;
        $this->description = $description;
        $this->name = $name;
    }
}
