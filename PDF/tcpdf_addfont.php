<?php
require_once('tcpdf.php');

function addFont($fontPath) {
    // Set up TCPDF and create font files
    $pdf = new TCPDF();
    $fontName = $pdf->addTTFfont($fontPath, 'TrueType', '', 32);
    return $fontName;
}

// Path to your TTF font file
$fontPath = 'path/to/your/THSarabunNew.ttf'; // Update with your font path

// Call the function to add the font
$fontName = addFont($fontPath);
echo "Font added: $fontName";
?>
