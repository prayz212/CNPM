<?php
class RequestModel extends DB{
    function getAllRequestStockIn() {
        $sql = "SELECT `request`.`id`, `request`.`type`, `request`.`note`, `request`.`date`, `stock`.`name` FROM `request`, `stock` WHERE `stock`.`id` = `request`.`id_stock` and `request`.`type` = 0";

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
    function getAllRequestStockOut() {
        $sql = "SELECT `request`.`id`, `request`.`type`, `request`.`note`, `request`.`date`, `stock`.`name` FROM `request`, `stock` WHERE `stock`.`id` = `request`.`id_stock` and `request`.`type` = 1";

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
    function insertRequest($id, $type, $note, $date, $stock) {
        $sql = "INSERT INTO request (id, id_stock, type, note, date) VALUES (?, ?, ?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('ssiss', $id, $stock, $type, $note, $date);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function getRequestById($id) {
        $sql = "SELECT * FROM request WHERE id = ?";

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

    function updateRequestById($id, $note) {
        $update = "UPDATE `request` SET `request`.`note` = ? WHERE `request`.`id` = ?";
        $stm = $this->con->prepare($update);
        $stm->bind_param('ss',$note, $id);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        return false;
    }

    function deteleRequestById($id) {
        $sql = 'DELETE FROM `request` WHERE `id` = ?';

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $id);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }


}
?>