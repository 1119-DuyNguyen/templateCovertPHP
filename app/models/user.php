<?php
class User extends Model
{
    protected static $table = 'users';
    protected static $driver = 'mysql';
    private $username;
    private $email;
    private $password;
    private $url_address = "";
    private $date;
    public static function login()
    {

        if (isset($_POST['username']) && isset($_POST['password'])) {
            $DB = Database::create('mysql');
            $sql = "SELECT * FROM users WHERE username=:username AND password= :password";

            $user = $DB->read(
                $sql,
                [
                    'username' => $_POST['username'],
                    'password' => $_POST['password']
                ]
            );


            if ($user) {
                $_SESSION['user_name'] = $_POST['username'];

                header("Location:" . ROOT . "home");
                return;
            } else {
                $_SESSION['error'] = "wrong username or password";

            }
        }

    }

    public function signup()
    {

        $_SESSION['error'] = "";
        if (isset($_POST['username']) && isset($_POST['password'])) {

            $this->username = $_POST['username'];
            $this->password = $_POST['password'];
            $this->email = $_POST['email'];
            $this->date = date("Y-m-d H:i:s");

            if ($this->insert(get_object_vars($this))) {

                header("Location:" . ROOT . "home");
                die;
            }

        } else {

            $_SESSION['error'] = "please enter a valid username and password";
        }
    }

}