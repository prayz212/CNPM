<?php
$isShow = false;
if (isset($data["RequestList"]) and $data["RequestList"] != false) {
    $isShow = true;
    $listRequest = $data["RequestList"];
}

?>

<div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
    <h5 class="text-center my-3">DANH SÁCH YÊU CẦU NHẬP HÀNG</h5>
    <div class="d-flex flex-row-reverse">
        <a role="button" aria-pressed="true" class="mb-3" data-toggle="modal" data-target="#newStockInRequest">
            <button class="btn btn-primary">
                Tạo yêu cầu nhập hàng
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
            <th scope="col">Mã yêu cầu</th>
            <th scope="col">Ghi chú</th>
            <th scope="col">Kho</th>
            <th scope="col">Ngày yêu cầu</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if ($isShow) {
            $number = 1;
            while ($res = $listRequest->fetch_assoc()) {
                $id = $res["id"];
                ?>
                <tr id="<?= $id ?>" class="table-row-stock-in">
                    <th scope="row"><?= $number ?></th>
                    <td><?= $id ?></td>
                    <td><?= $res["note"] ?></td>
                    <td><?= $res["name"] ?></td>
                    <td><?= $res["date"] ?></td>
                </tr>
                <?php
                $number++;
            }
        } else { ?>
            <td colspan="6">Chua co yeu cau</td>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Tạo mới hoá đơn -->
<div class="modal fade" id="newStockInRequest" tabindex="-1" role="dialog" aria-labelledby="newStockInRequestLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newStockInRequestLabel">Tạo yêu cầu nhập hàng mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= $root . "Home/NewStockInRequest" ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <div class="input-group">
                            <input id="book_id" type="text" class="form-control mr-1 rounded w-50" placeholder="Nhập mã sách">
                            <input id="quanlity" type="text" class="form-control mr-1 rounded w-25" placeholder="Nhập số lượng">
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
                    <div class="form-group">
                        <select class="form-control" name="stock" class="w-100">
                            <option value="" selected disabled hidden>Chọn kho</option>
                            <option value="mM47aKyVvZzL">Kho A</option>
                            <option value="viONpbQTCtBD">Kho B</option>
                            <option value="BTHx9NL30yEw">Kho C</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Tạo yêu cầu</button>
                </div>
            </form>
        </div>
    </div>
</div>
