<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::whitespace', function (): void {
    it('should matches any whitespace character', function (string $input, string $expected): void {
        // Arrange
        $whitespace = Pacman::whitespace();

        // Act
        $actual = $whitespace->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        [' ', ' '],
        ["\n", "\n"],
        ["\t\r\n", "\t"],
        ["\r\n", "\r"],
    ]);

    it('should not matches any non-whitespace character', function (string $input): void {
        // Arrange
        $whitespace = Pacman::whitespace();

        // Act
        $actual = $whitespace->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['abc'],
        ['123'],
        ['!xyz'],
    ]);
});
