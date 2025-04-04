<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::alpha', function (): void {
    it('should matches any alphabetic character', function (string $input, string $expected): void {
        // Arrange
        $alpha = Pacman::alpha();

        // Act
        $actual = $alpha->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['a', 'a'],
        ['BC', 'B'],
        ['xyz', 'x'],
    ]);

    it('should not matches any non-alphabetic character', function (string $input): void {
        // Arrange
        $alpha = Pacman::alpha();

        // Act
        $actual = $alpha->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['123abc'],
        ['!xyz'],
        [' '],
    ]);
});
