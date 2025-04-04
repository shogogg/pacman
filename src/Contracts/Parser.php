<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman\Contracts;

/**
 * Interface for a parser.
 *
 * @template T
 */
interface Parser
{
    /**
     * Parses the input string.
     *
     * @param string $input
     * @return ParserOutput<T>
     */
    public function parse(string $input): ParserOutput;
}
