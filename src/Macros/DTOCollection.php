<?php

namespace D3JDigital\DataTransferObject\Laravel\Macros;

use D3JDigital\DataTransferObject\DataTransferObject;

class DTOCollection
{
    const METHOD_NAME = 'toDto';

    public function __construct(
        protected $collection,
    ) {}

    /**
     * @return mixed
     */
    public function execute(): mixed
    {
        return $this->collection->map(function ($result) {
            $method = self::METHOD_NAME;

            if (method_exists($result, $method)) {
                $class = $result->{$method}();
                if ($class instanceof DataTransferObject) {
                    return $class;
                }
            }
            return null;
        });
    }
}