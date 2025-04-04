<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman\Contracts;

/**
 * Interface for the result of a parser.
 *
 * @template T
 */
interface ParserOutput
{
    /**
     * Returns true if the parsing was successful.
     *
     * @return bool returns true if the parsing was successful, false otherwise.
     */
    public function isSuccessful(): bool;

    /**
     * Returns the value.
     *
     * @return T
     */
    public function value(): mixed;

    /**
     * Returns the length of the consumed input.
     *
     * @return int
     */
    public function length(): int;
}
