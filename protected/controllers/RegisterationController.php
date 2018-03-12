<?php

class RegisterationController extends Controller
{

	public function init()
    {
        $this->checkSession();
        $this->checkAdmin();
    }
	public function actionAdd()
	{
		$data['districts'] = Districts::model()->findAll();
		$data['tehsils'] = Tehsil::model()->findAll();
		$data['villages'] = Villages::model()->findAll();
		$data['vehicletypes'] = VehicleTypes::model()->findAll();
		$data['labor'] = Labours::model()->findAll(array(
			'order' => "id DESC",
		    'limit' =>1,
		));
		$this->render('add',$data);
	}
	
	public function actionIndex()
	{
		$data['labors'] = Labours::model()->findAll(array(
			'order' => "id DESC",
		    'limit' =>100,
		));
		$data['deactivatestatus'] = DeactivateReasons::model()->findAll();
		$data['blackstatus'] = BlacklistReasons::model()->findAll();
		$this->render('index',$data);
	}

	public function actionChecklicense($date){
		if( strtotime(date('Y-m-d')) >= strtotime($date)){
			echo json_encode(1);
		} else{
			echo json_encode(0);
		}
	}
	public function actionReport(){
		$data['villages'] = Villages::model()->findAll();
		$data['tehsils'] = Tehsil::model()->findAll();
		$data['districts'] = Districts::model()->findAll();

		if(isset($_REQUEST['submit'])){
			$criteria = new CDbCriteria;
			//if value is TRUE
			if(@$_REQUEST['nicop']){
				$criteria->addCondition("nicop = {$_REQUEST['nicop']}");	
			}
			if(@$_REQUEST['village_id']){
				$criteria->addCondition("village_id = {$_REQUEST['village_id']}");	
			}
			if(@$_REQUEST['tehsil_id']){
				$criteria->addCondition("tehsil_id = {$_REQUEST['tehsil_id']}");	
			}
			if(@$_REQUEST['category_id']){
				$criteria->addCondition("category_id = {$_REQUEST['category_id']}");
			}
			if(@$_REQUEST['block_2']){
				//$criteria->addCondition("block_2 = '%{$_REQUEST['block_2']}%'");	
				$criteria->addCondition("block_2 = {$_REQUEST['block_2']}");	
			}
			if(@$_REQUEST['gender']){
				$criteria->addCondition("gender = '{$_REQUEST['gender']}'");	
			}
			if(@$_REQUEST['martial_status']){
				$criteria->addCondition("martial_status = {$_REQUEST['martial_status']}");
			}
			if(@$_REQUEST['createdOnf']){
				$criteria->addCondition("createdOn >= '{$_REQUEST['createdOnf']}'");	
			}
			if(@$_REQUEST['createdOne']){
				$criteria->addCondition("createdOn <= '{$_REQUEST['createdOne']}'");	
			}
			$data['applicants'] = Labours::model()->findAll($criteria);
		}

		if(isset($_REQUEST['pdf'])){
			$criteria = new CDbCriteria;
			//if value is TRUE
			if(@$_REQUEST['nicop']){
				$criteria->addCondition("nicop = {$_REQUEST['nicop']}");	
			}
			if(@$_REQUEST['village_id']){
				$criteria->addCondition("village_id = {$_REQUEST['village_id']}");	
			}
			if(@$_REQUEST['tehsil_id']){
				$criteria->addCondition("tehsil_id = {$_REQUEST['tehsil_id']}");	
			}
			if(@$_REQUEST['category_id']){
				$criteria->addCondition("category_id = {$_REQUEST['category_id']}");
			}
			if(@$_REQUEST['block_2']){
				//$criteria->addCondition("block_2 = '%{$_REQUEST['block_2']}%'");	
				$criteria->addCondition("block_2 = {$_REQUEST['block_2']}");	
			}
			if(@$_REQUEST['gender']){
				$criteria->addCondition("gender = '{$_REQUEST['gender']}'");	
			}
			if(@$_REQUEST['martial_status']){
				$criteria->addCondition("martial_status = {$_REQUEST['martial_status']}");
			}
			if(@$_REQUEST['createdOnf']){
				$criteria->addCondition("createdOn >= '{$_REQUEST['createdOnf']}'");	
			}
			if(@$_REQUEST['createdOne']){
				$criteria->addCondition("createdOn <= '{$_REQUEST['createdOne']}'");	
			}
			$model = Labours::model()->findAll($criteria);

			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                            'L', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("ENGRO");
            $pdf->SetTitle("Report");
            $pdf->SetSubject("Report");
            $pdf->SetKeywords("Report,");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            $pdf->SetFont("times", "N", 9);


            $html='<style>.table-pdf td{text-align:center;font-weight:normal;vertical-align:middle;font-style:normal;padding:10px}</style>';
            //generate report data
            
            $html .= '<table class="table-pdf" border="1">';
            //generate report data
            
            //$html .= '<table border="1">';
            $html .= '<tr><td colspan="7" style="text-align:center">All Applicants</td></tr>';
            
            $html .= '<tr><td colspan="7"></td></tr>';
            $html .= '<tr><td>ID</td><td>Name</td><td>Father Name</td><td>CNIC</td><td>Number</td><td>Work Status</td><td>Registered On</td></tr>';

            foreach($model as $m){
              $html .= '<tr><td>'.$m->id.'</td><td>'.$m->full_name.'</td><td>'.$m->father_name.'</td><td>'.$m->cnic.'</td><td>'.$m->mobile_number.'</td><td>'.(($this->Laborstatus($m->id)==true)?'On duty '.$this->Laborwork($m->id).'':'Available').'</td><td>'.(date('d M,Y',strtotime($m->createdOn))).'</td></tr>';
            }

            $html .= '</table>';
            // output the HTML content
            
            //echo $html;exit;
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
            die;
		}
		if(isset($_REQUEST['excel'])){

			$criteria = new CDbCriteria;
			//if value is TRUE
			if(@$_REQUEST['nicop']){
				$criteria->addCondition("nicop = {$_REQUEST['nicop']}");	
			}
			if(@$_REQUEST['village_id']){
				$criteria->addCondition("village_id = {$_REQUEST['village_id']}");	
			}
			if(@$_REQUEST['tehsil_id']){
				$criteria->addCondition("tehsil_id = {$_REQUEST['tehsil_id']}");	
			}
			if(@$_REQUEST['category_id']){
				$criteria->addCondition("category_id = {$_REQUEST['category_id']}");
			}
			if(@$_REQUEST['block_2']){
				//$criteria->addCondition("block_2 = '%{$_REQUEST['block_2']}%'");	
				$criteria->addCondition("block_2 = {$_REQUEST['block_2']}");	
			}
			if(@$_REQUEST['gender']){
				$criteria->addCondition("gender = '{$_REQUEST['gender']}'");	
			}
			if(@$_REQUEST['martial_status']){
				$criteria->addCondition("martial_status = {$_REQUEST['martial_status']}");
			}
			if(@$_REQUEST['createdOnf']){
				$criteria->addCondition("createdOn >= '{$_REQUEST['createdOnf']}'");	
			}
			if(@$_REQUEST['createdOne']){
				$criteria->addCondition("createdOn <= '{$_REQUEST['createdOne']}'");	
			}
			$model = Labours::model()->findAll($criteria);

			Yii::import('ext.phpexcel.XPHPExcel');      
	          $objPHPExcel = XPHPExcel::createPHPExcel();
	          // Set properties
	          $objPHPExcel->getProperties()->setCreator("ENGRO KT");
	          $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
	          $objPHPExcel->getProperties()->setTitle("All Applicants");
	          $objPHPExcel->getProperties()->setSubject("All Applicants");
	          $objPHPExcel->getProperties()->setDescription("All Applicants");
	          
	          // Active sheet
	          $sheet1=$objPHPExcel->setActiveSheetIndex(0);
	          $count = 6;
	          $headAlpha=0;
	          $sheet1->setCellValue('C2', 'All Applicants');
	          $sheet1->mergeCells("C2:O2");
	          $sheet1->getStyle("C2:O2")->applyFromArray(array("font" => array( "bold" => true)));
	          

	          
	          //Columns
	          $sheet1->setCellValue('A3', 'ID');
	          $sheet1->setCellValue('B3', 'Full Name');
	          $sheet1->setCellValue('C3', 'Father Name');
	          $sheet1->setCellValue('D3', 'CNIC');
	          $sheet1->setCellValue('E3', 'Religion');
	          $sheet1->setCellValue('F3', 'DOB');
	          $sheet1->setCellValue('G3', 'Mobile Number');
	          $sheet1->setCellValue('H3', 'Martial Status');
	          $sheet1->setCellValue('I3', 'Kids');
	          $sheet1->setCellValue('J3', 'Block 2');
	          $sheet1->setCellValue('K3', 'Village');
	          $sheet1->setCellValue('L3', 'Tehsil');
	          $sheet1->setCellValue('M3', 'District');
	          $sheet1->setCellValue('N3', 'Category');
	          $sheet1->setCellValue('O3', 'Applied For');
	          $sheet1->setCellValue('P3', 'Registered');
	          $sheet1->setCellValue('Q3', 'Remarks');
	          $sheet1->setCellValue('R3', 'Work Status');
	          $sheet1->setCellValue('S3', 'Drive');
	          $sheet1->setCellValue('T3', 'Driving License Number');
	          $sheet1->setCellValue('U3', 'Driving License Category');
	          $sheet1->setCellValue('V3', 'Vehicle Type');
	          $sheet1->setCellValue('W3', 'Issue Date');
	          $sheet1->setCellValue('X3', 'Valid Upto');
	          $sheet1->setCellValue('Y3', 'Applicant HSE');
	          $sheet1->setCellValue('Z3', 'Applicant Medical Type');
	          $sheet1->setCellValue('AA3', 'Applicant Medical Result');
	          $sheet1->setCellValue('AB3', 'Applicant Police Verified');

	          $sheet1->setCellValue('AC3', 'Source of Income');
	          $sheet1->setCellValue('AD3', 'Company Name');
	          $sheet1->setCellValue('AE3', 'Date From ');          
	          $sheet1->setCellValue('AF3', 'Date To');          
	          $sheet1->setCellValue('AG3', 'Position');          
	          $sheet1->setCellValue('AH3', 'Salary');


	          $sheet1->setCellValue('AI3', 'Degree');
	          $sheet1->setCellValue('AJ3', 'Board');
	          $sheet1->setCellValue('AK3', 'Passing Year');
	          $sheet1->setCellValue('AL3', 'Institute Name');
	          $sheet1->setCellValue('AM3', 'Certificate');

	          
	          
	          $sheet1->getStyle("A3:AM3")->applyFromArray(array("font" => array( "bold" => true)));
	          
	          $sheet1->getColumnDimension("A")->setAutoSize(true);
	          $sheet1->getColumnDimension("B")->setAutoSize(true);
	          $sheet1->getColumnDimension("C")->setAutoSize(true);
	          $sheet1->getColumnDimension("D")->setAutoSize(true);
	          $sheet1->getColumnDimension("E")->setAutoSize(true);
	          $sheet1->getColumnDimension("F")->setAutoSize(true);
	          $sheet1->getColumnDimension("G")->setAutoSize(true);
	          $sheet1->getColumnDimension("H")->setAutoSize(true);
	          $sheet1->getColumnDimension("I")->setAutoSize(true);
	          $sheet1->getColumnDimension("J")->setAutoSize(true);
	          $sheet1->getColumnDimension("K")->setAutoSize(true);
	          $sheet1->getColumnDimension("L")->setAutoSize(true);
	          $sheet1->getColumnDimension("M")->setAutoSize(true);
	          $sheet1->getColumnDimension("N")->setAutoSize(true);
	          $sheet1->getColumnDimension("O")->setAutoSize(true);
	          $sheet1->getColumnDimension("P")->setAutoSize(true);
	          $sheet1->getColumnDimension("Q")->setAutoSize(true);
	          $sheet1->getColumnDimension("R")->setAutoSize(true);
	          $sheet1->getColumnDimension("S")->setAutoSize(true);
	          $sheet1->getColumnDimension("T")->setAutoSize(true);
	          $sheet1->getColumnDimension("U")->setAutoSize(true);
	          $sheet1->getColumnDimension("V")->setAutoSize(true);
	          $sheet1->getColumnDimension("W")->setAutoSize(true);
	          $sheet1->getColumnDimension("X")->setAutoSize(true);
	          $sheet1->getColumnDimension("Y")->setAutoSize(true);
	          $sheet1->getColumnDimension("Z")->setAutoSize(true);
	          $sheet1->getColumnDimension("AA")->setAutoSize(true);
	          $sheet1->getColumnDimension("AB")->setAutoSize(true);
	          $sheet1->getColumnDimension("AC")->setAutoSize(true);
	          $sheet1->getColumnDimension("AD")->setAutoSize(true);
	          $sheet1->getColumnDimension("AE")->setAutoSize(true);
	          $sheet1->getColumnDimension("AF")->setAutoSize(true);
	          $sheet1->getColumnDimension("AG")->setAutoSize(true);
	          $sheet1->getColumnDimension("AH")->setAutoSize(true);
	          $sheet1->getColumnDimension("AI")->setAutoSize(true);
	          $sheet1->getColumnDimension("AJ")->setAutoSize(true);
	          $sheet1->getColumnDimension("AK")->setAutoSize(true);
	          $sheet1->getColumnDimension("AL")->setAutoSize(true);
	          $sheet1->getColumnDimension("AM")->setAutoSize(true);


	          $count = 5;
	          foreach($model as $m){
	            
	            $sheet1->setCellValue("A$count", $m->id);
	            $sheet1->setCellValue("B$count", $m->full_name);
	            $sheet1->setCellValue("C$count", $m->father_name);
	            $sheet1->setCellValue("D$count", $m->cnic);
	            $sheet1->setCellValue("E$count", $m->religion);
	            $sheet1->setCellValue("F$count", $m->dob);//date('d M,Y',strtotime($m->dob)));
	            $sheet1->setCellValue("G$count", $m->mobile_number);
	            $sheet1->setCellValue("H$count", ($m->martial_status==1)?'Married':'Single');
	            $sheet1->setCellValue("I$count", $m->kids);
	            $sheet1->setCellValue("J$count", ($m->block_2==1)?'Yes':'No');
	            $sheet1->setCellValue("K$count", @$m->village->village);
	            $sheet1->setCellValue("L$count", @$m->tehsil->name);
	            $sheet1->setCellValue("M$count", @$m->district->name);
	            $sheet1->setCellValue("N$count", ($m->category_id==1)?'Skilled':'Unskilled');
	            $sheet1->setCellValue("O$count", $m->designation);
	            $sheet1->setCellValue("P$count", date('d M,Y',strtotime(@$m->createdOn)));
	            $sheet1->setCellValue("Q$count", $m->remarks);
	            $sheet1->setCellValue("R$count", $this->Laborwork($m->id));
	            $sheet1->setCellValue("S$count", ($m->drive==1)?'Yes':'No');
	            $sheet1->setCellValue("T$count", (@$m->drivingLicense)?$m->drivingLicense[0]->driving_license_number:'-');
	            $sheet1->setCellValue("U$count", (@$m->drivingLicense)?$m->drivingLicense[0]->license_category:'-');
	            $sheet1->setCellValue("V$count", (@$m->drivingLicense)?$m->drivingLicense[0]->vehicle_type:'-');
	            $sheet1->setCellValue("W$count", (@$m->drivingLicense)?$m->drivingLicense[0]->issue_date:'-');
	            $sheet1->setCellValue("X$count", (@$m->drivingLicense)?$m->drivingLicense[0]->valid_upto:'-');
	            $sheet1->setCellValue("Y$count", (@$m->hse)?(($m->hse[0]->hse==1)?'Yes':'No'):'-');
	            $sheet1->setCellValue("Z$count", (@$m->medical)?$m->medical[0]->type:'-');
	            $sheet1->setCellValue("AA$count", (@$m->medical)?$m->medical[0]->result:'-');
	            $sheet1->setCellValue("AB$count", (@$m->police)?(($m->police[0]->police_verified==1)?'Yes':'No'):'-');



	            $company = array();
	            $fDate = array();
	            $tDate = array();
	            $position = array();
	            $salary = array();
	            foreach($m->employments as $index=>$ld):
	                $company[] = $ld->company_name;
	                $fDate[] = $ld->from_date;
	                $tDate[] = $ld->to_date;
	                $position[] = $ld->position;
	                $salary[] = $ld->salary;
	            endforeach;

	            $sheet1->setCellValue("AC$count", (@$m->employments)?$m->employments[0]->source_of_income:'-');
	            $sheet1->setCellValue("AD$count", (@$company)?implode(', ', @$company):'-');
	            $sheet1->setCellValue("AE$count", (@$fDate)?implode(', ', @$fDate):'-');
	            $sheet1->setCellValue("AF$count", (@$tDate)?implode(', ', @$tDate):'-');
	            $sheet1->setCellValue("AG$count", (@$position)?implode(', ', @$position):'-');
	            $sheet1->setCellValue("AH$count", (@$salary)?implode(', ', @$salary):'-');


	            $degree = array();
	            $board = array();
	            $year = array();
	            $ins = array();
	            $certi = array();
	            foreach($m->educations as $index=>$ld):
	                switch ($ld->education_type_id) {
	                  case '1':
	                    $educationTypeId = 'Primary';
	                    break;
	                  case '2':
	                    $educationTypeId = 'Middle';
	                    break;
	                  case '3':
	                    $educationTypeId = 'Matric';
	                    break;
	                  case '4':
	                    $educationTypeId = 'Intermediate';
	                    break;
	                  case '5':
	                    $educationTypeId = 'Graduation';
	                    break;
	                  case '6':
	                    $educationTypeId = 'Masters';
	                    break;
	                  case '7':
	                    $educationTypeId = 'Diploma';
	                    break;
	                  default:
	                    # code...
	                    break;
	                }
	                $degree[] = @$educationTypeId;
	                $board[] = $ld->board;
	                $year[] = $ld->passing_year;
	                $ins[] = $ld->organization_name;
	                $certi[] = ($ld->degree==1)?'Yes':'No';
	            endforeach;

	            $sheet1->setCellValue("AI$count", (@$degree)?implode(', ', @$degree):'-');
	            $sheet1->setCellValue("AJ$count", (@$board)?implode(', ', @$board):'-');
	            $sheet1->setCellValue("AK$count", (@$year)?implode(', ', @$year):'-');
	            $sheet1->setCellValue("AL$count", (@$ins)?implode(', ', @$ins):'-');
	            $sheet1->setCellValue("AM$count", (@$certi)?implode(', ', @$certi):'-');

	            $count++;
	          }
	          $sheet1->setTitle('All Applicants');
	          /*$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	          //$file = getcwd().'\uploads\areport.xlsx';
	          $file = '/home2/thepaks1/public_html/khushaalthar\uploads/\areport.xlsx';
	          //echo $file;exit;
	          $objWriter->save($file);*/
	          $filename = 'allapplicants.xlsx';
	          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	          header("Content-Disposition: attachment;filename={$filename}");
	          header('Cache-Control: max-age=0');
	          $objWriter->save('php://output');
			die;
		}
		$this->render('report',$data);	
	}

	public function actionSearchapplicant(){
		$model = Labours::model()->findAll(array(
			'condition' => 'village_id=:village AND tehsil_id=:tehsil AND category_id=:category AND block_2=:block AND gender=:gender AND martial_status=:martial',
			'params'=>array(':village'=>$_POST['village_id'],':tehsil'=>$_POST['tehsil_id'],':category'=>$_POST['category_id'],':block'=>$_POST['block_2'],':gender'=>$_POST['gender'],':martial'=>$_POST['martial_status']),
			'order' => "id ASC",
		));
		if($model){
			foreach($model as $m):
				echo $m->id.'--';
			endforeach;	
		} else{
			echo json_encode(array('error'=>'no applicants found.'));
		}
		
	}


	public function actionGetthumb(){
		$model = Bioverification::model()->find(array(
			'order' => "id DESC",
			'limit'=>1
		));
		//$uploadFolder=getcwd().'/applicant_thumb/uploads/';
		$uploadFolder=getcwd().'/uploads/applicantthumb/';
		$fileName  = uniqid().'.png';
		$file = $uploadFolder.$fileName;
        // Open the file to get existing content
        // Append a new person to the file
        $current = $model["fingerImageFile"];
        // Write the contents back to the file
        if(file_put_contents($file, $current)){
        	$model->delete();
        	echo json_encode(array('success'=>1,'thumbs'=>$fileName,'link'=>'<img style="width: 200px;" src="'.Yii::app()->baseUrl.'/uploads/applicantthumb/'.$fileName.'"/>'));
        } else{
        	echo json_encode(array('error'=>'No data found. Try again.'));
        }
	}



	public function actionFetchall(){
		
		$result_array = [];
        parse_str($_SERVER['REQUEST_URI'], $result_array);
        
		switch ($result_array['order'][0]['column']) {
			case '0':
				$result_array['order'][0]['column'] = 'id';
				break;
			case '1':
				$result_array['order'][0]['column'] = 'id';
				break;
			case '2':
				$result_array['order'][0]['column'] = 'full_name';
				break;
			case '3':
				$result_array['order'][0]['column'] = 'cnic';
				break;
			/*case '2':
				$result_array['order'][0]['column'] = 'emailaddress';
				break;
			case '3':
				$result_array['order'][0]['column'] = 'mobile_number';
				break;
			case '4':
				$result_array['order'][0]['column'] = 'updated_on';
				break;
			case '5':
				$result_array['order'][0]['column'] = 'form_step';
				break;*/
			default:
				$result_array['order'][0]['column'] = 'id';
				break;
		}
		$sort = $result_array['order'][0]['column'];
		$order = $result_array['order'][0]['dir'];
		if(empty($result_array['search']['value'])){
			$model = Labours::model()->findAll(array(
			    'order' => "$sort $order",
			    'limit' =>$result_array['length'],
			    'offset' => $result_array['start'],
			));
			$student = Labours::model()->findAll();
		} else{
			$model = Labours::model()->findAll(array(
			    'condition' => '(id LIKE  :id) OR (full_name LIKE  :name) OR (cnic LIKE :cnic) OR (mobile_number LIKE :number) OR (designation LIKE :designation)',
			    'params' => array(':id'=>$result_array['search']['value'],':name'=>$result_array['search']['value'].'%',':cnic'=>'%'.$result_array['search']['value'].'%',':number'=>'%'.$result_array['search']['value'].'%',':designation'=>$result_array['search']['value'].'%'),
			    'order' => "$sort $order",
			    'limit' =>$result_array['length'],
			    'offset' => $result_array['start'],
			));
			$student = Labours::model()->findAll(array(
			    'condition' => '(id LIKE  :id) OR (full_name LIKE  :name) OR (cnic LIKE :cnic) OR (mobile_number LIKE :number) OR (designation LIKE :designation)',
			    'params' => array(':id'=>$result_array['search']['value'],':name'=>$result_array['search']['value'].'%',':cnic'=>'%'.$result_array['search']['value'].'%',':number'=>'%'.$result_array['search']['value'].'%',':designation'=>$result_array['search']['value'].'%'),
			));
		}
		
		$result = array();
		$i=0;
		$result['draw'] = $result_array['draw'];
		$result['recordsTotal'] = count($student);
		$result['recordsFiltered'] = count($student);
		$result['data'] = '';
		if($model){
			foreach($model as $m):
				$result['data'][$i][]= '<a href="'.Yii::app()->baseUrl.'/labor/view/id/'.$m->id.'">'.$m->id.'</a>';//'<a target="_blank" href="'.Yii::app()->baseUrl.'/site/ApplicantView/id/'.$m->qr_code.'">'.$m->qr_code.'</a>';
				$result['data'][$i][]= '<div style="position:relative; display:inline-block;"><a href="#" class="btn btn-xs btn-success dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><span class="caret"></span></a><ul style="    position: absolute;top: 20px;left: 0px;" class="dropdown-menu" role="menu"><li><a href="'.Yii::app()->baseUrl.'/labor/edit/id/'.$m->id.'">Edit</a></li><li><a class="deactivate" data-toggle="modal" data-target="'.(($m->status == 1) ? "#rejectModal" : "#activeModal").'" rel="'.$m->id.'">'.(($m->status == 1) ? "Deactivate" : "Activate").'</a></li><li><a class="deactivate" data-toggle="modal" data-target="#blacklistModal" rel="'.$m->id.'">Blacklist</a></li></ul></div>';//$m->id;//$m->fullname;
				$result['data'][$i][]= '<a href="'.Yii::app()->baseUrl.'/labor/view/id/'.$m->id.'">'.$m->full_name.'</a>';//'<a target="_blank" href="'.Yii::app()->baseUrl.'/site/ApplicantView/id/'.$m->qr_code.'">'.$m->
				$result['data'][$i][]= @$m->cnic;//str_replace('+92', '0',$m->mobile_number);
				if (@$m->category_id == 1) {
                    $cat = 'Skilled';
                } if (@$m->category_id == 2) {
                    $cat = 'Unskilled';
                }
				$result['data'][$i][]= @$cat;//date('M d, h:i a',strtotime($m->created_on));
				$mob = explode(',',$m->mobile_number);
				$result['data'][$i][]= @$mob[0];//($m->terms==1)?'Submitted':'Not submitted';
				$result['data'][$i][]= ($m->block_2 == 1) ? 'Yes' : 'No';//'<span class="bs-label label-'.$class.'">'.$status.'</span>';
				//$result['data'][$i][]= $m->id;//'<a target="_blank" href="'.Yii::app()->baseUrl.'/site/ApplicantView/id/'.$m->qr_code.'" class="pull-right"><span class="bs-label label-success">View</span></a>&nbsp;&nbsp;<a href="#myModal" data-toggle="modal" data-target="#myModal" class="pull-right"><span class="bs-label label-success scheduleBtn" rel="'.$m->id.'">Schedule</span></a>&nbsp;&nbsp;<a  href="javascript:void" class="pull-right "><span rel="'.$m->id.'" class="formActiveBtn bs-label label-success">Active Form</span></a>';
				$result['data'][$i][]= @$m->district->name;//'<a target="_blank" href="'.Yii::app()->baseUrl.'/site/ApplicantView/id/'.$m->qr_code.'" class="pull-right"><span class="bs-label label-success">View</span></a>';
				$result['data'][$i][]= @$m->designation;//'<a target="_blank" href="'.Yii::app()->baseUrl.'/admin/editstudent/id/'.$m->id.'" class="pull-right"><span class="bs-label label-success">Edit</span></a>';
				if ($m->status == 1) {
                    $status = '<span class="label label-success">Activated</span>';
                } 
                if ($m->status == 0) {
                    $status = '<span class="label label-warning">Deactivated</span><br/>' . $m->remarks;
                } 
                if ($m->status == 5) {
                    $status = '<span class="label label-danger">Blacklisted</span><br/>' . $m->remarks;
                }
				$result['data'][$i][]= @$status;//'<a  href="javascript:void" class="pull-right "><span rel="'.$m->id.'" class="formActiveBtn bs-label label-success">Active Form</span></a>';
				if ($m->status == 1) {
		            $result['data'][$i][]= ($this->Laborstatus($m->id) == true) ? '<span class="label label-info">' . $this->Laborwork($m->id) . '</span>' : '<span class="label label-success">Available</span>';
		        } else {
		            $result['data'][$i][]= '<span class="label label-danger">Un-available</span>';
		        }
				$i++;
			endforeach;	
		}
		
		echo json_encode($result);
	}

	

	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}