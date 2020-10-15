<?php

namespace Api\Controllers;

use Api\Services\SubscriberService;
use Api\Http\JsonResponseTrait;
use Api\Controllers\Controller;

class SubscriberController extends Controller
{
    use JsonResponseTrait;

    private SubscriberService $subscriberService;

    public function __construct(SubscriberService $subscriberService)
    {
        parent::__construct($subscriberService);
    }
}
