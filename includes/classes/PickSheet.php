<?php

    class PickSheet extends FPDF {

// PDF FUNCTIONS - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -

        function header() {
            global $modelNumber;
            global $batchQty;
            $this->SetFillColor(120,120,120);
            $this->SetFont('arial', 'B', 10);
            $this->Cell(0,1,'',0,0,'C',true);
            $this->Ln();
            $this->SetFillColor(230,230,230);
            $this->Cell(0,10,$modelNumber. ' Pick Sheet - Qty '.$batchQty,0,0,'C',true);
            $this->Ln();
        }
        function footer() {
            $this->SetY(-15);
            $this->SetFillColor(230,230,230);
            $this->SetFont('arial', '', 6);
            $this->Cell(0,5,'Page '.$this->PageNo().'/{nb}',0,0,'C',true);
        }
        function headerTable() {
            $this->SetTextColor(255,255,255);
            $this->SetFillColor(120,120,120);
            $this->SetFont('arial', 'B', 7);
            $this->Cell(20,5,'Part Number',0,0,'L',true);
            $this->Cell(60,5,'Description',0,0,'L',true);
            $this->Cell(10,5,'Rack',0,0,'R',true);
            $this->Cell(10,5,'Bin',0,0,'L',true);
            $this->Cell(40,5,'Group',0,0,'C',true);
            $this->Cell(10,5,'BOM',0,0,'C',true);
            $this->Cell(15,5,'Give To',0,0,'C',true);
            $this->Cell(10,5,'Pick Qty',0,0,'C',true);
            $this->Cell(15,5,'Check',0,0,'C',true);
            $this->Ln();
        }
        function dataTable($result, $batchQty) {
            $this->SetTextColor(0,0,0);
            $this->SetFont('arial', '', 7);
            $i = 0;
            foreach ($result as $row) {
                $total = $row['qtyPer'] * $batchQty;
                if ($i % 2 == 0) {
                    $this->SetFillColor(255,255,255);
                } else {
                    $this->SetFillColor(230,230,230);
                }
                $this->Cell(20,5,$row['partNumber'],0,0,'L',true);
                $this->Cell(60,5,$row['description'],0,0,'L',true);
                $this->Cell(10,5,$row['rackNumber'],0,0,'R',true);
                $this->Cell(10,5,$row['binNumber'],0,0,'L',true);
                $this->Cell(40,5,$row['groupTo'],0,0,'C',true);
                $this->Cell(10,5,$row['qtyPer'],0,0,'C',true);
                $this->Cell(15,5,$row['giveTo'],0,0,'C',true);
                $this->Cell(10,5,$total,0,0,'C',true);
                $this->Cell(15,5,'',0,0,'C',true);
                $this->Ln();
                $i++;
            }
        }
        function addLine() {
            $this->SetFillColor(120,120,120);
            $this->SetFont('arial', 'B', 10);
            $this->Cell(0,1,'',0,0,'C',true);
        }

    }
