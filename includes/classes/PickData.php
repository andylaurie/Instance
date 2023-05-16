<?php

    class PickData extends Sql {

        // LIST ALL MODELS...
        public function listModels($limit, $offset) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT DISTINCT
                    rd_mach_pick.modelNumber, rd_desc_all.description
                    FROM rd_mach_pick
                        LEFT JOIN (
                    SELECT partNumber, description
                    FROM rd_desc_pronto
                        UNION ALL
                    SELECT partNumber, description
                    FROM rd_desc_other) AS rd_desc_all
                    ON rd_desc_all.partNumber = rd_mach_pick.modelNumber
                    ORDER BY rd_mach_pick.modelNumber
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
                $query = "SELECT DISTINCT
                    rd_mach_pick.modelNumber, rd_desc_all.description
                    FROM rd_mach_pick
                        LEFT JOIN (
                    SELECT partNumber, description
                    FROM rd_desc_pronto
                        UNION ALL
                    SELECT partNumber, description
                    FROM rd_desc_other) AS rd_desc_all
                    ON rd_desc_all.partNumber = rd_mach_pick.modelNumber
                    ORDER BY rd_mach_pick.modelNumber";
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

        // GET MODEL DETAILS...
        public function getModelDetails($modelNumber) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT
                    rd_mach_pick.modelNumber, rd_mach_pick.partNumber,
                    rd_desc_all.description, rd_mach_pick.qtyPer,
                    rd_mach_pick.giveTo, rd_mach_pick.groupTo,
                    rd_loc_main.rackNumber, rd_loc_main.binNumber
                    FROM rd_mach_pick
                        LEFT JOIN (
                    SELECT partNumber, description
                    FROM rd_desc_pronto
                        UNION ALL
                    SELECT partNumber, description
                    FROM rd_desc_other) AS rd_desc_all
                    ON rd_desc_all.partNumber = rd_mach_pick.partNumber
                        LEFT JOIN rd_loc_main
                    ON rd_loc_main.partNumber = rd_mach_pick.partNumber
                    WHERE rd_mach_pick.modelNumber = :modelNumber
                    ORDER BY rd_mach_pick.groupTo, rd_mach_pick.giveTo,
                    rd_loc_main.rackNumber, rd_loc_main.binNumber";
                $stmt = $db->prepare($query);
                $stmt->bindParam(':modelNumber', $modelNumber, PDO::PARAM_STR);
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
