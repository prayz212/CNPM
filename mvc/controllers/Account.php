<?php

class Account extends Controller {

    function Login() {
        if (isset($_SESSION["EmployerModel"])) {
            header("Location: ../Home/Intro");
            exit();
        }

        if (!isset($_POST["username"]) && !isset($_POST["password"])) {
            $this->view("LoginView", []);
        }
        else {
            $username = $_POST["employer-id"];
            $password = $_POST["password"];

            $tmp = $this->model("EmployerModel");
            $data = $tmp->login($username, $password);
            if ($data) {

                $res = $data->fetch_assoc();

                $_SESSION["loggedIn"] = $res["id"];
                $_SESSION["permission"] = $res["permission"];

                header("Location: ../Home/Intro");
                exit();
            } else {
                $_SESSION["loginStatus"] = "fail";
                header("Location: ../");
                exit();
            }
        }
    }

    function Logout() {
        session_unset();
        session_destroy();

        header("Location: ../");
    }
}

?>
