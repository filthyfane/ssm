<?php 
require_once(KIK_PLUGIN_ABSPATH . '/plugins/tcpdf/tcpdf.php');

//////////////////////////////TCPDF//////////////////////////////////////////////
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
    	$text = "Denumirea: " . get_option("kikCompanyName") . "\r\n"
    		. "Sediu: " . get_option("kikRegisteredOffice") . "\r\n"
			. "Cod Poștal: " . get_option("kikPostalCode") . "\r\n"
			. "Localitate: " . get_option("kikCity") . "\r\n"
			. "Cod unic de înregistrare: " . get_option("kikCompanyCui") . "\r\n"
			. "Număr RECOM: " . get_option("kikCompanyRecom") . "\r\n";

		// add header text
        $this->Multicell(0, $this->getStringHeight(0, $text) + 2, $text, 0, 'L', false, 1);

		
		if ($this->header_xobjid === false) {
			// start a new XObject Template
			$this->header_xobjid = $this->startTemplate($this->w, $this->tMargin);
			$headerfont = $this->getHeaderFont();
			$headerdata = $this->getHeaderData();
			$this->x = $this->original_lMargin;
			
			// set starting margin for text data cell
			$header_x = $this->original_lMargin + ($headerdata['logo_width'] * 1.1);
			
			// print an ending header line
			$this->SetLineStyle(array(
				'width' => 0.85 / $this->k,
				'cap' => 'butt', 
				'join' => 'miter', 
				'dash' => 0, 
				'color' => $headerdata['line_color']
			));
			
			$this->SetX($this->original_lMargin);
			$this->Cell(($this->w - $this->original_lMargin - $this->original_rMargin), 0, '', 'T', 0, 'C');
			$this->endTemplate();
		}

		// set custom header height
		$this->SetMargins(PDF_MARGIN_LEFT, $this->y, PDF_MARGIN_RIGHT);

		// print header template
		$x = 0;
		$dx = 0;

		if ($this->rtl) {
			$x = $this->w + $dx;
		} else {
			$x = 0 + $dx;
		}
		
		$this->printTemplate($this->header_xobjid, $x, $this->y, 0, 0, '', '', false);
		if ($this->header_xobj_autoreset) {
			// reset header xobject template at each page
			$this->header_xobjid = false;
		}
    }
} 

// AJAX FUNCTION CALLED ON SAVE REPORT
add_action('wp_ajax_KIK_ACTION_Save_New_Pdf', 'KIK_ACTION_Save_New_Pdf');
add_action('wp_ajax_nopriv_KIK_ACTION_Save_New_Pdf', 'KIK_ACTION_Save_New_Pdf');

function KIK_ACTION_Save_New_Pdf(){	
	$currUser 	 = wp_get_current_user();
	$textToPrint = str_replace('\\', '', $_POST['pdfText']);
	$aUploadDir  = wp_upload_dir();
	$path        = $aUploadDir['basedir'].'/reports/';
	
	//Create the directory reports if it not exists
	if (!is_dir($path) ){
		mkdir($path);
	} 
	
	$postID 	= isset($_POST['companyID']) ? $_POST['companyID'] : $_POST['currPostID'];
	$date 		= new DateTime();
	$timestamp 	= $date->format('U');
	
	
	$raport = array(
		'userId' 	 => $currUser->ID,
		'reportType' => $_POST['reportType'],
		'fileName' 	 => $_POST['fileName'].'_'.$timestamp,
		'createDate' => $timestamp
	);
	
	if(isset($_POST['startDate']) && isset($_POST['endDate'])){
		$raport['startDate'] = $_POST['startDate'];
		$raport['endDate']   = $_POST['endDate'];
	}

	
	
	// create new PDF document
	$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor($currUser->user_firstname . " " . $currUser->user_lastname);
	$pdf->SetTitle($raport["fileName"]);
	$pdf->SetSubject("Raport SSM");

	// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $raport["fileName"], PDF_HEADER_STRING);

	// set header and footer fonts
	$pdf->SetFont('freesans', '', 8);
	//$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setHeaderFont(Array('freesans', '', 8));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set dynamic margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	    require_once(dirname(__FILE__).'/lang/eng.php');
	    $pdf->setLanguageArray($l);
	}

	// set font
	$pdf->SetFont('freesans', 'B', 20);

	// add a page
	if($_POST['reportType'] == 'Raport-semestrial') {
		$pdf->AddPage('L');
	} else {
		$pdf->AddPage();
	}

	$pdf->SetFont('freesans', '', 8);
	$pdf->writeHTML($textToPrint, true, false, false, false, '');


	//Close and output PDF document
	$pdf->Output($path.$raport['fileName'].'.pdf', 'F');

	//SAVE REPORT TO THE CORRESPONDING COMPANY
	add_post_meta($postID, 'rapoarte', serialize($raport));
	
	echo json_encode('success');
		wp_die();
}

?>