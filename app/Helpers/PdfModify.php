<?php
namespace app\helpers;
use setasign\Fpdi\Tcpdf\Fpdi;

class PdfModify extends Fpdi {
    //Page header
    public function Header() {

    }

    // Page footer
    public function Footer() {
        $this->SetRightMargin(-5);
        // Set font
        $this->SetFont('', '', 8);
        // Page number
        // Position at 10 mm from bottom
        $this->setY(-10);
        $this->Cell('', '', $this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'R', 0, '', 0, false, 'T', 'M');
    }
}
