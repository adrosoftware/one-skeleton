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

use App\Helper\Environment as Env;
use App\Service\View\View;
use Interop\Container\ContainerInterface;

/**
 * BasicServicesProvider.
 *
 * @package App
 * @since 0.1.0
 */
class BasicServicesProvider implements \App\Provider\ServiceProviderInterface
{
    /**
     * Register App default services.
     *
     * @param Container $container.
     */
    public function register(ContainerInterface $container)
    {
        if (!isset($container->slim)) {
            /**
             * Slim\App
             *
             * @param Container $container
             *
             * @return Slim\App
             */
            $container['slim'] = function ($container) {
                return $container->app->slim;
            };
        }
        if (!isset($container->env)) {
            $container['env'] = function () {
                return Env::fromEnvironmentVariable();
            };
        }
        if (!isset($container->view)) {
            /**
             * View
             *
             * @param Container $container
             *
             * @return View
             */
            $container['view'] = function ($container) {
                return new View($container);
            };
        }
    }
    public function boot(ContainerInterface $container)
    {
    }
}