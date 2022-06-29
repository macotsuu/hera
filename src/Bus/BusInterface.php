<?php

namespace Hera\Bus;

use Hera\Command\CommandInterface;
use Hera\Query\QueryInterface;

interface BusInterface
{
    /**
     * @param QueryInterface|CommandInterface $query
     * @return mixed
     */
    public function handle(QueryInterface|CommandInterface $query): mixed;
}