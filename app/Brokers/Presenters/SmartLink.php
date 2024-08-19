<?php

namespace App\Brokers\Presenters;

class SmartLink extends AbstractPresenter
{
    protected function getData(): array
    {
        return [
            'slug' => $this->model->slug,
            'default_url' => $this->model->default_url,
            'expires_at' => $this->model->expires_at
        ];
    }
}
