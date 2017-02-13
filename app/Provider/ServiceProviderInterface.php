<?php
/**
 * One Skeleton.
 *
 * @link      https://github.com/adrosoftware/one-skeleton
 *
 * @copyright Copyright (c) 2017 Adro Rocker
 * @author    Adro Rocker <alejandro.morelos@jarwebdev.com>
 */
namespace App\Provider;

use Interop\Container\ContainerInterface;

interface ServiceProviderInterface
{
    public function register(ContainerInterface $container);

    public function boot(ContainerInterface $container);
}
