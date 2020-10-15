<?php

namespace Api\Controllers;

class Controller
{
    protected $requestBody;

    protected $service;

    public function __construct($service)
    {
        $data = $_REQUEST;
        $this->requestBody = (object)$data;
        $this->service = $service;
    }

    public function getAll(): bool
    {
        $items = $this->service->getAll();
        return $this->json(['items' => $items], 200);
    }

    public function getOne(int $id): bool
    {
        $items = $this->service->getOne($id);
        return $this->json(['items' => $items], 200);
    }

    public function create(): bool
    {
        $http_code = 200;
        $http_out = $this->service->create((array)$this->requestBody);

        if (is_string($http_out)) {
            $http_code = 400;
        }

        return $this->json(['items' => $http_out], $http_code);
    }
}
