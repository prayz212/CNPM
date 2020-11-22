<?php
$employer = $data["EmployerInfo"]->fetch_assoc();
?>

<div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
    <H5 class="text-center my-3">CHI TIẾT NHÂN VIÊN</H5>

    <form class="p-2" method="post" action="<?= $root . "Home/UpdateEmployer/" . $employer["id"] ?>">
        <div class="form-group row">
            <div class="input-group mb-3 col-md-5">
                <div class="input-group-append">
                    <span class="input-group-text">Mã nhân viên</span>
                </div>
                <input type="text" class="form-control" readonly value="<?= $employer["id"] ?>">
            </div>

            <div class="input-group mb-3 col-md-7">
                <div class="input-group-append">
                    <span class="input-group-text">Chức vụ</span>
                </div>
                <?php
                $perm = $employer["permission"];
                ?>
                <select class="form-control" name="permission">
                    <option value="0" <?= $perm == 0 ? "selected" : ""?>>Quản lý</option>
                    <option value="1" <?= $perm == 1 ? "selected" : ""?>>Nhân viên kho</option>
                    <option value="2" <?= $perm == 2 ? "selected" : ""?>>Nhân viên bán hàng</option>
                </select>
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-8">
                <div class="input-group-append">
                    <span class="input-group-text">Họ và tên</span>
                </div>
                <input name="fullname" type="text" class="form-control" value="<?= $employer["lastName"] . " " . $employer["firstName"] ?>">
            </div>

            <div class="input-group mb-3 col-md-4">
                <div class="input-group-append">
                    <span class="input-group-text">Ngày sinh</span>
                </div>
                <input name="dob" type="text" class="form-control" value="<?= $employer["DOB"] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-5">
                <div class="input-group-append">
                    <span class="input-group-text">Số điện thoại</span>
                </div>
                <input name="phone" type="text" class="form-control" value="<?= $employer["phoneNumber"] ?>">
            </div>

            <div class="input-group mb-3 col-md-7">
                <div class="input-group-append">
                    <span class="input-group-text">Email</span>
                </div>
                <input name="email" type="text" class="form-control" value="<?= $employer["email"] ?>">
            </div>
        </div>

        <div class="form-group row">
            <div class="input-group mb-3 col-md-8">
                <div class="input-group-append">
                    <span class="input-group-text">Địa chỉ</span>
                </div>
                <input name="address" type="text" class="form-control" value="<?= $employer["address"] ?>">
            </div>

            <div class="input-group mb-3 col-md-4">
                <div class="input-group-append">
                    <span class="input-group-text">Thâm niên</span>
                </div>
                <input name="senior" type="text" class="form-control" value="<?= $employer["senior"] ?>">
            </div>
        </div>

        <div class="d-flex flex-row-reverse">
            <button type="submit" class="btn btn-primary mx-3">Lưu thay đổi</button>
            <button id="<?= $employer["id"] ?>" data-toggle="modal" type="button" class="delete_employer btn btn-danger ml-3">Xóa nhân viên</button>
            <button type="button" class="btn btn-secondary" onclick="window.location='<?= $root . "Home/Management" ?>';">Hủy bỏ</button>
        </div>

    </form>
</div>

<!-- Xóa nhân viên -->
<div class="modal fade" id="deleteEmployer" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title my-2" id="deleteModalLabel">Xác nhận xóa</h3>
                <div>Bạn có chắc chắn muốn xóa nhân viên này?</div>
                <div>Việc này sẽ xóa vĩnh viễn không thể khôi phục.</div>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" data-dismiss="modal">Hủy</a>
                <a id="sure" type="button" class="btn btn-primary">Chắc chắn</a>
            </div>
        </div>
    </div>
</div>