<?php

namespace LogicLeap\SasinduPharmacy\controllers;

use LogicLeap\SasinduPharmacy\core\Application;
use LogicLeap\SasinduPharmacy\core\CSRF_Token;
use LogicLeap\SasinduPharmacy\core\Session;
use LogicLeap\SasinduPharmacy\models\Page;
use LogicLeap\SasinduPharmacy\models\User;

class SiteController
{
    public function __construct()
    {
        Application::$app->session = new Session();
    }

    /**
     * For site default values, naming convention to use in HTML document is 'site:variable'.
     * For other variables it should be path_to_file:filename:variable.
     * Note that path_to_file should start from view directory.
     * For example, placeholder variables in login.php should use like 'forms:login:username'.
     * This procedure is used to prevent placeholder collisions.
     */

    /**
     * This array is passed to render with every page.
     * Override these values to change any settings for specific page.
     */
    public static array $SiteSettings = [
        'site:title' => 'Pharmacy',
        'site:favicon' => '',
    ];

    /**
     * Append this part to the beginning of the title.
     * NOTE - should be called before calling render function.
     * For example := calling with 'Login' will result in changing the title to 'Login - SiteName'.
     * @param string $title Title for the page.
     */
    public static function appendToTitle(string $title): void
    {
        self::$SiteSettings['site:title'] = $title . ' - ' . self::$SiteSettings['site:title'];
    }


    /**
     * All the functions in here are used to call render function with their placeholder values.
     */

    public static function httpError(\Exception $exception): void
    {
        $page = new Page(Page::DEFAULT_HEADER_WITH_MENU, Page::DEFAULT_FOOTER,
            'errorPage', $exception->getMessage());
        $placeholderValues = [
            'errorPage:err-code' => $exception->getCode(),
            'errorPage:err-message' => $exception->getMessage()
        ];
        Application::$app->renderer->renderPage($page, $placeholderValues);
    }

    /**
     * Render the "Page not Found" page.
     */
    public static function pageNotFound(): void
    {
        $page = new Page(Page::DEFAULT_HEADER_WITH_MENU, Page::DEFAULT_FOOTER,
            'errorPage', "Page not Found");
        $placeholderValues = [
            'errorPage:err-code' => 404,
            'errorPage:err-message' => 'Page not Found'
        ];
        Application::$app->renderer->renderPage($page, $placeholderValues);
    }

    public function login(): void
    {
        if (Application::$app->request->isGet()) {
            $page = new Page(Page::BLANK_HEADER, Page::BLANK_FOOTER, 'forms/login', 'Login');
            $params = ['login:csrf-token' => CSRF_Token::generateToken('/')];
            Application::$app->renderer->renderPage($page, $params);
        } elseif (Application::$app->request->isPost()) {
            $params = Application::$app->request->getBodyParams();
            if (!CSRF_Token::validateToken('/', $params['csrf-token'] ?? false)) {
                Application::$app->session->setFlashMessage('loginError',
                    'Invalid CSRF token', Page::ALERT_TYPE_ERROR);
                Application::$app->response->redirect('/');
                exit();
            }

            $user = new User();
            if (!isset($params['username']) || !isset($params['password'])) {
                Application::$app->session->setFlashMessage('loginError',
                    'Required fields were empty', Page::ALERT_TYPE_ERROR);
                Application::$app->response->redirect('/');
                exit();
            }
            if ($user->validateUser($params['username'], $params['password'])) {
                $_SESSION['userId'] = $user->userId;
                $user->loadUserData($user->userId);
                $_SESSION['role'] = $user->role;
                Application::$app->response->redirect('/dashboard');
            } else {
                Application::$app->session->setFlashMessage('loginError',
                    'Invalid Username or Password', Page::ALERT_TYPE_ERROR);
                Application::$app->response->redirect('/');
            }
        }
    }

    public function register(): void
    {
        if (Application::$app->request->isGet()) {
            $page = new Page(Page::BLANK_HEADER, Page::BLANK_FOOTER, 'forms/register', 'Register');
            $params = ['register:csrf-token' => CSRF_Token::generateToken('/register')];
            Application::$app->renderer->renderPage($page, $params);
        } elseif (Application::$app->request->isPost()) {
            $params = Application::$app->request->getBodyParams();
            if (!CSRF_Token::validateToken('/register', $params['csrf-token'] ?? false)) {
                Application::$app->session->setFlashMessage('RegisterError',
                    'Invalid CSRF token', Page::ALERT_TYPE_ERROR);
                Application::$app->response->redirect('/register');
                exit();
            }

            $user = new User();
            $status = $user->createNewUser($params);
            if ($status === 'user created.') {
                Application::$app->session->setFlashMessage('registerSuccess',
                    'Successfully registered.', Page::ALERT_TYPE_SUCCESS);
                Application::$app->response->redirect('/login');
            } else {
                Application::$app->session->setFlashMessage('registerError',
                    $status, Page::ALERT_TYPE_ERROR);
                Application::$app->response->redirect('/register');
            }
        }
    }

    public function stocks(): void
    {
        if (Application::$app->request->isGet()) {
            if (!isset($_SESSION['role']) || !isset($_SESSION['userId'])) {
                self::pageNotFound();
                exit();
            }
            if ($_SESSION['role'] != User::ROLE_SUPER_ADMINISTRATOR && $_SESSION['role'] != User::ROLE_ADMINISTRATOR){
                self::pageNotFound();
                exit();
            }
                $page = new Page(Page::DEFAULT_HEADER_WITH_MENU, Page::DEFAULT_FOOTER, 'stocks', 'Stock');
            Application::$app->renderer->renderPage($page);
        }
    }
}