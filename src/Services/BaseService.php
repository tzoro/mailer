<?php

namespace Api\Services;

use Api\Database\DatabaseFactory;

class BaseService
{
    private DatabaseFactory $db;
    private $model;

    public function __construct($model)
    {
        $this->db = new DatabaseFactory();
        $this->model = $model;
    }

    public function getAll(): array
    {
        $db     = $this->db->getInstance();
        $query  = "SELECT " . implode(',', $this->model::TABLE_FIELDS) . " FROM " . $this->model::TABLE_NAME;
        return $db->rows($query);
    }

    public function getOne(int $id): \stdClass
    {
        $db = $this->db->getInstance();
        return $db->getById($this->model::TABLE_NAME, $id);
    }

    public function create(array $params = [])
    {
        $db = $this->db->getInstance();
        $this->model->assignAttributes($params);
        $errors = $this->model->validate();

        if (!is_null($errors)) {
            return $errors;
        }

        try {
            $db->insert($this->model::TABLE_NAME, $params);
        } catch (\PDOException $e) {
            return $e->getMessage();
        } catch (\Exception $e) {
            throw $e;
        }

        $id = (int)$db->lastInsertId();
        return $id;
    }
}
