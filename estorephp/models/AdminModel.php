<?php 

class AdminModel {
    
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function createAdmin($username, $email, $password, $firstName, $lastName) {
        $query = "INSERT INTO admins (adminID, username, email, password, firstName, lastName) 
        VALUES (NULL, :username, :email, :password, :firstName, :lastName)";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $password);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $result = $statement->execute();
        $statement->closeCursor();

        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function doesAdminExist($name, $email) {
        $query = "SELECT * FROM admins WHERE username = :username OR email = :email";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':username', $name);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $admins = $statement->fetchAll();
        $statement->closeCursor();
        if(count($admins) > 0){
            return true;
        } else {
            return false;
        }
    }

    public function adminLogin($email, $password) {
        $query  = "SELECT password FROM admins WHERE email = :email";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        if ($admin) {
            $hash = $admin['password'];
            if (password_verify($password, $hash)) {
                session_start();
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function getAdminID($email) {
        $query = "SELECT adminID FROM admins WHERE email = :email";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':email', $email);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        if($admin) {
            return $admin['adminID'];
        }
    }

    public function getAdminname($id) {
        $query = "SELECT * FROM admins WHERE adminID = :adminID";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':adminID', $id);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        if($admin) {
            return $admin;
        }
    }

    public function getAdminData($id) {
        $query = "SELECT * FROM admins WHERE adminID = :adminID";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':adminID', $id);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        return $admin;
    }

    public function changePassword($id, $old, $new) {
        $query = "SELECT * FROM admins WHERE adminID = :adminID";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':adminID', $id);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        $hash = $admin['password'];

        if(password_verify($old, $hash)) {
            $new_hash = password_hash($new, PASSWORD_DEFAULT);
            $query  = "UPDATE admins SET password = :newHash WHERE adminID = :adminID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':adminID', $id);
            $statement->bindValue(':newHash', $new_hash);
            $result = $statement->execute();
            $statement->closeCursor();
            if($result) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 3;
        }
    }

    public function deleteAccount($id, $password) { 
        $query = "SELECT * FROM admins WHERE adminID = :adminID";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':adminID', $id);
        $statement->execute();
        $admin = $statement->fetch();
        $statement->closeCursor();
        $hash = $admin['password'];
        if (password_verify($password, $hash)) {
            $query2 = "DELETE FROM admins WHERE adminID = :adminID";
            $statement2 = $this->db->prepare($query2);
            $statement2->bindValue(':adminID', $id);
            $result = $statement2->execute();
            if($result) {
                return 1;
            } else {
                return 2;
            }
        } else {
            return 3;
        }
        
    }

    public function updateadminData($id, $name, $email, $firstName, $lastName) {

        $query = "UPDATE admins SET username = :name, email = :email, firstName = :firstName, lastName = :lastName WHERE adminID = :adminID";
        $statement = $this->db->prepare($query);
        $statement->bindValue(':adminID', $id);
        $statement->bindValue(':name', $name);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $result = $statement->execute();
        $statement->closeCursor();
        if($result) {
            return true;
        } else {
            return false;
        }

    }
}
?>