<?php

namespace Kata;

interface SeatingPolicyInterface {

    /**
     * Returns a list of seating filtered by the implemented policy
     * @param array $seating An array of seating
     * @return array The filtered seating array
     */
    public function filterSeating(array $seating) : array;
}