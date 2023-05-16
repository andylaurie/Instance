<?php

    class Import extends Sql {

        private $uriPath;

        function __construct($uriPath) {
            $this->uriPath = $uriPath;
        }

// PRIVATES - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        private function getBase() {
            return basename($this->uriPath);
        }

        private function getMethod() {
            return str_replace('-', '', ucwords($this->getBase()));
        }

        private function checkDir() {
            if (is_dir($this->getPath()) == false) {
                mkdir($this->getPath());
            }
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
                return true;
            } catch (PDOException $e) {
                $db->rollback();
                alert("Error : " . $e->getMessage());
            }
        }

// QUERIES - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        private function clearStock(){
            $query = "DELETE FROM rd_loc_back";
            return $this->runQuery($query);
        }

        private function importStock($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_loc_back
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES (
                    partNumber,
                    rackNumber,
                    boxQty,
                    dateRec,
                    boxID)";
            return $this->runQuery($query);
        }

        private function replaceBlankNull(){
            $query = "UPDATE rd_loc_back
                SET rackNumber = NULL
                WHERE rackNumber = ''";
            return $this->runQuery($query);
        }

        private function clearMainLocations(){
            $query = "DELETE FROM rd_loc_main";
            return $this->runQuery($query);
        }

        private function importMainLocations($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_loc_main
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES (
                    partNumber,
                    rackNumber,
                    binNumber)";
            return $this->runQuery($query);
        }

        private function clearDespLocations(){
            $query = "DELETE FROM rd_loc_desp";
            return $this->runQuery($query);
        }

        private function importDespLocations($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_loc_desp
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES (
                    partNumber,
                    rackNumber,
                    binNumber)";
            return $this->runQuery($query);
        }

        private function clearFactLocations(){
            $query = "DELETE FROM rd_loc_fact";
            return $this->runQuery($query);
        }

        private function importFactLocations($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_loc_fact
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES (
                    partNumber,
                    rackNumber,
                    binNumber)";
            return $this->runQuery($query);
        }

        private function clearWeldLocations(){
            $query = "DELETE FROM rd_loc_weld";
            return $this->runQuery($query);
        }

        private function importWeldLocations($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_loc_weld
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES (
                    partNumber,
                    rackNumber,
                    binNumber)";
            return $this->runQuery($query);
        }

        private function clearMachLocations(){
            $query = "DELETE FROM rd_loc_mach";
            return $this->runQuery($query);
        }

        private function importMachLocations($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_loc_mach
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES (
                    partNumber,
                    rackNumber,
                    binNumber)";
            return $this->runQuery($query);
        }

        private function clearProntoDescriptions(){
            $query = "DELETE FROM rd_desc_pronto";
            return $this->runQuery($query);
        }

        private function importProntoDescriptions($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_desc_pronto
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES (
                    partNumber,
                    description)";
            return $this->runQuery($query);
        }

        private function clearCustomDescriptions(){
            $query = "DELETE FROM rd_desc_other";
            return $this->runQuery($query);
        }

        private function importCustomDescriptions($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_desc_other
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES (
                    partNumber,
                    description)";
            return $this->runQuery($query);
        }

        private function clearMachineDetails(){
            $query = "DELETE FROM rd_mach_details";
            return $this->runQuery($query);
        }

        private function importMachineDetails($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_mach_details
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES
                (modelNumber,
                productCode,
                descriptionTop,
                descriptionBottom,
                supplyVoltage,
                ratedInput,
                serialDesignation,
                serialWidth,
                packedWeight,
                active,
                packedDimensions,
                brand)";
            return $this->runQuery($query);
        }

        private function clearPickSheets(){
            $query = "DELETE FROM rd_mach_pick";
            return $this->runQuery($query);
        }

        private function importPickSheets($file){
            $query = "LOAD DATA LOCAL INFILE '$file' REPLACE
                INTO TABLE rd_mach_pick
                FIELDS TERMINATED BY ','
                LINES TERMINATED BY '\n'
                IGNORE 1 LINES
                (partNumber,
                qtyPer,
                modelNumber,
                giveTo,
                groupTo)";
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
            return Constants::IMPORT_DETAILS[$this->getBase()];
        }

        public function getSavedFile() {
            $name = array_values(array_diff(scandir($this->getPath()), array('.', '..')));
            return $name['0'];
        }

// ACTIONS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        public function uploadButton() {
            $this->checkDir();
            $fileName = basename($_FILES["csvFile"]["name"]);
            $targetFile = $this->getPath().'/'.$fileName;
            $uploaded = 1;
            // CHECK A FILE DOESNT ALREADY EXIST...
            if (count(glob($this->getPath().'/*')) > 0) {
                alert("A file already exists.");
                $uploaded = 0;
            }
            // CHECK FILE HAS BEEN UPLOADED...
            if ($uploaded == 0) {
                alert("Error, the file was not uploaded.");
            // UPLOAD FILE...
            } else {
                if (move_uploaded_file($_FILES["csvFile"]["tmp_name"], $targetFile)) {
                    alert("The file $fileName has been uploaded.");
                } else {
                    alert("Choose a file, there was nothing to upload.");
                }
            }
        }

        public function deleteButton() {
            if (file_exists($this->getPath() .'/'. $this->getSavedFile())) {
                if (!unlink($this->getPath() .'/'. $this->getSavedFile())) {
                    alert($this->getSavedFile()." cannot be deleted due to an error");
                }
                else {
                    alert("The upload has been deleted.");
                }
            } else {
                alert("Error: The upload does not exist.");
            }
        }

        public function addButton() {
            // DELETE DATA FROM TABLE...
            $file = $this->getPath() .'/'. $this->getSavedFile();
            if($this->{'import'.$this->getMethod()}($file) == true) {
                if (ucwords($this->getBase()) == 'Stock') {
                    $this->replaceBlankNull();
                }
                alert($this->getSavedFile()." has been imported");
                unlink($this->getPath().'/'.$this->getSavedFile());
            } else {
                alert("There was an error importing the file ".$this->getSavedFile());
            }
        }

        public function replaceButton() {
            // DELETE DATA FROM TABLE...
            $this->{'clear'.$this->getMethod()}();
            $file = $this->getPath()."/".$this->getSavedFile();
            if($this->{'import'.$this->getMethod()}($file) == true) {
                if (ucwords($this->getBase()) == 'Stock') {
                    $this->replaceBlankNull();
                }
                alert($this->getSavedFile()." has been imported");
                unlink($this->getPath() .'/'. $this->getSavedFile());
            } else {
                alert("There was an error importing the file ".$this->getSavedFile());
            }
        }

// END OF CLASS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
    }
