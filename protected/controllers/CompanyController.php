<?php

class CompanyController extends Controller
{
	public function init()
    {
        $this->checkSession();
    }
	public function actionAdd()
	{
		$this->render('add');
	}

	public function actionIndex()
	{
		$this->checkAdmin();
		$data['companies'] = ClientCompanies::model()->findAll();
		$this->render('index',$data);
	}

	public function actionView($id)
	{
		$this->checkAdmin();
		$data['company'] = ClientCompanies::model()->findByPk($id);
		$this->render('view',$data);
	}
	public function actionEdit($id)
	{
		$this->checkAdmin();
		$data['company'] = ClientCompanies::model()->findByPk($id);
		$this->render('edit',$data);
	}

	public function actionRequisitions(){
		$length = 10;
        $chars2 = array_merge(range(0, 9), range('A', 'Z'));
        shuffle($chars2);
        if(Yii::app()->session['userModel']['user']['userType']=='company'){
        	$company = ClientCompanies::model()->findByPk($id);
			if($company){
				$clientcompanyRequisitions = ClientCompanyRequisitions::model()->count('company_id=:id',array(':id'=>Yii::app()->session['userModel']['user']['id']));	
				$cal = 	$company->allied_to;
				if($company->code_format){
					$hash = $company->code_format.sprintf('%03d', ($clientcompanyRequisitions==0)?1:$clientcompanyRequisitions+1);
				} else{
					if($cal==1){
						$hash = 'KT / M / '.sprintf('%03d', ($clientcompanyRequisitions==0)?1:$clientcompanyRequisitions+1);
					}
					if($cal==2){
						$hash = 'KT / P / '.sprintf('%03d', ($clientcompanyRequisitions==0)?1:$clientcompanyRequisitions+1);
					}	
				}
				
			}
        	
        } else{
        	$person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']); 
        	if($person){
        		$cal = $person->company->allied_to;
        		$clientcompanyRequisitions = ClientCompanyRequisitions::model()->count('company_id=:id',array(':id'=>$person->company_id));	
        		if($person->company->code_format){
					$hash = $person->company->code_format.sprintf('%03d', ($clientcompanyRequisitions==0)?1:$clientcompanyRequisitions+1);
				} else{
					if($cal==1){
						$hash = 'KT / M / '.sprintf('%03d', ($clientcompanyRequisitions==0)?1:$clientcompanyRequisitions+1);
					}
					if($cal==2){
						$hash = 'KT / P / '.sprintf('%03d', ($clientcompanyRequisitions==0)?1:$clientcompanyRequisitions+1);
					}	
				}

        	}
        }
        $data['hash'] = $hash;
        $data['deo'] = CompanyPersons::model()->findAll('company_id=:id',array(':id'=>Yii::app()->session['userModel']['user']['id'])); 
 		$this->render('addrequisition',$data);
	}

	public function actionAllrequisitions(){

		if(Yii::app()->session['userModel']['user']['userType']=='deo'){
			$data['clientcompanyRequisitions'] = ClientCompanyRequisitions::model()->findAll(array('order'=>'id DESC'));	
		} else if(Yii::app()->session['userModel']['user']['userType']=='person'){
			$person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);
			if($person){
				$data['clientcompanyRequisitions'] = ClientCompanyRequisitions::model()->findAll('company_id=:id',array(':id'=>$person->company_id),array('order'=>'id DESC'));	
			}
			
		} else{
			$data['clientcompanyRequisitions'] = ClientCompanyRequisitions::model()->findAll('company_id=:id',array(':id'=>Yii::app()->session['userModel']['user']['id']),array('order'=>'id DESC'));
		}
		
		$this->render('requisitionIndex',$data);
	}

	function emptyElementExists($arr) {
	  return array_search("", $arr) !== false;
	}

	public function actionSubmitreq(){
		//print_r($_POST);die;
		if(!empty(@$_POST['requisition_code'])){
				if(!empty($_POST['type']) && $this->emptyElementExists($_POST['date_required'])==FALSE && $this->emptyElementExists($_POST['skilled'])==FALSE && $this->emptyElementExists($_POST['head'])==FALSE && $this->emptyElementExists($_POST['type'])==FALSE){

						$model = new ClientCompanyRequisitions;
						if(Yii::app()->session['userModel']['user']['userType']=='person'){
							$person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);
							$model->company_id = $person->company_id;
						} else{
							$model->company_id = Yii::app()->session['userModel']['user']['id'];	
						}
						
						$model->requisition_code = $_POST['requisition_code'];
						$model->person_id = $_POST['deo_id'];
						$model->status = 0;
						$model->createdOn = date('Y-m-d H:i:s');
						if($model->save()){
							$tcount = 0;
							foreach($_POST['type'] as $index => $t){
								$req = new ClientCompanyRequisitionDetails;
								$req->requisition_id = $model->id;
								$req->type = $t;
								$req->skill = $_POST['skilled'][$tcount];
								$req->count = $_POST['head'][$tcount];
								$req->date_from = $_POST['date_required'][$tcount];
								$req->date_to = $_POST['date_till'][$tcount];
								$req->status = 1;
								$req->save(false);
								$tcount++;	
							}


							//live
							$modelL = new ClientCompanyRequisitionsLive;
							if(Yii::app()->session['userModel']['user']['userType']=='person'){
								$person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);
								$modelL->company_id = $person->company_id;
							} else{
								$modelL->company_id = Yii::app()->session['userModel']['user']['id'];	
							}
							
							$modelL->requisition_code = $_POST['requisition_code'];
							$modelL->person_id = $_POST['deo_id'];
							$modelL->status = 0;
							$modelL->createdOn = date('Y-m-d H:i:s');
							if($modelL->save(false)){
								$tcount = 0;
								foreach($_POST['type'] as $index => $t){
									$reqL = new ClientCompanyRequisitionDetailsLive;
									$reqL->requisition_id = $modelL->id;
									$reqL->type = $t;
									$reqL->skill = $_POST['skilled'][$tcount];
									$reqL->count = $_POST['head'][$tcount];
									$reqL->date_from = $_POST['date_required'][$tcount];
									$reqL->date_to = $_POST['date_till'][$tcount];
									$reqL->status = 1;
									$reqL->save(false);
									$tcount++;	
								}
							}
							$noti = new RequisitionNotifications;
							$noti->company_id = $model->company_id;
							$noti->requisition_id = $model->id;
							$noti->text = $model->company->company_name.' has raised new requisition # <b>'.$model->requisition_code.'</b>.';
							$noti->status = 1;
							$noti->createdOn = date('Y-m-d H:i:s');
							$noti->link = Yii::app()->baseUrl.'/requisitions/view/id/'.$model->id;
							$noti->save(false);
							//$this->requisitionEmail($model->id);
							
							//requisition email
							$data['model'] = ClientCompanyRequisitionDetails::model()->findAll('requisition_id=:id',array(':id'=>$model->id));
							$views = $this->renderPartial('//mail/ktrequisition',$data,true);
							$this->mailsend('info@khushaalthar.com','KT Admin','New Requisition by Client',$views);
							

							/*$data['model'] = ClientCompanyRequisitionDetails::model()->findAll('requisition_id=:id',array(':id'=>$model->id));
							$views = $this->renderPartial('//mail/ktrequisition',$data,true);
							$this->mailsend('zafarimemon@gmail.com','KT Admin','New Requisition by Client',$views);*/


							//client company user email
							if(Yii::app()->session['userModel']['user']['userType']=='person'){
								$person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);

								$views = $this->renderPartial('//mail/clientrequisition',$data,true);
								$this->mailsend3(@$person->email_address,@$person->name,'New Requisition',$views);
							}
							echo json_encode(array('success'=>'Information updated successfully.'));
						} else{
							$error = '';
							foreach ($model->getErrors() as $key => $value) {
								$error .= $value[0].'</br>';
							}
							echo json_encode(array('error'=>$error));
							
						}
			} else{
				echo json_encode(array('error'=>'All fields are required.'));
			}
		} else{
			echo json_encode(array('error'=>'please fill required field'));
		}
	}

	public function actionOnboard(){
		$person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);
    	$data['company_id'] = $person->company_id;
		$this->render('onboard',$data);
	}



	public function actionDeosubmit(){
		if(!empty($_POST['cnic'])){
			$length = 10;
	        $chars2 = array_merge(range(0, 9), range('A', 'Z'));
	        shuffle($chars2);
			$model = new CompanyPersons;
			$model->attributes = $_POST;
			$model->code = implode(array_slice($chars2, 0, $length));
			$model->password = md5($_POST['password']);
			$model->status = 1;
			$model->createdOn = date('Y-m-d H:i:s');
			$model->save(false);
			echo json_encode(array('success'=>'Information updated successfully'));
		} else{
			echo json_encode(array('error'=>'please fill required field'));
		}
	}
	public function actionCheckdeocnic(){
		$model = CompanyDeos::model()->find('cnic=:cnic',array(':cnic'=>$_POST['cnic']));
		if($model){
			echo json_encode(1);
		} else{
			echo json_encode(0);
		}
	}

	public function actionSubmit(){
		if(/*!empty($_POST['client_code']) && !empty($_POST['company_email']) &&*/ !empty(@$_POST['allied_to']) ){
			$length = 10;
			$error = '';
	        $chars2 = array_merge(range(0, 9), range('A', 'Z'));
	        shuffle($chars2);
	        
			if(isset($_POST['id'])){
				$model = ClientCompanies::model()->findByPk($_POST['id']);
			} else{
				$model = new ClientCompanies;
			}
			$model->attributes = $_POST;
			if(!isset($_POST['id'])){
				$model->password = md5(12345);
			}
			
			$model->client_code = implode(array_slice($chars2, 0, $length));
			$model->status = 1;
			$model->createdOn = date('Y-m-d H:i:s');
			if($model->save()){
				foreach($_POST['company']['name'] as $index=>$c){
					$length = 10;
			        $chars2 = array_merge(range(0, 9), range('A', 'Z'));
			        shuffle($chars2);
			       	if(!empty($_POST['company']['name'][$index])){
			       		if(isset($_POST['company']['id'][$index])){
							$modelP = CompanyPersons::model()->findByPk($_POST['company']['id'][$index]);
						} else{
							$modelP = new CompanyPersons;
						}
			        	//$modelP = new CompanyPersons;
						$modelP->company_id = $model->id;
						$modelP->code = implode(array_slice($chars2, 0, $length));
						$modelP->name = $_POST['company']['name'][$index];
						$modelP->email_address = $_POST['company']['email_address'][$index];
						if(!isset($_POST['company']['id'][$index])){
							$modelP->password = md5($_POST['company']['password'][$index]);
						}
						$modelP->cnic = $_POST['company']['cnic'][$index];
						$modelP->mobile_number = $_POST['company']['mobile_number'][$index];
						$modelP->designation = $_POST['company']['designation'][$index];
						$modelP->status = 1;
						$modelP->createdOn = date('Y-m-d H:i:s');;	
						$modelP->expire = date('Y-m-d', strtotime("+30 days"));
						if($modelP->save(false)){
							$error = 1;//echo json_encode(array('success'=>'Update information successfully.'));
						} else{
							$error = '';
							foreach ($modelP->getErrors() as $key => $value) {
								$error .= $value[0].'</br>';
							}
							echo json_encode(array('error'=>$error));
							die;
						}
					}
				}
				if($error==1){
					echo json_encode(array('success'=>'Update information successfully.'));	
					die;
				}
			} else{
				$error = '';
				foreach ($model->getErrors() as $key => $value) {
					$error .= $value[0].'</br>';
				}
				echo json_encode(array('error'=>$error));
			}
		} else{
			echo json_encode(array('error'=>'please fill required field'));
		}
	}

	public function actionReport(){
		$data['company'] = ClientCompanies::model()->findAll();

		if(isset($_REQUEST['submit'])){
			$criteria = new CDbCriteria;
			//if value is TRUE
			if(@$_REQUEST['company_id']){
				$criteria->addCondition("requisition.company_id = {$_REQUEST['company_id']}");	
			}
			if(@$_REQUEST['type']){
				$criteria->addCondition("t.type = {$_REQUEST['type']}");	
			}
			if(@$_REQUEST['skill']){
				$criteria->addCondition("t.skill LIKE '%{$_REQUEST['skill']}%'");	
			}
			if(@$_REQUEST['date_from']){
				$criteria->addCondition("requisition.createdOn >= '{$_REQUEST['date_from']} 01:00:00'");	
			}
			if(@$_REQUEST['date_end']){
				$criteria->addCondition("requisition.createdOn <= '{$_REQUEST['date_end']} 23:59:00'");	
			}

			if(@$_REQUEST['status']){
				if(@$_REQUEST['status']!='all'){
					$criteria->addCondition("t.status = '{$_REQUEST['status']}'");		
				}
				
			}
			$data['requisitions'] = ClientCompanyRequisitionDetails::model()->with('requisition')->findAll($criteria);
		}
		if(isset($_REQUEST['pdf'])){
			$criteria = new CDbCriteria;
			//if value is TRUE
			if(@$_REQUEST['company_id']){
				$criteria->addCondition("requisition.company_id = {$_REQUEST['company_id']}");	
			}
			if(@$_REQUEST['type']){
				$criteria->addCondition("t.type = {$_REQUEST['type']}");	
			}
			if(@$_REQUEST['skill']){
				$criteria->addCondition("t.skill LIKE '%{$_REQUEST['skill']}%'");	
			}
			if(@$_REQUEST['date_from']){
				$criteria->addCondition("requisition.createdOn >= '{$_REQUEST['date_from']} 01:00:00'");	
			}
			if(@$_REQUEST['date_end']){
				$criteria->addCondition("requisition.createdOn <= '{$_REQUEST['date_end']} 23:59:00'");	
			}
			if(@$_REQUEST['status']){
				if($_REQUEST['status']!='all'){
					$criteria->addCondition("t.status = '{$_REQUEST['status']}'");		
				}
			}
			$company = ClientCompanyRequisitionDetails::model()->with('requisition')->findAll($criteria);


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
                if($d->laborRequisitions){
                	$html .= '<tr><td colspan="11">Applicants Detail</td></tr>';
                	$html .= '<tr><td>ID</td><td colspan="2">Name</td><td colspan="2">Father Name</td><td>CNIC</td><td>Number</td><td>Work Status</td><td>Accepted Date</td><td>Rejected/Release Date</td><td>Reason</td></tr>';
                	foreach($d->laborRequisitions as $lr){
                		if($lr->status==0){
		                  $status="Pending";
		                }
		                if($lr->status==1){
		                  $status="Accepted";
		                }
		                if($lr->status==2){
		                  $status="Rejected";
		                }
		                if($lr->status==3){
	                      $statuss="Job Completed";
	                    }
		                if($lr->status==4){
	                      $statuss="Temporary";
	                    }
                		$html .= '<tr><td>'.$lr->labour->id.'</td>';
                		$html .= '<td colspan="2">'.$lr->labour->full_name.'</td>';
                		$html .= '<td colspan="2">'.$lr->labour->father_name.'</td>';
                		$html .= '<td>'.$lr->labour->cnic.'</td>';
                		$html .= '<td>'.$lr->labour->mobile_number.'</td>';
                		$html .= '<td>'.$status.'</td>';
                		$html .= '<td>'.$lr->accepted_date.'</td>';
                		$html .= '<td>'.$lr->rejected_date.'</td>';
                		$html .= '<td>'.$lr->reason.'</td></tr>';
                	}
                	$html .= '<tr><td colspan="11"></td></tr>';
            	};
              //}
            }

            $html .= '</table>';
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
		}

		if(isset($_REQUEST['excel'])){
			$criteria = new CDbCriteria;
			//if value is TRUE
			if(@$_REQUEST['company_id']){
				$criteria->addCondition("requisition.company_id = {$_REQUEST['company_id']}");	
			}
			if(@$_REQUEST['type']){
				$criteria->addCondition("t.type = {$_REQUEST['type']}");	
			}
			if(@$_REQUEST['skill']){
				$criteria->addCondition("t.skill LIKE '%{$_REQUEST['skill']}%'");	
			}
			if(@$_REQUEST['date_from']){
				$criteria->addCondition("requisition.createdOn >= '{$_REQUEST['date_from']} 01:00:00'");	
			}
			if(@$_REQUEST['date_end']){
				$criteria->addCondition("requisition.createdOn <= '{$_REQUEST['date_end']} 23:59:00'");	
			}
			if(@$_REQUEST['status']){
				if($_REQUEST['status']!='all'){
					$criteria->addCondition("t.status = '{$_REQUEST['status']}'");		
				}
			}
			$company = ClientCompanyRequisitionDetails::model()->with('requisition')->findAll($criteria);


			Yii::import('ext.phpexcel.XPHPExcel');      
          $objPHPExcel = XPHPExcel::createPHPExcel();
          // Set properties
          $objPHPExcel->getProperties()->setCreator("ENGRO KT");
          $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
          $objPHPExcel->getProperties()->setTitle("Requisition Report");
          $objPHPExcel->getProperties()->setSubject("Requisition Report");
          $objPHPExcel->getProperties()->setDescription("Requisition Report");
          
          // Active sheet
          $sheet1=$objPHPExcel->setActiveSheetIndex(0);
          $count = 6;
          $headAlpha=0;
          $sheet1->setCellValue('C2', 'All Requisitions');
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
			$sheet1->setCellValue('X3', 'Martial Status');
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
			$sheet1->setCellValue('BN3', 'Certificate');


			$sheet1->getStyle("B3:BN3")->applyFromArray(array("font" => array( "bold" => true)));


			for($col = 'B'; $col !== 'BN'; $col++) {
				$objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
			}
          
          
		$count = 5;
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
	        
	        if($d->laborRequisitions){
	        	foreach($d->laborRequisitions as $lr){
	        	    
		            
					$sheet1->setCellValue("B$count", $lr->requisition->requisition->requisition_code);
					$sheet1->setCellValue("C$count", (ucfirst($lr->requisition->requisition->company->company_name).' ('.$alliedto).')');
					$sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
					$sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
					$sheet1->setCellValue("F$count", date('d M,Y',strtotime($lr->requisition->requisition->createdOn)));
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
					$sheet1->setCellValue("X$count", (@$lr->labour->martial_status==1)?'Married':'Single');
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
					}
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
          $sheet1->setTitle('Requisition Report');
          /*$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          $file = getcwd().'\uploads\rreport.xlsx';
          $objWriter->save($file);
          echo "<script type='text/javascript'>window.location='".Yii::app()->baseUrl."/uploads/rreport.xlsx';</script>";*/
          $filename = 'requisitionreport.xlsx';
          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment;filename={$filename}");
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
          die;
		}
		$this->render('report',$data);	
	}

	public function actionViewreport($id,$type){
			
            $company = ClientCompanies::model()->findByPk($id);
		if($type=='requisition'){
			$labor = Labours::model()->findByPk($id);
			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                            'L', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("ENGRO");
            $pdf->SetTitle("Client Compnay Requisition Report");
            $pdf->SetSubject("Client Compnay Requisition Report");
            $pdf->SetKeywords("Client Compnay Requisition,Report,");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            $pdf->SetFont("times", "N", 9);


            $html='<style>.table-pdf td{text-align:center;font-weight:normal;vertical-align:middle;font-style:normal;padding:10px}</style>';
            //generate report data
            
            $html .= '<table class="table-pdf" border="1">';
            $html .= '<tr><td colspan="10" style="text-align:center">Client Compnay Requisition Report</td></tr>';
            
            $html .= '<tr><td colspan="10"></td></tr>';
            $html .= '<tr><td >Company Name</td ><td >Company Person</td ><td >Company Person Number</td ><td >Requisition Code</td><td>Type</td><td>Skill</td><td>Head Count</td><td>Start Date</td><td>End Date</td><td>Status</td></tr>';
            foreach(@$company->companyRequisitions as $compr):$models = ClientCompanyRequisitionDetails::model()->findAll('requisition_id =:req',array(':req'=>$compr->id)); foreach($models as $ind=>$m):
	            	if(@$m->status==0){
	                $status = 'Pending';
	              }
	              if(@$m->status==1){
	                $status = 'Open';
	              }
	              if(@$m->status==2){
	                $status = 'Closed';
	              }
	              if(@$m->status==3){
	                $status = 'Under discussion';
	              }
	              if(@$m->status==4){
	                $status = 'In Process';
	              }
	              if(@$m->status==5){
	                $status = 'Rejected';
	              }
					$html .= '<tr>';
	              $html .= '<td>'.@$compr->company->company_name.'</td>';
	              $html .= '<td>'.@$compr->person->name.'</td>';
	              $html .= '<td>'.@$compr->person->mobile_number.'</td>';
	              $html .= '<td>'.@$compr->requisition_code.'</td>';
	              $html .= '<td>'.((@$m->type==1)?'Skilled':'Unskilled').'</td>';
	              $html .= '<td>'.@$m->skill.'</td>';
	              $html .= '<td>'.@$m->count.'</td>';
	              $html .= '<td>'.date('d M,Y',strtotime($m->date_from)).'</td>';
	              $html .= '<td>'.date('d M,Y',strtotime($m->date_to)).'</td>';
	              $html .= '<td>'.@$status.'</td></tr>';
	              endforeach;
	        endforeach;
            $html .= '</table>';
            
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
		}
		if($type=='person'){
			$labor = Labours::model()->findByPk($id);
			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                            'L', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("ENGRO");
            $pdf->SetTitle("Client Compnay Requisition Report");
            $pdf->SetSubject("Client Compnay Requisition Report");
            $pdf->SetKeywords("Client Compnay Requisition,Report,");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            $pdf->SetFont("times", "N", 9);


            $html='<style>.table-pdf td{text-align:center;font-weight:normal;vertical-align:middle;font-style:normal;padding:10px}</style>';
            //generate report data
            
            $html .= '<table class="table-pdf" border="1">';
            $html .= '<tr><td colspan="6" style="text-align:center">Client Compnay Person Report</td></tr>';
            
            
            $html .= '<tr><td colspan="6"></td></tr>';
            $html .= '<tr><td >Company Name</td ><td >Person Name</td><td>Email</td><td>CNIC</td><td>Designation</td><td>Mobile Number</td></tr>';
            foreach(@$company->companypersons as $deos):
	            $html .= '<tr>';
	              $html .= '<td>'.$deos->company->company_name.'</td>';
	              $html .= '<td>'.$deos->name.'</td>';
	              $html .= '<td>'.$deos->email_address.'</td>';
	              $html .= '<td>'.$deos->cnic.'</td>';
	              $html .= '<td>'.$deos->designation.'</td>';
	              $html .= '<td>'.$deos->mobile_number.'</td></tr>';
	        endforeach;
            $html .= '</table>';
            
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
		}
	}


	public function actionDeactivate(){
		if(!empty($_POST['reason'])){
			$id = $_POST['company_id'];
			$model = ClientCompanies::model()->findByPk($id);
			if($model){
				if($model->companyRequisitions){
					foreach($model->companyRequisitions as $cr){
						if($cr->clientCompanyRequisitionDetails){
							foreach($cr->clientCompanyRequisitionDetails as $crd){
								if($crd->laborRequisitions){
									foreach($crd->laborRequisitions as $crdl){
										$d = LaborRequisitions::model()->findByPk($crdl->id);
										if($d->status==0){
											$d->status = 3;	
											$d->reason = 'Company deactivated';	
										}
										if($d->status==1){
											$d->status = 3;	
											$d->reason = 3;	
										}
										if($d->status==1){
											$d->status = 3;	
										}
										if($d->status==1){
											$d->status = 3;	
										}
										
										$d->save(false);
										$lrt = LaborRequisitionsTemp::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$crdl->requisition_id,':labour'=>$crdl->labour_id));	
										if($lrt){
											$lrt->delete();
										}
										$noti = new RequisitionNotifications;
										$noti->company_id = $id;
										$noti->requisition_id = $crdl->requisition_id;
										$noti->text = $crdl->labour->full_name.' is dehired ,  requisition # <b>'.$crdl->requisition->requisition->requisition_code.'</b> on date '.date('Y-m-d').'.';
										$noti->status = 1;
										$noti->createdOn = date('Y-m-d H:i:s');
										$noti->link = Yii::app()->baseUrl.'/requisitions/viewtemp/id/'.$crdl->requisition->requisition->id.'/type/'.$crdl->requisition_id;
										$noti->save(false);
									}
								}
								$crd->status = 2;
								$crd->remarks = $_POST['reason'];
								$crd->person_id = Yii::app()->session['userModel']['user']['id'];
								$crd->person = Yii::app()->session['userModel']['user']['userType'];
								$crd->close_date = date('Y-m-d');
								$crd->save(false);
							}
						}
						
					}
				}
				if($model->companypersons){
					foreach($model->companypersons as $cp){
						$modelP = CompanyPersons::model()->findByPk($cp->id);
						$modelP->status = 0;
						$modelP->save(false);
					}
				}
				$model->status = 0;
				$model->save(false);
				echo json_encode(array('success'=>'Information updated successfully'));
			} else{
				echo json_encode(array('error'=>'something went wrong.'));	
			}	
		} else{
			echo json_encode(array('error'=>'Reason must be entered.'));	
		}
	}

	public function actionActivate(){
		if(!empty($_POST['reason'])){
			$id = $_POST['company_id'];
			$model = ClientCompanies::model()->findByPk($id);
			if($model){
				$model->status = 1;
				$model->save(false);
				foreach($model->companypersons as $cp){
					$modelP = CompanyPersons::model()->findByPk($cp->id);
					$modelP->status = 1;
					$modelP->save(false);
				}
				echo json_encode(array('success'=>'Information updated successfully'));
			} else{
				echo json_encode(array('error'=>'something went wrong.'));	
			}
		} else{
			echo json_encode(array('error'=>'Reason must be entered.'));	
		}
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