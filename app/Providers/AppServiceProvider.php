<?php

namespace App\Providers;

use App\Brokers\Kafka\Facades\Producer;
use App\Brokers\Kafka\Message\Message;
use App\Interfaces\Broker\Producer\ProducerMessageInterface;
use App\Interfaces\Broker\ProducerInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProducerMessageInterface::class, Message::class);
        $this->app->bind(ProducerInterface::class, Producer::class);

        $this->app->bind('BrokerPresenter.Create', function ($app, array $params) {
            $model = $params[0];
            $ref = new \ReflectionClass($model);
            $presenterName = $ref->getShortName();

            $fullNameClass = app('Namespace.BrokerPresenter') . $presenterName;
            if (!class_exists($fullNameClass)) {
                throw new \Exception("Broker presenter $fullNameClass does not exist");
            }

            return new $fullNameClass($model);
        });

        $this->app->bind('Namespace.BrokerPresenter', function () {
            return "\\App\\Brokers\\Presenters\\";
        });

        $this->app->bind('BrokerTopic.Create', function ($app, array $params) {
            $model = $params[0];
            $ref = new \ReflectionClass($model);
            return $ref->getShortName();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
