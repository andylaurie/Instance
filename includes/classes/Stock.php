<?php

    class Stock extends Sql {

// SANITARY FUNCTIONS - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// FORMAT DATE
        public function sanitizeDateRec($dateRec) {
            if($dateRec == NULL) {
                $dateRec = date("Y-m-d");
            } else {
                $dateRec = str_replace('/', '-', $dateRec);
                $dateRec = date("Y-m-d", strtotime($dateRec));
            }
            return $dateRec;
        }

// UPDATE DATE
        public function updateDateRec($dateRec) {
            if(($dateRec == NULL) or ($dateRec == "")) {
                echo "ENTER A DATE";
            } else {
                $dateRec = str_replace('/', '-', $dateRec);
                $dateRec = date("Y-m-d", strtotime($dateRec));
                return $dateRec;
            }
        }

// MAKE PART NUMBER UPPERCASE
        public function sanitizePartNumber($partNumber) {
            $partNumber = strtoupper($partNumber);
            return $partNumber;
        }

// GET DESCRIPTION
        public function getDescription($partNumber) {
            $query = Sql::getInstance()->prepare("SELECT partNumber, description
                FROM rd_desc_pronto
                WHERE partNumber = :partNumber
                UNION ALL
                SELECT partNumber, description
                FROM rd_desc_other
                WHERE partNumber = :partNumber
                ORDER BY partNumber");
            $query->bindValue(':partNumber', $partNumber, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchColumn(1);
            return $result;
        }

// GET MAX BOXID
        public function maxBoxID() {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT MAX(boxID) FROM rd_loc_back";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $db->commit();
                $result = $stmt->fetchColumn();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

// VERIFICATION FUNCTIONS - - - - - - - - - - - - - - - - - - - - - - - - - - -

// CHECK PART NUMBER EXISTS
        public function checkExists($partNumber) {
            try {
                $values = [$partNumber, $partNumber];
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT 1
                    FROM rd_desc_pronto
                    WHERE partNumber = ?
                    UNION
                    SELECT partNumber
                    FROM rd_desc_other
                    WHERE partNumber = ? LIMIT 1";
                $stmt = $db->prepare($query);
                $stmt->execute($values);
                $db->commit();
                $result = $stmt->fetchColumn();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }


// MAIN FUNCTIONS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

// SEARCH
        public function search($partNumber, $limit, $offset) {
            try {
                $partNumber = '%'.$partNumber.'%';
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT
                    rd_loc_back.partNumber, rd_desc_all.description,
                    rd_loc_back.rackNumber, rd_loc_back.boxQty,
                    rd_loc_back.dateRec, rd_loc_back.boxID
                        FROM rd_loc_back
                        LEFT JOIN(SELECT partNumber, description
                            FROM rd_desc_pronto
                            UNION ALL
                            SELECT partNumber, description
                                FROM rd_desc_other) AS rd_desc_all ON
                                rd_desc_all.partNumber = rd_loc_back.partNumber
                                WHERE rd_loc_back.partNumber LIKE :partNumber
                                LIMIT :l OFFSET :o";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':partNumber', $partNumber, PDO::PARAM_STR);
                $stmt->bindParam(':l', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':o', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
                $db->commit();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        // GET SEARCH ROWS
                public function getSearchRows($field) {
                    try {
                        $values = ['%'.$field.'%'];
                        $db = Sql::getInstance();
                        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        $db->beginTransaction();
                        $query = "SELECT
                            rd_loc_back.partNumber, rd_desc_all.description,
                            rd_loc_back.rackNumber, rd_loc_back.boxQty,
                            rd_loc_back.dateRec, rd_loc_back.boxID
                                FROM rd_loc_back
                                LEFT JOIN(SELECT partNumber, description
                                    FROM rd_desc_pronto
                                    UNION ALL
                                    SELECT partNumber, description
                                        FROM rd_desc_other) AS rd_desc_all ON
                                        rd_desc_all.partNumber = rd_loc_back.partNumber
                                        WHERE rd_loc_back.partNumber LIKE ?";
                        $stmt = $db->prepare($query);
                        $stmt->execute($values);
                        $result = $stmt->rowCount(PDO::FETCH_ASSOC);
                        $db->commit();
                        return $result;
                    } catch (PDOException $e) {
                        $db->rollback();
                        echo "Error : " . $e->getMessage();
                    }
                }

// GET ALL DETAILS
        public function getDetails($id) {
            try {
                $values = [$id];
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                //$query = "SELECT * FROM rd_loc_back WHERE boxID = ?";
                $query = "SELECT
                    rd_loc_back.partNumber, rd_desc_all.description,
                    rd_loc_back.rackNumber, rd_loc_back.boxQty,
                    rd_loc_back.dateRec, rd_loc_back.boxID
                        FROM rd_loc_back
                        LEFT JOIN(SELECT partNumber, description
                            FROM rd_desc_pronto
                            UNION ALL
                            SELECT partNumber, description
                                FROM rd_desc_other) AS rd_desc_all ON
                                rd_desc_all.partNumber = rd_loc_back.partNumber
                                WHERE rd_loc_back.boxID = ?";
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


// GET ROW COUNT
        public function getNoLocationRows() {
            $query = Sql::getInstance()->prepare("SELECT COUNT(*)
                    FROM rd_loc_back WHERE rackNumber IS NULL");
            $query->execute();
            $result = $query->fetchColumn();
            return $result;
        }


// NO LOCATION
        public function getNoLocation($limit, $offset) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT
                    rd_loc_back.partNumber, rd_desc_all.description,
                    rd_loc_back.rackNumber, rd_loc_back.boxQty,
                    rd_loc_back.dateRec, rd_loc_back.boxID
                        FROM rd_loc_back
                        LEFT JOIN(SELECT partNumber, description
                            FROM rd_desc_pronto
                            UNION ALL
                            SELECT partNumber, description
                                FROM rd_desc_other) AS rd_desc_all ON
                                rd_desc_all.partNumber = rd_loc_back.partNumber
                                WHERE rd_loc_back.rackNumber IS NULL ORDER BY
                                rd_loc_back.dateRec ASC, rd_loc_back.boxID ASC
                                LIMIT :limit OFFSET :offset";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $db->commit();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

// BOOK IN
        public function bookIn($partNumber, $boxQty, $qty, $dateRec, $user) {
            $partNumber = Stock::sanitizePartNumber($partNumber);
            $dateRec = Stock::sanitizeDateRec($dateRec);
            try {
                $values = [$partNumber, $boxQty, $dateRec];
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "INSERT INTO rd_loc_back
                    (partNumber, rackNumber, boxQty, dateRec)
                    VALUES (?, NULL, ?, ?)";
                $stmt = $db->prepare($query);
                for($x = 0; $x < $qty; $x++) {
                    $stmt->execute($values);
                }
                $db->commit();
                $action = "Booked in - Qty [". $qty ."], Part Number [". $partNumber ."], BoxQty [". $boxQty ."].";
                Sql::logEvent($user, $action);
                return true;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }


// BOOK OUT
        public function bookOut($partNumber, $boxID, $boxQty, $user) {
            try {
                $values = [$boxID];
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "DELETE FROM rd_loc_back WHERE boxID = ?";
                $stmt = $db->prepare($query);
                $stmt->execute($values);
                $db->commit();
                $action = "Booked Out - Part Number (". $partNumber ."), BoxQty (". $boxQty ."), BoxID (". $boxID.").";
                Sql::logEvent($user, $action);
                return true;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }




// UPDATE
        public function update($partNumber, $boxQty, $rackNumber, $dateRec, $boxID, $user) {
            $partNumber = Stock::sanitizePartNumber($partNumber);
            $dateRec = Stock::updateDateRec($dateRec);
//            if ($rackNumber = '') {
//                $rackNumber = NULL;
//            }
            try {
                $values = [$partNumber, $rackNumber, $boxQty, $dateRec, $boxID];
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "UPDATE rd_loc_back
                    SET partNumber = ?, rackNumber = ?, boxQty = ?, dateRec = ? WHERE boxID = ?";
                $stmt = $db->prepare($query);
                $stmt->execute($values);
                $db->commit();
                $action = "Updated - Part Number (". $partNumber ."), BoxQty (".
                $boxQty ."), Location (". $rackNumber ."), BoxID (". $boxID .").";
                Sql::logEvent($user, $action);
                return true;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }


    }
