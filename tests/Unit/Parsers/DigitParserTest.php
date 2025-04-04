<?php
/*
 * Copyright (c) 2025 shogogg
 * This code is licensed under MIT license (see LICENSE.md for details)
 */
declare(strict_types=1);

use Pacman\Pacman;

describe('::digit', function (): void {
    it('should matches any numeric character', function (string $input, string $expected): void {
        // Arrange
        $digit = Pacman::digit();

        // Act
        $actual = $digit->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['012', '0'],
        ['123', '1'],
        ['234', '2'],
        ['345', '3'],
        ['456', '4'],
        ['567', '5'],
        ['678', '6'],
        ['789', '7'],
        ['890', '8'],
        ['910', '9'],
    ]);

    it('should not matches any non-numeric character', function (string $input): void {
        // Arrange
        $digit = Pacman::digit();

        // Act
        $actual = $digit->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['abc'],
        ['!123'],
        [' 123'],
        ['abc123'],
    ]);
});
