<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;
use Phalcon\Di\FactoryDefault;
use Phalcon\Image\Adapter\Gd;
use Phalcon\Image\ImageFactory;
use Phalcon\Mvc\Url;

class PhalconsatuController extends ControllerBase
{
    public function indexAction()
    {
        return 'index';
    }

    public function loginAction()
    {
        $this->view->disable();

        $request = new Request();
        $response = new Response();

        if ($request->isPost()) {
            $email = $request->getPost('email');
            $password = $request->getPost('password');

            $response->setStatusCode(200, 'OK');
            $response->setJsonContent([
                'userid' => 'LoggedInUser',
                'displayName' => 'Logged In User',
                'token' => 'abcdefg',
            ]);
        }
        $response->send();
    }

    public function imageAction()
    {
        $this->view->disable();

        $dir = 'img/';
        $request = new Request();
        $response = new Response();

        $response->setStatusCode(200, 'OK');
        $url = new Url();
        $modifyUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $urlArray = explode('/', $modifyUrl);

        $response->setJsonContent([
            $urlArray[0] .
            '/' .
            $urlArray[1] .
            '/public/img/twitch-profile-picture-size.png',
        ]);

        $response->send();
    }

    public function imageListAction()
    {
        $this->view->disable();

        $dir = 'img/';
        $request = new Request();
        $response = new Response();

        $response->setStatusCode(200, 'OK');
        $url = new Url();
        $modifyUrl = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $urlArray = explode('/', $modifyUrl);

        $image =
            $urlArray[0] .
            '/' .
            $urlArray[1] .
            '/public/img/twitch-profile-picture-size.png';

        $response->setJsonContent([$image, $image, $image]);

        $response->send();
    }

    public function menuAction()
    {
        $this->view->disable();
        if (!$this->request->isGet()) {
            return '';
        }
        $response = new Response();
        $response->setJsonContent(['Logout']);
        $response->send();
    }

    public function verifyAction()
    {
        $this->view->disable();
        $request = new Request();
        $response = new Response();

        if (!$request->isPost()) {
            return '';
        }

        $phoneNumber = $request->getPost('phoneNumber');
        //todo if matches data.

        $response->setStatusCode(200, 'OK');
        $response->setJsonContent([
            'verifynumber' => '123456',
        ]);
        $response->send();
    }

    public function satuAction()
    {
        $this->view->disable();
        if ($this->request->isGet()) {
            $this->response->getStatusCode(405, 'Method Not Allowed');
            $this->response->setJsonContent([
                'status' => false,
                'error' => 'Method Not Allowed',
            ]);
        }
        $this->response->send();
    }
}
