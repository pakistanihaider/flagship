<?php
  define("_VALID_PHP", true);
  require_once("../admin-panel-fll/init.php");
  
  if (!$user->levelCheck("2,3,5,6,7,9"))
      redirect_to("index.php");
      
  $row = $user->getUserData();
?> 
<?php
include('header.php');

    $columns = mysql_query("SELECT `COLUMN_NAME`  
	from `information_schema`.`columns` 
	where `table_schema` = 'cocoa_fll' and `table_name` in ('fll_departures', 'fll_arrivals',  'fll_reservations')");
    
	while($row=mysql_fetch_assoc($columns)) {
				$headings[] = $row;
			}	
	$headings = array('Id', 'T/O', 'First Name', 'Last Name', 'Ref #', 'Rep', 'Rep Service', 'Hotel', 'Arr Trans Type', 'Arr Trans Supplier', 'Arr Vehicle', 'IS / CS / BS', 'CT / BW', 'A / C / I', 'Arr Date', 'Arr Flight#', 'Arr Time', 'Excursion Name', 'Excursion Date', 'Excursion Pickup Time', 'Excursion Confirmed By Whom', 'Excursion Date of Confirmation', 'Excursion Number of Guests', 'Arrival & Transportation Notes', 'Dept Trans', 'Dept Supplier',  'Dept Vehicle', 'Dept Date', 'Depart Flight#', 'Depart Time', 'Pick Up Location', 'Pick Up Time', 'Departure & Transportation Notes','Rep Notes');
	
	if(isset($_REQUEST['sect']) && $_REQUEST['sect']=='fsft'){
	    $reservations = mysql_query("SELECT * FROM fll_reservations as res
	    left join fll_arrivals as arr on res.arr_flight_no = arr.id
	    left join fll_departures as dep on res.arr_flight_no = dep.id
	    WHERE res.fast_track = 0 && res.status=1");
	} else {
	    $reservations = mysql_query("SELECT * FROM fll_reservations as res
	    left join fll_arrivals as arr on res.arr_flight_no = arr.id
	    left join fll_departures as dep on res.arr_flight_no = dep.id
	    WHERE res.fast_track = 1 && res.status=1");
	}
		

	$data_array = array();
	while($row = mysql_fetch_array($reservations)) {
                                                
                                                $arr_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM fll_flights WHERE id_flight='" . $row[16] . "'"));
                                                $arr_time = mysql_fetch_row(mysql_query("SELECT * FROM fll_flighttime WHERE id_fltime='" . $row[15] . "'"));                                                   
                                                $dpt_flight_no = mysql_fetch_row(mysql_query("SELECT * FROM fll_flights WHERE id_flight='" . $row[28] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM fll_flighttime WHERE id_fltime='" . $row[27] . "'"));
                                                $dpt_time = mysql_fetch_row(mysql_query("SELECT * FROM fll_flighttime WHERE id_fltime='" . $row[27] . "'"));
                                                $tour_oper = mysql_fetch_row(mysql_query("SELECT * FROM fll_touroperator WHERE id='" . $row[5] . "'"));
                                                $rep_type = mysql_fetch_row(mysql_query("SELECT * FROM fll_reptype WHERE id='" . $row[24] . "'"));
                                                $flight_class = mysql_fetch_row(mysql_query("SELECT * FROM fll_flightclass WHERE id='" . $row[17] . "'"));
                                                $rep_name = mysql_fetch_row(mysql_query("SELECT * FROM fll_reps WHERE id_rep='" . $row[42] . "'"));
                                                $hotel = mysql_fetch_row(mysql_query("SELECT * FROM fll_location WHERE id_location='" . $row[22] . "'"));
                                                $arr_driver = mysql_fetch_row(mysql_query("SELECT * FROM fll_transport WHERE id_transport='" . $row[19] . "'"));
                                                $dep_driver = mysql_fetch_row(mysql_query("SELECT * FROM fll_transport WHERE id_transport='" . $row[30] . "'"));

                                                $arr_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM fll_vehicles WHERE id_vehicle='" . $row[20] . "'"));
                                                $dep_vehicle = mysql_fetch_row(mysql_query("SELECT * FROM fll_vehicles WHERE id_vehicle='" . $row[31] . "'"));
                                                //assign names to results that are readable

                                                $rep = $row[42];

                                                if ($row[53]>0){
                                                        $ct= ''. $row[53] . 'CT(s)';
                                                    } else {
                                                        $ct='No CT';
                                                    
                                                    }
                                                    
                                                if ($row[54]>0){
                                                        $bw= ''. $row[54] . 'BW';
                                                    } else {
                                                        $bw='No BW';
                                                    
                                                    }
                                                
                                                if ($row[12]>0){
                                                        $fsft='Y';
                                                    } else {
                                                        $fsft='N';
                                                    
                                                    }
                                                
                                                if ($row[42]>0){
                                                        $rep = $rep_name;
                                                    } else {
                                                        $rep='Not Assigned';
                                                    
                                                    }
                                                $data = array(
	                                                'id' => $row[0],
	                                                'tour_op' => $tour_oper[1],
	                                                'first_name' => $row[2],
	                                                'last_name' => $row[3],
	                                                'ref_no' => $row[7],
	                                                'rep' => $rep[1] ,
	                                                'rep_service' => $rep_type[1],
	                                                'hotel' => $hotel[1],
	                                                'arr_trans_type' => $row[18],
	                                                'arr_trans_supp' => $arr_driver[1],
	                                                'arr_vehicle' => $arr_vehicle[2],
	                                                'is_cs_bs' => $row[48].' / '.$row[49].' / '.$row[50],
	                                                'ct_bw' => $row[53].' / '.$row[54],
	                                                'a_c_i' => $row[8].' / '.$row[9].' / '.$row[10],
	                                                'arr_date' => $row[14],
	                                                'arr_fl_no' => $row[15],
	                                                'arr_time' => $row[16],
	                                                'excursion_name' => $row[92],
	                                                'excursion_date' => $row[93],
	                                                'excursion_pick_time' => $row[94],
	                                                'excursion_conf_by_whom' => $row[95],
	                                                'excursion_dt_conf' => $row[96],
	                                                'excursion_num_of_guest' => $row[97],
	                                                'arr_trans_notes' => $row[92],
	                                                'dept_trans' => $row[29],
	                                                'dept_supp' => $dep_driver[1],
	                                                'dept_vehicle' => $dep_vehicle[2],
	                                                'dept_date' => $row[26],
	                                                'dept_fl_no' => $row[28],
	                                                'dept_time' => $row[27],
	                                                'dept_pick_loc' => $row[32],
	                                                'dept_pick_time' => $row[34],
	                                                'dept_&_trans_notes' => $row[45],
	                                                'rep_notes' => $row[11],
                                                	);
                                                array_push($data_array, $data);
                                            }	
		if(!empty($data_array))
			$reservations = $data_array;
   
	require('dompdf/fpdf.php');

	$pdf = new FPDF('P', 'mm', 'custom');
	$pdf->AddPage('P', 'custom', 0); 
	$pdf->SetFont('Arial','B',12);	
	//$pdf->SetDisplayMode('fullpage', 'two');	
	foreach($headings as $heading) {
			$pdf->Cell(70,12,$heading,1);
	}

	foreach($reservations as $row) {
		$pdf->SetFont('Arial','',12);	
		$pdf->Ln();
		foreach($row as $column)
			$pdf->Cell(70,12,$column,1);
	}
	$pdf->Output();



/*include('header.php');
     $reservations = mysql_query("SELECT * FROM fll_reservations as res
    left join fll_arrivals as arr on res.arr_flight_no = arr.id
    left join fll_departures as dep on res.arr_flight_no = dep.id
    WHERE res.fast_track = 1 && res.status=1");

     $html = '<tr>';
while($row=mysql_fetch_assoc($reservations)) {
			$html.='<td>data</td>';
		}		
		$html.='</tr>';
		

	require 'dompdf/vendor/autoload.php';
	//require'dompdf/vendor/dompdf/dompdf/autoload.inc.php';

	use Dompdf\Dompdf;
	//use Dompdf\Options;

	$dompdf = new Dompdf();
	
	$dompdf->loadHtml($html);

	// (Optional) Setup the paper size and orientation
	$dompdf->setPaper('A4', 'landscape');

	// Render the HTML as PDF
	$dompdf->render();

	// Output the generated PDF to Browser
	$dompdf->stream();*/
 ?>