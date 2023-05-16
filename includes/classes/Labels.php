<?php

    class Labels extends Sql {

// SHOW ITEMS WITH NO LOCATION
        public function searchPartNumber($partNumber) {
            $values = ['%'.$partNumber.'%', '%'.$partNumber.'%'];
            $db = Sql::getInstance();
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $db->beginTransaction();
            $query = "SELECT partNumber, description
                FROM rd_desc_pronto
                WHERE partNumber LIKE ?
                UNION ALL
                SELECT partNumber, description
                FROM rd_desc_other
                WHERE partNumber LIKE ?
                ORDER BY partNumber";
            $stmt = $db->prepare($query);
            $stmt->execute($values);
            $db->commit();
            $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }

        public function searchSpares($partNumber, $limit, $offset) {
            try {
                $partNumber = "%$partNumber%";
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM (
					SELECT
                    partNumber, description
                    FROM rd_desc_pronto
                        UNION ALL
                    SELECT
                    partNumber, description
                    FROM rd_desc_other) AS rd_desc_all
                        WHERE rd_desc_all.partNumber LIKE :partNumber
                        ORDER BY rd_desc_all.partNumber ASC
                        LIMIT :l OFFSET :o";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':partNumber', $partNumber, PDO::PARAM_STR);
                $stmt->bindParam(':l', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':o', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $db->commit();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        public function searchSparesRows($partNumber) {
            try {
                $partNumber = "%$partNumber%";
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM (
					SELECT
                    partNumber, description
                    FROM rd_desc_pronto
                        UNION ALL
                    SELECT
                    partNumber, description
                    FROM rd_desc_other) AS rd_desc_all
                        WHERE rd_desc_all.partNumber LIKE :partNumber
                        ORDER BY rd_desc_all.partNumber ASC";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':partNumber', $partNumber, PDO::PARAM_STR);
                $stmt->execute();
                $db->commit();
                $result = $stmt->rowCount(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        // LIST ALL MODELS...
        public function listModels($limit, $offset) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT modelNumber, descriptionTop, descriptionBottom,
                    supplyVoltage, ratedInput, serialDesignation, serialWidth,
                    packedWeight, brand FROM rd_mach_details ORDER BY modelNumber
                    LIMIT :l OFFSET :o";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':l', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':o', $offset, PDO::PARAM_INT);
                $stmt->execute();
                $db->commit();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        public function listModelRows() {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT modelNumber, descriptionTop, descriptionBottom,
                    supplyVoltage, ratedInput, serialDesignation, serialWidth,
                    packedWeight, brand FROM rd_mach_details ORDER BY modelNumber";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $db->commit();
                $result = $stmt->rowCount();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
        public function getMachines() {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT modelNumber, descriptionTop, descriptionBottom,
                    supplyVoltage, ratedInput, serialDesignation, serialWidth,
                    packedWeight, brand FROM rd_mach_details ORDER BY modelNumber";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $db->commit();
                $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        public function getMachineDetails($modelNumber) {
            try {
                $values = [$modelNumber];
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT modelNumber, descriptionTop, descriptionBottom,
                    supplyVoltage, ratedInput, serialDesignation, serialWidth,
                    packedWeight, brand FROM rd_mach_details WHERE modelNumber = ?";
                $stmt = $db->prepare($query);
                $stmt->execute($values);
                $db->commit();
                $result = $stmt->fetchALL(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
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
            $result = $query->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }

// LOAD ITEM BY ID
        public function loadId($id) {
            $query = Sql::getInstance()->prepare("SELECT * FROM rd_loc_back WHERE id = :id");
            $query->bindValue(':id', $id, PDO::PARAM_STR);
            $query->execute();
            $result = $query->fetchALL(PDO::FETCH_ASSOC);
            return $result;
        }

// - - - - - - - LIST ALL TABLES - - - - - - - - - - - - - - - - - - - -

        public function getTables() {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SHOW TABLES";
                $stmt = $db->prepare($query);
                $stmt->execute();
                $db->commit();
                $result = $stmt->fetchALL(PDO::FETCH_NUM);
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

    }
