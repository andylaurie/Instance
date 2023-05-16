<?php

    class Export extends Sql {

        private $uriPath;

        function __construct($uriPath) {
            $this->uriPath = $uriPath;
        }

// PRIVATES - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        private function getBase() {
            return basename($this->uriPath);
        }

        private function getHeader() {
            return Constants::EXPORT_DETAILS[$this->getBase()]['headers'];
        }

        private function getMethod() {
            return 'export'.str_replace('-', '', ucwords($this->getBase()));
        }

// QUERY RUNNER - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        private function runQuery($query) {
            try {
                $db = Sql::getInstance();
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $db->beginTransaction();
                $stmt = $db->prepare($query);
                $stmt->execute();
                $db->commit();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                $db->rollback();
                echo "Error : " . $e->getMessage();
            }
        }

// QUERIES - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        private function exportMachineDetails(){
            $query = "SELECT * FROM rd_mach_details";
            return $this->runQuery($query);
        }

        private function exportProntoDescriptions(){
            $query = "SELECT * FROM rd_desc_pronto";
            return $this->runQuery($query);
        }

        private function exportCustomDescriptions(){
            $query = "SELECT * FROM rd_desc_other";
            return $this->runQuery($query);
        }

        private function exportAllLocations(){
            $query = "SELECT * FROM rd_loc_main
                    UNION ALL
                SELECT * FROM rd_loc_desp
                    UNION ALL
                SELECT * FROM rd_loc_mach
                    UNION ALL
                SELECT * FROM rd_loc_fact
                    UNION ALL
                SELECT * FROM rd_loc_weld";
            return $this->runQuery($query);
        }

        private function exportStock(){
            $query = "SELECT * FROM rd_loc_back";
            return $this->runQuery($query);
        }

        private function exportPickSheets(){
            $query = "SELECT * FROM rd_mach_pick";
            return $this->runQuery($query);
        }

// PUBLICS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        public function noFile() {
            if (count(glob($this->getPath().'/*')) === 0 ) {
                return true;
            } else {
                return false;
            }
        }

        public function getPath() {
            return Constants::EXPORT_DETAILS[$this->getBase()]['path'];
        }

        public function getFile() {
            return '/'.ucwords($this->getBase()).'.csv';
        }

        public function getExported() {
            if (count(glob($this->getPath() .'/*')) === 1) {
                $name = array_values(array_diff(scandir($this->getPath()), array('.', '..')));
                return $name['0'];
            }
        }

// ACTIONS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        public function buttonExport(){
            if (is_dir($this->getPath()) == false) {
                mkdir($this->getPath());
            }
            // IF THE PATH IS CLEAR, EXPORT TO PATH..
            if (count(glob($this->getPath() .'/*')) === 0) {
                $result = $this->{$this->getMethod()}();
                // IF NO RESULTS...
                if (!$result) {
                    alert("Error with query");
                } else {
                    // CREATE FILE...
                    $f = fopen($this->getPath().$this->getFile(), 'w');
                    // IF CANNOT OPEN FILE...
                    if (!$f) {
                        alert("Error cannot write to file");
                    } else {
                        // WRITE HEADERS...

                        fputcsv($f, $this->getHeader());
                        // WRITE DATA TO FILE...
                        foreach ($result as $row) {
                            fputcsv($f, $row);
                        }
                        fclose($f);
                        // GET CREATED FILENAME...
                        alert($this->getExported()." has been exported");
                    }
                }
            } else {
                // IF PATH IS NOT EMPTY, RETURN FILENAME...
                alert("The file ".$this->getExported()." already exists");
            }
        }

        public function buttonDelete(){
            if (file_exists($this->getPath() .'/'. $this->getExported())) {
                if (!unlink($this->getPath() .'/'. $this->getExported())) {
                    alert($this->getExported()." cannot be deleted due to an error");
                }
                else {
                    alert("The export has been deleted.");
                }
            } else {
                alert("Error: The export does not exist.");
            }
        }

// END OF CLASS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    }
