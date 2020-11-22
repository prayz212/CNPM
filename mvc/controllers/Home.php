<?php

class Home extends Controller{

    // Must have Error()
    function Error(){
        echo "sai url";
    }

    function getUserInfo() {
        $id = $_SESSION["loggedIn"];
        $employerModel = $this->model("EmployerModel");
        $employer = $employerModel->getEmployerById($id);

        return $employer;
    }

    function Intro() {
        //Call view
        $this->view("HomeView", [
            "IntroView" => "true"
        ]);
    }

    function Invoice() {
        //Call model
        $invoiceModel = $this->model("InvoiceModel");
        $invoiceList = $invoiceModel->getAllInvoice();

        $user = $this->getUserInfo();

        //Call view
        $this->view("HomeView", [
            "ListInvoiceView" => "true",
            "listInvoices" => $invoiceList,
            "userInfo" => $user
        ]);
    }

    function Management() {
        //Call model
        $employerModel = $this->model("EmployerModel");
        $employers = $employerModel->getAllEmployer();

        $user = $this->getUserInfo();

        //Call view
        $this->view("HomeView", [
            "ManegementView" => "true",
            "EmployerList" => $employers,
            "userInfo" => $user
        ]);
    }

    function StockIn() {
        //Call model
        $requestModel = $this->model("RequestModel");

        $requests = $requestModel->getAllRequestStockIn();

        $user = $this->getUserInfo();

        //Call view
        $this->view("HomeView", [
            "StockInView" => "true",
            "RequestList" => $requests,
            "userInfo" => $user
        ]);
    }

    /*-------------------------------------     NHAN VIEN BAN HANG      -------------------------------------*/
    function DeleteInvoice($id) {
        //Call model
        $invoiceModel = $this->model("InvoiceModel");
        $detailInvoiceModel = $this->model("DetailInvoiceModel");

        $deleteDetail = $detailInvoiceModel->deteleDetailInvoiceById($id);

        if ($deleteDetail) {
            $deleteResult = $invoiceModel->deteleInvoiceById($id);

            if ($deleteResult) {
                header("Location: ../../Home/Invoice");
                exit();
            }
        }
    }

    function NewInvoice() {
        $id_arr = $_POST["book_id"];
        $quan_arr = $_POST["quanlity"];
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $id =  substr(str_shuffle($permitted_chars), 0, 12);
        $note = $_POST["note"];
        $now = date('d/m/Y');
        $n = count($id_arr);

        //Call model
        $invoiceModel = $this->model("InvoiceModel");
        $detailInvoiceModel = $this->model("DetailInvoiceModel");

        //CREATE INVOICE FIRST
        $newInvoice = $invoiceModel->insertInvoice($id, $now, $note);

        if ($newInvoice) {
            //INSERT DETAIL INVOICE
            $detailInvoice = $detailInvoiceModel->insertDetailInvoice($id, $id_arr, $quan_arr, $n);

            if ($detailInvoice) {
                header("Location: ../Home/Invoice");
                exit();
            }
        } else {
            echo "Khong the them hoa don";
        }
    }

    function DetailInvoice($id) {
        //Call model
        $invoiceModel = $this->model("InvoiceModel");
        $detailInvoiceModel = $this->model("DetailInvoiceModel");

        $invoice = $invoiceModel->getInvoiceById($id);
        $detail = $detailInvoiceModel->getDetailInvoiceById($id);

        $user = $this->getUserInfo();

        $this->view("HomeView", [
            "DetailInvoiceView" => "true",
            "InvoiceInfo" => $invoice,
            "DetailInvoice" => $detail,
            "userInfo" => $user
        ]);
    }

    function UpdateInvoice($id) {
        $id_arr = $_POST["book_id"];
        $quan_arr = $_POST["quanlity"];
        $note = $_POST["note"];
        $n = count($id_arr);

        //Call model
        $invoiceModel = $this->model("InvoiceModel");
        $detailInvoiceModel = $this->model("DetailInvoiceModel");

        //DELETE DETAIL INVOICE FIRST
        $deteleDetail = $detailInvoiceModel->deteleDetailInvoiceById($id);

        if (!$deteleDetail) {
            die("Xoa chi tiet hoa don that bai");
        }

        //UPDATE INVOICE INFO
        $updateInfo = $invoiceModel->updateInvoiceById($id, $note);
        if (!$updateInfo) {
            die("Cap nhat thong tin hoa don that bai");
        }

        //INSERT NEW DETAIL INVOICE
        $detailInvoice = $detailInvoiceModel->insertDetailInvoice($id, $id_arr, $quan_arr, $n);
        if ($detailInvoice) {
            header("Location: ../../Home/Invoice");
            exit();
        } else {
            die("Them chi tiet hoa don that bai");
        }
    }
    /*-------------------------------------     HET NHAN VIEN BAN HANG      -------------------------------------*/

    /*-------------------------------------     NHAN VIEN QUAN LY      -------------------------------------*/
    function NewEmployer() {
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $id =  substr(str_shuffle($permitted_chars), 0, 12);

        //SPLIT FULLNAME INTO FIRSTNAME AND LASTNAME
        $fullname = $_POST["fullname"];
        $name = explode(" ", $fullname);
        $n = count($name);
        $firstName = $name[$n - 1];
        $lastName = "";
        for ($i = 0; $i < $n - 1; $i++) {
            $lastName .= $name[$i];

            if (($i + 1) < ($n - 1)) {
                $lastName .= " ";
            }
        }

        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $dob = $_POST["dob"];
        $email = $_POST["email"];
        $permission = $_POST["permission"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $senior = 0;

        //Call model
        $employerModel = $this->model("EmployerModel");

        $newEmployer = $employerModel->insertEmployer($id, $firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior, $username, $password);

        if ($newEmployer) {
            header("Location: ../Home/Management");
            exit();
        } else {
            echo "Khong the them nhan vien";
        }
    }

    function DeleteEmployer($id) {
        //Call model
        $employerModel = $this->model("EmployerModel");

        $deleteEmployer = $employerModel->deteleEmployerById($id);

        if ($deleteEmployer) {
            header("Location: ../../Home/Management");
            exit();
        }
    }

    function DetailEmployer($id) {
        //Call model
        $employerModel = $this->model("EmployerModel");

        $employerInfo = $employerModel->getEmployerById($id);

        $user = $this->getUserInfo();

        $this->view("HomeView", [
            "DetailEmployerView" => "true",
            "EmployerInfo" => $employerInfo,
            "userInfo" => $user
        ]);
    }

    function UpdateEmployer($id) {
        //SPLIT FULLNAME INTO FIRSTNAME AND LASTNAME
        $fullname = $_POST["fullname"];
        $name = explode(" ", $fullname);
        $n = count($name);
        $firstName = $name[$n - 1];
        $lastName = "";
        for ($i = 0; $i < $n - 1; $i++) {
            $lastName .= $name[$i];

            if (($i + 1) < ($n - 1)) {
                $lastName .= " ";
            }
        }

        $permission = $_POST["permission"];
        $dob = $_POST["dob"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $address = $_POST["address"];
        $senior = $_POST["senior"];

        //Call model
        $employerModel = $this->model("EmployerModel");

        $update = $employerModel->updateEmployerById($id, $firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior);
        if ($update) {
            header("Location: ../../Home/Management");
            exit();
        } else {
            die("Cap nhat nhan vien that bai");
        }
    }
    /*-------------------------------------     HET NHAN VIEN QUAN LY      -------------------------------------*/

    /*-------------------------------------     NHAN VIEN KHO      -------------------------------------*/
    function NewStockInRequest() {
        $id_arr = $_POST["book_id"];
        $quan_arr = $_POST["quanlity"];
        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        $id =  substr(str_shuffle($permitted_chars), 0, 12);
        $stock = $_POST["stock"];
        $note = $_POST["note"];
        $now = date('d/m/Y');
        $n = count($id_arr);
        $type = 0;

        //Call model
        $requestModel = $this->model("RequestModel");
        $detailRequestModel = $this->model("DetailRequestModel");

        //CREATE REQUEST FIRST
        $newRequest = $requestModel->insertRequestStockIn($id, $type, $note, $now, $stock);


        if ($newRequest) {
            //INSERT REQUEST DETAIL
            $newRequestDetail = $detailRequestModel->insertDetailRequestStockIn($id, $id_arr, $quan_arr, $n);

            if ($newRequestDetail) {
                header("Location: ../Home/StockIn");
                exit();
            }
        } else {
            echo "Khong the them hoa don";
        }
    }

    function DetailStockInRequest($id) {
        //Call model
        $requestModel = $this->model("RequestModel");
        $detailRequestModel = $this->model("DetailRequestModel");

        $request = $requestModel->getRequestStockInById($id);
        $detail = $detailRequestModel->getDetailRequestStockInById($id);

        $user = $this->getUserInfo();

        //Call view
        $this->view("HomeView", [
            "DetailStockInRequestView" => "true",
            "RequestInfo" => $request,
            "RequestDetail" => $detail,
            "userInfo" => $user
        ]);
    }

    function DeleteRequest($id) {
        //Call model
        $requestModel = $this->model("RequestModel");
        $detailRequestModel = $this->model("DetailRequestModel");

        $deleteDetail = $detailRequestModel->deteleDetailRequestStockInById($id);
        $deleteRequest = $requestModel->deteleRequestById($id);

        if ($deleteDetail and $deleteRequest) {
            header("Location: ../../Home/StockIn");
            exit();
        }
    }

    function UpdateRequestStockIn($id) {
        $id_arr = $_POST["book_id"];
        $quan_arr = $_POST["quanlity"];
        $note = $_POST["note"];
        $n = count($id_arr);

        //Call model
        $requestModel = $this->model("RequestModel");
        $detailRequestModel = $this->model("DetailRequestModel");

        //DELETE DETAIL REQUEST FIRST
        $deleteDetail = $detailRequestModel->deteleDetailRequestStockInById($id);

        if (!$deleteDetail) {
            die("Xoa chi tiet yeu cau that bai");
        }

        //UPDATE REQUEST INFO
        $updateInfo = $requestModel->updateRequestById($id, $note);
        if (!$updateInfo) {
            die("Cap nhat thong tin yeu cau that bai");
        }

        //INSERT NEW DETAIL REQUEST
        $detailRequest = $detailRequestModel->insertDetailRequestStockIn($id, $id_arr, $quan_arr, $n);
        if ($detailRequest) {
            header("Location: ../../Home/StockIn");
            exit();
        } else {
            die("Them chi tiet hoa don that bai");
        }
    }
}
?>