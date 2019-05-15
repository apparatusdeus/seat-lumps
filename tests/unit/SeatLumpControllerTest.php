<?php

declare(strict_types=1);

namespace Tests\Kata;

use Kata\Controller\SeatLumpController;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class SeatLumpControllerTest extends TestCase
{
    /**
     * @var SeatLumpController
     */
    protected $controller;

    public function setUp() {
        $this->controller = new SeatLumpController();
    }

    /**
     * @test
     */
    public function test_return_seating_by_seat_count_returns_array(): void
    {
        Assert::assertIsArray($this->controller->returnSeatingBySeatCount(2));
    }

    public function test_return_seating_by_seat_count_returns_correct_count(): void
    {
        $result = $this->controller->returnSeatingBySeatCount(5);
        print_r($result);
        Assert::assertCount(5, $result);
    }

    public function test_seats_to_text_formats_correctly() {
        $seats = [
            [
                "row" => "C",
                "number" => 1,
            ],
            [
                "row" => "C",
                "number" => 2,
            ],
            [
                "row" => "C",
                "number" => 3,
            ],
            [
                "row" => "C",
                "number" => 4,
            ],
            [
                "row" => "C",
                "number" => 5,
            ]
        ];

        $result = $this->controller->seatsToText($seats, 0, 2);
        Assert::assertEquals($result, ' C1 C2');
    }
}
