<?php
namespace PdfModify;
use \setasign\Fpdi\Tcpdf\Fpdi;

class PdfModify extends Fpdi {
    protected $reportId;

    public function setReportId($id){
        $this->reportId = $id;
    }
    //Page header
    function Header() {
        $this->setY(5);
        $this->Image(public_path().'/teleira-logo.jpeg', 10, $this->getY() + 2, 50);
    }

    // Page footer
    function Footer() {
        $this->SetRightMargin(-5);
        // Set font
        $this->SetFont('', '', 8);
        // Page number
        // Position at 10 mm from bottom
        $this->setY(-10);
        $this->Cell('', '', $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
