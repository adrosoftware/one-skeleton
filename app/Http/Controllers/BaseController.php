<?php
/**
 * One Skeleton.
 *
 * @link      https://github.com/adrosoftware/one-skeleton
 *
 * @copyright Copyright (c) 2017 Adro Rocker
 * @author    Adro Rocker <alejandro.morelos@jarwebdev.com>
 */
namespace App\Http\Controllers;

use Interop\Container\ContainerInterface;

class BaseController
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Return property
     *
     * @param string $name Name of the method
     *
     * @throws BadMethodCallException If the $name is not a property
     */
    public function __call($name, $arguments)
    {
        if (true !== $this->container->has($name)) {
            throw new BadMethodCallException(sprintf(
                'The metod "%s" does not exist',
                $name
            ));
        }

        return $this->container->get($name);
    }
}
