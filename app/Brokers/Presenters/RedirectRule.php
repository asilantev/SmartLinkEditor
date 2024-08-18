<?php

namespace App\Brokers\Presenters;

class RedirectRule extends AbstractPresenter
{

    protected function getData(): array
    {
        return [
            'smart_link_id' => $this->model->smart_link_id,
            'target_url' => $this->model->target_url,
            'priority' => $this->model->priority,
            'is_active' => $this->model->is_active
        ];
    }
}
