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

use InvalidArgumentException;

class Environment
{
    /**
     * The specified environment.
     * @var string
     */
    protected $slug;

    private function __construct($slug)
    {
        $slug = strtolower($slug);

        if (! in_array($slug, ['live', 'dev', 'test'])) {
            throw new InvalidArgumentException('Invalid environment specified.');
        }

        $this->slug = (string) $slug;
    }

    /**
     * @return Environment
     */
    public static function live()
    {
        return new self('live');
    }

    /**
     * @return Environment
     */
    public static function dev()
    {
        return new self('dev');
    }

    /**
     * @return Environment
     */
    public static function test()
    {
        return new self('test');
    }

    /**
     * @return Environment
     */
    public static function fromEnvironmentVariable()
    {
        $environment = isset($_SERVER['ENV']) ? $_SERVER['ENV'] : 'live';

        return new self($environment);
    }

    /**
     * @param $env
     *
     * @return Environment
     */
    public static function fromString($env)
    {
        return new self($env);
    }

    /**
     * @param  Environment $environment
     * @return bool
     */
    public function equals(Environment $environment)
    {
        return $this->slug === (string) $environment;
    }

    public function isLive()
    {
        return $this->slug == 'live';
    }

    public function isDev()
    {
        return $this->slug == 'dev';
    }

    public function isTest()
    {
        return $this->slug == 'test';
    }

    public function __toString()
    {
        return $this->slug;
    }
}
