<?php

class LaborController extends Controller
{
	public function init()
    {
        $this->checkSession();
        $this->checkAdmin();
    }
	public function actionAdd()
	{
		
		$this->render('add');
	}

	public function actionIndex()
	{
		$this->render('index');
	}

	public function actionPrint($id)
	{
		if(!empty($id)){
			$data['model'] = Labours::model()->findByPk($id);
			$this->layout = 'print';
			$this->render('view',$data);	
		}
		
	}

	public function actionCard($id)
	{
		$data['model'] = Labours::model()->findByPk($id);
		$this->layout = 'card';
		$this->render('card',$data);
	}


	public function actionScan($id)
	{
		$data['model'] = Labours::model()->findByPk($id);
		$this->layout = 'scan';
		$this->render('scan',$data);
	}

	public function actionEdit($id)
	{
		$data['districts'] = Districts::model()->findAll();
		$data['tehsils'] = Tehsil::model()->findAll();
		$data['villages'] = Villages::model()->findAll();
		$data['labor'] = Labours::model()->findByPk($id);
		$data['vehicletypes'] = VehicleTypes::model()->findAll();
		$data['trainings'] = Trainings::model()->findAll();
		$this->layout = 'main';
		$this->render('edit',$data);
	}
	public function actionView($id)
	{
		$data['labor'] = Labours::model()->findByPk($id);
		$this->render('profile',$data);
	}

	public function actionViewrequisition($id){
		$data['model'] = LaborRequisitions::model()->findByPk($id);
		$data['detail'] = LaborRequisitionDetails::model()->find('labor_requisition_id=:id',array(':id'=>$id));
		
		$this->render('viewrequisition',$data);
	}
	
	public function actionCheckcnic(){
		$model = Labours::model()->find('cnic=:cnic',array(':cnic'=>$_POST['cnic']));
		if($model){
			echo json_encode(array('error'=>'CNIC already exist in database with form # <b>'.@$model->id.'</b>'));
		} else{
			echo json_encode(array('success'=>'successfully'));
		}
	}
	public function actionCheckdob(){
		
		$from = new DateTime($_POST['dob']);
		$to   = new DateTime('today');
		if($from->diff($to)->y >= 18){
			echo json_encode(1);
		} else{
			echo json_encode(0);
		}

		/*# procedural
		echo date_diff(date_create('1970-02-01'), date_create('today'))->y, "\n";*/
	}


	public function convertImage($string){

		$uploadFolder=getcwd().'/uploads/';
		
		$string = str_replace('data:image/jpeg;base64,', '', $string);
		$string = str_replace('data:image/png;base64,', '', $string);
		$string = str_replace('data:image/jpg;base64,', '', $string);
		$string = str_replace('data:image/x-icon;base64,', '', $string);
		$string = str_replace('data:image/gif;base64,', '', $string);
		$string = str_replace(' ', '+', $string);
		$data = base64_decode($string);
		$filename=uniqid().'.png';
		$file = $uploadFolder . $filename;
		//$success = file_put_contents($file, $data);
		if(file_put_contents($file, $data)){
			return $filename;
		}
	}

	
	public function actionSave($type,$step){
		if($type=='add'){
			if($step==2){
				$step=4;
			}
		}
		if(!empty($_POST['cnic']) && @$step==1){
			if($type=='add'){
				$model = new Labours;
			} else{
				$model = Labours::model()->findByPk($_POST['labor_id']);
				if(!$model){
					$model = new Labours;
				}	
			}
			
			//$model = new Labours;
			$_POST['mobile_number'] = implode(',', array_filter($_POST['mobile_number']));
			if($type=='add'){
				$_POST['full_name'] = @$_POST['first_name'].' '.@$_POST['middle_name'].' '.@$_POST['last_name'];	
			}
			if($type=='edit'){
				$_POST['full_name'] = @$_POST['full_name'];	
			}
			
			$model->attributes = $_POST;
			$dob = explode('-', @$_POST['dob']);
			$model->dob = @$dob[2].'-'.$dob[1].'-'.$dob[0];
			if(isset($_POST['avatar'])){
				$model->avatar = $this->convertImage(@$_POST['avatar']);	
			}
			if(@$_POST['block_2']==1){
				$model->district_id = '1';
				$model->tehsil_id = '1';
			}
			if($_POST['thumb']!=''){
				$model->thumb = $_POST['thumb'];	
			}
			$model->deo_id = Yii::app()->session['userModel']['user']['id'];
			$model->status = 1;
			//$model->remarks = @$_POST['remarks'];
			$model->createdOn = date('Y-m-d H:i:s');
			if($model->save()){
				if(@$model->drive==1){
					LabourDrivingLicenses::model()->deleteAll('labour_id=:id',array(':id'=>$model->id));
					$driving = new LabourDrivingLicenses;
					$driving->labour_id = $model->id;
					if(@$_POST['driving_license']==1){
						$driving->attributes = $_POST;	
					} else{
						//$driving->attributes = $_POST;
						$driving->vehicle_type = '';
						$driving->driving_license = 0;
						$driving->driving_license_number = '';
						$driving->issue_date = '';
						$driving->valid_upto = '';
						$driving->license_category = '';
						$driving->driving_license_expiry = '';
					}
					
					$driving->save(false);	
				} else{
					LabourDrivingLicenses::model()->deleteAll('labour_id=:id',array(':id'=>$model->id));
				}
				if(@$_POST['education_type_id']){
					//if(isset($_POST['degree'])){
						$keys = array_keys(@$_POST['degree']);
						LabourEducations::model()->deleteAll('labour_id=:id',array(':id'=>$model->id));
						$keyValue = 0;
						foreach(@$_POST['education_type_id'] as $index=>$education_type_id){
							if(!empty($education_type_id)){
								$educations = new LabourEducations;
								$educations->labour_id = $model->id;
								$educations->education_type_id = $education_type_id;
								$educations->board = @$_POST['board'][$index];
								$educations->passing_year = @$_POST['passing_year'][$index];
								$educations->organization_name = @$_POST['organization_name'][$index];
								$educations->degree = isset($_POST['degree'][$keyValue])?$_POST['degree'][$keyValue]:'0';
								$keyValue = @$keys[array_search($keyValue,$keys)+1];
								$educations->save(false);
							}
						}
					//}
				} else{
					LabourEducations::model()->deleteAll('labour_id=:id',array(':id'=>$model->id));
				}
				if(@$_POST['working']==1){
					LabourEmployments::model()->deleteAll('labour_id=:id',array(':id'=>$model->id));
					if(!empty($_POST['company_name'])){
						foreach(@$_POST['company_name'] as $index=>$source){
							if(!empty($source)){
								$employments = new LabourEmployments;
								$employments->labour_id = $model->id;;
								$employments->working = @$_POST['working'];
								$employments->source_of_income = '';
								$employments->company_name = @$source;
								$employments->from_date = (@$_POST['from_date'][$index])?@$_POST['from_date'][$index]:NULL;
								$employments->to_date = (@$_POST['till_date'][$index]==0)?((@$_POST['to_date'][$index])?@$_POST['to_date'][$index]:NULL):NULL;
								$employments->position = @$_POST['position'][$index];
								$employments->salary = @$_POST['salary'][$index];
								$employments->save(false);	
							}
						}	
					}
				} else{
					LabourEmployments::model()->deleteAll('labour_id=:id',array(':id'=>$model->id));
					$employments = new LabourEmployments;
					$employments->labour_id = $model->id;;
					$employments->working = 0;
					$employments->source_of_income = @$_POST['source_of_income'];
					$employments->from_date = NULL;
					$employments->to_date = NULL;
					$employments->save(false);	
				}
			} else{
				$error = '';
				foreach ($model->getErrors() as $key => $value) {
					$error .= $value[0].'</br>';
				}
				echo json_encode(array('error'=>$error));
				die;
			}
			if($_POST['labor_id']){
				$msg = 'Labor edited successfully';
				$this->editedLabor($model->id);
			} else{
				$msg = 'Labor registered successfully';
				$mobiles = explode(',',$model->mobile_number);
				$number = str_replace('-','', $mobiles[0]);
				$message = "خوشحال تھر آفیس تشریف لانے اور اپنی رجسڑئشن کروانے کا شکریہ۔
				آپ کی درخواست کا نمبر $model->id  ہے.
				اپنی درخواست کا اسٹیٹس جاننے کے لیے ابھی KT$model->id لکھ کر    8655   پر بھیج دیں۔";
				/*$url = 'http://pk.eocean.us/APIManagement/API/RequestAPI?user=Khushalthar&pwd=APvWYWVxBy8e9W8%2bCkcrkLMhHhltjZpX8D1Fy9XqDDgTq20XGxMLdSfcICiBGF9R2g%3d%3d&sender=KhushalThar&reciever='.@$number.'&msg-data='.urlencode($message).'&response=string';*/
				$url = 'http://pk.eocean.us/apimanagement/API/RequestAPI?user=khushalthar&pwd=AMCWNo7dIaDuDt%2bU8bAwro8KPsTjcc04R%2fPcKXxi2CTdcoyhkW%2bF28r06baGczi65w%3d%3d&sender=KhushalThar&reciever='.@$number.'&msg-data='.urlencode($message).'&response=string';
				$sms = @file_get_contents($url);
			}
			echo json_encode(array('success'=>$msg,'data'=>$model->attributes));
		} elseif($step==2){
			if(!empty($_POST['labor_id'])){
				$model = Labours::model()->findByPk($_POST['labor_id']);
				//HSE
				if(isset($_POST['hse'])){
					$hse = LabourHse::model()->find('labour_id=:id',array(':id'=>$_POST['labor_id']));
					if(!$hse){
						$hse = new LabourHse;
					}
					$hse->labour_id = $_POST['labor_id'];
					$hse->hse = isset($_POST['hse'])?$_POST['hse']:0;
					$hse->save(false);
				}
				 

				//Medical
				if(isset($_POST['medical'])){
					$medical = LabourMedical::model()->find('labour_id=:id',array(':id'=>$_POST['labor_id']));
					if(!$medical){
						$medical = new LabourMedical;
					}
					$medical->labour_id = $_POST['labor_id'];
					$medical->medical = isset($_POST['medical'])?$_POST['medical']:0;
					$medical->type = @$_POST['type'];
					$medical->result = @$_POST['result'];
					$medical->save(false); 
				}

				//Police
				if(isset($_POST['police'])){
					$police = LabourPolice::model()->find('labour_id=:id',array(':id'=>$_POST['labor_id']));
					if(!$police){
						$police = new LabourPolice;
					}
					$police->labour_id = $_POST['labor_id'];
					$police->police_verified = isset($_POST['police'])?$_POST['police']:0;
					$police->submitted_date = !empty($_POST['submitted_date'])?$_POST['submitted_date']:NULL;
					$police->cleared_date = !empty($_POST['cleared_date'])?$_POST['cleared_date']:NULL;
					$police->security_date = !empty($_POST['security_date'])?$_POST['security_date']:NULL;
					$police->save(false);
				}



				//skill
				if(!empty($_POST['skill_date']) && !empty($_POST['skill'])){
					$skill = new LabourSkillTest;
					$skill->labour_id = $_POST['labor_id'];
					$skill->score = $_POST['skill'];
					$skill->result = $_POST['skill'];
					$skill->date = $_POST['skill_date'];
					$skill->createdOn = date('Y-m-d H:i:s');
					$skill->save(false);
				}
				
				



				echo json_encode(array('success'=>'Information updated successfully','data'=>$model->attributes));
			}
		} elseif($step==3){
			$model = Labours::model()->findByPk($_POST['labor_id']);
			$training = LabourTraings::model()->find('labour_id=:id',array(':id'=>$_POST['labor_id']));
			if(!$training){
				$training = new LabourTraings;
			}
			$training->labour_id = $_POST['labor_id'];
			$training->traings = @$_POST['training'];
			$training->training_id = @$_POST['training_id'];
			$training->institute = @$_POST['institute'];
			$training->trade = @$_POST['trade'];
			$training->score = @$_POST['score'];
			$training->result = @$_POST['result'];
			$training->batch_number = @$_POST['batch_number'];
			$training->status = 1;
			$training->save(false);
			
			echo json_encode(array('success'=>'Information updated successfully','data'=>$model->attributes));
		} elseif($step==4){
			//$model = Labours::model()->findByPk($_POST['labor_id']);
			//echo json_encode(array('success'=>'Information updated successfully','data'=>$model->attributes));
			echo json_encode(array('success'=>'Information updated successfully'));
		} else{
			echo json_encode(array('error'=>'CNIC field required.'));
		}
	}


	public function actiondeactivate(){
		if(!empty($_POST['reason'])){
			$id = $_POST['labor_id'];
			$model = Labours::model()->findByPk($id);
			if($model){
				if($model->status==0){
					$model->remarks = $model->remarks.', '.date('d-m-Y').'- Activated - '.@$_POST['reason'];
					$model->status = 1;
					$model->save(false);
				} else if($model->status==5){
					$model->remarks = $model->remarks.', '.date('d-m-Y').'- Activated - '.@$_POST['reason'];
					$model->status = 1;
					$model->save(false);
				} else{
					$this->deactivateLabor($id,'deactivate labor');
					$model->remarks = $model->remarks.', '.date('d-m-Y').'- Deactivated - '.@$_POST['reason'];
					$model->status = 0;
					$model->save(false);
				}
				echo json_encode(array('success'=>'Information updated successfully'));
			} else{
				echo json_encode(array('error'=>'something went wrong.'));	
			}	
		} else{
			echo json_encode(array('error'=>'Reason must be entered.'));	
		}
	}

	public function actionBlklist(){
		if(!empty($_POST['reason'])){
			$id = $_POST['labor_id'];
			$model = Labours::model()->findByPk($id);
			if($model){
				$this->deactivateLabor($id,'blacklist labor');
				$model->remarks = $model->remarks.', '.date('d-m-Y').'- Blacklist - '.@$_POST['reason'];
				$model->status = 5;
				$model->save(false);
				echo json_encode(array('success'=>'Information updated successfully'));
			} else{
				echo json_encode(array('error'=>'something went wrong.'));	
			}	
		} else{
			echo json_encode(array('error'=>'Reason must be entered.'));	
		}
	}

	public function actionUploaddocuments(){
		if(!empty($_FILES['file']['name'])){
			$uploadFolder=getcwd().'/uploads/';
			if(move_uploaded_file($_FILES['file']['tmp_name'],$uploadFolder.$_POST['labor_id'].'_'.$_FILES['file']['name'])){
				$model = new LabourDocuments;
				$model->labour_id = @$_POST['labor_id'];
				$model->document_type = 'scan';
				$model->name = $_FILES['file']['name'];
				$model->file = $_POST['labor_id'].'_'.$_FILES['file']['name'];
				$model->save(false);
			}
		}
	}

	public function actionViewpdf($id,$type){
		if($type=='training'){
			$labor = Labours::model()->findByPk($id);
			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                            'L', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("ENGRO");
            $pdf->SetTitle("Applicant Training Report");
            $pdf->SetSubject("Applicant Training Report");
            $pdf->SetKeywords("Applicant Training,Report,");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            $pdf->SetFont("times", "N", 9);


            $html='<style>.table-pdf td{text-align:center;font-weight:normal;vertical-align:middle;font-style:normal;padding:10px}</style>';
            //generate report data
            
            $html .= '<table class="table-pdf" border="1">';
            $html .= '<tr><td colspan="9" style="text-align:center">'.$labor->full_name.' Training Report</td></tr>';
            
            $html .= '<tr><td colspan="9"></td></tr>';
            $html .= '<tr><td >ID</td><td>Name</td><td>Type</td><td>Batch No.</td><td>Start Date</td><td>End Date</td><td>Status</td><td>Score</td><td>Result</td></tr>';
            if($labor->traings){
            	foreach($labor->traings as $d){ 
	              //foreach($requisition->clientCompanyRequisitionDetails as $d){
	                $html .= '<tr><td >'.$d->training->id.'</td><td>'.$d->training->institute_name.'</td><td>'.$d->training->training_type.'</td><td>'.$d->training->batch_no.'</td><td>'.$d->training->start_date.'</td><td>'.$d->training->end_date.'</td><td>'.(($d->training->status==0)?'Open':'End').'</td><td>'.$d->score.'</td><td>'.$d->result.'</td></tr>'; 
                }
            }

            $html .= '</table>';
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
		} 
		if($type=='work'){
			$labor = Labours::model()->findByPk($id);
			$pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 
                            'L', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("ENGRO");
            $pdf->SetTitle("Applicant Training Report");
            $pdf->SetSubject("Applicant Training Report");
            $pdf->SetKeywords("Applicant Training,Report,");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            $pdf->SetFont("times", "N", 9);


            $html='<style>.table-pdf td{text-align:center;font-weight:normal;vertical-align:middle;font-style:normal;padding:10px}</style>';
            //generate report data
            
            $html .= '<table class="table-pdf" border="1">';
            $html .= '<tr><td colspan="7" style="text-align:center">'.$labor->full_name.' Requisition Report</td></tr>';
            
            $html .= '<tr><td colspan="7"></td></tr>';
			$html .= '<tr><td >Company Name</td><td>Requisition #</td><td>Date From</td><td>Date End</td><td>Accepted Date</td><td>Rejected/Release Date</td><td>Remarks</td></tr>';
            if($labor->laborRequisitions){
            	foreach($labor->laborRequisitions as $lr){ 
            		$status = '';
            		if(@$lr->status==0){ $status = 'Pending';} if(@$lr->status==1){ $status = 'Accepted';} if(@$lr->status==2){ $status = 'Rejected<br/>'.$lr->reason;}if(@$lr->status==3){ $status = 'Job Completed';}if(@$lr->status==4){ $status = 'Temporary';}
	              //foreach($requisition->clientCompanyRequisitionDetails as $d){
	                $html .= '<tr><td >'.ucfirst(@$lr->requisition->requisition->company->company_name).'</td><td>'.@$lr->requisition->requisition->requisition_code.'</td><td>'.(date('d M,Y',strtotime(@$lr->requisition->date_from))).'</td><td>'.(date('d M,Y',strtotime(@$lr->requisition->date_to))).'</td><td>'.((@$lr->accepted_date)?(date('d M,Y',strtotime(@$lr->accepted_date))):'-').'</td><td>'.((@$lr->rejected_date)?(date('d M,Y',strtotime(@$lr->rejected_date))):'-').'</td><td>'.($status).'</td></tr>'; 
                }
            }

            $html .= '</table>';
            //echo $html;exit;
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
		}
	}


	public function actionDeleteskill($id){
		$model = LabourSkillTest::model()->findByPk($id);
		if($model){
			$model->delete();
			echo json_encode(array('success'=>'Information updated successfully.'));	
		} else{
			echo json_encode(array('error'=>'No data found.'));	
		}
	}

	public function actionDeletefile($id){
		
		$model = LabourDocuments::model()->findByPk($id);
		if($model){
			$uploadFolder=getcwd().'/uploads/';
			@unlink($uploadFolder.$model->labour_id.'_'.$model->name);
			$model->delete();
			
			echo json_encode(array('success'=>'Information updated successfully.'));	
		} else{
			echo json_encode(array('error'=>'No data found.'));	
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