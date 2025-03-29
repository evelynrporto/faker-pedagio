<?php

class Faker
{
    public function numberBetween(int $min = 1, int $max = 100): int
    {
        return random_int($min, $max);
    }

    public function randomFloat(int $decimals = 2, float $min = 1.0, float $max = 10.0): float
    {
        $factor = pow(10, $decimals);
        $minInt = (int) ($min * $factor);
        $maxInt = (int) ($max * $factor);
        return random_int($minInt, $maxInt) / $factor;
    }

    public function date(string $format = 'Y-m-d'): string
    {
        $timestamp = random_int(strtotime('2000-01-01'), strtotime('2025-12-31'));
        return date($format, $timestamp);
    }

    public function dateTime(string $format = 'Y-m-d H:i:s'): string
    {
        $timestamp = random_int(strtotime('2000-01-01 00:00:00'), strtotime('2025-03-29 23:59:59'));
        return date($format, $timestamp);
    }

    public function licensePlate(): string
    {
        $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; //25
        $numbers = '0123456789';

        return
            $letters[random_int(0, 25)] .
            $letters[random_int(0, 25)] .
            $letters[random_int(0, 25)] .
            $numbers[random_int(0, 9)] .
            $letters[random_int(0, 25)] .
            $numbers[random_int(0, 9)] .
            $numbers[random_int(0, 9)];
    }

    public function name(int $maxLength = 10): string
    {
        $letters = 'abcdefghijklmnopqrstuvwxyz';
        $nameLength = random_int(2, $maxLength);

        $name = strtoupper($letters[random_int(0, 25)]);

        for ($i = 1; $i < $nameLength; $i++) {
            $name .= $letters[random_int(0, 25)];
        }

        return $name;
    }

}
