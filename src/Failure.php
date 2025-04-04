<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman;

use Pacman\Contracts\ParserOutput;

/**
 * Failed parsing output.
 *
 * @implements ParserOutput<never>
 */
final readonly class Failure implements ParserOutput
{
    /**
     * Creates a new instance of {@see Failure}.
     *
     * @return ParserOutput<never>
     */
    public static function getInstance(): ParserOutput
    {
        return new self();
    }

    /** {@inheritdoc} */
    public function isSuccessful(): bool
    {
        return false;
    }

    /** {@inheritdoc} */
    public function length(): int
    {
        return 0;
    }

    /** {@inheritdoc} */
    public function value(): never
    {
        throw new \LogicException('There is no value.');
    }
}
