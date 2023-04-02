<?php

namespace LogicLeap\SasinduPharmacy\models;

use PDO;

class User extends DbModel
{

    // Following constants need to be initialized. They are used when executing Database actions.

    private const TABLE_NAME = 'users';
    private const PRIMARY_KEY = 'id';
    private const TABLE_COLUMNS = ['id', 'username', 'email', 'firstname', 'lastname', 'password', 'role'];

    // User Roles
    public const ROLE_SUPER_ADMINISTRATOR = 0;
    public const ROLE_ADMINISTRATOR = 1;
    public const ROLE_DATA_ENTRY_OPERATOR = 2;

    public int $userId;
    public string $username;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $role;


    /**
     * @return string[] An associate array of [ user role id => role text ]
     */
    public static function getUserRoles():array{
        return [
            1=>'Administrator',
            2=>'Data Entry Operator'
        ];
    }

    /**
     * Generate a password hash.
     * @param string $password String Password
     * @return string Hashed password string
     */
    public static function generatePasswordHash(string $password): string
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    // Password Requirements
    public const MAX_PASSWORD_LENGTH = 24;
    public const MIN_PASSWORD_LENGTH = 8;

    /**
     * Create a new user in the database.
     * @param array $params An array of [key=> value] pairs.
     * @return string Return 'user created.' if success, Error msg if failed
     */
    public function createNewUser(array $params): string
    {
        if (!isset($params['username']) || !isset($params['password'])
            || !isset($params['role']) || !isset($params['firstname']) ||
            !isset($params['lastname'])) {
            return 'All required fields were not filled.';
        }

        // Performing checks on input variables.

        $statement = self::getDataFromTable(['id'], self::TABLE_NAME, 'username=:username',
            [':username' => $params['username']]);
        if ($statement->fetch(PDO::FETCH_ASSOC)) {
            return 'Username already exists.';
        }

        if (strlen($params['password']) < self::MIN_PASSWORD_LENGTH) {
            return 'Password is too short.';
        }

        if (strlen($params['password']) > self::MAX_PASSWORD_LENGTH) {
            return 'Password is too long.';
        }
        if (!is_int($params['role'])) {
            return 'Invalid user role.';
        }

        $params['password'] = self::generatePasswordHash($params['password']);

        if (!isset($params['email'])) {
            $params['email'] = null;
        }

        if ($params['role'] === User::ROLE_SUPER_ADMINISTRATOR) {
            $params['role'] = User::ROLE_ADMINISTRATOR;
        }

        // Filter user passed variables against actual database available columns.
        foreach ($params as $key => $value) {
            if (!in_array($key, self::TABLE_COLUMNS)) {
                unset($params[$key]);
            }
        }
        if (self::insertIntoTable(self::TABLE_NAME, $params)) {
            return 'user created.';
        }
        return 'Unknown error occurred.';
    }

    public function updateUserDetails(array $params): string
    {
        if (!isset($params['username']) || !isset($params['id']) || !isset($params['role']) ||
            !isset($params['firstname']) || !isset($params['lastname'])) {
            return 'All required fields were not filled.';
        }

        // Performing checks on input variables.

        try{
            $params['role'] = intval($params['role']);
        }catch (\Exception) {
            return 'Invalid user role.';
        }

        if (!isset($params['email'])) {
            $params['email'] = null;
        }

        if (isset($params['password']))
            unset($params['password']);

        $userId = $params['id'];
        if ($params['role'] === User::ROLE_SUPER_ADMINISTRATOR) {
            $params['role'] = User::ROLE_ADMINISTRATOR;
        }
        unset($params['id']);

        // Filter user passed variables against actual database available columns.
        foreach ($params as $key => $value) {
            if (!in_array($key, self::TABLE_COLUMNS)) {
                unset($params[$key]);
            }
        }
        if (self::updateTableData(self::TABLE_NAME, $params, 'id=:id', [':id' => $userId])) {
            return 'user updated.';
        }
        return 'Unknown error occurred.';
    }

    public function updateUserPassword(int $userId, string $password): bool
    {
        $passwordHash = self::generatePasswordHash($password);
        return self::updateTableData(self::TABLE_NAME, ['password' => $passwordHash], "id=$userId");
    }

    public static function getAllUsers(): array
    {
        $statement = DbModel::getDataFromTable(['id', 'username', 'email', 'firstname', 'lastname', 'role'],
            self::TABLE_NAME, 'role!=' . User::ROLE_SUPER_ADMINISTRATOR);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * If passed user ID is present, set instance variable values.
     * @param int $userID User ID to look for
     * @return bool True if user is present, false otherwise.
     */
    public function loadUserData(int $userID): bool
    {
        $statement = self::getDataFromTable(['*'], 'users', "id=" . $userID);
        $userData = $statement->fetchAll()[0];
        if ($userData) {
            $this->userId = $userData['id'];
            $this->username = $userData['username'];
            $this->email = $userData['email'];
            $this->firstname = $userData['firstname'];
            $this->lastname = $userData['lastname'];
            $this->role = $userData['role'];
            return true;
        }
        return false;
    }

    /**
     * Validate the user presence. If user is present set userId value of the instance to the userId.
     * @param string $username Username / Email of the user.
     * @param string $password Password of the user.
     * @return bool Return true if user exists, false if not.
     */
    public function validateUser(string $username, string $password): bool
    {
        $sql = "SELECT id, password FROM " . self::TABLE_NAME . " WHERE username=:username OR email=:username";
        $statement = self::prepare($sql);
        $statement->bindValue(':username', $username);
        $statement->execute();
        $data = $statement->fetch(PDO::FETCH_ASSOC);
        if ($data) {
            if (password_verify($password, $data['password'])) {
                $this->userId = $data['id'];
                return true;
            }
        }
        return false;
    }

    /**
     * Get user type text.
     * @return string Return user type message. 'none' if no role found.
     */
    public function getUserRoleText(): string
    {
        if ($this->role == User::ROLE_ADMINISTRATOR)
            return 'admin';
        elseif ($this->role == User::ROLE_DATA_ENTRY_OPERATOR)
            return 'user';
        else
            return 'none';
    }

    /**
     * @param int $role Role id of the User.
     * @return bool Return true if user is an admin, false otherwise.
     */
    public static function isAdmin(int $role): bool
    {
        if ($role != User::ROLE_SUPER_ADMINISTRATOR && $role != User::ROLE_ADMINISTRATOR) {
            return false;
        }
        return true;
    }

    public static function removeUser(int $userId): bool
    {
        $sql = "DELETE FROM " . self::TABLE_NAME . " WHERE id=$userId";
        return self::exec($sql);
    }
}