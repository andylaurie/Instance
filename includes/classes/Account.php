<?php

    class Account extends Sql {

        private $errorArray;


        public function __construct() {
            $this->errorArray = array();
        }

        public function login($un, $pw) {
            $pw = md5($pw);
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM users
                    WHERE username = :username
                    AND password = :password
                    AND enabled='yes'";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':username', $un, PDO::PARAM_STR);
                $stmt->bindParam(':password', $pw, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->rowCount();
                $db->commit();
                if($result == 1) {
                    return true;
                } else {
                    array_push($this->errorArray, Constants::LOGIN_FAILED);
                    return false;
                }
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        public function getError($error) {
            if(!in_array($error, $this->errorArray)) {
                $error = "";
            }
            return "<span class='errorMessage'>$error</span>";
        }

// LIST ALL USERS WITH DETAILS...
        public function listUsers($limit, $offset) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT id, username, department, access, enabled FROM users
                    LIMIT :l OFFSET :o";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':l', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':o', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $db->commit();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

// GET ROW COUNT FOR LIST ALL USERS...
        public function listUsersRows() {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $stmt = $db->prepare("SELECT * FROM users");
                $stmt->execute();
                $result = $stmt->rowCount();
                $db->commit();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

// GET ALL USER DETAILS...
        public function getUserDetailsId($id) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT id, username, department, access, enabled FROM users
                    WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $db->commit();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

// GET USER DETAILS...
        public function getUserDetails($username) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT department, access, id FROM users
                    WHERE username = :username";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->execute();
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                $db->commit();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

// UPDATE USER DETAILS...
        public function update($id, $username, $department, $access, $enabled) {
            if ($enabled == NULL) {
                $enabled = 'no';
            }
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "UPDATE users
                    SET username = :username,
                        department = :department,
                        access = :access,
                        enabled = :enabled
                    WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':username', $username, PDO::PARAM_STR);
                $stmt->bindParam(':department', $department, PDO::PARAM_STR);
                $stmt->bindParam(':access', $access, PDO::PARAM_INT);
                $stmt->bindParam(':enabled', $enabled, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $db->commit();
                return true;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        public function updatePassword($id, $password) {
            $password = md5($password);
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "UPDATE users
                    SET password = :password
                    WHERE id = :id";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                $stmt->execute();
                $db->commit();
                return true;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        public function resetPassword($id) {
            // TO BE COMPLETED
        }

        public function getSetting($user) {
            try {
                $values = [$user];
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM settings WHERE user = ?";
                $stmt = $db->prepare($query);
                $stmt->execute($values);
                $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
                $db->commit();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        public function changeSetting($user, $setting, $option) {

            // WORK IN PROGRESS

        }


    }

?>
