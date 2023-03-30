<?php

namespace LogicLeap\SasinduPharmacy\controllers;

use LogicLeap\SasinduPharmacy\core\Application;
use LogicLeap\SasinduPharmacy\core\CSRF_Token;
use LogicLeap\SasinduPharmacy\core\Response;
use LogicLeap\SasinduPharmacy\core\Session;
use LogicLeap\SasinduPharmacy\models\Page;
use LogicLeap\SasinduPharmacy\models\Stocks;
use LogicLeap\SasinduPharmacy\models\Suppliers;
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
        Application::$app->response->setStatusCode($exception->getCode());
        $page = new Page(Page::HEADER_DEFAULT_WITH_MENU, Page::FOOTER_DEFAULT,
            'errorPage', $exception->getMessage());
        $placeholderValues = [
            'errorPage:err-code' => $exception->getCode(),
            'errorPage:err-message' => $exception->getMessage()
        ];
        Application::$app->renderer->renderPage($page, $placeholderValues);
    }

    private function addNoCacheHeaders(): void
    {
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
    }

    /**
     * Get JSON POST request body
     * @return array Associative array of values
     */
    private function getPostJsonBody(): array
    {
        return json_decode(file_get_contents('php://input'), true);
    }

    /**
     * Send JSON type response for API type requests.
     */
    private function sendJsonResponse(int $statusCode, string $statusMessage, array $body): void
    {
        header("Content-Type: application/json");
        $this->addNoCacheHeaders();
        $response = [
            'statusCode' => $statusCode,
            'statusMessage' => $statusMessage,
            'body' => $body
        ];
        echo json_encode($response);
    }

    public function login(): void
    {
        if (Application::$app->request->isGet()) {
            $this->addNoCacheHeaders();
            $page = new Page(Page::HEADER_BLANK, Page::FOOTER_BLANK, 'forms/login', 'Login');
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
            $this->addNoCacheHeaders();
            $page = new Page(Page::HEADER_BLANK, Page::FOOTER_BLANK, 'forms/register', 'Register');
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

    /**
     * Check if the user making the request has admin privileges.
     * If user does have admin privileges, does nothing.
     * If user does not have admin privileges, Redirect to login page if request is GET,
     * send FORBIDDEN response if request is POST
     */
    private function checkAdmin(): void
    {
        $success = true;
        if (!isset($_SESSION['role']) || !isset($_SESSION['userId'])) {
            $success = false;
        } elseif (!User::isAdmin($_SESSION['userId'], $_SESSION['role'])) {
            $success = false;
        }
        if (Application::$app->request->isGet()) {
            if (!$success) {
                Application::$app->response->redirect('/');
            }
        } elseif (Application::$app->request->isPost()) {
            if (!$success) {
                $this->sendJsonResponse(Response::STATUS_CODE_FORBIDDEN, 'forbidden',
                    ['message' => 'You need to log in first']);
            }
        }
    }

    public function dashboard(): void
    {
        if (Application::$app->request->isGet()) {
            $this->checkAdmin();

            $this->addNoCacheHeaders();
            $page = new Page(Page::HEADER_DEFAULT_WITH_MENU, Page::FOOTER_DEFAULT, 'dashboard', 'Dashboard');
            Application::$app->renderer->renderPage($page);
        }
    }

    public function stocks(): void
    {
        $this->checkAdmin();
        if (Application::$app->request->isGet()) {

            $page = new Page(Page::HEADER_DEFAULT_WITH_MENU, Page::FOOTER_DEFAULT, 'stocks', 'Stock');
            Application::$app->renderer->renderPage($page);
        } elseif (Application::$app->request->isPost()) {
            $req = $this->getPostJsonBody();
            if (!isset($req['action'])) {
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                    ['message' => 'Invalid request']);
            }
            if ($req['action'] === 'get-items') {
                $itemLimit = $req['payload']['filters']['limit'] ?? 30;
                $itemBeginIndex = $req['payload']['filters']['begin'] ?? 0;
                $itemName = $req['payload']['filters']['product-name'] ?? '';
                $itemPrice = $req['payload']['filters']['price'] ?? -1;
                $itemCompanyId = $req['payload']['filters']['supplier-id'] ?? -1;
                $data = Stocks::getItems($itemBeginIndex, $itemLimit, $itemName, $itemPrice, $itemCompanyId);
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                    [
                        'total-number-of-rows' => $data['number-of-rows'],
                        'items' => $data['data']
                    ]);

            } elseif ($req['action'] === 'add-item') {
                $productName = $req['payload']['product-name'] ?? 'none';
                $productAmount = $req['payload']['amount'] ?? 0;
                $buyingDate = $req['payload']['buying-date'] ?? '2023-01-01';
                $expireDate = $req['payload']['expire-date'] ?? '2023-01-01';
                $supplierId = $req['payload']['supplier-id'] ?? -1;
                $price = $req['payload']['product-price'] ?? 0;
                $success = Stocks::addItem($productName, $productAmount, $buyingDate, $expireDate, $supplierId, $price);
                if ($success) {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                        [
                            'message' => 'New Item Added Successfully.'
                        ]);
                } else {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        [
                            'message' => 'Failed to add item.'
                        ]);
                }
            } elseif ($req['action'] === 'update-item') {
                $productId = $req['payload']['product-id'] ?? -1;
                $productName = $req['payload']['product-name'] ?? 'none';
                $productAmount = $req['payload']['amount'] ?? 0;
                $buyingDate = $req['payload']['buying-date'] ?? '2023-01-01';
                $expireDate = $req['payload']['expire-date'] ?? '2023-01-01';
                $supplierId = $req['payload']['supplier-id'] ?? -1;
                $price = $req['payload']['product-price'] ?? 0;
                $success = Stocks::updateItem($productId, $productName, $productAmount, $buyingDate, $expireDate, $supplierId, $price);
                if ($success) {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                        [
                            'message' => 'Item Updated Successfully.'
                        ]);
                } else {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        [
                            'message' => 'Failed to update item.'
                        ]);
                }
            } elseif ($req['action'] === 'delete-item') {
                $productId = $req['payload']['product-id'] ?? null;
                try {
                    $productId = intval($productId);
                }catch (\Exception){
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        [
                            'message' => 'Failed to delete item.'
                        ]);
                }
                if (Stocks::deleteItem($productId)) {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                        [
                            'message' => 'Item Deleted Successfully.'
                        ]);
                } else {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        [
                            'message' => 'Failed to delete item.'
                        ]);
                }
            } else {
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                    ['message' => 'Invalid action']);
            }
        }
    }

    public function users(): void
    {
        $this->checkAdmin();
        if (Application::$app->request->isGet()) {
            $page = new Page(Page::HEADER_DEFAULT_WITH_MENU, Page::FOOTER_DEFAULT, 'users', 'Users');
            Application::$app->renderer->renderPage($page);
        } elseif (Application::$app->request->isPost()) {
            $req = $this->getPostJsonBody();
            if (!isset($req['action'])) {
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                    ['message' => 'Invalid request']);
            }
            if ($req['action'] === 'add-user') {
                $user = new User();
                $msg = $user->createNewUser($req['payload']);
                if ($msg === 'user created.') {
                    unset($req['payload']['password']);
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success', $req);
                } else {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        ['message' => $msg]);
                }
            } elseif ($req['action'] === 'update-user') {
                $user = new User();
                $msg = $user->updateUserDetails($req['payload']);
                if ($msg === 'user updated.') {
                    unset($req['payload']['password']);
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success', $req);
                } else {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        ['message' => $msg]);
                }
            } elseif ($req['action'] === 'update-user-password') {
                $userId = $req['payload']['user-id'];
                if (!is_int($userId) || !isset($req['password'])) {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        ['message' => 'invalid request.']);
                }
                $user = new User();
                if ($user->updateUserPassword($userId, $req['password'])) {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                        ['message' => 'Password Updated.']);
                } else {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        ['message' => 'Password Failed.']);
                }
            } elseif ($req['action'] === 'get-users') {
                $users = User::getAllUsers();
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                    ['users' => $users]);
            } elseif ($req['action'] === 'remove-user') {
                $userId = $req['payload']['user-id'] ?? null;
                if (!is_int($userId)) {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        ['message' => 'Failed to remove user.']);
                }
                if (User::removeUser($userId)) {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                        ['message' => 'User removed successfully.']);
                } else {
                    $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                        ['message' => 'Failed to remove user.']);
                }
            } else {
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                    ['message' => 'Invalid action']);
            }
        }
    }

    public function suppliers(): void
    {
        $this->checkAdmin();
        if (Application::$app->request->isGet()) {
            $page = new Page(Page::HEADER_DEFAULT_WITH_MENU, Page::FOOTER_DEFAULT, 'suppliers', 'Suppliers');
            Application::$app->renderer->renderPage($page);
        } elseif (Application::$app->request->isPost()) {
            $req = $this->getPostJsonBody();
            if (!isset($req['action'])) {
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'error',
                    ['message' => 'Invalid request']);
            }
            if ($req['action'] === 'get-suppliers') {
                $supplierData = Suppliers::getAllSupplierDetails();
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                    ['suppliers' => $supplierData]);
            }elseif ($req['action'] === 'get-supplier-by-id'){
                $supplierId = $req['payload']['supplier-id'] ?? -1;
                $supplierName = Suppliers::getSupplierName($supplierId);
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                    ['supplier-name' => $supplierName]);
            }elseif ($req['action'] === 'get-supplier-by-name'){
                $supplierName = $req['payload']['supplier-name'] ?? '';
                $supplierId = Suppliers::getSupplierId($supplierName);
                $this->sendJsonResponse(Response::STATUS_CODE_SUCCESS, 'success',
                    ['supplier-id' => $supplierId]);
            }elseif($req['action']==='add-supplier'){

            }
        }
    }

    public function payments(): void
    {
        $this->checkAdmin();
        if (Application::$app->request->isGet()) {
            $page = new Page(Page::HEADER_DEFAULT_WITH_MENU, Page::FOOTER_DEFAULT, 'payments', 'Payments');
            Application::$app->renderer->renderPage($page);
        }
    }

    public function logout(): void
    {
        session_destroy();
    }
}