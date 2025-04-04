<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

namespace Pacman\Parsers;

use Pacman\Contracts\Parser;
use Pacman\Contracts\ParserOutput;

/**
 * Abstract parser class.
 *
 * @template T
 * @implements Parser<T>
 */
abstract readonly class AbstractParser implements Parser
{
    /** {@inheritdoc} */
    public function parse(string $input): ParserOutput
    {
        return $this->parseFrom($input, 0);
    }

    /**
     * Parses the input string from the specified offset.
     *
     * @param string $input
     * @param int $offset
     * @return ParserOutput<T>
     */
    abstract protected function parseFrom(string $input, int $offset): ParserOutput;
}
