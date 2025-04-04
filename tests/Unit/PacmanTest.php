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

describe('::alphaNum', function (): void {
    it('should matches any alphanumeric character', function (string $input, string $expected): void {
        // Arrange
        $alphaNum = Pacman::alphaNum();

        // Act
        $actual = $alphaNum->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe(1);
        expect($actual->value())->toBe($expected);
    })->with([
        ['abc', 'a'],
        ['123', '1'],
        ['abc123', 'a'],
    ]);

    it('should not matches any non-alphanumeric character', function (string $input): void {
        // Arrange
        $alphaNum = Pacman::alphaNum();

        // Act
        $actual = $alphaNum->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['!abc'],
        [' '],
    ]);
});

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
