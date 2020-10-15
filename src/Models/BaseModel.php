<?php

namespace Api\Models;

abstract class BaseModel
{
    protected int $id;
    protected array $attributes;

    public function assignAttributes($data)
    {
        foreach ($this::TABLE_FIELDS as $key => $val) {
            $this->attributes[$val] = $data[$val];
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }
}
