<?php
/**
 * One Skeleton.
 *
 * @link      https://github.com/adrosoftware/one-skeleton
 *
 * @copyright Copyright (c) 2017 Adro Rocker
 * @author    Adro Rocker <alejandro.morelos@jarwebdev.com>
 */
namespace App\Helper;

class RootPath
{
    private $root;

    public function __construct($base)
    {
        defined('ROOT_PATH') || define('ROOT_PATH', (getenv('ROOT_PATH') ? getenv('ROOT_PATH') : realpath($base)));

        $this->root = ROOT_PATH;
    }

    public function getRoot()
    {
        return $this->root;
    }

    public function __toString()
    {
        return (string) $this->root;
    }
}
