<?php

    class Log extends Sql {


// GET ROW COUNT
        public function getRows() {
            $query = Sql::getInstance()->prepare("SELECT COUNT(*) FROM rd_log_action");
            $query->execute();
            $result = $query->fetchColumn();
            return $result;
        }

// SHOW ALL LOG ITEMS
        public function getLog($limit, $offset) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "SELECT * FROM rd_log_action ORDER BY logTime DESC LIMIT :limit OFFSET :offset";
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

    }
