<?php

/*
 * This file is part of the Active Collab Controller project.
 *
 * (c) A51 doo <info@activecollab.com>. All rights reserved.
 */

declare(strict_types=1);

namespace ActiveCollab\Controller\Test\Fixtures;

use ActiveCollab\Controller\ActionResult\Container\ActionResultContainerInterface;
use Pimple\Container;
use RuntimeException;

class ActionResultInContainer implements ActionResultContainerInterface
{
    /**
     * @var Container
     */
    private $container;

    private $key;

    public function __construct(Container $container, $key = 'action_result')
    {
        $this->container = $container;
        $this->key = $key;
    }

    public function get()
    {
        if ($this->has()) {
            return $this->container[$this->key];
        }

        throw new RuntimeException('Action result not found in the container.');
    }

    public function has(): bool
    {
        return $this->container->offsetExists($this->key);
    }

    public function &set($action_result): ActionResultContainerInterface
    {
        $this->container[$this->key] = $action_result;

        return $this;
    }
}
