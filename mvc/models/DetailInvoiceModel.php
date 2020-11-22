<?php
class DetailInvoiceModel extends DB{
    function deteleDetailInvoiceById($id) {
        $sql = 'DELETE FROM `detail_invoice` WHERE `id_invoice` = ?';

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $id);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function insertDetailInvoice($invoice, $id_book, $quanlity, $count) {
        $sql = "INSERT INTO detail_invoice (id_invoice, id_book, quanlity) VALUES (?, ?, ?)";
        $stm = $this->con->prepare($sql);

        for ($i = 0; $i < $count; $i++) {
            $book = $id_book[$i];
            $quan = $quanlity[$i];
            $stm->bind_param('ssi', $invoice, $book, $quan);
            $result = $stm->execute();

            if (!$result) {
                return false;
            }
        }

        return true;
    }

    function getDetailInvoiceById($id) {
        $sql = 'SELECT `detail_invoice`.`quanlity`, `detail_invoice`.`id_book`, `book`.`price` FROM `detail_invoice`, `book` WHERE id_invoice = ? and book.id = detail_invoice.id_book';

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
}
?>