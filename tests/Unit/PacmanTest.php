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

describe('::anyOf', function (): void {
    it('should matches when any of the parsers match', function (string $input, string $expected, int $length): void {
        // Arrange
        $anyOf = Pacman::anyOf(
            Pacman::string('foo'),
            Pacman::alpha(),
            Pacman::digit(),
        );

        // Act
        $actual = $anyOf->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe($length);
        expect($actual->value())->toBe($expected);
    })->with([
        ['abc', 'a', 1],
        ['123', '1', 1],
        ['foo', 'foo', 3],
        ['bar', 'b', 1],
    ]);

    it('should not matches when none of the parsers match', function (string $input): void {
        // Arrange
        $anyOf = Pacman::anyOf(
            Pacman::string('foo'),
            Pacman::alpha(),
            Pacman::digit(),
        );

        // Act
        $actual = $anyOf->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['!abc'],
        [' foo'],
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

describe('::fake', function (): void {
    it('should always succeed when success is true', function (string $input, int $length): void {
        // Arrange
        $fake = Pacman::fake(success: true);

        // Act
        $actual = $fake->parse($input);

        // Assert
        expect($actual)->toBeSuccess();
        expect($actual->length())->toBe($length);
        expect($actual->value())->toBe($input);
    })->with([
        ['abc', 3],
        ['123', 3],
        ['!xyz', 4],
    ]);

    it('should always fail when success is false', function (string $input): void {
        // Arrange
        $fake = Pacman::fake(success: false);

        // Act
        $actual = $fake->parse($input);

        // Assert
        expect($actual)->toBeFailure();
    })->with([
        ['abc'],
        ['123'],
        ['!xyz'],
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
        ['A', 'A'],
        ['XYZ', 'X'],
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
