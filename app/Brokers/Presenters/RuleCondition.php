<?php

namespace App\Brokers\Presenters;


class RuleCondition extends AbstractPresenter
{

    protected function getData(): array
    {
        return [
            'rule_id' => $this->model->rule_id,
            'condition_type_id' => $this->model->condition_type_id,
            'condition_value' => $this->model->condition_value,
        ];
    }
}
