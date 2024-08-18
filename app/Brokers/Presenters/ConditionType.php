<?php

namespace App\Brokers\Presenters;

class ConditionType extends AbstractPresenter
{
    protected function getData(): array
    {
        return [
            'code' => $this->model->code,
            'name' => $this->model->name,
        ];
    }
}
