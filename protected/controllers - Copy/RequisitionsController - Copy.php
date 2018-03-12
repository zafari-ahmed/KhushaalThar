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
			if(Yii::app()->session['userModel']['user']['userType']=='company'){
				$data['model'] = LaborRequisitions::model()->findAll('requisition_id=:id',array(':id'=>$type));
				$data['detail_id'] = $type;
				$criteria = new CDbCriteria;
				$criteria->addCondition("t.id = '{$id}'");	
				$criteria->addCondition("clientCompanyRequisitionDetails.id = '{$type}'");	
				$data['company'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria);

				$this->render('laborRequisitions',$data);
			} else if(Yii::app()->session['userModel']['user']['userType']=='person'){
				$data['model'] = LaborRequisitions::model()->findAll('requisition_id=:id',array(':id'=>$type));
				$data['detail_id'] = $type;
				$criteria = new CDbCriteria;
				$criteria->addCondition("t.id = '{$id}'");	
				$criteria->addCondition("clientCompanyRequisitionDetails.id = '{$type}'");	
				$data['company'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria);

				$this->render('laborRequisitions',$data);
			} else{
				$data['id'] = $id;
				$data['type'] = $type;
				$criteria = new CDbCriteria;
				$criteria->addCondition("t.id = '{$id}'");	
				$criteria->addCondition("clientCompanyRequisitionDetails.id = '{$type}'");	
				$data['model'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria);
				$this->render('index',$data);
			}
			
		} else{
			$data['model'] = ClientCompanyRequisitions::model()->findByPk($id);
			$this->render('index2',$data);
		}
	}

	public function actionViewtemp($id,$type='')
	{
		$data['model'] = LaborRequisitionsTemp::model()->findAll('requisition_id=:id',array(':id'=>$type));
		$data['detail_id'] = $type;
		$criteria = new CDbCriteria;
		$criteria->addCondition("t.id = '{$id}'");	
		$criteria->addCondition("clientCompanyRequisitionDetails.id = '{$type}'");	
		$data['company'] = ClientCompanyRequisitions::model()->with('clientCompanyRequisitionDetails')->find($criteria);	
		$this->render('laborRequisitionsTemp',$data);
		
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
	          

	          
	          //Columns
	          $sheet1->setCellValue('B3', 'ID');
	          $sheet1->setCellValue('C3', 'Code');
	          $sheet1->setCellValue('D3', 'Company Name');
	          $sheet1->setCellValue('E3', 'Company Person');
	          $sheet1->setCellValue('F3', 'Person Number');
	          $sheet1->setCellValue('G3', 'Requisition Date');
	          $sheet1->setCellValue('H3', 'Applicant Type');
	          $sheet1->setCellValue('I3', 'Skill Required');
	          $sheet1->setCellValue('J3', 'HC');
	          $sheet1->setCellValue('K3', 'Status');
	          $sheet1->setCellValue('L3', 'Requisition Date');
	          

	          
	          
	          $sheet1->getStyle("B3:L3")->applyFromArray(array("font" => array( "bold" => true)));
	          
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
	          $sheet1->getColumnDimension("K")->setAutoSize(true);
	          


	          $count = 5;


              foreach($company as $d){ $deo = CompanyPersons::model()->findByPk($d->requisition->person_id);
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
	            $sheet1->setCellValue("B$count", $d->id);
	            $sheet1->setCellValue("C$count", $d->requisition->requisition_code);
	            $sheet1->setCellValue("D$count", (ucfirst($d->requisition->company->company_name).' ('.$alliedto).')');
	            $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->name):'-'));
	            $sheet1->setCellValue("F$count", (($deo)?$deo->mobile_number:'-'));//date('d M,Y',strtotime($m->dob)));
	            $sheet1->setCellValue("G$count", (date('d M,Y',strtotime($d->requisition->createdOn))));
	            $sheet1->setCellValue("H$count", @$type);
	            $sheet1->setCellValue("I$count", $d->skill);
	            $sheet1->setCellValue("J$count", $d->count);
	            $sheet1->setCellValue("K$count", @$status);
	            $sheet1->setCellValue("L$count", (date('d M,Y',strtotime($d->date_from))).' - '.(date('d M,Y',strtotime($d->date_to))));
	            $count++;

	            $sheet1->setCellValue("C$count", '');
	          	$sheet1->mergeCells("C$count:L$count");
	          	$count = $count+1;
	          	$sheet1->setCellValue("C$count", 'Applicants Detail');
	          	$sheet1->mergeCells("C$count:L$count");
	            $sheet1->getStyle("C$count:L$count")->applyFromArray(array("font" => array( "bold" => true)));

	            $count = $count+2;
	            	$sheet1->setCellValue("B$count", 'ID');
		          $sheet1->setCellValue("C$count", 'Name');
		          $sheet1->setCellValue("D$count", 'Father Name');
		          $sheet1->setCellValue("E$count", 'CNIC');
		          $sheet1->setCellValue("F$count", 'Mobile Number');
		          $sheet1->setCellValue("G$count", 'Work Status');
		          $sheet1->setCellValue("H$count", 'Accepted Date');
		          $sheet1->setCellValue("I$count", 'Rejected Date');
		          $sheet1->setCellValue("J$count", 'Reason');
		          
		          

		          
		          
		          $sheet1->getStyle("B$count:J$count")->applyFromArray(array("font" => array( "bold" => true)));
		          
		          $sheet1->getColumnDimension("B")->setAutoSize(true);
		          $sheet1->getColumnDimension("C")->setAutoSize(true);
		          $sheet1->getColumnDimension("D")->setAutoSize(true);
		          $sheet1->getColumnDimension("E")->setAutoSize(true);
		          $sheet1->getColumnDimension("F")->setAutoSize(true);
		          $sheet1->getColumnDimension("G")->setAutoSize(true);
		          $sheet1->getColumnDimension("H")->setAutoSize(true);
		          $sheet1->getColumnDimension("I")->setAutoSize(true);
		          $sheet1->getColumnDimension("J")->setAutoSize(true);
		          
				if($d->laborRequisitions){
                	$jjcount = $count+1;
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
                		$sheet1->setCellValue("B$jjcount", $lr->labour->id);
			            $sheet1->setCellValue("C$jjcount", $lr->labour->full_name);
			            $sheet1->setCellValue("D$jjcount", $lr->labour->father_name);
			            $sheet1->setCellValue("E$jjcount", $lr->labour->cnic);
			            $sheet1->setCellValue("F$jjcount", $lr->labour->mobile_number);//date('d M,Y',strtotime($m->dob)));
			            $sheet1->setCellValue("G$jjcount", $status);
			            $sheet1->setCellValue("H$jjcount", $lr->accepted_date);
			            $sheet1->setCellValue("I$jjcount", $lr->rejected_date);
			            $sheet1->setCellValue("J$jjcount", $lr->reason);
			            $jjcount++;
                	}
            	}


	          }
	          $sheet1->setTitle('Company Requisition');
	          /*$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
	          //$file = getcwd().'\uploads\areport.xlsx';
	          $file = '/home2/thepaks1/public_html/khushaalthar\uploads/\areport.xlsx';
	          //echo $file;exit;
	          $objWriter->save($file);*/
	          $filename = 'areport.xlsx';
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
                $html .= '<tr><td>ID</td><td colspan="2">Name</td><td colspan="2">Father Name</td><td>CNIC</td><td>Number</td><td>Work Status</td><td>Accepted Date</td><td>Rejected Date</td><td>Reason</td></tr>';
                if($d->laborRequisitions){
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
		if(!empty($_POST['labor_id'])){
			$model = LaborRequisitions::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id']));	
			if($model){
				$model->accepted_date = $_POST['accept_date'];
				$model->status = 1;
				if($model->save(false)){
					$lrt = LaborRequisitionsTemp::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id']));	
					$lrt->status = 1;
					$lrt->save(false);


					$lrd = new LaborRequisitionDetails;
					$lrd->labor_requisition_id = $model->id;
					$lrd->job_type = $_POST['job_type'];
					$lrd->salary = $_POST['salary'];
					$lrd->save(false);

					$noti = new RequisitionNotifications;
					$noti->company_id = $model->requisition->requisition->company_id;
					$noti->requisition_id = $_POST['requisition_id'];
					$noti->text = $model->labour->full_name.' is accepted by '.$model->requisition->requisition->company->company_name.',  requisition # <b>'.$model->requisition->requisition->requisition_code.'</b> on date '.$_POST['accept_date'].'.';
					$noti->status = 1;
					$noti->createdOn = date('Y-m-d H:i:s');
					$noti->save(false);

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

	public function actionReject(){
		if(!empty($_POST['labor_id'])){
			$model = LaborRequisitions::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id']));	
			if($model){
				$model->rejected_date = date('Y-m-d');
				$model->reason = $_POST['reason'];
				$model->status = 2;
				if($model->save(false)){
					$lrt = LaborRequisitionsTemp::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$_POST['labor_id']));	
					$lrt->status = 2;
					$lrt->reason = $_POST['reason'];
					$lrt->rejected_date = date('Y-m-d');
					$lrt->save(false);
					/*if($lrt){
						$lrt->delete();
					}*/
					$noti = new RequisitionNotifications;
					$noti->company_id = $model->requisition->requisition->company_id;
					$noti->requisition_id = $_POST['requisition_id'];
					$noti->text = $model->labour->full_name.' is rejected by '.$model->requisition->requisition->company->company_name.',  requisition # <b>'.$model->requisition->requisition->requisition_code.'</b> on date '.date('Y-m-d').' with reason "'.$model->reason.'".';
					$noti->status = 1;
					$noti->createdOn = date('Y-m-d H:i:s');
					$noti->save(false);


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
				foreach($_POST['labors'] as $l):
					//$model = new LaborRequisitions;
					$m = LaborRequisitionsTemp::model()->find('labour_id=:lab AND requisition_id=:req',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
					
					if(!$m){
						$model = new LaborRequisitionsTemp;
						$model->labour_id = $l;
						$model->requisition_id = $_POST['requisition_id'];
						$model->accepted_date = NULL;
						$model->rejected_date = NULL;
						$model->reason = '';
						$model->status = 0;
						$model->createdOn = date('Y-m-d H:i:s');
						$model->save(false);
						$s++;
					} else{
						$e++;
					}
					
				endforeach;
				echo json_encode(array('success'=>$s.' applicants are temporary assigned to requisition. <br/>'.$e.' are already in this requisition temporary list.'));
			} else{
				echo json_encode(array('error'=>'Please select atleat one applicant.'));
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
					$model = LaborRequisitionsTemp::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
					$model->delete();
					
				endforeach;
				echo json_encode(array('success'=>count($_POST['labors']).' applicants are removed from requisition.'));
			} else{
				echo json_encode(array('error'=>'Please select atleat one applicant.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}
	public function actionSubmitfinalrequisitionsdata(){
		if(!empty($_POST['requisition_id'])){
			if(!empty($_POST['labors'])){
				foreach($_POST['labors'] as $l):
					$modelT = LaborRequisitionsTemp::model()->find('requisition_id=:req AND labour_id=:lab',array(':lab'=>$l,':req'=>$_POST['requisition_id']));
					$modelT->status = 2;
					$modelT->save(false);
					$model = new LaborRequisitions;
					$model->labour_id = $l;
					$model->requisition_id = $_POST['requisition_id'];
					$model->accepted_date = NULL;
					$model->rejected_date = NULL;
					$model->reason = '';
					$model->status = 0;
					$model->createdOn = date('Y-m-d H:i:s');
					$model->save(false);
				endforeach;
				echo json_encode(array('success'=>count($_POST['labors']).' applicants are assigned to requisition.'));
			} else{
				echo json_encode(array('error'=>'Please select atleat one applicant.'));
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
				echo json_encode(array('error'=>'Please select atleat one applicant.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}

	public function actionsubmitdehire(){
		if(!empty($_POST['requisition_id'])){
			if(!empty($_POST['labors'])){
				foreach($_POST['labors'] as $l):
					$d = LaborRequisitions::model()->find('labour_id=:labor AND requisition_id = :id AND status = 1',array(':labor'=>$l,':id'=>$_POST['requisition_id']));
					if($d){
						$d->status = 3;
						$d->save(false);
						$lrt = LaborRequisitionsTemp::model()->find('requisition_id=:id AND labour_id=:labour',array(':id'=>$_POST['requisition_id'],':labour'=>$l));	
						$lrt->status = 3;
						$lrt->save(false);
						/*if($lrt){
							$lrt->delete();
						}*/
						$noti = new RequisitionNotifications;
						$noti->company_id = $d->requisition->requisition->company_id;
						$noti->requisition_id = $_POST['requisition_id'];
						$noti->text = $d->labour->full_name.' is dehired ,  requisition # <b>'.$d->requisition->requisition->requisition_code.'</b> on date '.date('Y-m-d').'.';
						$noti->status = 1;
						$noti->createdOn = date('Y-m-d H:i:s');
						$noti->save(false);
					}
				endforeach;
				echo json_encode(array('success'=>'Information updated successfully.'));
			} else{
				echo json_encode(array('error'=>'Please select atleat one applicant.'));
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
			echo json_encode(array('success'=>'Information updated successfully.'));
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}


	public function actionChangestatus(){
		$model = clientCompanyRequisitionDetails::model()->findByPk($_POST['requisition_id']);
		$model->status = $_POST['status'];
		if($model->save(false))
			echo json_encode(array('success'=>'Information updated successfully.'));
		else{
			echo json_encode(array('error'=>'Something went wrong.'));
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