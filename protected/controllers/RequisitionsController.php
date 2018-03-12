<?php

class RequisitionsController extends Controller
{
	public function init()
    {
        $this->checkSession();
    }
	public function actionAdd()
	{
		$this->render('add');
	}

	public function actionView($id,$type='')
	{
		if(!empty($type)){
			if(Yii::app()->session['userModel']['user']['userType']=='company '){
				$data['model'] = LaborRequisitions::model()->findAll('requisition_id=:id  AND status != 4',array(':id'=>$type));
				$data['detail_id'] = $type;
				$criteria = new CDbCriteria;
				$criteria->addCondition("t.id = '{$id}'");	
				$criteria->addCondition("clientCompanyRequisitionDetails.id = '{$type}'");
				$data['company'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria,array('order'=>'t.id DESC'));

				$this->render('laborRequisitions',$data);
			} else if(Yii::app()->session['userModel']['user']['userType']=='person'){

                $access = 0;
                if(Yii::app()->session['userModel']['user']['userType']=='person'){
                    $person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);
                    if($person){
                        $req = ClientCompanyRequisitions::model()->find('company_id=:id AND id = :req',array(':id'=>$person->company_id,':req'=>$id),array('order'=>'id DESC')); 
                        if($req){
                            $access = 1;
                        } else{
                            $access = 0;
                        }
                    } else{
                        $access = 0;
                    }
                } else{
                    $access = 1;
                }

                if($access == 1){
                    $data['model'] = LaborRequisitions::model()->findAll('requisition_id=:id AND status != 4',array(':id'=>$type));
                    $data['detail_id'] = $type;
                    $criteria = new CDbCriteria;
                    $criteria->addCondition("t.id = '{$id}'");  
                    $criteria->addCondition("clientCompanyRequisitionDetails.id = '{$type}'");  
                    $data['company'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria,array('order'=>'t.id DESC'));

                    $this->render('laborRequisitions',$data);    
                } else{
                    $this->redirect(Yii::app()->baseUrl.'/site/error');
                }
				
			} else{
				$data['id'] = $id;
				$data['type'] = $type;
				$criteria = new CDbCriteria;
				$criteria->addCondition("t.id = '{$id}'");	
				$criteria->addCondition("clientCompanyRequisitionDetails.id = '{$type}'");	
				$data['model'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria,array('order'=>'t.id DESC'));
				$this->render('index',$data);
			}
			
		} else{
			$data['model'] = ClientCompanyRequisitions::model()->findByPk($id);
			$this->render('index2',$data);
		}
	}

	public function actionViewtemp($id,$type='')
	{
        $access = 0;
        if(Yii::app()->session['userModel']['user']['userType']=='person'){
            $person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);
            if($person){
                $req = ClientCompanyRequisitions::model()->find('company_id=:id AND id = :req',array(':id'=>$person->company_id,':req'=>$id),array('order'=>'id DESC')); 
                if($req){
                    $access = 1;
                } else{
                    $access = 0;
                }
            } else{
                $access = 0;
            }
        } else{
            $access = 1;
        }

        if($access == 1){
            $data['model'] = LaborRequisitions::model()->findAll('requisition_id=:id',array(':id'=>$type));
            $data['detail_id'] = $type;
            $criteria = new CDbCriteria;
            $criteria->addCondition("t.id = '{$id}'");  
            $criteria->addCondition("clientCompanyRequisitionDetails.id = '{$type}'");  
            $data['company'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria);    
            $this->render('laborRequisitionsTemp',$data);    
        } else{
            $this->redirect(Yii::app()->baseUrl.'/site/error');
        }
		
		
	}
	public function actionViewreport2($id,$type='')
  {
    $company = ClientCompanyRequisitionDetails::model()->findAll('id=:id',array(':id'=>$id));
    if($type=='excel'){
      Yii::import('ext.phpexcel.XPHPExcel');      
            $objPHPExcel = XPHPExcel::createPHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("ENGRO KT");
            $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
            $objPHPExcel->getProperties()->setTitle("Company Requisition");
            $objPHPExcel->getProperties()->setSubject("Company Requisition");
            $objPHPExcel->getProperties()->setDescription("Company Requisition");
            
            // Active sheet
            $sheet1=$objPHPExcel->setActiveSheetIndex(0);
            $count = 6;
            $headAlpha=0;
            $sheet1->setCellValue('C2', 'Company Requisition');
            $sheet1->mergeCells("C2:F2");
            $sheet1->getStyle("C2:F2")->applyFromArray(array("font" => array( "bold" => true)));
            

            $sheet1->setCellValue('B3', 'Code');
            $sheet1->setCellValue('C3', 'Company Name');
            $sheet1->setCellValue('D3', 'Company Person');
            $sheet1->setCellValue('E3', 'Person Number');
            $sheet1->setCellValue('F3', 'Requisition Date');
            $sheet1->setCellValue('G3', 'Applicant Type');
            $sheet1->setCellValue('H3', 'Skill Required');
            $sheet1->setCellValue('I3', 'HC');
            $sheet1->setCellValue('J3', 'Requisition Status');
            $sheet1->setCellValue('K3', 'Requisition Start Date');
            $sheet1->setCellValue('L3', 'Requisition End Date');
            $sheet1->setCellValue("M3", 'Applicant ID');

            $sheet1->setCellValue("N3", 'Accepted Date');
            $sheet1->setCellValue("O3", 'Rejected / Release Date');
            $sheet1->setCellValue("P3", 'Reason');
            $sheet1->setCellValue("Q3", 'Status');

            $sheet1->setCellValue('R3', 'Full Name');
            $sheet1->setCellValue('S3', 'Father Name');
            $sheet1->setCellValue('T3', 'CNIC');
            $sheet1->setCellValue('U3', 'Religion');
            $sheet1->setCellValue('V3', 'DOB');
            $sheet1->setCellValue('W3', 'Mobile Number');
            $sheet1->setCellValue('X3', 'District');
            /*$sheet1->setCellValue('X3', 'Martial Status');
            $sheet1->setCellValue('Y3', 'Kids');
            $sheet1->setCellValue('Z3', 'Block 2');
            $sheet1->setCellValue('AA3', 'Village');
            $sheet1->setCellValue('AB3', 'Tehsil');
            $sheet1->setCellValue('AC3', 'District');
            $sheet1->setCellValue('AD3', 'Category');
            $sheet1->setCellValue('AE3', 'Applied For');
            $sheet1->setCellValue('AF3', 'Registered');
            $sheet1->setCellValue('AG3', 'Remarks');
            //$sheet1->setCellValue('AG3', 'Work Status');
            $sheet1->setCellValue('AH3', 'Drive');
            $sheet1->setCellValue('AI3', 'Driving License Number');
            $sheet1->setCellValue('AJ3', 'Driving License Category');
            $sheet1->setCellValue('AK3', 'Vehicle Type');
            $sheet1->setCellValue('AL3', 'Issue Date');
            $sheet1->setCellValue('AM3', 'Valid Upto');
            $sheet1->setCellValue('AN3', 'Applicant HSE');
            $sheet1->setCellValue('AO3', 'Applicant Medical Type');
            $sheet1->setCellValue('AP3', 'Applicant Medical Result');
            $sheet1->setCellValue('AQ3', 'Applicant Police Verified');

            $sheet1->setCellValue('AR3', 'Source of Income');
            $sheet1->setCellValue('AS3', 'Company Name');
            $sheet1->setCellValue('AT3', 'Date From ');          
            $sheet1->setCellValue('AU3', 'Date To');          
            $sheet1->setCellValue('AV3', 'Position');          
            $sheet1->setCellValue('AW3', 'Salary');

            $sheet1->setCellValue('AX3', 'Source of Income');
            $sheet1->setCellValue('AY3', 'Company Name');
            $sheet1->setCellValue('AZ3', 'Date From ');          
            $sheet1->setCellValue('BA3', 'Date To');          
            $sheet1->setCellValue('BB3', 'Position');          
            $sheet1->setCellValue('BC3', 'Salary');

            $sheet1->setCellValue('BD3', 'Experience');


            $sheet1->setCellValue('BE3', 'Degree');
            $sheet1->setCellValue('BF3', 'Board');
            $sheet1->setCellValue('BG3', 'Passing Year');
            $sheet1->setCellValue('BH3', 'Institute Name');
            $sheet1->setCellValue('BI3', 'Certificate');

            $sheet1->setCellValue('BJ3', 'Degree');
            $sheet1->setCellValue('BK3', 'Board');
            $sheet1->setCellValue('BL3', 'Passing Year');
            $sheet1->setCellValue('BM3', 'Institute Name');
            $sheet1->setCellValue('BN3', 'Certificate');*/


            $sheet1->getStyle("B3:X3")->applyFromArray(array("font" => array( "bold" => true)));


            for($col = 'B'; $col !== 'X'; $col++) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
            }
            
            foreach($company as $d){ $deo = CompanyPersons::model()->findByPk($d->requisition->person_id);
              if($d->type==1){
                  $type="Skilled";
                }
                if($d->type==2){
                  $type="Unskilled";
                }
                
                if(@$d->status==0){
                  $status = 'Pending';
                }
                if(@$d->status==1){
                  $status = 'Open';
                }
                if(@$d->status==2){
                  $status = 'Closed';
                }
                if(@$d->status==3){
                  $status = 'Under discussion';
                }
                if(@$d->status==4){
                  $status = 'In Process';
                }
                if(@$d->status==5){
                  $status = 'Rejected';
                }
                if($d->requisition->company->allied_to==1){
                  $alliedto = 'Mining';
                }
                if($d->requisition->company->allied_to==2){
                  $alliedto = 'Power';
                }
              
                if($d->laborRequisitionsActiveCom){
                  foreach($d->laborRequisitionsActiveCom as $lr){
                    $sheet1->setCellValue("B$count", $d->requisition->requisition_code);
                    $sheet1->setCellValue("C$count", (ucfirst($d->requisition->company->company_name).' ('.$alliedto).')');
                    $sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
                    $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                    $sheet1->setCellValue("F$count", date('d-m-Y',strtotime($d->requisition->createdOn)));
                    $sheet1->setCellValue("G$count", @$type);
                    $sheet1->setCellValue("H$count", @$d->skill);
                    $sheet1->setCellValue("I$count", @$d->count);
                    $sheet1->setCellValue("J$count", @$status);
                    $sheet1->setCellValue("K$count", (date('d-m-Y',strtotime($d->date_from))));
                    $sheet1->setCellValue("L$count", (date('d-m-Y',strtotime($d->date_to))));
                    if($lr->status==0){
                      $statuss="Pending";
                    }
                    if($lr->status==1){
                      $statuss="Accepted";
                    }
                    if($lr->status==2){
                      $statuss="Rejected";
                    }
                    if($lr->status==3){
                      $statuss="Job Completed";
                    }
                    if($lr->status==4){
                      $statuss="Temporary";
                    }

                    $sheet1->setCellValue("M$count", @$lr->labour->id);

                    
                    $sheet1->setCellValue("N$count", ($lr->accepted_date)?(date('d-m-Y',strtotime(@$lr->accepted_date))):'');
                    $sheet1->setCellValue("O$count", ($lr->rejected_date)?(date('d-m-Y',strtotime(@$lr->rejected_date))):'');
                    $sheet1->setCellValue("P$count", $lr->reason);
                    $sheet1->setCellValue("Q$count", $statuss);

                    $sheet1->setCellValue("R$count", @$lr->labour->full_name);
                    $sheet1->setCellValue("S$count", @$lr->labour->father_name);
                    $sheet1->setCellValue("T$count", @$lr->labour->cnic);
                    $sheet1->setCellValue("U$count", @$lr->labour->religion);
                    $sheet1->setCellValue("V$count", date('d-m-Y',strtotime(@$lr->labour->dob)));//date('d M,Y',strtotime(@$lr->labour->dob)));
                    $sheet1->setCellValue("W$count", @$lr->labour->mobile_number);
                    $sheet1->setCellValue("X$count", @$lr->labour->district->name);
                    /*$sheet1->setCellValue("X$count", (@$lr->labour->martial_status==1)?'Married':'Single');
                    $sheet1->setCellValue("Y$count", @$lr->labour->kids);
                    $sheet1->setCellValue("Z$count", (@$lr->labour->block_2==1)?'Yes':'No');
                    $sheet1->setCellValue("AA$count", @$lr->labour->village->village);
                    $sheet1->setCellValue("AB$count", @$lr->labour->tehsil->name);
                    $sheet1->setCellValue("AC$count", @$lr->labour->district->name);
                    $sheet1->setCellValue("AD$count", (@$lr->labour->category_id==1)?'Skilled':'Unskilled');
                    $sheet1->setCellValue("AE$count", @$lr->labour->designation);
                    $sheet1->setCellValue("AF$count", date('d-m-Y',strtotime(@$lr->labour->createdOn)));
                    $sheet1->setCellValue("AG$count", @$lr->labour->remarks);
                    //$sheet1->setCellValue("AH$count", $this->Laborwork(@$lr->labour->id));
                    $sheet1->setCellValue("AH$count", (@$lr->labour->drive==1)?'Yes':'No');
                    $sheet1->setCellValue("AI$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->driving_license_number:'-');
                    $sheet1->setCellValue("AJ$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->license_category:'-');
                    $sheet1->setCellValue("AK$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->vehicle_type:'-');
                    $sheet1->setCellValue("AL$count", (@$lr->labour->drivingLicense)?(date('d-m-Y',strtotime(@$lr->labour->drivingLicense[0]->issue_date))):'-');
                    $sheet1->setCellValue("AM$count", (@$lr->labour->drivingLicense)?(date('d-m-Y',strtotime(@$lr->labour->drivingLicense[0]->valid_upto))):'-');
                    $sheet1->setCellValue("AN$count", (@$lr->labour->hse)?((@$lr->labour->hse[0]->hse==1)?'Yes':'No'):'-');
                    $sheet1->setCellValue("AO$count", (@$lr->labour->medical)?@$lr->labour->medical[0]->type:'-');
                    $sheet1->setCellValue("AP$count", (@$lr->labour->medical)?@$lr->labour->medical[0]->result:'-');
                    $sheet1->setCellValue("AQ$count", (@$lr->labour->police)?((@$lr->labour->police[0]->police_verified==1)?'Yes':'No'):'-');



                    $employments = $this->getRecentData(@$lr->labour->id,'employment');
                    if(!empty($employments['data'])){
                    if (array_key_exists(0, $employments['data'])) {
                      $sheet1->setCellValue("AR$count", $employments['data'][0]['source_of_income']);
                      $sheet1->setCellValue("AS$count", $employments['data'][0]['company_name']);
                      $sheet1->setCellValue("AT$count", date('d-m-Y',strtotime($employments['data'][0]['from_date'])));
                      $sheet1->setCellValue("AU$count", date('d-m-Y',strtotime($employments['data'][0]['to_date'])));
                      $sheet1->setCellValue("AV$count", $employments['data'][0]['position']);
                      $sheet1->setCellValue("AW$count", $employments['data'][0]['salary']);  
                    }
                    if (array_key_exists(1, $employments['data'])) {
                      $sheet1->setCellValue("AX$count", $employments['data'][1]['source_of_income']);
                      $sheet1->setCellValue("AY$count", $employments['data'][1]['company_name']);
                      $sheet1->setCellValue("AZ$count", date('d-m-Y',strtotime($employments['data'][1]['from_date'])));
                      $sheet1->setCellValue("BA$count", date('d-m-Y',strtotime($employments['data'][1]['to_date'])));
                      $sheet1->setCellValue("BB$count", $employments['data'][1]['position']);
                      $sheet1->setCellValue("BC$count", $employments['data'][1]['salary']);  
                    }
                    }
                    $sheet1->setCellValue("BD$count", $employments['experience']);

                    $educations = $this->getRecentData(@$lr->labour->id,'education');
                    if(!empty($educations)){
                    if (array_key_exists(0, $educations)) {
                      switch ($educations[0]['education_type_id']) {
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
                      $sheet1->setCellValue("BE$count", @$$educationTypeId);
                      $sheet1->setCellValue("BF$count", $educations[0]['board']);
                      $sheet1->setCellValue("BG$count", $educations[0]['passing_year']);
                      $sheet1->setCellValue("BH$count", $educations[0]['organization_name']);
                      $sheet1->setCellValue("BI$count", $educations[0]['degree']);  
                    }
                    if (array_key_exists(1, $educations)) {
                      switch ($educations[1]['education_type_id']) {
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
                      $sheet1->setCellValue("BJ$count", @$$educationTypeId);
                      $sheet1->setCellValue("BK$count", $educations[1]['board']);
                      $sheet1->setCellValue("BL$count", $educations[1]['passing_year']);
                      $sheet1->setCellValue("BM$count", $educations[1]['organization_name']);
                      $sheet1->setCellValue("BN$count", $educations[1]['degree']);  
                    }
                    }*/
                    $count++;
                  }
                } else{
                  $sheet1->setCellValue("B$count", $d->requisition->requisition_code);
                  $sheet1->setCellValue("C$count", (ucfirst($d->requisition->company->company_name).' ('.$alliedto).')');
                  $sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
                  $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                  $sheet1->setCellValue("F$count", date('d M,Y',strtotime($d->requisition->createdOn)));
                  $sheet1->setCellValue("G$count", @$type);
                  $sheet1->setCellValue("H$count", @$d->skill);
                  $sheet1->setCellValue("I$count", @$d->count);
                  $sheet1->setCellValue("J$count", @$status);
                  $sheet1->setCellValue("K$count", (date('d M,Y',strtotime($d->date_from))));
                  $sheet1->setCellValue("L$count", (date('d M,Y',strtotime($d->date_to))));
                  $count++;
                }
            }
            $sheet1->setTitle('Company Requisition');
            /*$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            //$file = getcwd().'\uploads\areport.xlsx';
            $file = '/home2/thepaks1/public_html/khushaalthar\uploads/\areport.xlsx';
            //echo $file;exit;
            $objWriter->save($file);*/
            $filename = 'companyrequisitionreport.xlsx';
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename={$filename}");
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            die;
    }
    if($type=='pdf'){
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
            $html .= '<tr><td colspan="11" style="text-align:center">Client Company Requisition Detail</td></tr>';
            
            $html .= '<tr><td colspan="11"></td></tr>';
            $html .= '<tr><td >ID</td><td>Code</td><td>Company Name</td><td>Company Person</td><td>Person Number</td><td>Requisition Date</td><td>Applicant Type</td><td>Skill Required</td><td>HC</td><td>Status</td><td>Requisition Date</td></tr>';

            foreach($company as $d){ $deo = CompanyPersons::model()->findByPk($d->requisition->person_id);
              //foreach($requisition->clientCompanyRequisitionDetails as $d){
                if($d->type==1){
                  $type="Skilled";
                }
                if($d->type==2){
                  $type="Unskilled";
                }
                if($d->status==1){
                  $status="Open";
                }
                if($d->status==2){
                  $status="Closed";
                }
                if($d->requisition->company->allied_to==1){
                  $alliedto = 'Mining';
                }
                if($d->requisition->company->allied_to==2){
                  $alliedto = 'Power';
                }
                $html .= '<tr><td >'.$d->id.'</td><td>'.$d->requisition->requisition_code.'</td><td>'.(ucfirst($d->requisition->company->company_name).' ('.$alliedto).')</td><td>'.(($deo)?ucfirst($deo->name):'-').'</td><td>'.(($deo)?$deo->mobile_number:'-').'</td><td>'.(date('d M,Y',strtotime($d->requisition->createdOn))).'</td><td>'.@$type.'</td><td>'.@$d->skill.'</td><td>'.@$d->count.'</td><td>'.@$status.'</td><td>'.(date('d M,Y',strtotime($d->date_from)).' - '.date('d M,Y',strtotime($d->date_to))).'</td></tr>'; 
                $html .= '<tr><td colspan="11"></td></tr>';
                $html .= '<tr><td colspan="11">Applicants Detail</td></tr>';
                $html .= '<tr><td>ID</td><td colspan="2">Name</td><td colspan="2">Father Name</td><td>CNIC</td><td>Number</td><td>Work Status</td><td>Accepted Date</td><td>Rejected/Release Date</td><td>Reason</td></tr>';
                if($d->laborRequisitionsActiveCom){
                  foreach($d->laborRequisitionsActiveCom as $lr){
                    if($lr->status==0){
                      $statuss="Pending";
                    }
                    if($lr->status==1){
                      $statuss="Accepted";
                    }
                    if($lr->status==2){
                      $statuss="Rejected";
                    }
                    if($lr->status==3){
                      $statuss="Rejected";
                    }
                    if($lr->status==4){
                      $statuss="Temporary";
                    }
                    $html .= '<tr><td>'.$lr->labour->id.'</td>';
                    $html .= '<td colspan="2">'.$lr->labour->full_name.'</td>';
                    $html .= '<td colspan="2">'.$lr->labour->father_name.'</td>';
                    $html .= '<td>'.$lr->labour->cnic.'</td>';
                    $html .= '<td>'.$lr->labour->mobile_number.'</td>';
                    $html .= '<td>'.@$statuss.'</td>';
                    $html .= '<td>'.$lr->accepted_date.'</td>';
                    $html .= '<td>'.$lr->rejected_date.'</td>';
                    $html .= '<td>'.$lr->reason.'</td></tr>';
                  }
                  $html .= '<tr><td colspan="11"></td></tr>';
              };
              //}
            }

            $html .= '</table>';
            //echo $html;exit;
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
            die;
    }
      
  }
  public function actionViewreport($id,$type='')
	{
		$company = ClientCompanyRequisitionDetails::model()->findAll('id=:id',array(':id'=>$id));
		if($type=='excel'){
			Yii::import('ext.phpexcel.XPHPExcel');      
            $objPHPExcel = XPHPExcel::createPHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("ENGRO KT");
            $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
            $objPHPExcel->getProperties()->setTitle("Company Requisition");
            $objPHPExcel->getProperties()->setSubject("Company Requisition");
            $objPHPExcel->getProperties()->setDescription("Company Requisition");

            // Active sheet
            $sheet1=$objPHPExcel->setActiveSheetIndex(0);
            $count = 6;
            $headAlpha=0;
            $sheet1->setCellValue('C2', 'Company Requisition');
            $sheet1->mergeCells("C2:F2");
            $sheet1->getStyle("C2:F2")->applyFromArray(array("font" => array( "bold" => true)));
	          

            $sheet1->setCellValue('B3', 'Code');
            $sheet1->setCellValue('C3', 'Company Name');
            $sheet1->setCellValue('D3', 'Company Person');
            $sheet1->setCellValue('E3', 'Person Number');
            $sheet1->setCellValue('F3', 'Requisition Date');
            $sheet1->setCellValue('G3', 'Applicant Type');
            $sheet1->setCellValue('H3', 'Skill Required');
            $sheet1->setCellValue('I3', 'HC');
            $sheet1->setCellValue('J3', 'Requisition Status');
            $sheet1->setCellValue('K3', 'Requisition Start Date');
            $sheet1->setCellValue('L3', 'Requisition End Date');
            $sheet1->setCellValue("M3", 'Applicant ID');

            $sheet1->setCellValue("N3", 'Accepted Date');
            $sheet1->setCellValue("O3", 'Rejected / Release Date');
            $sheet1->setCellValue("P3", 'Reason');
            $sheet1->setCellValue("Q3", 'Status');

            $sheet1->setCellValue('R3', 'Full Name');
            $sheet1->setCellValue('S3', 'Father Name');
            $sheet1->setCellValue('T3', 'CNIC');
            $sheet1->setCellValue('U3', 'Religion');
            $sheet1->setCellValue('V3', 'DOB');
            $sheet1->setCellValue('W3', 'Mobile Number');
            $sheet1->setCellValue('X3', 'District');
            /*$sheet1->setCellValue('X3', 'Martial Status');
            $sheet1->setCellValue('Y3', 'Kids');
            $sheet1->setCellValue('Z3', 'Block 2');
            $sheet1->setCellValue('AA3', 'Village');
            $sheet1->setCellValue('AB3', 'Tehsil');
            $sheet1->setCellValue('AC3', 'District');
            $sheet1->setCellValue('AD3', 'Category');
            $sheet1->setCellValue('AE3', 'Applied For');
            $sheet1->setCellValue('AF3', 'Registered');
            $sheet1->setCellValue('AG3', 'Remarks');
            //$sheet1->setCellValue('AG3', 'Work Status');
            $sheet1->setCellValue('AH3', 'Drive');
            $sheet1->setCellValue('AI3', 'Driving License Number');
            $sheet1->setCellValue('AJ3', 'Driving License Category');
            $sheet1->setCellValue('AK3', 'Vehicle Type');
            $sheet1->setCellValue('AL3', 'Issue Date');
            $sheet1->setCellValue('AM3', 'Valid Upto');
            $sheet1->setCellValue('AN3', 'Applicant HSE');
            $sheet1->setCellValue('AO3', 'Applicant Medical Type');
            $sheet1->setCellValue('AP3', 'Applicant Medical Result');
            $sheet1->setCellValue('AQ3', 'Applicant Police Verified');

            $sheet1->setCellValue('AR3', 'Source of Income');
            $sheet1->setCellValue('AS3', 'Company Name');
            $sheet1->setCellValue('AT3', 'Date From ');          
            $sheet1->setCellValue('AU3', 'Date To');          
            $sheet1->setCellValue('AV3', 'Position');          
            $sheet1->setCellValue('AW3', 'Salary');

            $sheet1->setCellValue('AX3', 'Source of Income');
            $sheet1->setCellValue('AY3', 'Company Name');
            $sheet1->setCellValue('AZ3', 'Date From ');          
            $sheet1->setCellValue('BA3', 'Date To');          
            $sheet1->setCellValue('BB3', 'Position');          
            $sheet1->setCellValue('BC3', 'Salary');

            $sheet1->setCellValue('BD3', 'Experience');


            $sheet1->setCellValue('BE3', 'Degree');
            $sheet1->setCellValue('BF3', 'Board');
            $sheet1->setCellValue('BG3', 'Passing Year');
            $sheet1->setCellValue('BH3', 'Institute Name');
            $sheet1->setCellValue('BI3', 'Certificate');

            $sheet1->setCellValue('BJ3', 'Degree');
            $sheet1->setCellValue('BK3', 'Board');
            $sheet1->setCellValue('BL3', 'Passing Year');
            $sheet1->setCellValue('BM3', 'Institute Name');
            $sheet1->setCellValue('BN3', 'Certificate');*/


            $sheet1->getStyle("B3:X3")->applyFromArray(array("font" => array( "bold" => true)));


            for($col = 'B'; $col !== 'X'; $col++) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
            }
	          
	          foreach($company as $d){ $deo = CompanyPersons::model()->findByPk($d->requisition->person_id);
	            if($d->type==1){
                  $type="Skilled";
                }
                if($d->type==2){
                  $type="Unskilled";
                }
                
                if(@$d->status==0){
                  $status = 'Pending';
                }
                if(@$d->status==1){
                  $status = 'Open';
                }
                if(@$d->status==2){
                  $status = 'Closed';
                }
                if(@$d->status==3){
                  $status = 'Under discussion';
                }
                if(@$d->status==4){
                  $status = 'In Process';
                }
                if(@$d->status==5){
                  $status = 'Rejected';
                }
                if($d->requisition->company->allied_to==1){
                  $alliedto = 'Mining';
                }
                if($d->requisition->company->allied_to==2){
                  $alliedto = 'Power';
                }
	            
                /*if($d->laborRequisitions){
                	foreach($d->laborRequisitions as $lr){
	            	    $sheet1->setCellValue("B$count", $d->requisition->requisition_code);
                  	$sheet1->setCellValue("C$count", (ucfirst($d->requisition->company->company_name).' ('.$alliedto).')');
                  	$sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
                  	$sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                  	$sheet1->setCellValue("F$count", date('d M,Y',strtotime($d->requisition->createdOn)));
                  	$sheet1->setCellValue("G$count", @$type);
                  	$sheet1->setCellValue("H$count", @$d->skill);
                  	$sheet1->setCellValue("I$count", @$d->count);
                  	$sheet1->setCellValue("J$count", @$status);
                  	$sheet1->setCellValue("K$count", (date('d M,Y',strtotime($d->date_from))));
                  	$sheet1->setCellValue("L$count", (date('d M,Y',strtotime($d->date_to))));
                    if($lr->status==0){
                      $statuss="Pending";
                    }
                    if($lr->status==1){
                      $statuss="Accepted";
                    }
                    if($lr->status==2){
                      $statuss="Rejected";
                    }
                    if($lr->status==3){
                      $statuss="Job Completed";
                    }
                    if($lr->status==4){
                      $statuss="Temporary";
                    }
                    
                  	$sheet1->setCellValue("M$count", @$lr->labour->id);
                  	$sheet1->setCellValue("N$count", @$lr->labour->full_name);
                  	$sheet1->setCellValue("O$count", @$lr->labour->father_name);
                  	$sheet1->setCellValue("P$count", @$lr->labour->cnic);
                  	$sheet1->setCellValue("Q$count", @$lr->labour->mobile_number);
                  	$sheet1->setCellValue("R$count", (@$lr->labour->category_id==1)?'Skilled':'Unskilled');
                  	$sheet1->setCellValue("S$count", (@$lr->labour->block_2==1)?'Yes':'No');
                  	$sheet1->setCellValue("T$count", @$lr->labour->district->name);
                  	$sheet1->setCellValue("U$count", @$lr->labour->tehsil->name);
                  	$sheet1->setCellValue("V$count", @$lr->labour->village->village);
                  	$sheet1->setCellValue("W$count", @$lr->labour->designation);
                  	$sheet1->setCellValue("X$count", @$statuss);
                  	$sheet1->setCellValue("Y$count", $lr->accepted_date);
                  	$sheet1->setCellValue("Z$count", $lr->rejected_date);
                  	$sheet1->setCellValue("AA$count", $lr->reason);
                  
                  	$count++;
                  }
				        } else{
                  $sheet1->setCellValue("B$count", $d->requisition->requisition_code);
                  $sheet1->setCellValue("C$count", (ucfirst($d->requisition->company->company_name).' ('.$alliedto).')');
                  $sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
                  $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                  $sheet1->setCellValue("F$count", date('d M,Y',strtotime($d->requisition->createdOn)));
                  $sheet1->setCellValue("G$count", @$type);
                  $sheet1->setCellValue("H$count", @$d->skill);
                  $sheet1->setCellValue("I$count", @$d->count);
                  $sheet1->setCellValue("J$count", @$status);
                  $sheet1->setCellValue("K$count", (date('d M,Y',strtotime($d->date_from))));
                  $sheet1->setCellValue("L$count", (date('d M,Y',strtotime($d->date_to))));
                  $count++;
                }*/
                if($d->laborRequisitions){
                    foreach($d->laborRequisitions as $lr){
                    $sheet1->setCellValue("B$count", $d->requisition->requisition_code);
                    $sheet1->setCellValue("C$count", (ucfirst($d->requisition->company->company_name).' ('.$alliedto).')');
                    $sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
                    $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                    $sheet1->setCellValue("F$count", date('d M,Y',strtotime($d->requisition->createdOn)));
                    $sheet1->setCellValue("G$count", @$type);
                    $sheet1->setCellValue("H$count", @$d->skill);
                    $sheet1->setCellValue("I$count", @$d->count);
                    $sheet1->setCellValue("J$count", @$status);
                    $sheet1->setCellValue("K$count", (date('d M,Y',strtotime($d->date_from))));
                    $sheet1->setCellValue("L$count", (date('d M,Y',strtotime($d->date_to))));
                    if($lr->status==0){
                      $statuss="Pending";
                    }
                    if($lr->status==1){
                      $statuss="Accepted";
                    }
                    if($lr->status==2){
                      $statuss="Rejected";
                    }
                    if($lr->status==3){
                      $statuss="Job Completed";
                    }
                    if($lr->status==4){
                      $statuss="Temporary";
                    }

                    $sheet1->setCellValue("M$count", @$lr->labour->id);

                    $sheet1->setCellValue("N$count", $lr->accepted_date);
                    $sheet1->setCellValue("O$count", $lr->rejected_date);
                    $sheet1->setCellValue("P$count", $lr->reason);
                    $sheet1->setCellValue("Q$count", $statuss);

                    $sheet1->setCellValue("R$count", @$lr->labour->full_name);
                    $sheet1->setCellValue("S$count", @$lr->labour->father_name);
                    $sheet1->setCellValue("T$count", @$lr->labour->cnic);
                    $sheet1->setCellValue("U$count", @$lr->labour->religion);
                    $sheet1->setCellValue("V$count", date('d-m-Y',strtotime(@$lr->labour->dob)));//date('d M,Y',strtotime(@$lr->labour->dob)));
                    $sheet1->setCellValue("W$count", @$lr->labour->mobile_number);
                    $sheet1->setCellValue("X$count", @$lr->labour->district->name);
                    /*$sheet1->setCellValue("X$count", (@$lr->labour->martial_status==1)?'Married':'Single');
                    $sheet1->setCellValue("Y$count", @$lr->labour->kids);
                    $sheet1->setCellValue("Z$count", (@$lr->labour->block_2==1)?'Yes':'No');
                    $sheet1->setCellValue("AA$count", @$lr->labour->village->village);
                    $sheet1->setCellValue("AB$count", @$lr->labour->tehsil->name);
                    $sheet1->setCellValue("AC$count", @$lr->labour->district->name);
                    $sheet1->setCellValue("AD$count", (@$lr->labour->category_id==1)?'Skilled':'Unskilled');
                    $sheet1->setCellValue("AE$count", @$lr->labour->designation);
                    $sheet1->setCellValue("AF$count", date('d-m-Y',strtotime(@$lr->labour->createdOn)));
                    $sheet1->setCellValue("AG$count", @$lr->labour->remarks);
                    //$sheet1->setCellValue("AH$count", $this->Laborwork(@$lr->labour->id));
                    $sheet1->setCellValue("AH$count", (@$lr->labour->drive==1)?'Yes':'No');
                    $sheet1->setCellValue("AI$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->driving_license_number:'-');
                    $sheet1->setCellValue("AJ$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->license_category:'-');
                    $sheet1->setCellValue("AK$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->vehicle_type:'-');
                    $sheet1->setCellValue("AL$count", (@$lr->labour->drivingLicense)?(date('d-m-Y',strtotime(@$lr->labour->drivingLicense[0]->issue_date))):'-');
                    $sheet1->setCellValue("AM$count", (@$lr->labour->drivingLicense)?(date('d-m-Y',strtotime(@$lr->labour->drivingLicense[0]->valid_upto))):'-');
                    $sheet1->setCellValue("AN$count", (@$lr->labour->hse)?((@$lr->labour->hse[0]->hse==1)?'Yes':'No'):'-');
                    $sheet1->setCellValue("AO$count", (@$lr->labour->medical)?@$lr->labour->medical[0]->type:'-');
                    $sheet1->setCellValue("AP$count", (@$lr->labour->medical)?@$lr->labour->medical[0]->result:'-');
                    $sheet1->setCellValue("AQ$count", (@$lr->labour->police)?((@$lr->labour->police[0]->police_verified==1)?'Yes':'No'):'-');



                    $employments = $this->getRecentData(@$lr->labour->id,'employment');
                    if(!empty($employments['data'])){
                    if (array_key_exists(0, $employments['data'])) {
                      $sheet1->setCellValue("AR$count", $employments['data'][0]['source_of_income']);
                      $sheet1->setCellValue("AS$count", $employments['data'][0]['company_name']);
                      $sheet1->setCellValue("AT$count", date('d-m-Y',strtotime($employments['data'][0]['from_date'])));
                      $sheet1->setCellValue("AU$count", date('d-m-Y',strtotime($employments['data'][0]['to_date'])));
                      $sheet1->setCellValue("AV$count", $employments['data'][0]['position']);
                      $sheet1->setCellValue("AW$count", $employments['data'][0]['salary']);  
                    }
                    if (array_key_exists(1, $employments['data'])) {
                      $sheet1->setCellValue("AX$count", $employments['data'][1]['source_of_income']);
                      $sheet1->setCellValue("AY$count", $employments['data'][1]['company_name']);
                      $sheet1->setCellValue("AZ$count", date('d-m-Y',strtotime($employments['data'][1]['from_date'])));
                      $sheet1->setCellValue("BA$count", date('d-m-Y',strtotime($employments['data'][1]['to_date'])));
                      $sheet1->setCellValue("BB$count", $employments['data'][1]['position']);
                      $sheet1->setCellValue("BC$count", $employments['data'][1]['salary']);  
                    }
                    }
                    $sheet1->setCellValue("BD$count", $employments['experience']);

                    $educations = $this->getRecentData(@$lr->labour->id,'education');
                    if(!empty($educations)){
                    if (array_key_exists(0, $educations)) {
                      switch ($educations[0]['education_type_id']) {
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
                      $sheet1->setCellValue("BE$count", @$$educationTypeId);
                      $sheet1->setCellValue("BF$count", $educations[0]['board']);
                      $sheet1->setCellValue("BG$count", $educations[0]['passing_year']);
                      $sheet1->setCellValue("BH$count", $educations[0]['organization_name']);
                      $sheet1->setCellValue("BI$count", $educations[0]['degree']);  
                    }
                    if (array_key_exists(1, $educations)) {
                      switch ($educations[1]['education_type_id']) {
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
                      $sheet1->setCellValue("BJ$count", @$$educationTypeId);
                      $sheet1->setCellValue("BK$count", $educations[1]['board']);
                      $sheet1->setCellValue("BL$count", $educations[1]['passing_year']);
                      $sheet1->setCellValue("BM$count", $educations[1]['organization_name']);
                      $sheet1->setCellValue("BN$count", $educations[1]['degree']);  
                    }
                    }*/
                    $count++;
                  }
                } else{
                  $sheet1->setCellValue("B$count", $d->requisition->requisition_code);
                  $sheet1->setCellValue("C$count", (ucfirst($d->requisition->company->company_name).' ('.$alliedto).')');
                  $sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
                  $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                  $sheet1->setCellValue("F$count", date('d M,Y',strtotime($d->requisition->createdOn)));
                  $sheet1->setCellValue("G$count", @$type);
                  $sheet1->setCellValue("H$count", @$d->skill);
                  $sheet1->setCellValue("I$count", @$d->count);
                  $sheet1->setCellValue("J$count", @$status);
                  $sheet1->setCellValue("K$count", (date('d M,Y',strtotime($d->date_from))));
                  $sheet1->setCellValue("L$count", (date('d M,Y',strtotime($d->date_to))));
                  $count++;
                }
	          }
	          $sheet1->setTitle('Company Requisition');
	          /*$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	          //$file = getcwd().'\uploads\areport.xlsx';
	          $file = '/home2/thepaks1/public_html/khushaalthar\uploads/\areport.xlsx';
	          //echo $file;exit;
	          $objWriter->save($file);*/
	          $filename = 'companyrequisitionreport.xlsx';
	          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	          header("Content-Disposition: attachment;filename={$filename}");
	          header('Cache-Control: max-age=0');
	          $objWriter->save('php://output');
	          die;
		}
		if($type=='pdf'){
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
            $html .= '<tr><td colspan="11" style="text-align:center">Client Company Requisition Detail</td></tr>';
            
            $html .= '<tr><td colspan="11"></td></tr>';
            $html .= '<tr><td >ID</td><td>Code</td><td>Company Name</td><td>Company Person</td><td>Person Number</td><td>Requisition Date</td><td>Applicant Type</td><td>Skill Required</td><td>HC</td><td>Status</td><td>Requisition Date</td></tr>';

            foreach($company as $d){ $deo = CompanyPersons::model()->findByPk($d->requisition->person_id);
              //foreach($requisition->clientCompanyRequisitionDetails as $d){
                if($d->type==1){
                  $type="Skilled";
                }
                if($d->type==2){
                  $type="Unskilled";
                }
                if($d->status==1){
                  $status="Open";
                }
                if($d->status==2){
                  $status="Closed";
                }
                if($d->requisition->company->allied_to==1){
                  $alliedto = 'Mining';
                }
                if($d->requisition->company->allied_to==2){
                  $alliedto = 'Power';
                }
                $html .= '<tr><td >'.$d->id.'</td><td>'.$d->requisition->requisition_code.'</td><td>'.(ucfirst($d->requisition->company->company_name).' ('.$alliedto).')</td><td>'.(($deo)?ucfirst($deo->name):'-').'</td><td>'.(($deo)?$deo->mobile_number:'-').'</td><td>'.(date('d M,Y',strtotime($d->requisition->createdOn))).'</td><td>'.@$type.'</td><td>'.@$d->skill.'</td><td>'.@$d->count.'</td><td>'.@$status.'</td><td>'.(date('d M,Y',strtotime($d->date_from)).' - '.date('d M,Y',strtotime($d->date_to))).'</td></tr>'; 
                $html .= '<tr><td colspan="11"></td></tr>';
                $html .= '<tr><td colspan="11">Applicants Detail</td></tr>';
                $html .= '<tr><td>ID</td><td colspan="2">Name</td><td colspan="2">Father Name</td><td>CNIC</td><td>Number</td><td>Work Status</td><td>Accepted Date</td><td>Rejected/Release Date</td><td>Reason</td></tr>';
                if($d->laborRequisitions){
                	foreach($d->laborRequisitions as $lr){
                		if($lr->status==0){
		                  $statuss="Pending";
		                }
		                if($lr->status==1){
		                  $statuss="Accepted";
		                }
		                if($lr->status==2){
		                  $statuss="Rejected";
		                }
                    if($lr->status==3){
                      $statuss="Rejected";
                    }
                    if($lr->status==4){
                      $statuss="Temporary";
                    }
                		$html .= '<tr><td>'.$lr->labour->id.'</td>';
                		$html .= '<td colspan="2">'.$lr->labour->full_name.'</td>';
                		$html .= '<td colspan="2">'.$lr->labour->father_name.'</td>';
                		$html .= '<td>'.$lr->labour->cnic.'</td>';
                		$html .= '<td>'.$lr->labour->mobile_number.'</td>';
                		$html .= '<td>'.@$statuss.'</td>';
                		$html .= '<td>'.$lr->accepted_date.'</td>';
                		$html .= '<td>'.$lr->rejected_date.'</td>';
                		$html .= '<td>'.$lr->reason.'</td></tr>';
                	}
                	$html .= '<tr><td colspan="11"></td></tr>';
            	};
              //}
            }

            $html .= '</table>';
            //echo $html;exit;
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
            die;
		}
			
	}


	public function actionRequisitiondetail($id){
		$criteria = new CDbCriteria;
		$criteria->addCondition("clientCompanyRequisitionDetails.id = '{$id}'");	
		$data['company'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria);
		//$data['attandance'] = LabourAttendances::model()->find('labour_id=:labor AND requisition_id = :id AND date = :date',array(':labor'=>$l,':id'=>$_POST['requisition_id'],':date'=>$_POST['date']));
		$data['detail_id'] = $id;
		$this->render('requisitionDetail',$data);

	}

	public function actionAccept(){
    //print_r($_POST);exit;

		if(!empty($_POST['labor_id'])){
			$model = LaborRequisitions::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id']));	
			if($model){
				$model->accepted_date = $_POST['accept_date'];
				$model->status = 1;
				if($model->save(false)){
					
          
                      $lrd = LaborRequisitionDetails::model()->find('labor_requisition_id=:id',array(':id'=>$model->id));
                      if(!$lrd){
                        $lrd = new LaborRequisitionDetails;
                      }
    				$lrd->labor_requisition_id = $model->id;
					$lrd->job_type = $_POST['job_type'];
					$lrd->salary = $_POST['salary'];
					$lrd->save(false);




                    /*$modelL = LaborRequisitionsLive::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id'])); 
                    if($modelL){
                        $modelL->accepted_date = $_POST['accept_date'];
                        $modelL->status = 1;
                        if($modelL->save(false)){
                            
                  
                              $lrdL = LaborRequisitionDetailsLive::model()->find('labor_requisition_id=:id',array(':id'=>$modelL->id));
                              if(!$lrdL){
                                $lrdL = new LaborRequisitionDetailsLive;
                              }
                            $lrdL->labor_requisition_id = $modelL->id;
                            $lrdL->job_type = $_POST['job_type'];
                            $lrdL->salary = $_POST['salary'];
                            $lrdL->save(false);
                        }
                    }*/

					$noti = new RequisitionNotifications;
					$noti->company_id = $model->requisition->requisition->company_id;
					$noti->requisition_id = $_POST['requisition_id'];
					$noti->text = $model->labour->full_name.' is accepted by '.$model->requisition->requisition->company->company_name.',  requisition # <b>'.$model->requisition->requisition->requisition_code.'</b> on date '.$_POST['accept_date'].'.';
					$noti->link = Yii::app()->baseUrl.'/requisitions/viewtemp/id/'.$model->requisition->requisition->id.'/type/'.$_POST['requisition_id'];
					$noti->status = 1;
					$noti->createdOn = date('Y-m-d H:i:s');
					$noti->save(false);

                    $this->requisitionEmailAccept(@$_POST['requisition_id']);
					echo json_encode(array('success'=>'Information updated successfully.'));
				} else{
					echo json_encode(array('error'=>'Something went wrong.'));
				}
			} else{
				echo json_encode(array('error'=>'No applicant selected.please try again.'));
			}		
		} elseif(!empty($_POST['labors'])){
      foreach($_POST['labors'] as $l):
        $model = LaborRequisitions::model()->find('requisition_id=:id AND labour_id=:labour AND status = 0',array(':id'=>$_POST['requisition_id'],':labour'=>$l)); 
        if($model){
          $model->accepted_date = $_POST['accept_date'];
          $model->status = 1;
          if($model->save(false)){
            
            $lrd = LaborRequisitionDetails::model()->find('labor_requisition_id=:id',array(':id'=>$model->id));
            if(!$lrd){
              $lrd = new LaborRequisitionDetails;
            }
            $lrd->labor_requisition_id = $model->id;
            $lrd->job_type = $_POST['job_type'];
            $lrd->salary = $_POST['salary'];
            $lrd->save(false);

            $noti = new RequisitionNotifications;
            $noti->company_id = $model->requisition->requisition->company_id;
            $noti->requisition_id = $_POST['requisition_id'];
            $noti->text = $model->labour->full_name.' is accepted by '.$model->requisition->requisition->company->company_name.',  requisition # <b>'.$model->requisition->requisition->requisition_code.'</b> on date '.$_POST['accept_date'].'.';
            $noti->link = Yii::app()->baseUrl.'/requisitions/viewtemp/id/'.$model->requisition->requisition->id.'/type/'.$_POST['requisition_id'];
            $noti->status = 1;
            $noti->createdOn = date('Y-m-d H:i:s');
            $noti->save(false);
          }
        }



        /*$modelL = LaborRequisitionsLive::model()->find('requisition_id=:id AND labour_id=:labour AND status = 0',array(':id'=>$_POST['requisition_id'],':labour'=>$l)); 
        if($modelL){
          $modelL->accepted_date = $_POST['accept_date'];
          $modelL->status = 1;
          if($modelL->save(false)){
            
            $lrdL = LaborRequisitionDetailsLive::model()->find('labor_requisition_id=:id',array(':id'=>$modelL->id));
            if(!$lrdL){
              $lrdL = new LaborRequisitionDetailsLive;
            }
            $lrdL->labor_requisition_id = $modelL->id;
            $lrdL->job_type = $_POST['job_type'];
            $lrdL->salary = $_POST['salary'];
            $lrdL->save(false);
          }
        }*/
      endforeach;
      $this->requisitionEmailAccept(@$_POST['requisition_id']);
      echo json_encode(array('success'=>'Information updated successfully.'));
    } else{
			echo json_encode(array('error'=>'No applicant selected.please try again.'));
		}
		 
	}

	public function actionReject(){
		if(!empty($_POST['labor_id'])){
			$model = LaborRequisitions::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id']));	
			if($model){
				$model->rejected_date = date('Y-m-d');
				$model->reason = $_POST['reason'];
				$model->status = 2;
				if($model->save(false)){
					/*$lrt = LaborRequisitionsTemp::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id']));	
					$lrt->status = 2;
					$lrt->reason = $_POST['reason'];
					$lrt->rejected_date = date('Y-m-d');
					$lrt->save(false);*/
					/*if($lrt){
						$lrt->delete();
					}*/

                    /*$modelL = LaborRequisitionsLive::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id'])); 
                    if($modelL){
                        $modelL->rejected_date = date('Y-m-d');
                        $modelL->reason = $_POST['reason'];
                        $modelL->status = 2;
                        $modelL->save(false);
                    }*/
					$noti = new RequisitionNotifications;
					$noti->company_id = $model->requisition->requisition->company_id;
					$noti->requisition_id = $_POST['requisition_id'];
					$noti->text = $model->labour->full_name.' is rejected by '.$model->requisition->requisition->company->company_name.',  requisition # <b>'.$model->requisition->requisition->requisition_code.'</b> on date '.date('Y-m-d').' with reason "'.$model->reason.'".';
					$noti->status = 1;
					$noti->link = Yii::app()->baseUrl.'/requisitions/viewtemp/id/'.$model->requisition->requisition->id.'/type/'.$_POST['requisition_id'];
					$noti->createdOn = date('Y-m-d H:i:s');
					$noti->save(false);


                    $this->requisitionEmailReject(@$_POST['requisition_id']);
					echo json_encode(array('success'=>'Information updated successfully.'));
				} else{
					echo json_encode(array('error'=>'Something went wrong.'));
				}
			} else{
				echo json_encode(array('error'=>'Something went wrong.'));
			}		
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}

	public function actionSubmitrequisitionsdata(){
		if(!empty($_POST['requisition_id'])){
			if(!empty($_POST['labors'])){
				$s = 0;
				$e = 0;
				$eNames = '';
				foreach($_POST['labors'] as $l):
					//$model = new LaborRequisitions;
					//$m = LaborRequisitions::model()->find('labour_id=:lab AND requisition_id=:req OR (status = 4 AND status != 2)',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
					$m = LaborRequisitions::model()->find('labour_id=:lab AND requisition_id=:req',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
					
					if(!$m){
						$model = new LaborRequisitions;
						$model->labour_id = $l;
						$model->requisition_id = $_POST['requisition_id'];
						$model->accepted_date = NULL;
						$model->rejected_date = NULL;
						$model->reason = '';
						$model->status = 4;
						$model->createdOn = date('Y-m-d H:i:s');
						$model->save(false);
						$s++;
					} else{
						$e++;
						$eNames .= $m->labour->full_name.', ';
					}
				endforeach;
				if($e>0){
					$msg = $s.' applicants are temporary assigned to requisition. <br/>'.$eNames.' are already in this requisition temporary list.';
				} else{
					$msg = $s.' applicants are temporary assigned to requisition.';
				}
				echo json_encode(array('success'=>$msg));
			} else{
				echo json_encode(array('error'=>'Please select atleast one applicant.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}

	public function actionRemoverequisitionlabor(){
		if(!empty($_POST['requisition_id'])){
			if(!empty($_POST['labor_id'])){
				$model = LaborRequisitions::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$_POST['labor_id'],':req'=>$_POST['requisition_id']));
				if($model->delete()){
					$labor = Labours::model()->findByPk($_POST['labor_id']);
					$remarks = $labor->remarks;
					$labor->remarks = ($remarks=='')?(date('d-m-Y').' - '.$_POST['reason'].' @ '.@$model->requisition->requisition->requisition_code):($remarks.','.date('d-m-Y').' - '.$_POST['reason'].' @ '.@$model->requisition->requisition->requisition_code);
					$labor->save(false);
				}

                //live
                /*$modelL = LaborRequisitionsLive::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$_POST['labor_id'],':req'=>$_POST['requisition_id']));
                if($modelL->delete()){
                    $laborL = LaboursLive::model()->findByPk($_POST['labor_id']);
                    $remarks = $laborL->remarks;
                    $laborL->remarks = ($remarks=='')?(date('d-m-Y').' - '.$_POST['reason'].' @ '.@$model->requisition->requisition->requisition_code):($remarks.','.date('d-m-Y').' - '.$_POST['reason'].' @ '.@$model->requisition->requisition->requisition_code);
                    $laborL->save(false);
                }*/
                $this->requisitionEmailRemoved(@$_POST['requisition_id']);
				echo json_encode(array('success'=>count($_POST['labor_id']).' applicants are removed from requisition.'));
			} else{
				echo json_encode(array('error'=>'Please select atleast one applicant.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}
	public function actionRemoverequisitionsdata(){
		if(!empty($_POST['requisition_id'])){
			if(!empty($_POST['labors'])){
				foreach($_POST['labors'] as $l):
					//$model = new LaborRequisitions;
					$model = LaborRequisitions::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
					$model->delete();

                    /*$modelL = LaborRequisitionsLive::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
                    $modelL->delete();*/
					
				endforeach;
                $this->requisitionEmailRemoved(@$_POST['requisition_id']);
				echo json_encode(array('success'=>count($_POST['labors']).' applicants are removed from requisition.'));
			} else{
				echo json_encode(array('error'=>'Please select atleast one applicant.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}
	public function actionSubmitfinalrequisitionsdata(){
		if(!empty($_POST['requisition_id'])){
			if(!empty($_POST['labors'])){
				foreach($_POST['labors'] as $l):
					/*$modelT = LaborRequisitionsTemp::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
					$modelT->status = 2;
					$modelT->save(false);*/
					$model = LaborRequisitions::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
					if(!$model){
						$model = new LaborRequisitions;
					}
					$model->labour_id = $l;
					$model->requisition_id = $_POST['requisition_id'];
					$model->accepted_date = NULL;
					$model->rejected_date = NULL;
					$model->reason = '';
					$model->status = 0;
					$model->createdOn = date('Y-m-d H:i:s');
					$model->save(false);


                    /*$modelL = LaborRequisitionsLive::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
                    if(!$modelL){
                        $modelL = new LaborRequisitionsLive;
                    }
                    $modelL->labour_id = $l;
                    $modelL->requisition_id = $_POST['requisition_id'];
                    $modelL->accepted_date = NULL;
                    $modelL->rejected_date = NULL;
                    $modelL->reason = '';
                    $modelL->status = 0;
                    $modelL->createdOn = date('Y-m-d H:i:s');
                    $modelL->save(false);*/

				endforeach;

        //member assigned email
        $this->requisitionEmail(@$_POST['requisition_id']);
				echo json_encode(array('success'=>count($_POST['labors']).' applicants are assigned to requisition.'));
			} else{
				echo json_encode(array('error'=>'Please select atleast one applicant.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}

	public function actionSubmitattandance(){
		if(!empty($_POST['requisition_id'])){
			if(!empty($_POST['labors'])){
				foreach($_POST['labors'] as $l):
					$d = LabourAttendances::model()->find('labour_id=:labor AND requisition_id = :id AND date = :date',array(':labor'=>$l,':id'=>$_POST['requisition_id'],':date'=>$_POST['date']));
					if(!$d){
						$model = new LabourAttendances;
						$model->labour_id = $l;
						$model->requisition_id = $_POST['requisition_id'];
						$model->date = $_POST['date'];
						$month = explode('-',$_POST['date']);
						$model->month = @$month[1];
						$model->save(false);
					}
				endforeach;
				echo json_encode(array('success'=>'Information updated successfully.'));
			} else{
				echo json_encode(array('error'=>'Please select atleast one applicant.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}

	public function actionsubmitdehire(){
		if(!empty($_POST['requisition_id'])){
			if(!empty($_POST['labors']) && !empty($_POST['date'])){
				foreach($_POST['labors'] as $l):
					$d = LaborRequisitions::model()->find('labour_id=:labor AND requisition_id = :id AND status = 1',array(':labor'=>$l,':id'=>$_POST['requisition_id']));
					if($d){
						$d->status = 3;
						$d->rejected_date = @$_POST['date'];//date('Y-m-d');
						$d->reason = 'Job Completed';
						$d->save(false);

                       /* $dLive = LaborRequisitionsLive::model()->find('labour_id=:labor AND requisition_id = :id AND status = 1',array(':labor'=>$l,':id'=>$_POST['requisition_id']));
						if($dLive){
                            $dLive->status = 3;
                            $dLive->rejected_date = @$_POST['date'];//date('Y-m-d');
                            $dLive->reason = 'Job Completed';
                            $dLive->save(false);
                        }*/
                        /*$lrt = LaborRequisitionsTemp::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$l));	
						$lrt->status = 3;
						$lrt->save(false);*/
						/*if($lrt){
							$lrt->delete();
						}*/
						$noti = new RequisitionNotifications;
						$noti->company_id = $d->requisition->requisition->company_id;
						$noti->requisition_id = $_POST['requisition_id'];
						$noti->text = $d->labour->full_name.' is dehired ,  requisition # <b>'.$d->requisition->requisition->requisition_code.'</b> on date '.date('Y-m-d').'.';
						$noti->status = 1;
						$noti->link = Yii::app()->baseUrl.'/requisitions/viewtemp/id/'.$d->requisition->requisition->id.'/type/'.$_POST['requisition_id'];
						$noti->createdOn = date('Y-m-d H:i:s');
						$noti->save(false);
					}
				endforeach;
                $this->requisitionEmailDone(@$_POST['requisition_id']);
				echo json_encode(array('success'=>'Information updated successfully.'));
			} else{
				echo json_encode(array('error'=>'Please select atleast one applicant or date must be filled.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}


	public function actionCancelreq(){
		
		if($_POST['requisition_id']){
			$model = ClientCompanyRequisitionDetails::model()->findByPk($_POST['requisition_id']);
			$model->status = 2;
			$model->remarks = $_POST['reason'];
			$model->person_id = Yii::app()->session['userModel']['user']['id'];
			$model->person = Yii::app()->session['userModel']['user']['userType'];
			$model->close_date = date('Y-m-d');
			$model->save(false);

            $modelL = ClientCompanyRequisitionDetailsLive::model()->findByPk($_POST['requisition_id']);
            $modelL->status = 2;
            $modelL->remarks = $_POST['reason'];
            $modelL->person_id = Yii::app()->session['userModel']['user']['id'];
            $modelL->person = Yii::app()->session['userModel']['user']['userType'];
            $modelL->close_date = date('Y-m-d');
            $modelL->save(false);

			if($model->laborRequisitions){
				foreach ($model->laborRequisitions as $key => $value) {
					if($value->status==4){
						$lr = LaborRequisitions::model()->findByPk($value->id);
						$lr->delete();
					}
				}
			}

            //live
            if($modelL->laborRequisitions){
                foreach ($modelL->laborRequisitions as $key => $value) {
                    if($value->status==4){
                        $lr = LaborRequisitionsLive::model()->findByPk($value->id);
                        $lr->delete();
                    }
                }
            }

            //live requisitions
            /*$modelL = ClientCompanyRequisitionDetailsLive::model()->findByPk($_POST['requisition_id']);
            $modelL->status = 2;
            $modelL->remarks = $_POST['reason'];
            $modelL->person_id = Yii::app()->session['userModel']['user']['id'];
            $modelL->person = Yii::app()->session['userModel']['user']['userType'];
            $modelL->close_date = date('Y-m-d');
            $modelL->save(false);
            if($modelL->laborRequisitions){
                foreach ($modelL->laborRequisitions as $key => $value) {
                    if($value->status==4){
                        $lr = LaborRequisitionsLive::model()->findByPk($value->id);
                        $lr->delete();
                    }
                }
            }*/
      
      //close requisition email
      $data['model'] = ClientCompanyRequisitionDetails::model()->findByPk($_POST['requisition_id']);
      $views = $this->renderPartial('//mail/closerequisition',$data,true);
      $req = ClientCompanyRequisitionDetails::model()->findByPk($_POST['requisition_id']);
        foreach($req->requisition->company->companypersons as $d):
        if($req->requisition->person_id == $d->id){
            $this->mailsend3($d->email_address,$d->name,'Requisition Closed',$views);  
        }
        endforeach;
      $this->mailsend('info@khushaalthar.com','KT Admin','Requisition Closed',$views);
			
      echo json_encode(array('success'=>'Information updated successfully.'));
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}


	public function actionChangestatus(){
		$model = clientCompanyRequisitionDetails::model()->findByPk($_POST['requisition_id']);
		$model->status = $_POST['status'];
		if($model->save(false)){
            $modelL = clientCompanyRequisitionDetailsLive::model()->findByPk($_POST['requisition_id']);
            $modelL->status = $_POST['status'];
            $modelL->save(false);
			echo json_encode(array('success'=>'Information updated successfully.'));
        }
		else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}




    public function actionRequisitionbystatus($status){
        $data['requisitions'] = clientCompanyRequisitionDetails::model()->findAll("status = $status");
        $this->render('statusList',$data);
    }
  public function actionFetchall(){
    
    switch ($_GET['order'][0]['column']) {
      case '0':
        $_GET['order'][0]['column'] = 't.id';
        break;
      case '1':
        $_GET['order'][0]['column'] = 't.id';
        break;
      case '2':
        $_GET['order'][0]['column'] = 'full_name';
        break;
      case '3':
        $_GET['order'][0]['column'] = 'cnic';
        break;
    case '7':
        $_GET['order'][0]['column'] = 'district.name';
        break;
    case '8':
        $_GET['order'][0]['column'] = 'designation';
        break;
      default:
        $_GET['order'][0]['column'] = 't.id';
        break;
    }
    $sort = $_GET['order'][0]['column'];
    $order = $_GET['order'][0]['dir'];
    if(empty($_GET['search']['value'])){
      $model = Labours::model()->with('district')->findAll(array(
          'condition'=>'t.status = 1',
          'order' => "$sort $order",
          'limit' =>$_GET['length'],
          'offset' => $_GET['start'],
      ));
      $student = Labours::model()->with('district')->findAll(array(
          'condition'=>'t.status = 1',
      ));
    } else{
      $model = Labours::model()->with('district')->findAll(array(
          'condition' => '(t.id LIKE  :id) OR (full_name LIKE  :name) OR (cnic LIKE :cnic) OR (mobile_number LIKE :number) OR (designation LIKE :design) AND t.status = 1',
          'params' => array(':id'=>$_GET['search']['value'],':name'=>$_GET['search']['value'].'%',':cnic'=>$_GET['search']['value'].'%',':design'=>'%'.$_GET['search']['value'].'%',':number'=>'%'.$_GET['search']['value'].'%'),
          'order' => "$sort $order",
          'limit' =>$_GET['length'],
          'offset' => $_GET['start'],
      ));
      $student = Labours::model()->with('district')->findAll(array(
          'condition' => '(t.id LIKE  :id) OR (full_name LIKE  :name) OR (cnic LIKE :cnic) OR (mobile_number LIKE :number) OR (designation LIKE :design) AND t.status = 1',
          'params' => array(':id'=>$_GET['search']['value'],':name'=>$_GET['search']['value'].'%',':cnic'=>$_GET['search']['value'].'%',':design'=>'%'.$_GET['search']['value'].'%',':number'=>'%'.$_GET['search']['value'].'%'),
      ));
    }
    
    $result = array();
    $i=0;
    $result['draw'] = $_GET['draw'];
    $result['recordsTotal'] = count($student);
    $result['recordsFiltered'] = count($student);
    $result['data'] = '';
    if($model){
      foreach($model as $m): 

        $lr = LaborRequisitions::model()->find('labour_id=:id AND status != 2 AND status != 3',array(':id'=>$m->id)); 
        $lrtr = LabourTraings::model()->with('training')->find('training.status = 0 AND t.labour_id=:id AND t.status = 0',array(':id'=>$m->id));
        if(empty($lr) && empty($tlr) && empty($lrtr)){ /*if(!$labor->traingsActive){*/
          $result['data'][$i][] = '<input type="checkbox" name="requisitionLabor[]" value="'.$m->id.'">';
          $result['data'][$i][]= '<a href="'.Yii::app()->baseUrl.'/labor/view/id/'.$m->id.'">'.$m->id.'</a>';//'<a target="_blank" href="'.Yii::app()->baseUrl.'/site/ApplicantView/id/'.$m->qr_code.'">'.$m->qr_code.'</a>';
          $result['data'][$i][]= '<a href="'.Yii::app()->baseUrl.'/labor/view/id/'.$m->id.'">'.$m->full_name.'</a>';//'<a target="_blank" href="'.Yii::app()->baseUrl.'/site/ApplicantView/id/'.$m->qr_code.'">'.$m->
          $result['data'][$i][]= $m->cnic;//str_replace('+92', '0',$m->mobile_number);
          if ($m->category_id == 1) {
                      $cat = 'Skilled';
                  } if ($m->category_id == 2) {
                      $cat = 'Unskilled';
                  }
          $result['data'][$i][]= $cat;//date('M d, h:i a',strtotime($m->created_on));
          $mob = explode(',',$m->mobile_number);
          $result['data'][$i][]= $mob[0];//($m->terms==1)?'Submitted':'Not submitted';
          $result['data'][$i][]= ($m->block_2 == 1) ? 'Yes' : 'No';//'<span class="bs-label label-'.$class.'">'.$status.'</span>';
          $result['data'][$i][]= @$m->district->name;//'<a target="_blank" href="'.Yii::app()->baseUrl.'/site/ApplicantView/id/'.$m->qr_code.'" class="pull-right"><span class="bs-label label-success">View</span></a>';
          $result['data'][$i][]= $m->designation;//'<a target="_blank" href="'.Yii::app()->baseUrl.'/admin/editstudent/id/'.$m->id.'" class="pull-right"><span class="bs-label label-success">Edit</span></a>';
          $i++;
        }
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