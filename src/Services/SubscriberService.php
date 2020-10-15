<?php

namespace Api\Services;

use Api\Models\Subscriber;
use Api\Services\BaseSerice;

class SubscriberService extends BaseService
{
    public function __construct(Subscriber $model)
    {
        parent::__construct($model);
    }
}
