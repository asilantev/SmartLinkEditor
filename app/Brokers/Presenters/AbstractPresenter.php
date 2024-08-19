<?php

namespace App\Brokers\Presenters;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractPresenter implements \JsonSerializable
{
    public function __construct(protected Model $model)
    {
    }

    public function jsonSerialize(): mixed
    {
        $data = [
            'id' => $this->model->id,
            'deleted' => !$this->model->exists
        ];
        if ($this->model->exists) {
            $data['data'] = $this->getData();
        }

        return $data;
    }

    abstract protected function getData(): array;
}
