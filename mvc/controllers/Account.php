<?php

class Account extends Controller {

    function Login() {
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

                header("Location: ../Home/Info");
                exit();
            } else {
                echo "dang nhap that bai";
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
