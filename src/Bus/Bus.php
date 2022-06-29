<?php

namespace Hera\Bus;

use Exception;
use Hera\Command\CommandHandlerInterface;
use Hera\Command\CommandInterface;
use Hera\Query\QueryHandlerInterface;
use Hera\Query\QueryInterface;

class Bus implements BusInterface
{
    /** @var array */
    private array $handlers = [];

    /**
     * Handle and get result for QueryInterface|CommandInterface
     *
     * @param QueryInterface|CommandInterface $query
     * @return mixed
     * @throws Exception
     */
    public function handle(QueryInterface|CommandInterface $query): mixed
    {
        $handler = $this->resolveHandler($query::class);
        return $handler->dispatch($query);
    }

    /**
     * Get handler for given instance of.
     *
     * @param string $query Valid instance of QueryInterface|CommandInterface
     * @return QueryHandlerInterface|CommandHandlerInterface
     * @throws Exception
     */
    public function resolveHandler(string $query): QueryHandlerInterface|CommandHandlerInterface
    {
        if (!isset($this->handlers[$query])) {
            throw new Exception(sprintf("Handler for query %s not found", $query));
        }

        return new $this->handlers[$query];
    }

    /**
     * Register new handler for given Query or Command
     *
     * @param string $query Valid instance of QueryInterface|CommandInterface
     * @param string $handler Valid instance of QueryHandlerInterface|CommandHandlerInterface
     * @return bool
     * @throws Exception
     */
    public function register(string $query, string $handler): bool
    {
        if (isset($this->handlers[$query])) {
            return false;
        }

        if (!class_exists($query) || !class_exists($handler)) {
            throw new Exception(
                sprintf(
                    "%s or %s is not valid class name.",
                    $query,
                    $handler
                )
            );
        }

        $this->handlers[$query] = $handler;

        return true;
    }
}