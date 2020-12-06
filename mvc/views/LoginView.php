<?php

if (isset($_GET["url"])) {
    $url = explode("/", filter_var(trim($_GET["url"], "/")));

    $level = count($url);
    $root = "";

    while ($level > 1) {
        $root = $root . "../";
        $level--;
    }
} else {
    $root = "";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Đăng nhập</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= $root . "public/style.css" ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>
    <script src="<?= $root . "public/myscript.js" ?>"></script>
</head>
<body>

<div class="outer">
    <div class="middle">
        <div class="inner">
            <div id="login-row" class="row no-gutters">
                <div class="col-lg-6">
                    <img id="login-img" src="<?= $root . "public/imgs/login-imgs.jpg" ?>">
                </div>

                <div class="col-lg-6 px-5 pt-3">
                    <div class="d-flex justify-content-center">
                        <img id="login-logo" src="<?= $root . "public/imgs/logo.jpg" ?>">
                    </div>


                    <form action="<?= $root . "Account/Login" ?>" method="post">
                        <div class="form-row">
                            <div class="input">
                                <input name="employer-id" type="text" class="form-control my-2 p-3" placeholder="Mã số nhân viên">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input">
                                <input name="password" type="password" class="form-control p-3" placeholder="Mật khẩu">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="input">
                                <button type="submit" class="button-summit">Đăng nhập</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <?php
            if (isset($_SESSION["loginStatus"])) {
                if ($_SESSION["loginStatus"] === "fail") {
                    $mess = "Đăng nhập thất bại. Vui lòng kiểm tra lại tên đăng nhập hoặc mật khẩu.";
                    $isSuccess = false;
                }

                unset($_SESSION["loginStatus"]);
            }

            if (isset($isSuccess)) {
                ?>

                <div class="row d-flex justify-content-center">
                    <div class="my-3 my-alert alert <?= $isSuccess ? "alert-success" : "alert-danger" ?> w-75 text-center" role="alert"><?= $mess ?></div>
                </div>

                <?php
            }
            ?>
        </div>
    </div>
</div>

</body>
</html>