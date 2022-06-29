<?php

namespace Hera\Query;

interface QueryHandlerInterface
{
    /**
     * @param QueryInterface $query
     * @return mixed
     */
    public function dispatch(QueryInterface $query): mixed;
}