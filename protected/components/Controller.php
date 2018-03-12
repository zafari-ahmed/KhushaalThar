<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	public function checkSession() {
		if (!isset(Yii::app()->session['userModel']['user'])) {
	        $this->redirect(Yii::app()->baseUrl);
	    }
	}


	public function checkAdmin() {
		if(Yii::app()->session['userModel']['user']['userType']=='person'){
			$this->redirect(Yii::app()->baseUrl.'/site/error');
		}
	}


	public function labourLastComment($id){
		$model = LaborRequisitions::model()->find(array(
		    "condition" => "labour_id= '".$id."'",
		    "order" => "id DESC",
		    "limit" => 1,
		));
		if($model){
			if($model->status==0){
			return 'Pending';
			}
			if($model->status==1){
				return 'Working';
			}
			if($model->status==2){
				return $model->reason;
			}
			if($model->status==3){
				return $model->reason;
			}	
		} else{
			return '';
		}
		
		
	}

	public function labourLastWork($id){
		$model = LaborRequisitions::model()->find(array(
		    "condition" => "labour_id= '".$id."'",
		    "order" => "id DESC",
		    "limit" => 1,
		));
		
		if($model){
			return $model->requisition->requisition->requisition_code;
		} else{
			return '';
		}
		
	}
	public function Laborstatus($id){
		$model = LaborRequisitions::model()->find('labour_id=:id AND status != 2 AND status !=3',array(':id'=>$id));
		//$modelTemp = LaborRequisitionsTemp::model()->find('labour_id=:id AND status = 0',array(':id'=>$id));
		$training = LabourTraings::model()->find('labour_id=:id AND status = 0',array(':id'=>$id));

		if($training){
			if(@$training->training->status==0){
				return true;
			} else{
				return false;
			}
			
		} /*else if($modelTemp){
			return true;
		} */else if($model){
			return true;
		}  else{
			return false;
		}
	}
	public function LaborstatusDetail($id){
		$model = LaborRequisitions::model()->find('labour_id=:id AND status != 2 AND status != 3',array(':id'=>$id));
		if($model){
			return true;
		} else{
			return false;
		}
	}


	public function deactivateLabor2($id,$reason){
			$model = LaborRequisitions::model()->find('labour_id=:id AND status != 2 AND status != 3',array(':id'=>$id));
			$training = LabourTraings::model()->find('labour_id=:id AND status = 0',array(':id'=>$id));
			if($model){
				$model->status = 2;
				$model->reason = $reason;
				$model->rejected_date = date('Y-m-d');
				$model->save(false);
			}
			if($training){
				$training->training->status==1;
				$training->training->save(false);
			}
	}

	public function deactivateLabor($id,$reason){
			$model = LaborRequisitions::model()->find('labour_id=:id AND status != 2 AND status != 3',array(':id'=>$id));
			$training = LabourTraings::model()->find('labour_id=:id AND status = 0',array(':id'=>$id));
			if($model){
				$model->status = 2;
				$model->reason = $reason;
				$model->rejected_date = date('Y-m-d');
				$model->save(false);
			}
			if($training){
				$training->training->status==1;
				$training->training->save(false);
			}
	}
	public function Laborwork($id){
		$model = LaborRequisitions::model()->find('labour_id=:id AND status != 2 AND status != 3',array(':id'=>$id));
		//$modelTemp = LaborRequisitionsTemp::model()->find('labour_id=:id AND status = 0',array(':id'=>$id));
		$training = LabourTraings::model()->find('labour_id=:id AND status = 0',array(':id'=>$id));
		/*if($modelTemp){
			return 'Temporary  # '.@$modelTemp->requisition->requisition->requisition_code;
		} else */
		if($model){
			if($model->status==0){
				return 'Pending # '.@$model->requisition->requisition->requisition_code;
			}
			if($model->status==4){
				return 'On temporary # '.@$model->requisition->requisition->requisition_code;
			}
			if($model->status==1){
				return 'On duty # '.@$model->requisition->requisition->requisition_code;
			}
		} else if($training){
			if(@$training->training->status==0){
				return ' On Training '.@$training->training->institute_name.' ('.@$training->training->training_type.') # '.@$training->training->batch_no;	
			}
		} else{
			$lab = Labours::model()->findByPk($id);
			if(@$lab->status==5){
				return 'Black-listed';
			} else if(@$lab->status==0){
				return 'De-activated';
			} else{
				return 'Available';
			}
			
		}
	}

	public function checkAttandance($labourid,$requisitionid,$date){
		$attandance = LabourAttendances::model()->find('labour_id=:labor AND requisition_id = :id AND date = :date',array(':labor'=>$labourid,':id'=>$requisitionid,':date'=>$date));
		if($attandance){
			return true;
		} else{
			return false;
		}
	}

	public function totalHired($id){
		$total = 0;
		
		$model = ClientCompanies::model()->findByPk($id);
		if($model){
			foreach($model->companyRequisitions as $cr){
				if($cr->clientCompanyRequisitionDetails){
					foreach($cr->clientCompanyRequisitionDetails as $crd){
						$total = $total + $crd->laborRequisitionsHired;
					}
				}
			}
		}
		return $total;
	}
	public function totalHired2(){
		$total = 0;
		
		$modell = ClientCompanies::model()->findAll();
		if($modell){
			foreach($modell as $model){
				foreach($model->companyRequisitions as $cr){
					if($cr->clientCompanyRequisitionDetails){
						foreach($cr->clientCompanyRequisitionDetails as $crd){
							$total = $total + $crd->laborRequisitionsHired;
						}
					}
				}

			}
		}
		return $total;
	}

	public function totalHired2detail($type,$type2){//type==>1=>thri,2=>non thri ,$type2===>1=>skill,2=>non skill
		$total = 0;
		$labors = array();
		$modell = ClientCompanies::model()->findAll();
		if($modell){
			foreach($modell as $model){
				foreach($model->companyRequisitions as $cr){
					if($cr->clientCompanyRequisitionDetails){
						foreach($cr->clientCompanyRequisitionDetails as $crd){
							if($crd->laborRequisitionsHiredDet){
								foreach($crd->laborRequisitionsHiredDet as $lbh){
									//$labor =
									array_push($labors, $lbh->labour_id);
								}
							}
							
						}
					}
				}

			}
		}
		$labc = implode(',', $labors);
		if(!empty($labc)){
			if($type==1 && $type2==1){
				$co = Labours::model()->count("category_id=1 AND district_id=1 AND id IN ($labc)");
			}
			if($type==1 && $type2==2){
				$co = Labours::model()->count("category_id=2 AND district_id=1 AND id IN ($labc)");
			}
			if($type==2 && $type2==1){
				$co = Labours::model()->count("category_id=1 AND district_id!=1 AND id IN ($labc)");
			}
			if($type==2 && $type2==2){
				$co = Labours::model()->count("category_id=2 AND district_id!=1 AND id IN ($labc)");
			}	
		} else{
			$co = 0;
		}
		
		return $co;
	}

	public function notiLink($id){
		$d = ClientCompanyRequisitions::model()->findByPk($id);
		$rd = ClientCompanyRequisitionDetails::model()->findByPk($id);
		if($rd){
			return Yii::app()->baseUrl.'/requisitions/viewtemp/id/'.$rd->requisition_id.'/type/'.$rd->id;
			die;
		} else if($d){
			return Yii::app()->baseUrl.'/requisitions/view/id/'.$id;
			die;
		} else{
			return '#';
		}

	}

	public function closeName($id,$type){
		if($type=='person'){
			$model = CompanyPersons::model()->findByPk($id);
			if($model){
				return $model->name;
			} else{
				return '';
			}
		}
		if($type=='deo'){
			$model = CompanyDeos::model()->findByPk($id);
			if($model){
				return $model->name;
			} else{
				return '';
			}
		}
	}


	public function requisitionEmail($id){
		$req = ClientCompanyRequisitionDetails::model()->findByPk($id);
		$data['model'] = ClientCompanyRequisitionDetails::model()->findAll('id=:id',array(':id'=>$id));
		$views = $this->renderPartial('//mail/memberassign',$data,true);
		/*foreach($req->requisition->company->companypersons as $d):
			$this->mailsend($d->email_address,$d->name,'Member assigned on requisition',$views);
		endforeach;*/
		$emailData = array();
		foreach($req->requisition->company->companypersons as $d):
			if($req->requisition->person_id == $d->id){
				$this->mailsend3($d->email_address,$d->name,'Member assigned on requisition',$views);	
			}
			
			//array_push($emailData, array('email'=>$d->email_address,'name'=>$d->name));
		endforeach;
		//$this->mailsend('zafarimemon@gmail.com','s','Member assigned on requisition',$views);
	}

	public function requisitionEmailAccept($id){
		$req = ClientCompanyRequisitionDetails::model()->findByPk($id);
		$data['model'] = ClientCompanyRequisitionDetails::model()->findAll('id=:id',array(':id'=>$id));
		$data['status'] = 'accepted some ';
		$views = $this->renderPartial('//mail/member_status',$data,true);
		$emailData = array();
		foreach($req->requisition->company->companypersons as $d):
			//$this->mailsend($d->email_address,$d->name,'Member job completed on requisition',$views);
			array_push($emailData, array('email'=>$d->email_address,'name'=>$d->name));
		endforeach;
		$this->mailsend2($emailData,'Member accepted on requisition',$views);
	}

	public function requisitionEmailReject($id){
		$req = ClientCompanyRequisitionDetails::model()->findByPk($id);
		$data['model'] = ClientCompanyRequisitionDetails::model()->findAll('id=:id',array(':id'=>$id));
		$data['status'] = 'rejected some ';
		$views = $this->renderPartial('//mail/member_status',$data,true);
		$emailData = array();
		foreach($req->requisition->company->companypersons as $d):
			//$this->mailsend($d->email_address,$d->name,'Member job completed on requisition',$views);
			array_push($emailData, array('email'=>$d->email_address,'name'=>$d->name));
		endforeach;
		$this->mailsend2($emailData,'Member rejected on requisition',$views);
	}

	public function requisitionEmailRemoved($id){
		$req = ClientCompanyRequisitionDetails::model()->findByPk($id);
		$data['model'] = ClientCompanyRequisitionDetails::model()->findAll('id=:id',array(':id'=>$id));
		$data['status'] = 'removed or dismiss some ';
		$views = $this->renderPartial('//mail/member_status',$data,true);
		$emailData = array();
		foreach($req->requisition->company->companypersons as $d):
			//$this->mailsend($d->email_address,$d->name,'Member job completed on requisition',$views);
			array_push($emailData, array('email'=>$d->email_address,'name'=>$d->name));
		endforeach;
		$this->mailsend2($emailData,'Member removed or dismiss on requisition',$views);
	}

	public function requisitionEmailDone($id){
		$req = ClientCompanyRequisitionDetails::model()->findByPk($id);
		$data['model'] = ClientCompanyRequisitionDetails::model()->findAll('id=:id',array(':id'=>$id));
		$data['status'] = 'job completed by some of ';
		$views = $this->renderPartial('//mail/member_status',$data,true);
		$emailData = array();
		foreach($req->requisition->company->companypersons as $d):
			//$this->mailsend($d->email_address,$d->name,'Member job completed on requisition',$views);
			array_push($emailData, array('email'=>$d->email_address,'name'=>$d->name));
		endforeach;
		$this->mailsend2($emailData,'Member job completed on requisition',$views);
	}
	
	

	public function mailsend($to,$name,$subject,$message){
        $mail=Yii::app()->Smtpmail;
        //$mail->SetFrom('khushaalthar1@gmail.com', 'Khushaal Thar');
        $mail->SetFrom('info@khushaalthar.com', 'Khushaal Thar');
        $mail->Subject    = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to, $name);
        $mail->AddCC('ktboys@khushaalthar.com', 'KT Boys');
        $mail->AddCC('t_sukumar@engro.com', 'Sunil Kumar');
        if(!$mail->Send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
            //echo "Message sent!";
        }
    }

    public function mailsend3($to,$name,$subject,$message){

        $mail3=Yii::app()->Smtpmail;
        //$mail->SetFrom('khushaalthar1@gmail.com', 'Khushaal Thar');
        $mail3->SetFrom('info@khushaalthar.com', 'Khushaal Thar');
        $mail3->Subject    = $subject;
        $mail3->MsgHTML($message);
        $mail3->AddAddress($to,$name);
        if(!$mail3->Send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
            //echo "Message sent!";
        }
    }

	public function mailsend2($emailData,$subject,$message){

        $mail2=Yii::app()->Smtpmail;
        //$mail2->SetFrom('khushaalthar1@gmail.com', 'Khushaal Thar');
        $mail2->SetFrom('info@khushaalthar.com', 'Khushaal Thar');
        $mail2->Subject    = $subject;
        $mail2->MsgHTML($message);
        $mail2->AddAddress('ktboys@khushaalthar.com', 'KT Boys');
        /*foreach($emailData as $ed){
        	$mail2->AddCC($ed['email'], $ed['name']);	
        }*/
        
        $mail2->AddCC('t_sukumar@engro.com', 'Sunil Kumar');
        $mail2->AddCC('info@khushaalthar.com', 'Khushaal Info');
        if(!$mail2->Send()) {
            //echo "Mailer Error: " . $mail->ErrorInfo;
        }else {
            //echo "Message sent!";
        }
    }

    public function editedLabor($id){
    	$model = Labours::model()->findByPk($id);
    	$modelL = LaboursLive::model()->findByPk($id);

    	$modelL->attributes = $model->attributes;
		if($modelL->save(false)){
			$labDr = LabourDrivingLicenses::model()->findAll('labour_id=:id',array(':id'=>$modelL->id));
			if($labDr){
				LabourDrivingLicensesLive::model()->deleteAll('labour_id=:id',array(':id'=>$modelL->id));
				foreach($labDr as $lDr){
					$laborLiveDr = new LabourDrivingLicensesLive;
					$laborLiveDr->attributes = $lDr->attributes;
					$laborLiveDr->save(false);		
				}	
			}
			

			$labEd = LabourEducations::model()->findAll('labour_id=:id',array(':id'=>$modelL->id));
			if($labEd){
				LabourEducationsLive::model()->deleteAll('labour_id=:id',array(':id'=>$modelL->id));
				foreach($labEd as $lEd){
					$laborLiveEd = new LabourEducationsLive;
					$laborLiveEd->attributes = $lEd->attributes;
					$laborLiveEd->save(false);		
				}	
			}
			

			$labEm = LabourEmployments::model()->findAll('labour_id=:id',array(':id'=>$modelL->id));
			if($labEm){
				LabourEmploymentsLive::model()->deleteAll('labour_id=:id',array(':id'=>$modelL->id));
				foreach($labEm as $lEm){
					$laborLiveEm = new LabourEmploymentsLive;
					$laborLiveEm->attributes = $lEm->attributes;
					$laborLiveEm->save(false);		
				}	
			}

			

			$labHSE = LabourHse::model()->findAll('labour_id=:id',array(':id'=>$modelL->id));
			if($labHSE){
				LabourHseLive::model()->deleteAll('labour_id=:id',array(':id'=>$modelL->id));
				foreach($labHSE as $lHSE){
					$laborLiveHSE = new LabourHseLive;
					$laborLiveHSE->attributes = $lHSE->attributes;
					$laborLiveHSE->save(false);		
				}	
			}
			

			$labMed = LabourMedical::model()->findAll('labour_id=:id',array(':id'=>$modelL->id));
			if($labMed){
				LabourMedicalLive::model()->deleteAll('labour_id=:id',array(':id'=>$modelL->id));
				foreach($labMed as $lMed){
					$laborLiveMed = new LabourMedicalLive;
					$laborLiveMed->attributes = $lMed->attributes;
					$laborLiveMed->save(false);
				}	
			}
			

			$labPo = LabourPolice::model()->findAll('labour_id=:id',array(':id'=>$modelL->id));
			if($labPo){
				LabourPoliceLive::model()->deleteAll('labour_id=:id',array(':id'=>$modelL->id));
				foreach($labPo as $lPo){
					$laborLivePo = new LabourPoliceLive;
					$laborLivePo->attributes = $lPo->attributes;
					$laborLivePo->save(false);
				}	
			}
			

			$labTr = LabourTraings::model()->findAll('labour_id=:id',array(':id'=>$modelL->id));
			if($labTr){
				LabourTraingsLive::model()->deleteAll('labour_id=:id',array(':id'=>$modelL->id));
				foreach($labTr as $lTr){
					$laborLiveTr = new LabourTraingsLive;
					$laborLiveTr->attributes = $lTr->attributes;
					$laborLiveTr->save(false);
				}	
			}

			$labSk = LabourSkillTest::model()->findAll('labour_id=:id',array(':id'=>$modelL->id));
			if($labSk){
				LabourSkillTestLive::model()->deleteAll('labour_id=:id',array(':id'=>$modelL->id));
				foreach($labSk as $lSk){
					$laborLiveSk = new LabourSkillTestLive;
					$laborLiveSk->attributes = $lSk->attributes;
					$laborLiveSk->save(false);
				}	
			}
    	}
    }

	public function getRecentData($id,$type){
		
		
		//$labor = Labours::model()->findByPk($id);
		$employment = array();
		$experience = 0;
		$education = array();
		$items = $id; 
		if($type=='employment'){
			if(!empty($items)){

				foreach($items as $lem){
					if($lem->company_name!=''){
						$employment[] = $lem->attributes;
						$date1 = new DateTime($lem->from_date);
						$date2 = new DateTime($lem->to_date);

						$experience = $experience + $date2->diff($date1)->format("%y");	
					}
					
				}
				usort($employment, function($a, $b) {
				    return strtotime($b["to_date"]) - strtotime($a["to_date"]);
				});
				$employment['data'] = array_slice($employment, 0, 2);
				$employment['experience'] = $experience;
			}	
			return $employment;
		}
		if($type=='education'){
			if(!empty($items)){
				foreach($items as $led){
					$education[] = $led->attributes;
				}
				usort($education, function($a, $b) {
				    return strtotime($b["passing_year"]) - strtotime($a["passing_year"]);
				});
				$education = array_slice($education, 0, 2);
			}	
			return $education;
		}
		
		
	}
}