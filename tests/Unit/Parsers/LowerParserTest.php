<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::lower', function (): void {
    it('should matches any lowercase alphabetic character', function (string $input, string $expected): void {
        // Arrange
        $lower = Pacman::lower();

        // Act
        $actual = $lower->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['abc', 'a'],
        ['xyz', 'x'],
    ]);

    it('should not matches any non-lowercase alphabetic character', function (string $input): void {
        // Arrange
        $lower = Pacman::lower();

        // Act
        $actual = $lower->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['ABC'],
        ['123'],
        ['!abc'],
        [' xyz'],
    ]);
});
