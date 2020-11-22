<?php
class DetailRequestModel extends DB{
    function getAllDetailRequestStockIn() {
        $sql = "SELECT stock.name FROM request, detail_request, stock WHERE `request`.`type` = 0 and request_detail.id_request = request.id and stock.id = request_detail.id_stock";

        $stm = $this->con->prepare($sql);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function insertDetailRequestStockIn($id, $book_id_arr, $quan_arr, $count) {
        $sql = "INSERT INTO detail_request (id_request, id_book, quanlity) VALUES (?, ?, ?)";
        $stm = $this->con->prepare($sql);

        for ($i = 0; $i < $count; $i++) {
            $book = $book_id_arr[$i];
            $quan = $quan_arr[$i];
            $stm->bind_param('ssi', $id, $book, $quan);
            $result = $stm->execute();

            if (!$result) {
                return false;
            }
        }

        return true;
    }

    function getDetailRequestStockInById($id) {
        $sql = "SELECT * FROM detail_request WHERE id_request = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $id);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

    function deteleDetailRequestStockInById($id) {
        $sql = 'DELETE FROM `detail_request` WHERE `id_request` = ?';

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $id);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }
}
?>