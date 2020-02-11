<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Admin;

class MainController extends Controller
{
    protected $userModel;

    public function __construct($route)
    {
        parent::__construct($route);

        $this->userModel = new Admin();
    }

    public function indexAction()
    {
        $this->view->render('index');
    }
}