<?php

namespace application\controllers;

use application\core\Controller;
use application\models\Admin;
use application\models\User;

class AdminController extends Controller
{

    protected $userModel;
    protected $adminModel;

    public function __construct($route)
    {
        parent::__construct($route);

        $this->userModel = new User();
        $this->adminModel = new Admin();
    }

    public function indexAction()
    {
        if (!empty($_SESSION)) {
            header('Location: /admin/dashboard/');
        }
        $this->view->render('index');
    }

    public function loginAction()
    {
        if ((!empty($_POST['login'])) && (!empty($_POST['password']))) {
            $login = trim($_POST['login']);
            $pass = trim($_POST['password']);
            $passHash = password_hash($pass, PASSWORD_DEFAULT);
            $res = $this->userModel->getUsers($login);
            if (empty($res)) {
                die('No matches');
            }
            $verify = password_verify($pass, $res[0]['pass']);
            if ($verify === true) {
                $_SESSION['user'] = $login;
                $_SESSION['csrf_token'] = substr(
                    str_shuffle('qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM'),
                    0,
                    10
                );
                $token = $_SESSION['csrf_token'];

                return $this->view->redirect('dashboard', $token);
            } else {
                return $this->view->redirect('index');
            }
        }

        return $this->view->redirect('index');
    }

    public function logoutAction()
    {
        session_destroy();
        session_regenerate_id(true);

        return $this->view->redirect('/');
    }

    public function dashboardAction()
    {
        if (empty($_SESSION['user'])) {
            return $this->view->redirect('index');
        }

        return $this->view->render('Dashboard');
    }

    public function createAction()
    {
        if (isset($_POST['submit'])) {
            if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === trim($_POST['csrf_token'])) {
                die('Invalid token');
            }
        }
        if (empty($_SESSION['csrf_token'])) {
            die('Token is empty');
        }
        if (empty($_SESSION['user'])) {
            return $this->view->redirect('index');
        }

        return $this->view->render('Dashboard');
    }

    public function saveAction()
    {
        if (!$_SESSION['csrf_token'] === $_POST['csrf_token']) {
            die('Invalid token');
        }

        if (!empty($_POST)) {
            if ($_POST['status'] < 0 || $_POST['status'] > 1) {
                die('status can not < 0');
            }
            if ($_POST['position'] == 0) {
                die('position can not = 0');
            }
            $title = htmlspecialchars(trim($_POST['title']));
            $image = $this->adminModel->uploadImage($_FILES['image']);
            $link = htmlspecialchars(trim($_POST['link']));
            $status = htmlspecialchars(trim($_POST['status']));
            $pos = htmlspecialchars(trim($_POST['position']));

            $this->adminModel->bannerAdd($title, $image, $link, $status, $pos);

            return $this->view->redirect('dashboard');
        }
    }

    public function updateAction()
    {
        if (isset($_POST['submit'])) {
            if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === trim($_POST['csrf_token'])) {
                die('Invalid token');
            }
        }
        if (!empty($_POST)) {
            $id = htmlspecialchars($_POST['id']);
            $title = htmlspecialchars($_POST['name']);
            $image = $this->adminModel->uploadImage($_FILES['image']);
            $link = htmlspecialchars($_POST['link']);
            $status = htmlspecialchars($_POST['status']);
            $pos = htmlspecialchars($_POST['position']);

            $this->adminModel->bannerUpd($id, $title, $image, $link, $status, $pos);
        }

        return $this->view->redirect('dashboard');
    }

    public function deleteAction()
    {
        if (isset($_POST['submit'])) {
            if (isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === trim($_POST['csrf_token'])) {
                die('Invalid token');
            }
        }
        $id = htmlspecialchars($_POST['delete']);
        $this->adminModel->bannerDelete($id);

        return $this->view->redirect('dashboard');
    }

    public function editAction()
    {
        if (empty($_SESSION['user'])) {
            return $this->view->redirect('index');
        }
        if (empty($_POST)) {
            return $this->view->redirect('dashboard');
        }
        $this->view->render('Editing');
    }
}