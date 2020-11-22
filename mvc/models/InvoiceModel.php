<?php
class InvoiceModel extends DB{
    function getAllInvoice() {
        $sql = 'SELECT `invoice`.`id`, SUM(`detail_invoice`.`quanlity` * `book`.`price`) AS total_price, `invoice`.`note`, `invoice`.`date` 
                FROM `detail_invoice`, `invoice`, `book` WHERE `detail_invoice`.`id_invoice` = `invoice`.`id` and `detail_invoice`.`id_book` = `book`.`id` 
                GROUP BY id_invoice';

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

    function deteleInvoiceById($id) {
        $sql = 'DELETE FROM `invoice` WHERE `id` = ?';

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $id);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function insertInvoice($id, $date, $note) {
        $sql = "INSERT INTO invoice (id, date, note) VALUES (?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('sss', $id, $date, $note);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function getInvoiceById($id) {
        $sql = 'SELECT * FROM `invoice` WHERE id = ?';

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

    function updateInvoiceById($id, $note) {
        $update = "UPDATE `invoice` SET `invoice`.`note` = ? WHERE `invoice`.`id` = ?";
        $stm = $this->con->prepare($update);
        $stm->bind_param('ss', $id, $note);
        $result = $stm->execute();

        if ($result) {
            return true;
        }

        return false;
    }
}
?>