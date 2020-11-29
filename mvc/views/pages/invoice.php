<?php
$isShow = false;
if (isset($data["listInvoices"]) and $data["listInvoices"] != false) {
    $isShow = true;
    $listInvoice = $data["listInvoices"];
}

?>

<div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
    <H5 class="text-center my-3">DANH SÁCH HÓA ĐƠN</H5>
    <div class="d-flex flex-row-reverse">
        <a role="button" aria-pressed="true" class="mb-3" data-toggle="modal" data-target="#createInvoice">
            <button class="btn btn-primary">
                Tạo hóa đơn
                <svg width="1.5em" height="1.5em" viewBox="0 0 16 16" class="bi bi-plus" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </button>

        </a>
    </div>
    <table class="table text-center table-hover">
        <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Mã hóa đơn</th>
            <th scope="col">Thành tiền</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Ngày tạo</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if ($isShow) {
            $number = 1;
            while ($row = $listInvoice->fetch_assoc()) {
                $id = $row["id"];
                ?>
        <tr id="<?= $id ?>" class="table-row-invoice">
            <th scope="row"><?= $number ?></th>
            <td><?= $id ?></td>
            <td><?= $row["total_price"] ?></td>
            <td><?= $row["note"] ?></td>
            <td><?= $row["date"] ?></td>
<!--            <td><a id="--><?//= $row["id"] ?><!--" class="delete_invoice" data-toggle="modal">Xóa</a></td>-->
        </tr>
        <?php
                $number++;
            }
        } else { ?>
            <td colspan="5">Chua co hoa don</td>
        <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Tạo mới hoá đơn -->
<div class="modal fade" id="createInvoice" tabindex="-1" role="dialog" aria-labelledby="createInvoiceLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createInvoiceLabel">Tạo hoá đơn mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= $root . "Home/NewInvoice" ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input id="book_id" type="text" class="form-control mr-1 rounded w-50" placeholder="Nhập mã sách" required>
                            <input id="quanlity" type="text" class="form-control mr-1 rounded w-25" placeholder="Nhập số lượng" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary rounded" type="button" onclick="addRow()">Thêm</button>
                            </div>
                            <p id="error-message" class="m-2 text-danger"></p>
                        </div>
                    </div>
                    <table id="book-table" class="table table-bordered">
                        <thead>
                        <tr>
                            <th scope="col">Mã sách</th>
                            <th scope="col">Số lượng</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <input name="note" type="text" class="form-control" id="class-room" placeholder="Nhập ghi chú">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Tạo hoá đơn</button>
                </div>
            </form>
        </div>
    </div>
</div>
