<?php

namespace Kata\Controller;

use Kata\Inventory\MockInventoryHttpClient;

class SeatLumpController {

    public function seatsToText($seats, $from, $count): string {
        $text = '';
        for($i = $from; $i < $from + $count; $i++) {
            $text .= ' ' . $seats[$i]['row'] . $seats[$i]['number'];
        }
        return $text;
    }

    /**
     * @param int $numberOfSeats
     * @return array List of seat options available to the customer
     */
    public function returnSeatingBySeatCount(int $numberOfSeats) {
        $availableSeats = [];

        $httpClient = new MockInventoryHttpClient();
        $responseBody = $httpClient->request('GET', '/availability/products/1587/quantity/2/seats?date=20190111&time=1930');

        $seating = json_decode($responseBody, true);

        foreach($seating['areas'] as $area) {
            foreach($area['groupings'] as $grouping) {
                $availableCount = $grouping['availableCount'];
                if($availableCount == $numberOfSeats || $availableCount >= $numberOfSeats + 2) {
                    $option = $area['name'] . ' -';
                    $option .= $this->seatsToText($grouping['seats'], 0, $numberOfSeats);
                    $availableSeats[] = $option;
                }
                if($availableCount >= $numberOfSeats + 2) {
                    for($i = 2; $i < ($availableCount - $numberOfSeats) - 1; $i++) {
                        $option = $area['name'] . ' -';
                        $option .= $this->seatsToText($grouping['seats'], $i, $numberOfSeats);
                        $availableSeats[] = $option;
                    }

                    $option = $area['name'] . ' -';
                    $option .= $this->seatsToText($grouping['seats'], $availableCount - $numberOfSeats, $numberOfSeats);
                    $availableSeats[] = $option;
                }
            }
        }

        return $availableSeats;
    }
}