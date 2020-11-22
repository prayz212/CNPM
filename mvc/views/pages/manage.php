<?php
$isShow = false;
if (isset($data["EmployerList"]) and $data["EmployerList"] != false) {
    $isShow = true;
    $listEmployer = $data["EmployerList"];
}

?>

<div class="col-lg-12 shadow p-2 mb-3 bg-light rounded">
    <h5 class="text-center my-3">DANH SÁCH NHÂN VIÊN</h5>
    <div class="d-flex flex-row-reverse">
        <a role="button" aria-pressed="true" class="mb-3" data-toggle="modal" data-target="#newEmployer">
            <button class="btn btn-primary">
                Tạo nhân viên
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
            <th scope="col">Mã nhân viên</th>
            <th scope="col">Họ và tên</th>
            <th scope="col">Ngày sinh</th>
            <th scope="col">Email</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Thâm niên</th>
        </tr>
        </thead>
        <tbody>
        <?php

        if ($isShow) {
            $number = 1;
            while ($row = $listEmployer->fetch_assoc()) {
                $id = $row["id"];
                ?>
                <tr id="<?= $id ?>" class="table-row-employer">
                    <th scope="row"><?= $number ?></th>
                    <td><?= $id ?></td>
                    <td><?= $row["lastName"] . " " . $row["firstName"] ?></td>
                    <td><?= $row["DOB"] ?></td>
                    <td><?= $row["email"] ?></td>
                    <td><?= $row["phoneNumber"] ?></td>
                    <td><?= $row["senior"] ?></td>
                </tr>
                <?php
                $number++;
            }
        } else { ?>
            <td colspan="6">Chua co nhan vien</td>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<!-- Tạo mới hoá đơn -->
<div class="modal fade" id="newEmployer" tabindex="-1" role="dialog" aria-labelledby="newEmployerLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newEmployerLabel">Thêm nhân viên mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= $root . "Home/NewEmployer" ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input name="fullname" type="text" class="form-control" placeholder="Nhập họ và tên">
                    </div>
                    <div class="form-group">
                        <input name="phone" type="text" class="form-control" id="class-room" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group">
                        <input name="address" type="text" class="form-control" id="class-room" placeholder="Nhập địa chỉ">
                    </div>
                    <div class="form-group">
                        <input name="dob" type="text" class="form-control" id="class-room" placeholder="Nhập ngày sinh">
                    </div>
                    <div class="form-group">
                        <input name="email" type="text" class="form-control" id="class-room" placeholder="Nhập địa chỉ email">
                    </div>
                    <div class="form-group">
                        <select class="form-control" name="permission" class="w-100">
                            <option value="" selected disabled hidden>Chọn chức vụ</option>
                            <option value="0">Quản lý</option>
                            <option value="1">Nhân viên kho</option>
                            <option value="2">Nhân viên bán hàng</option>
                        </select>
                    </div>
                    <div class="form-group row">
                        <div class="input-group mb-3 col-md-6">
                            <div class="input-group-append">
                                <span class="input-group-text">Tài khoản</span>
                            </div>
                            <input name="username" type="text" class="form-control" placeholder="Tên tài khoản">
                        </div>

                        <div class="input-group mb-3 col-md-6">
                            <div class="input-group-append">
                                <span class="input-group-text">Mật khẩu</span>
                            </div>
                            <input name="password" type="password" class="form-control" placeholder="Mật khẩu">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Hủy bỏ</button>
                    <button type="submit" class="btn btn-primary">Thêm nhân viên</button>
                </div>
            </form>
        </div>
    </div>
</div>
