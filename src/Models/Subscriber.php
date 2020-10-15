<?php

namespace Api\Models;

use Api\Models\BaseModel;

class Subscriber extends BaseModel
{
    public const TABLE_NAME = 'subscribers';
    public const TABLE_FIELDS = ['email', 'name', 'state'];

    public const STATE_ENUM_FIELDS = ['active', 'unsubscribed', 'junk', 'bounced', 'unconfirmed'];

    public function validate()
    {
        if (!filter_var($this->attributes['email'], FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email';
        }

        $domain = strrchr($this->attributes['email'], '@');
        $host = substr($domain, 1);
        $active = checkdnsrr($host);

        if (!$active) {
            return 'Domain not active';
        }

        if (!is_null($this->attributes['state'])) {
            if (!in_array($this->attributes['state'], $this::STATE_ENUM_FIELDS)) {
                return 'State invalid. Valid values: ' . implode(',', $this::STATE_ENUM_FIELDS);
            }
        }
    }
}
