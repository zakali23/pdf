<?php
use setasign\Fpdi;

require_once '../vendor/autoload.php';
$nomfile='simple.pdf';// fichier pdf


$orientation = 'L';           // orientation du pdf L (landscapre) paysage sinon P (portrait)


$pdf= new Fpdi\Fpdi();             // nouvelle instance FPDI
$pdf->setSourceFile($nomfile);      // récupération du PDF à importer
$p = $pdf->setSourceFile($nomfile); // récupération du nombre de page
$i=1;                         // initialisation pour la page 1
$texte = "à payer ALDEX"; // texte copyright

while($i <= $p) {
    $pdf->AddPage($orientation);       // add a page
    $tplIdx = $pdf->importPage($i); // import de la page en cours

    // use the imported page and place it at point 10,10 with a width of 100 mm
    if ($orientation == 'L'){
        $pdf->useTemplate($tplIdx, ['adjustPageSize' => true]);
    } else {$pdf->useTemplate($tplIdx,['adjustPageSize' => true]) ;}

    // now write some text above the imported page

    $pdf->SetTextColor(255, 0, 0);   // couleur du texte
    $pdf->SetFont("helvetica", "B", 34);
    $pdf->SetXY(30, 30);

    if ($orientation == 'L'){
        $pdf->Text(50,120,$texte);
       // $pdf->Text(160,207,$texte);
    } else {$pdf->Text(40,294,$texte) ;}

    $i++ ;


}

//show the PDF in page
//$pdf->Output('aldex'.$nomfile, 'D');
$pdf->Output();
