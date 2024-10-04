<?php
ob_start();
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class Functions
{
    public function redirect($address)
    {
        echo"<script>window.location.href='$address'</script>";
        exit();
    }

    public function setError($message)
    {
        $_SESSION['error'] = $message;
    }

    public function setAuth($data)
    {
        $_SESSION['Auth'] = $data;
    }

    public function Auth()
    {
        if (isset($_SESSION['Auth'])) {
            return $_SESSION['Auth'];
        } else {
            return false;
        }
    }

    public function error()
    {
        if (isset($_SESSION['error'])) {
            echo "Swal.fire('', '" . $_SESSION['error'] . "', 'error');";
            unset($_SESSION['error']);
        }
    }
    public function setAlert($message)
    {
        $_SESSION['alert'] = $message;
    }
    public function alert()
    {
        if (isset($_SESSION['alert'])) {
            echo "Swal.fire('', '" . $_SESSION['alert'] . "', 'success');";
            unset($_SESSION['alert']);
        }
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public function unsetSession($key)
    {
        unset($_SESSION[$key]);
    }

    public function getSession($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        } else {
            return false;
        }
    }

    public function AuthPage()
    {
        if (!isset($_SESSION['Auth'])) {
            $this->redirect('user_login.php');
        }
    }

    public function nonAuthPage()
    {
        if (isset($_SESSION['Auth'])) {
            $this->redirect('index.php');
        }
    }
    public function randomString()
    {
        $string = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ_" . time() . rand(1111, 999999);
        $string = str_shuffle($string);
        return str_split($string, 16)[0];
    }

}

$fn = new Functions();
ob_end_flush();