<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('/opt/lampp/htdocs/BBMS/DonationDashboard/functions/TCPDF/tcpdf.php');


// Extend the TCPDF class to create custom headers and footers
class PDF extends TCPDF {
    // Add your custom certificate layout
    public function createCertificate($userFullName) {
        // Set certificate content
        $content = 'This is to certify that ' . $userFullName . ' has made a blood donation on ' . date('Y-m-d') . '.';

        // Add a page
        $this->AddPage();

        // Set the font
        $this->SetFont('helvetica', 'B', 20);

        // Add a title
        $this->Cell(0, 10, 'Blood Donation Certificate', 0, 1, 'C');

        // Set the font for the certificate content
        $this->SetFont('helvetica', '', 12);

        // Add the certificate content
        $this->MultiCell(0, 10, $content, 0, 'C', 0, 1, '', '', true, 0, false, true, 10, 'M');
    }
}

// Instantiate the PDF class
$pdf = new PDF();

// Set the document properties
$pdf->SetCreator('VitaCare');
$pdf->SetAuthor('VitaCare');
$pdf->SetTitle('Blood Donation Certificate');
$pdf->SetSubject('Blood Donation Certificate');

// Add a certificate for a specific user
$pdf->createCertificate('John Doe');

// Output the PDF as a file for the user to download
$pdf->Output('blood_donation_certificate.pdf', 'D');
?>
