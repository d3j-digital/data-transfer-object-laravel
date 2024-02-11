<?php

namespace D3JDigital\DataTransferObject\Laravel;

use D3JDigital\DataTransferObject\Laravel\Macros\DTOCollection;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * @return void
     */
    public function boot(): void
    {
        Collection::macro('toDto', function () {
            return (new DTOCollection($this))->execute();
        });
    }
}