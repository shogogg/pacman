<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::upper', function (): void {
    it('should matches any uppercase alphabetic character', function (string $input, string $expected): void {
        // Arrange
        $upper = Pacman::upper();

        // Act
        $actual = $upper->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['ABC123', 'A'],
        ['XYZ456', 'X'],
    ]);

    it('should not matches any non-uppercase alphabetic character', function (string $input): void {
        // Arrange
        $upper = Pacman::upper();

        // Act
        $actual = $upper->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['abc'],
        ['123'],
        ['!ABC'],
        [' ABC'],
    ]);
});
