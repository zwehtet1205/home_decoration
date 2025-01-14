<?php
ini_set('display_errors', 1);


class UsersController extends SystemController
{
    public $usermodel;

    public function __construct()
    {
        // echo "i am Articlescontroller";
        $this->usermodel =  $this->model('User');
    }

    public function index()
    {
        // $articles = $this->mainmodel->getarticles();

        $datas = [
            "greeting" => "Have a day Sir!",
            
        ];

        return $this->view('users/register',$datas);

    }

    public function login()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        // Sanitize POST data
        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Prepare data array
        $datas = [
            "email" => textfilter($_POST['email'] ?? ''),
            "password" => textfilter($_POST['password'] ?? ''),
            "emailerr" => '',
            "passworderr" => '',
        ];

        // Validate email
        if (empty($datas['email'])) {
            $datas['emailerr'] = 'Please enter your email address';
        } elseif (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) {
            $datas['emailerr'] = 'Please enter a valid email address';
        } elseif (!$this->usermodel->checkuniqueemail($datas['email'])) {
            $datas['emailerr'] = 'No user found with this email';
        }

        // Validate password
        if (empty($datas['password'])) {
            $datas['passworderr'] = 'Please enter your password';
        }

        // Check for errors
        if (empty($datas['emailerr']) && empty($datas['passworderr'])) {

            // login user
            $loginuser = $this->usermodel->login($datas['email'],$datas['password']);
            if ($loginuser) {
                // Create session
                $this->createusersession($loginuser);

                redirect('welcomes/index');

            } else {
                $datas['passworderr'] = 'Password is incorrect';
                return $this->view('users/login', $datas);
            }
        } else {
            // Return view with errors
            return $this->view('users/login', $datas);
        }
    } else {
        // Default form data
        $datas = [
            "email" => '',
            "password" => '',
            "emailerr" => '',
            "passworderr" => '',
        ];
        return $this->view('users/login', $datas);
    }
}


    public function logout() {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);

        session_destroy();

        // set offline

        redirect('users/login');
    }

    public function createusersession($user){
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_email'] = $user['email'];
    }

    public function register()
{
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        $datas = [
            "fullname" => textfilter($_POST['fullname'] ?? ''),
            "email" => textfilter($_POST['email'] ?? ''),
            "password" => textfilter($_POST['password'] ?? ''),
            "cfmpassword" => textfilter($_POST['cfmpassword'] ?? ''),
            "fullnameerr" => '',
            "emailerr" => '',
            "passworderr" => '',
            "cfmpassworderr" => '',
        ];

        // Validate fullname
        if (empty($datas['fullname'])) {
            $datas['fullnameerr'] = 'Please enter your fullname';
        }

        // Validate email
        if (empty($datas['email'])) {
            $datas['emailerr'] = 'Please enter your email address';
        } elseif (!filter_var($datas['email'], FILTER_VALIDATE_EMAIL)) {
            $datas['emailerr'] = 'Please enter a valid email address';
        } elseif ($this->usermodel->checkuniqueemail($datas['email'])) {
            $datas['emailerr'] = 'Email is already taken';
        }

        // Validate password
        if (empty($datas['password'])) {
            $datas['passworderr'] = 'Please enter your password';
        } elseif (strlen($datas['password']) < 5) {
            $datas['passworderr'] = 'Password must be at least 5 characters';
        }

        // Validate confirm password
        if (empty($datas['cfmpassword'])) {
            $datas['cfmpassworderr'] = 'Please confirm your password';
        } elseif ($datas['password'] !== $datas['cfmpassword']) {
            $datas['cfmpassworderr'] = 'Passwords do not match';
        }

        // Check if all errors are empty
        if (empty($datas['fullnameerr']) && empty($datas['emailerr']) && empty($datas['passworderr']) && empty($datas['cfmpassworderr'])) {
            // Hash the password
            $datas['password'] = password_hash($datas['password'], PASSWORD_DEFAULT);

            // Register the user
            if ($this->usermodel->register($datas)) {
                flash('register_success', 'You have successfully registered');
                redirect('users/login');
            } else {
                die('Something went wrong while registering');
            }
        } else {
            // Load view with errors
            return $this->view('users/register', $datas);
        }

    } else {
        $datas = [
            "fullname" => '',
            "email" => '',
            "password" => '',
            "cfmpassword" => '',
            "fullnameerr" => '',
            "emailerr" => '',
            "passworderr" => '',
            "cfmpassworderr" => '',
        ];
        return $this->view('users/register', $datas);
    }
}


}