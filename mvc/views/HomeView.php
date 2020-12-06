<?php

$url = explode("/", filter_var(trim($_GET["url"], "/")));

$action = $url[1];

switch ($action) {
    case "Intro":
        $active = "0";
        break;
    case "Management":
        $active = "1";
        break;
    case "DetailEmployer":
        $active = "1";
        break;
    case "Invoice":
        $active = "2";
        break;
    case "DetailInvoice":
        $active = "2";
        break;
    case "StockIn":
        $active = "3";
        break;
    case "DetailStockInRequest":
        $active = "3";
        break;
    case "StockOut":
        $active = "4";
        break;
    case "DetailStockOutRequest":
        $active = "4";
        break;

}

$level = count($url);
$root = "";

while ($level > 1) {
    $root = $root . "../";
    $level--;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/css/bootstrap.min.css">
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="<?= $root . "public/style.css" ?>">
    <script src="<?= $root . "public/myscript.js" ?>"></script>

</head>

<body>
<div class="bg-light">
    <div class="header">
        <div class="navbar-part">
            <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
                <a class="navbar-brand" href="<?= $root . "Home/Intro" ?>"><img src="<?= $root . "public/imgs/logo-home.png" ?>" alt="" width="80px" height="22px"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item <?= $active == 0 ? "active" : "" ?>">
                            <a class="nav-link" href="<?= $root . "Home/Intro" ?>">Trang chủ</span></a>
                        </li>
                        <?php

                        if ($_SESSION["permission"] == 0) { ?>
                            <li class="nav-item <?= $active == 1 ? "active" : "" ?>">
                                <a class="nav-link" href="<?= $root . "Home/Management" ?>">Quản lý nhân viên</a>
                            </li>
                            <?php
                        }

                        if ($_SESSION["permission"] == 2) { ?>
                            <li class="nav-item <?= $active == 2 ? "active" : "" ?>">
                                <a class="nav-link" href="<?= $root . "Home/Invoice" ?>">Lập hoá đơn</a>
                            </li>
                            <?php
                        }

                        if ($_SESSION["permission"] == 1) { ?>
                            <li class="nav-item <?= $active == 3 ? "active" : "" ?>">
                                <a class="nav-link" href="<?= $root . "Home/StockIn" ?>">Ghi nhận nhập hàng</a>
                            </li>
                            <?php
                        }

                        if ($_SESSION["permission"] == 1) { ?>
                            <li class="nav-item <?= $active == 4 ? "active" : "" ?>">
                                <a class="nav-link" href="<?= $root . "Home/StockOut" ?>">Ghi nhận xuất hàng</a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>

                    <div class="mt-2 mt-md-0">
                        <a href="<?= $root . "Account/Logout" ?>" class="font-weight-bold btn btn-outline-success my-2 my-sm-0 ml-3" role="button">Đăng xuất</a>
                    </div>
                </div>
            </nav>
        </div>
    </div>

    <div class="carousel-part pt-2" style="background-color: #2f3542">
        <div id="carousel" class="container carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carousel" data-slide-to="0" class="active"></li>
                <li data-target="#carousel" data-slide-to="1"></li>
                <li data-target="#carousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100 pt-5" src="<?= $root . "public/imgs/carousel4.jpg"?>" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 pt-5" src="<?= $root . "public/imgs/carousel1.jpg"?>" alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100 pt-5" src="<?= $root . "public/imgs/carousel3.jpg"?>" alt="Third slide">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="py-5">
            <div class="row">
                <?php
                if ($active != 0) {
                    $user = $data["userInfo"]->fetch_assoc();
                ?>
                <!--Infor account-->
                <div class="col-lg-3 col-md-12 shadow-lg p-3 mb-3 bg-info rounded h-100 text-white text-center">
                    <h5 class="text-center mb-3">THÔNG TIN TÀI KHOẢN</h5>
                    <div><img class="rounded-circle shadow p-1 my-3" src="<?= $root . "public/imgs/icon-user.jpg" ?>" width="80px" height="80px"></div>
                    <h5 class="mb-1"><?= $user["lastName"] . " " . $user["firstName"] ?></h5>
                    <h6 class="mb-1"><?= "Email: " . $user["email"] ?></h6>
                    <h6 class="mb-3"><?= "Số điện thoại: " . $user["phoneNumber"] ?> </h6>
                </div>
                <?php
                }
                ?>

                <!--Action-->
                <div class="col-lg-9 col-md-12 pr-0 pl-md-0 pl-lg-2 h-75">
                    <?php isset($data["ListInvoiceView"]) and $data["ListInvoiceView"] === "true" ? require_once "./mvc/views/pages/invoice.php" : ""?>
                    <?php isset($data["DetailInvoiceView"]) and $data["DetailInvoiceView"] === "true" ? require_once "./mvc/views/pages/detail_invoice.php" : ""?>
                    <?php isset($data["ManegementView"]) and $data["ManegementView"] === "true" ? require_once "./mvc/views/pages/manage.php" : ""?>
                    <?php isset($data["DetailEmployerView"]) and $data["DetailEmployerView"] === "true" ? require_once "./mvc/views/pages/detail_employer.php" : ""?>
                    <?php isset($data["StockInView"]) and $data["StockInView"] === "true" ? require_once "./mvc/views/pages/stock_in.php" : ""?>
                    <?php isset($data["DetailStockInRequestView"]) and $data["DetailStockInRequestView"] === "true" ? require_once "./mvc/views/pages/detail_stock_in.php" : ""?>
                    <?php isset($data["StockOutView"]) and $data["StockOutView"] === "true" ? require_once "./mvc/views/pages/stock_out.php" : ""?>
                    <?php isset($data["DetailStockOutRequestView"]) and $data["DetailStockOutRequestView"] === "true" ? require_once "./mvc/views/pages/detail_stock_out.php" : ""?>

                    <?php

                    if (isset($_SESSION["insertInvoice"])) {
                        if ($_SESSION["insertInvoice"] === "success") {
                            $mess = "Đã thêm hoá đơn thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["insertInvoice"] === "fail") {
                            $mess = "Thêm hoá đơn thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["insertInvoice"]);
                    }

                    if (isset($_SESSION["deleteInvoice"])) {
                        if ($_SESSION["deleteInvoice"] === "success") {
                            $mess = "Đã xoá hoá đơn thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["deleteInvoice"] === "fail") {
                            $mess = "Xoá hoá đơn thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["deleteInvoice"]);
                    }

                    if (isset($_SESSION["updateInvoice"])) {
                        if ($_SESSION["updateInvoice"] === "success") {
                            $mess = "Đã cập nhật hoá đơn thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["updateInvoice"] === "fail") {
                            $mess = "Cập nhật hoá đơn thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["updateInvoice"]);
                    }

                    if (isset($_SESSION["insertEmployer"])) {
                        if ($_SESSION["insertEmployer"] === "success") {
                            $mess = "Đã thêm nhân viên thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["insertEmployer"] === "fail") {
                            $mess = "Thêm nhân viên thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["insertEmployer"]);
                    }

                    if (isset($_SESSION["deleteEmployer"])) {
                        if ($_SESSION["deleteEmployer"] === "success") {
                            $mess = "Đã xoá nhân viên thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["deleteEmployer"] === "fail") {
                            $mess = "Xoá nhân viên thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["deleteEmployer"]);
                    }

                    if (isset($_SESSION["updateEmployer"])) {
                        if ($_SESSION["updateEmployer"] === "success") {
                            $mess = "Đã cập nhật thông tin nhân viên thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["updateEmployer"] === "fail") {
                            $mess = "Cập nhật thông tin nhân viên thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["updateEmployer"]);
                    }

                    if (isset($_SESSION["newRequest"])) {
                        if ($_SESSION["newRequest"] === "success") {
                            $mess = "Đã thêm yêu cầu thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["newRequest"] === "fail") {
                            $mess = "Thêm yêu cầu thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["newRequest"]);
                    }

                    if (isset($_SESSION["deleteRequest"])) {
                        if ($_SESSION["deleteRequest"] === "success") {
                            $mess = "Đã xoá yêu cầu thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["deleteRequest"] === "fail") {
                            $mess = "Xoá yêu cầu thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["deleteRequest"]);
                    }

                    if (isset($_SESSION["updateRequest"])) {
                        if ($_SESSION["updateRequest"] === "success") {
                            $mess = "Đã cập nhật thông tin yêu cầu thành công.";
                            $isSuccess = true;
                        } else if ($_SESSION["updateRequest"] === "fail") {
                            $mess = "Cập nhật thông tin yêu cầu thất bại.";
                            $isSuccess = false;
                        }

                        unset($_SESSION["updateRequest"]);
                    }

                    if (isset($isSuccess)) {
                        ?>

                        <div class="row d-flex justify-content-center">
                            <div class="my-alert alert <?= $isSuccess ? "alert-success" : "alert-danger" ?> w-50 text-center" role="alert"><?= $mess ?></div>
                        </div>

                    <?php
                    }
                    ?>
                </div>
                <?php
                if ($active == 0) {
                    require_once "./mvc/views/pages/intro.php";
                }
                ?>
        </div>
    </div>
</div>
</body>
</html>

