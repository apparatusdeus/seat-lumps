<?php

declare(strict_types=1);

namespace Kata\Inventory;

class MockInventoryHttpClient
{
    /**
     * Perform an HTTP request to the given method verb and uri and returns the HTTP response body as a string.
     *
     * @param string $method Http method: "GET", "POST", "PUT", "PATCH", "DELETE"
     * @param string $uri    Request uri: "/api/resource"
     *
     * @return string
     */
    public function request(string $method, string $uri): string
    {
        return file_get_contents('../availability.json');
    }
}
