<?php
$request = $data["RequestInfo"]->fetch_assoc();
$detail = $data["RequestDetail"];
?>

<div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
    <H5 class="text-center my-3">CHI TIẾT YÊU CẦU NHẬP HÀNG</H5>

    <form class="p-2" method="post" action="<?= $root . "Home/UpdateRequestStockIn/" . $request["id"] ?>">
        <div class="form-group row">
            <div class="input-group mb-3 col-md-6">
                <div class="input-group-append">
                    <span class="input-group-text">Mã yêu cầu</span>
                </div>
                <input type="text" class="form-control" readonly value="<?= $request["id"] ?>">
            </div>

            <div class="input-group mb-3 col-md-6">
                <div class="input-group-append">
                    <span class="input-group-text">Ngày yêu cầu</span>
                </div>
                <input type="text" class="form-control" readonly value="<?= $request["date"] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-12">
                <div class="input-group-append">
                    <span class="input-group-text">Ghi chú</span>
                </div>
                <input name="note" type="text" class="form-control" value="<?= $request["note"] ?>">
            </div>
        </div>

        <table id="book-table" class="table table-bordered bg-white">
            <thead class="text-center">
            <tr>
                <th scope="col">Mã sách</th>
                <th scope="col">Số lượng</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $total = 0;
            while ($row = $detail->fetch_assoc()) {
                $quan = $row["quanlity"];
            ?>
            <tr>
                <td><input name="book_id[]" class="border-0 w-100" value="<?= $row["id_book"] ?>"></td>
                <td><input name="quanlity[]" class="border-0 w-100" value="<?= $quan ?>"></td>
            </tr>
            <?php
            }
            ?>
            </tbody>
        </table>

        <div class="d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary mx-3">Lưu thay đổi</button>
            <button id="<?= $request["id"] ?>" data-toggle="modal" type="button" class="delete_request_stock_in btn btn-danger ml-3">Xóa yêu cầu</button>
            <button type="button" class="btn btn-secondary" onclick="window.location='<?= $root . "Home/StockIn" ?>';">Hủy bỏ</button>
        </div>

    </form>
</div>

<!-- Xóa hóa đơn -->
<div class="modal fade" id="deleteRequest" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title my-2" id="deleteModalLabel">Xác nhận xóa</h3>
                <div>Bạn có chắc chắn muốn xóa yêu cầu này?</div>
                <div>Việc này sẽ xóa vĩnh viễn không thể khôi phục.</div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                <a id="sure" type="button" class="btn btn-primary">Chắc chắn</a>
            </div>
        </div>
    </div>
</div>