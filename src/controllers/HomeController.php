<?php

namespace src\controllers;

use core\Controller as ctrl;
use Exception;
// use src\handlers\;

class HomeController extends ctrl
{

    public function home() {
        $this->render('home');
    }

}