<?php
class EmployerModel extends DB{
    function login($userName, $password) {
        $sql = "SELECT * FROM employer WHERE username = ? AND password = ?";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('ss', $userName, $password);
        if (!$stm->execute()) {
            return false;
        }

        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            return $result;
        }

        return false;
    }

     function getAllEmployer() {
         $sql = "SELECT * FROM employer";

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

     function getEmployerById($id) {
         $sql = "SELECT * FROM employer WHERE id = ?";

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

     function updateEmployerById($id, $firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior) {
         $update = "UPDATE `employer` SET `employer`.`firstName` = ?, `employer`.`lastName` = ?, `employer`.`permission` = ?, 
                    `employer`.`DOB` = ?, `employer`.`phoneNumber` = ?, `employer`.`email` = ?, `employer`.`address` = ?, `employer`.`senior` = ? WHERE `employer`.`id` = ?";
         $stm = $this->con->prepare($update);
         $stm->bind_param('ssissssis',$firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior, $id);
         $result = $stm->execute();

         if ($result) {
             return true;
         }

         return false;
     }

    function deteleEmployerById($id) {
        $sql = 'DELETE FROM `employer` WHERE `id` = ?';

        $stm = $this->con->prepare($sql);
        $stm->bind_param('s', $id);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }

    function insertEmployer($id, $firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior, $username, $password) {
        $sql = "INSERT INTO employer (id, firstName, lastName, permission, DOB, phoneNumber, email, address, senior, username, password) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stm = $this->con->prepare($sql);
        $stm->bind_param('sssissssiss', $id, $firstName, $lastName, $permission, $dob, $phone, $email, $address, $senior, $username, $password);
        if (!$stm->execute()) {
            return false;
        }

        return true;
    }
}
?>