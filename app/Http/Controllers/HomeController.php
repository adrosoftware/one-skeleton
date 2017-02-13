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

class HomeController extends BaseController
{
    public function index($request, $response)
    {
        return $this->view()->render('index/index',$response);
    }

    public function ajax($request, $response)
    {
        return $this->view()->fetch('ajax/hello');
    }
}