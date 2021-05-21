<?php

declare(strict_types=1);

namespace App\Models\Order\Entities\Order;

use Webmozart\Assert\Assert;

/**
 * Class Status
 */
class Status
{
    public const ACTIVE = 'active';
    public const ARCHIVE = 'archive';

    private string $name;

    public function __construct(string $name)
    {
        Assert::oneOf($name, [
            self::ACTIVE,
            self::ARCHIVE,
        ]);
        $this->name = $name;
    }

    public static function archive(): self
    {
        return new self(self::ARCHIVE);
    }

    public static function active(): self
    {
        return new self(self::ACTIVE);
    }

    public function isArchived(): bool
    {
        return $this->name === self::ARCHIVE;
    }

    public function isActive(): bool
    {
        return $this->name === self::ACTIVE;
    }

    public function getName(): string
    {
        return $this->name;
    }
}
