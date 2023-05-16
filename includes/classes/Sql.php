<?php

    class Sql {

        private static $instance = null;

        public static function getInstance() {
            if(self::$instance == null)
            {
                try
                {
                    self::$instance = new PDO('mysql:host=localhost;dbname='.SQL_DB.';charset=utf8',
                        SQL_USR,
                        SQL_PW,
                        array(PDO::MYSQL_ATTR_LOCAL_INFILE => true));
                    self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
                }
                catch(PDOException $e)
                {
                    //echo 'Exception -> ';
                    //var_dump($e->getMessage());
                    throw $e;
                }
            }
            return self::$instance;
        }

        public function logEvent($user, $action) {
            try {
                $time = date('Y-m-d H:i:s');
                $values = [$time, $user, $action];
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $query = "INSERT INTO rd_log_action
                    (logTime , user, action)
                    VALUES (?, ?, ?)";
                $stmt = $db->prepare($query);
                $stmt->execute($values);
                $db->commit();
                return true;
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

    }
