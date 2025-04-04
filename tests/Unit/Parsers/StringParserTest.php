<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::string', function (): void {
    it('should matches the specified string', function (string $input, string $expected, int $length): void {
        // Arrange
        $string = Pacman::string($expected);

        // Act
        $actual = $string->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe($length);
        expect($actual->value())->toBe($expected);
    })->with([
        ['abc', 'ab', 2],
        ['pencil', 'pen', 3],
        ['foo-bar-baz', 'foo', 3],
    ]);

    it('should not matches any non-matching string', function (string $input, string $expected): void {
        // Arrange
        $string = Pacman::string($expected);

        // Act
        $actual = $string->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['123456', '456'],
        ['pencil', 'cil'],
        ['foo-bar-baz', 'bar'],
    ]);
});
