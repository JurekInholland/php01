<?php

class PdfService {

    public static function generatePdf(Post $post) {
        $pdf = self::setupPdf();
        $pdf->AddPage();
        $pdf->writeHTMLCell(0, 0, '', '', self::generateHtmlContent($post), 0, 1, 0, true, 'L', true);

        return $pdf;
    }


    private static function generateHtmlContent($post) {
        $requestedBy = App::get("user")->getName() ? App::get("user")->getName() : "Anonymous";
        $html = <<<EOD
        <p>Requested by: {$requestedBy}</p>
        <h1>{$post->getTitle()}</h1>
        <h3>By {$post->getAuthor()->getName()}, {$post->getDate()}</h3>
        <img style="width: 440px;" src="{$post->getImage()->getLink()}" alt="">
        <p>{$post->getContent()}</p>
        <img style="width: 180px;" src="{$post->getQrCode()}" alt="">
        EOD;
        return $html;
    }

    private static function setupPdf() {
        // create new PDF document
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        
        // Disable header and footer border
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);
        return $pdf;
    }
}