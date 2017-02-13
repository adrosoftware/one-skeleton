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

/**
 * RoutesProvider.
 *
 * @package App
 * @since 0.1.0
 */
class RoutesProvider implements \App\Provider\ServiceProviderInterface
{
    public function register(ContainerInterface $container)
    {
    }

    public function boot(ContainerInterface $container)
    {
        $slim = $container->get('slim');

        $slim->get('/', 'App\Http\Controllers\HomeController:index');
        $slim->get('/ajax/hello', 'App\Http\Controllers\HomeController:ajax');
    }
}