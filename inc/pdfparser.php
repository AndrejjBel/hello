<?php
require get_template_directory() . '/includes/pdfparser-master/alt_autoload.php-dist';

function pdf_text($url) {
    $config = new \Smalot\PdfParser\Config();

    // An empty string can prevent words from breaking up
    $config->setHorizontalOffset('');
    // A tab can help preserve the structure of your document
    // $config->setHorizontalOffset("\r"); // [\0\t\n\f\r ]

    $parser = new \Smalot\PdfParser\Parser([], $config);

    // $parser = new \Smalot\PdfParser\Parser();
    $pdf = $parser->parseFile($url);

    $text = $pdf->getText();

    // $data = $pdf->getPages()[0]->getDataTm();

    return $text;
}
