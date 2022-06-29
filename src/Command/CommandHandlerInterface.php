<?php

namespace Hera\Command;

interface CommandHandlerInterface
{
    /**
     * @param CommandInterface $command
     * @return mixed
     */
    public function dispatch(CommandInterface $command): mixed;
}