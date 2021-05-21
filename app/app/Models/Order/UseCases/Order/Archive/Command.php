<?php

declare(strict_types=1);

namespace App\Models\Order\UseCases\Order\Archive;

/**
 * Class Command
 */
class Command
{
    public string $id;

    /**
     * Command constructor.
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }
}
