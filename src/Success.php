<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman;

use Pacman\Contracts\ParserOutput;

/**
 * Successful parsing output.
 *
 * @template T
 * @implements ParserOutput<T>
 */
final readonly class Success implements ParserOutput
{
    /**
     * {@see Success} constructor.
     *
     * @param T $value
     * @param int $length
     */
    private function __construct(
        private mixed $value,
        private int   $length,
    ) {
    }

    /**
     * Creates a new instance of {@see Success}.
     *
     * @template U
     * @param U $value
     * @param int $length
     * @return ParserOutput<U>
     */
    public static function of(mixed $value, int $length): ParserOutput
    {
        return new self($value, $length);
    }

    /** {@inheritdoc} */
    public function isSuccessful(): bool
    {
        return true;
    }

    /** {@inheritdoc} */
    public function length(): int
    {
        return $this->length;
    }

    /** {@inheritdoc} */
    public function value(): mixed
    {
        return $this->value;
    }
}
