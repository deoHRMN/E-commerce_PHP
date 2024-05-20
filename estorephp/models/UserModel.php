<?php 

    class UserModel {
        
        private $db;

        public function __construct($db) {
            $this->db = $db;
        }

        public function createUser($username, $email, $password, $street, $city, $state, $country, $zipcode) {
            $query = "INSERT INTO users (userID, username, email, password, street, city, state, country, zipcode) 
            VALUES (NULL, :username, :email, :password, :street, :city, :state, :country, :zipcode)";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':username', $username);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':password', $password);
            $statement->bindValue(':street', $street);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':state', $state);
            $statement->bindValue(':country', $country);
            $statement->bindValue(':zipcode', $zipcode);
            $result = $statement->execute();
            $statement->closeCursor();

            if ($result) {
                return true;
            } else {
                return false;
            }
        }

        public function doesUserExist($name, $email) {
            $query = "SELECT * FROM users WHERE username = :username OR email = :email";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':username', $name);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $users = $statement->fetchAll();
            $statement->closeCursor();
            if(count($users) > 0){
                return true;
            } else {
                return false;
            }
        }

        public function userLogin($email, $password) {
            $query  = "SELECT password FROM users WHERE email = :email";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            if ($user) {
                $hash = $user['password'];
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

        public function getUserID($email) {
            $query = "SELECT userID FROM users WHERE email = :email";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            if($user) {
                return $user['userID'];
            }
        }

        public function getUserName($id) {
            $query = "SELECT username FROM users WHERE userID = :userID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userID', $id);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            if($user) {
                return $user['username'];
            }
        }

        public function getUserData($id) {
            $query = "SELECT * FROM users WHERE userID = :userID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userID', $id);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            return $user;
        }

        public function changePassword($id, $old, $new) {
            $query = "SELECT * FROM users WHERE userID = :userID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userID', $id);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            $hash = $user['password'];

            if(password_verify($old, $hash)) {
                $new_hash = password_hash($new, PASSWORD_DEFAULT);
                $query  = "UPDATE users SET password = :newHash WHERE userID = :userID";
                $statement = $this->db->prepare($query);
                $statement->bindValue(':userID', $id);
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
            $query = "SELECT * FROM users WHERE userID = :userID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userID', $id);
            $statement->execute();
            $user = $statement->fetch();
            $statement->closeCursor();
            $hash = $user['password'];
            if (password_verify($password, $hash)) {
                $query2 = "DELETE FROM users WHERE userID = :userID";
                $statement2 = $this->db->prepare($query2);
                $statement2->bindValue(':userID', $id);
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

        public function updateUserData($id, $name, $email, $street, $city, $state, $country, $zipcode) {

            $query = "UPDATE users SET username = :name, email = :email, street = :street, 
                        city = :city, state = :state, country = :country, zipcode = :zipcode WHERE userID = :userID";
            $statement = $this->db->prepare($query);
            $statement->bindValue(':userID', $id);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':email', $email);
            $statement->bindValue(':street', $street);
            $statement->bindValue(':city', $city);
            $statement->bindValue(':state', $state);
            $statement->bindValue(':country', $country);
            $statement->bindValue(':zipcode', $zipcode);
            $result = $statement->execute();
            $statement->closeCursor();
            if($result) {
                return true;
            } else {
                return false;
            }

        }

        public function viewAllUsers() {
            $query = "SELECT * FROM users ORDER BY userID DESC";
            $statement = $this->db->prepare($query);
            $statement->execute();
            $users = $statement->fetchAll();
            $statement->closeCursor();
            if(count($users) > 0) {return $users;}      
        }
    }
?>