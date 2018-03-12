<?php

class SettingsController extends Controller
{
	public function init()
    {
        $this->checkSession();
        $this->checkAdmin();
    }
	public function actionDistricts($id='')
	{
		if(empty($id)){
			$data['districts'] = Districts::model()->findAll();	
		} else{
			$data['districts'] = Districts::model()->findByPk($id);
		}
		//$data['districts'] = Districts::model()->findAll();
		$this->render('districts',$data);
	}

	public function actionSavedistricts(){
		if(!empty($_POST['name'])){
			//$model = new Districts;
			if(@$_POST['id']){
				$model = Districts::model()->findByPk($_POST['id']);
			} else{
				$model = new Districts;
			}
			$model->name = @$_POST['name'];
			$model->province = @$_POST['province'];
			$model->save(false);
			$this->redirect(Yii::app()->baseUrl.'/settings/districts');
		}
	}


	public function actionSavevehicletypes(){
		if(!empty($_POST['name'])){
			//$model = new VehicleTypes;
			if(@$_POST['id']){
				$model = VehicleTypes::model()->findByPk($_POST['id']);
			} else{
				$model = new VehicleTypes;
			}
			$model->name = @$_POST['name'];
			$model->save(false);
			$this->redirect(Yii::app()->baseUrl.'/settings/vehicletypes');
		}
	}

	public function actionVehicletypes($id='')
	{
		//$data['vehicletypes'] = VehicleTypes::model()->findAll();
		if(empty($id)){
			$data['vehicletypes'] = VehicleTypes::model()->findAll();	
		} else{
			$data['vehicletypes'] = VehicleTypes::model()->findByPk($id);
		}
		$this->render('vehicletypes',$data);
	}

	public function actionTehsils($id='')
	{
		//$data['tehsils'] = Tehsil::model()->findAll();
		if(empty($id)){
			$data['tehsils'] = Tehsil::model()->findAll();	
		} else{
			$data['tehsils'] = Tehsil::model()->findByPk($id);
		}
		$this->render('tehsils',$data);
	}

	public function actionSavetehsils(){
		if(!empty($_POST['name'])){
			//$model = new Tehsil;
			if(@$_POST['id']){
				$model = Tehsil::model()->findByPk($_POST['id']);
			} else{
				$model = new Tehsil;
			}
			$model->name = @$_POST['name'];
			$model->save(false);
			$this->redirect(Yii::app()->baseUrl.'/settings/tehsils');
		}
	}

	public function actionVillages($id='')
	{
		if(empty($id)){
			$data['villages'] = Villages::model()->findAll();	
		} else{
			$data['villages'] = Villages::model()->findByPk($id);
		}
		
		$this->render('villages',$data);
	}

	public function actionUseraccesslevel()
	{
		$data['accesslevels'] = UserTypes::model()->findAll();
		$this->render('useraccesslevel',$data);
	}

	public function actioneditusertype($id){
		$data['accesslevels'] = UserTypes::model()->findByPk($id);
		$data['edit'] = true;
		$this->render('useraccesslevel',$data);	
	}
	public function actionSaveusertype(){
		if(!empty($_POST['user_type'])){
			
			if(@$_POST['id']){
				$model = UserTypes::model()->findByPk($_POST['id']);	
			} else{
				$model = new UserTypes;
			}
			$model->attributes = @$_POST;
			if($model->save(false)){
				echo json_encode(array('success'=>'Information updated successfully.'));
			} else{
				echo json_encode(array('error'=>'Something went wrong.'));
			}
		} else{
			echo json_encode(array('error'=>'Something went wrong.'));
		}
	}

	public function actionSavevillages(){
		if(!empty($_POST['name'])){
			if(@$_POST['id']){
				$model = Villages::model()->findByPk($_POST['id']);
			} else{
				$model = new Villages;
			}
			$model->village = @$_POST['name'];
			$model->save(false);
			$this->redirect(Yii::app()->baseUrl.'/settings/villages');
		}
	}

	public function actionPassword(){
		$data['error'] = '';
		$this->render('changepassword',$data);
	}
	public function actionSavepassword(){
		if($_POST['password'] == $_POST['conf_password']){
			if(Yii::app()->session['userModel']['user']['userType']=='deo'){
				$person = CompanyDeos::model()->findByPk(Yii::app()->session['userModel']['user']['id']);	
				if($person->email_address == $_POST['email_address']){
					$error = 0;
					$eMessage = '';
				} else{
					$error = 1;
					$eMessage = 'Email address not match';
				}
				if($person->password == md5($_POST['old_password'])){
					$error = 0;
					$eMessage = '';
				} else{
					$error = 1;
					$eMessage = 'Old password not match';
				}

				if($error == 0){
					$person->password = $_POST['password'];
					$person->expire = date('Y-m-d', strtotime("+30 days"));
					if(!$person->save()){
						$error = '';
						foreach ($person->getErrors() as $key => $value) {
							$error .= $value[0].'</br>';
						}
						$data['error'] = $error;
						$this->render('changepassword',$data);
						return;
					} else{
						$person->password = md5($_POST['password']);
						$person->save(false);
					}
				} else{
					$data['error'] = $eMessage;
					$this->render('changepassword',$data);
					return;
				}
				
			}
			if(Yii::app()->session['userModel']['user']['userType']=='person'){
				$person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);	
				
				if($person->email_address == $_POST['email_address']){
					$error = 0;
					$eMessage = '';
				} else{
					$error = 1;
					$eMessage = 'Email address not match';
				}
				if($person->password == md5($_POST['old_password'])){
					$error = 0;
					$eMessage = '';
				} else{
					$error = 1;
					$eMessage = 'Old password not match';
				}

				if($error == 0){
					$person->password = $_POST['password'];
					$person->expire = date('Y-m-d', strtotime("+30 days"));
					if(!$person->save()){
						$error = '';
						foreach ($person->getErrors() as $key => $value) {
							$error .= $value[0].'</br>';
						}
						$data['error'] = $error;
						$this->render('changepassword',$data);
						return;
					} else{
						$person->password = md5($_POST['password']);
						$person->save(false);
					}
				} else{
					$data['error'] = $eMessage;
					$this->render('changepassword',$data);
					return;
				}
				
			}
			/*if(Yii::app()->session['userModel']['user']['userType']=='company'){
				$person = ClientCompanies::model()->findByPk(Yii::app()->session['userModel']['user']['id']);	
				$person->password = md5($_POST['password']);
				$person->save(false);
			}*/
			
			
			$data['error'] = 'Information updated successfully';
			$this->render('changepassword',$data);
		} else{
			$data['error'] = 'Confirm Password not match';
			$this->render('changepassword',$data);
		}
	}
	public function actionDeactivate($id='')
	{
		//$data['status'] = DeactivateReasons::model()->findAll();
		if(empty($id)){
			$data['status'] = DeactivateReasons::model()->findAll();	
		} else{
			$data['status'] = DeactivateReasons::model()->findByPk($id);
		}
		$this->render('deactivate_status',$data);
	}

	public function actionSavedeactivate(){
		if(!empty($_POST['reason'])){
			if(@$_POST['id']){
				$model = DeactivateReasons::model()->findByPk($_POST['id']);	
			} else{
				$model = new DeactivateReasons;
			}
			$model->reason = @$_POST['reason'];
			$model->save(false);
			$this->redirect(Yii::app()->baseUrl.'/settings/deactivate');
		}
	}
	public function actionBlacklist($id='')
	{
		//$data['status'] = BlacklistReasons::model()->findAll();
		if(empty($id)){
			$data['status'] = BlacklistReasons::model()->findAll();	
		} else{
			$data['status'] = BlacklistReasons::model()->findByPk($id);
		}
		$this->render('blacklist_status',$data);
	}

	public function actionSaveblacklist(){
		if(!empty($_POST['reason'])){
			if(@$_POST['id']){
				$model = BlacklistReasons::model()->findByPk($_POST['id']);	
			} else{
				$model = new BlacklistReasons;
			}
			$model->reason = @$_POST['reason'];
			$model->save(false);
			$this->redirect(Yii::app()->baseUrl.'/settings/blacklist');
		}
	}


	public function actionReject($id='')
	{
		//$data['status'] = BlacklistReasons::model()->findAll();
		if(empty($id)){
			$data['status'] = RejectReasons::model()->findAll();	
		} else{
			$data['status'] = RejectReasons::model()->findByPk($id);
		}
		$this->render('reject_status',$data);
	}

	public function actionSavereject(){
		if(!empty($_POST['reason'])){
			if(@$_POST['id']){
				$model = RejectReasons::model()->findByPk($_POST['id']);	
			} else{
				$model = new RejectReasons;
			}
			$model->reason = @$_POST['reason'];
			$model->save(false);
			$this->redirect(Yii::app()->baseUrl.'/settings/reject');
		}
	}



	public function actionDelete($type,$id){
		switch ($type) {
			case 'village':
				$labors = Labours::model()->find('village_id=:id',array(':id'=>$id));	
				if($labors){
					echo json_encode(array('error'=>'This village is assigned with applicants.'));
				} else{
					$village = Villages::model()->findByPk($id);
					$village->delete();
					echo json_encode(array('success'=>'Information updated successfully.'));
				}
				
				break;
			case 'tehsil':
				$labors = Labours::model()->find('tehsil_id=:id',array(':id'=>$id));	
				if($labors){
					echo json_encode(array('error'=>'This tehsil is assigned with applicants.'));
				} else{
					$Tehsil = Tehsil::model()->findByPk($id);
					$Tehsil->delete();
					echo json_encode(array('success'=>'Information updated successfully.'));
				}
				
				break;
			case 'district':
				$labors = Labours::model()->find('district_id=:id',array(':id'=>$id));	
				if($labors){
					echo json_encode(array('error'=>'This district is assigned with applicants.'));
				} else{
					$Districts = Districts::model()->findByPk($id);
					$Districts->delete();
					echo json_encode(array('success'=>'Information updated successfully.'));
				}
				
				break;
			case 'vehicle':
				$VehicleTypes = VehicleTypes::model()->findByPk($id);
				$VehicleTypes->delete();
				echo json_encode(array('success'=>'Information updated successfully.'));
				
				break;
			case 'blacklist':
				$BlacklistReasons = BlacklistReasons::model()->findByPk($id);
				$BlacklistReasons->delete();
				echo json_encode(array('success'=>'Information updated successfully.'));
				
				break;
			case 'deactivate':
				$DeactivateReasons = DeactivateReasons::model()->findByPk($id);
				$DeactivateReasons->delete();
				echo json_encode(array('success'=>'Information updated successfully.'));
				
				break;
				
			case 'reject':
				$DeactivateReasons = RejectReasons::model()->findByPk($id);
				$DeactivateReasons->delete();
				echo json_encode(array('success'=>'Information updated successfully.'));
				
				break;
			
			default:
				# code...
				break;
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