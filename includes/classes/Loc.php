<?php

    class Loc extends Sql {

        // SEARCH LOCATIONS
        public function searchPartNumber($partNumber, $limit, $offset) {
            try {
                $partNumber = "%$partNumber%";
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM (
					SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_main
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_desp
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_mach
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_fact
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_weld) AS merged
                        LEFT JOIN (
                            SELECT partNumber, description
                            FROM rd_desc_pronto
                                UNION ALL
                            SELECT partNumber, description
                            FROM rd_desc_other)
                            AS rd_desc_all ON
                                rd_desc_all.partNumber = merged.partNumber
                                WHERE merged.partNumber LIKE :partNumber
                                ORDER BY merged.rackNumber ASC, merged.binNumber ASC
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



        // ROW COUNT FOR SEARCH LOCATIONS
        public function getSearchRows($partNumber) {
            try {
                $partNumber = "%$partNumber%";
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM (
					SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_main
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_desp
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_mach
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_fact
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_weld) AS merged
                        LEFT JOIN (
                            SELECT partNumber, description
                            FROM rd_desc_pronto
                                UNION ALL
                            SELECT partNumber, description
                            FROM rd_desc_other)
                            AS rd_desc_all ON
                                rd_desc_all.partNumber = merged.partNumber
                                WHERE merged.partNumber LIKE :partNumber
                                ORDER BY merged.rackNumber ASC, merged.binNumber ASC";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':partNumber', $partNumber, PDO::PARAM_STR);
                $stmt->execute();
                $db->commit();
                $result = $stmt->rowCount();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        // SEARCH RACK LOCATIONS
        public function searchRackNumber($rackNumber, $limit, $offset) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM (
					SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_main
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_desp
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_mach
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_fact
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_weld) AS merged
                        LEFT JOIN (
                            SELECT partNumber, description
                            FROM rd_desc_pronto
                                UNION ALL
                            SELECT partNumber, description
                            FROM rd_desc_other)
                            AS rd_desc_all ON
                                rd_desc_all.partNumber = merged.partNumber
                                WHERE merged.rackNumber = :rackNumber
                                ORDER BY merged.binNumber ASC
                                LIMIT :l OFFSET :o";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':rackNumber', $rackNumber, PDO::PARAM_STR);
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



        // ROW COUNT FOR SEARCH RACK LOCATIONS
        public function getSearchRackRows($rackNumber) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM (
					SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_main
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_desp
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_mach
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_fact
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_weld) AS merged
                        LEFT JOIN (
                            SELECT partNumber, description
                            FROM rd_desc_pronto
                                UNION ALL
                            SELECT partNumber, description
                            FROM rd_desc_other)
                            AS rd_desc_all ON
                                rd_desc_all.partNumber = merged.partNumber
                                WHERE merged.rackNumber = :rackNumber
                                ORDER BY merged.binNumber ASC";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':rackNumber', $rackNumber, PDO::PARAM_STR);
                $stmt->execute();
                $db->commit();
                $result = $stmt->rowCount();
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

        // GET DETAILS
        public function getDetails($partNumber, $rackNumber) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM (
					SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_main
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_desp
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_mach
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_fact
                        UNION ALL
                    SELECT
                    partNumber, rackNumber, binNumber
                    FROM rd_loc_weld) AS merged
                        LEFT JOIN (
                            SELECT partNumber, description
                            FROM rd_desc_pronto
                                UNION ALL
                            SELECT partNumber, description
                            FROM rd_desc_other)
                            AS rd_desc_all ON
                                rd_desc_all.partNumber = merged.partNumber
                                WHERE merged.partNumber = :partNumber AND merged.rackNumber = :rackNumber";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':partNumber', $partNumber, PDO::PARAM_STR);
                $stmt->bindParam(':rackNumber', $rackNumber, PDO::PARAM_STR);
                $stmt->execute();
                $db->commit();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }


    }
