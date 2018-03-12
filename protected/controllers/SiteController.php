<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public $layout = 'login';
	
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(isset(Yii::app()->session['userModel']['user'])) {
			$this->redirect(Yii::app()->baseUrl.'/dashboard');
		} else{
			$this->render('index');
		}
		
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		} else{

				$this->render('error', 'You are not authorized to view this page.');
		}
	}

	public function actionAuthenticate()
	{
		//$this->render('authenticate');
		//if($_POST['username'] != ''){
		$email = $_POST['email'];
		$password = $_POST['password'];

		//$company = ClientCompanies::model()->find('company_email =:email AND password =:password',array(':email'=>$email,':password'=>md5($password)));
		$deo = CompanyDeos::model()->find('email_address =:email AND password =:password',array(':email'=>$email,':password'=>md5($password)));
		$person = CompanyPersons::model()->find('email_address =:email AND password =:password',array(':email'=>$email,':password'=>md5($password)));
		/*if($company){
			if($company->status==1){
				$userModel = array();
				$userModel['user'] = $company->attributes;
				$userModel['user']['userType'] = 'company';
				Yii::app()->session->add('userModel',$userModel);
				echo json_encode(array('success'=>'Logged in successfully.'));
			} else{
				echo json_encode(array('error'=>'You are not activated. Please contact administrator.'));		
			}
				
		} else */
		if($deo){
			if($deo->status==1){
				if(date('Y-m-d')>=$deo->expire){
					$link = Yii::app()->baseUrl.'/site/resetpassword/type/deo/hash/'.base64_encode($deo->id);
					echo json_encode(array('error'=>'Your password is expired. You are redirect to reset password.','expire'=>1,'link'=>$link));		
				} else{
					$userModel = array();
					$userModel['user'] = $deo->attributes;
					$userModel['user']['first_name'] = $deo->name;
					$userModel['user']['company_name'] = $deo->name;
					$userModel['user']['userType'] = 'deo';
					$userModel['user']['accesslevel'] = $deo->userType->attributes;
					Yii::app()->session->add('userModel',$userModel);
					echo json_encode(array('success'=>'Logged in successfully.'));		
				}
				
				
			} else{
				echo json_encode(array('error'=>'You are not activated. Please contact administrator.'));		
			}
			
		} else if($person){
			if($person->status==1){
				if(date('Y-m-d')>=$person->expire){
					$link = Yii::app()->baseUrl.'/site/resetpassword/type/person/hash/'.base64_encode($person->id);
					echo json_encode(array('error'=>'Your password is expired. You are redirect to reset password.','expire'=>1,'link'=>$link));		
				} else{
					$userModel = array();
					$userModel['user'] = $person->attributes;
					$userModel['user']['first_name'] = $person->name;
					$userModel['user']['company_name'] = $person->name;
					$userModel['user']['userType'] = 'person';
					Yii::app()->session->add('userModel',$userModel);
					echo json_encode(array('success'=>'Logged in successfully.'));	
				}
				
			} else{
				echo json_encode(array('error'=>'You are not activated. Please contact administrator.'));		
			}	
		} else{
			echo json_encode(array('error'=>'Invalid username or password'));	
		}
		
	}


	public function actionResetpassword($type,$hash){
		if($type=='deo'){
			$data['model'] = CompanyDeos::model()->findByPk(base64_decode($hash));
			$data['type'] = $type;
			$this->render('reset',$data);	
		}
		if($type=='person'){
			$data['model'] = CompanyPersons::model()->findByPk(base64_decode($hash));
			$data['type'] = $type;
			$this->render('reset',$data);	
		}
	}
	/*public function actionChangepassword(){
		if($_POST['password']==$_POST['conf_password']){
			if($_POST['type']=='deo'){
				$model = CompanyDeos::model()->findByPk($_POST['id']);
				if($model){
					$model->password = md5($_POST['password']);
					$model->expire = date('Y-m-d', strtotime("+30 days"));
					$model->save(false);
					echo json_encode(array('success'=>'Information updated successfully.'));	
				} else{
					echo json_encode(array('error'=>'something went wrong. Please try again.'));	
				}
			}
			if($_POST['type']=='person'){
				$model = CompanyPersons::model()->findByPk($_POST['id']);
				if($model){
					$model->password = md5($_POST['password']);
					$model->expire = date('Y-m-d', strtotime("+30 days"));
					$model->save(false);
					echo json_encode(array('success'=>'Information updated successfully.'));	
				} else{
					echo json_encode(array('error'=>'something went wrong. Please try again.'));	
				}
			}
		} else{
			echo json_encode(array('error'=>'Confirm password not match.'));	
		}
	}*/

	public function actionChangepassword(){
		if($_POST['password']==$_POST['conf_password']){
			if($_POST['type']=='deo'){
				$model = CompanyDeos::model()->findByPk($_POST['id']);
				if($model){
					if($model->email_address == $_POST['email_address']){
						$model->password = $_POST['password'];
						$model->expire = date('Y-m-d', strtotime("+30 days"));
						if($model->save()){
							$model->password = md5($_POST['password']);
							$model->save(false);
							$modelL = CompanyDeosLive::model()->findByPk($_POST['id']);
							$modelL->attributes = $model->attributes;
							$modelL->save(false);
							echo json_encode(array('success'=>'Information updated successfully.'));		
						} else{
							$error = '';
							foreach ($model->getErrors() as $key => $value) {
								$error .= $value[0].'</br>';
							}
							echo json_encode(array('error'=>$error));
						}
					} else{
						echo json_encode(array('error'=>'Email address not match.'));
					}
					
					
				} else{
					echo json_encode(array('error'=>'something went wrong. Please try again.'));	
				}
			}
			if($_POST['type']=='person'){
				$model = CompanyPersons::model()->findByPk($_POST['id']);
				if($model){
					if($model->email_address == $_POST['email_address']){
						$model->password = $_POST['password'];
						$model->expire = date('Y-m-d', strtotime("+30 days"));
						if($model->save()){
							$model->password = md5($_POST['password']);
							$model->save(false);
							
							$modelL = CompanyPersonsLive::model()->findByPk($_POST['id']);
							$modelL->attributes = $model->attributes;
							$modelL->save(false);
							echo json_encode(array('success'=>'Information updated successfully.'));		
						} else{
							$error = '';
							foreach ($model->getErrors() as $key => $value) {
								$error .= $value[0].'</br>';
							}
							echo json_encode(array('error'=>$error));
						}
					} else{
						echo json_encode(array('error'=>'Email address not match.'));
					}
					//echo json_encode(array('success'=>'Information updated successfully.'));	
				} else{
					echo json_encode(array('error'=>'something went wrong. Please try again.'));	
				}
			}
		} else{
			echo json_encode(array('error'=>'Confirm password not match.'));	
		}
	}

	

	public function actionForgotemail(){
		if($_POST['email']){
			$model = CompanyDeos::model()->find('email_address=:email',array(':email'=>$_POST['email']));
			$person = CompanyPersons::model()->find('email_address=:email',array(':email'=>$_POST['email']));
			if($model){
				$data['link'] = 'http://192.168.34.69'.Yii::app()->baseUrl.'/site/resetpassword/type/deo/hash/'.base64_encode($model->id);
				$views = $this->renderPartial('//mail/forgot',$data,true);
				$this->mailsend3(@$model->email_address,'Deo','Reset Password',$views);
				echo json_encode(array('success'=>'Reset password email send to you.'));
			} else if($person){
				$data['link'] = 'http://192.168.34.69'.Yii::app()->baseUrl.'/site/resetpassword/type/person/hash/'.base64_encode(@$person->id);
				$views = $this->renderPartial('//mail/forgot',$data,true);
				$this->mailsend3(@$person->email_address,'Deo','Reset Password',$views);
				echo json_encode(array('success'=>'Reset password email send to you.'));

			} else{
				echo json_encode(array('error'=>'No user found on this email address.'));
			}
		} else{
			echo json_encode(array('error'=>'Email required.'));	
		}
	}
	
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->baseUrl);
	}

	public function actionTest(){
		/*$data = json_decode('[{"id":173,"status":0},{"id":260,"status":0},{"id":376,"status":0},{"id":380,"status":0},{"id":384,"status":0},{"id":402,"status":0},{"id":451,"status":0},{"id":457,"status":0},{"id":1312,"status":0},{"id":1347,"status":0},{"id":1371,"status":0},{"id":1376,"status":0},{"id":1377,"status":0},{"id":1380,"status":0},{"id":1383,"status":0},{"id":1385,"status":0},{"id":1417,"status":0},{"id":1567,"status":0},{"id":2397,"status":5},{"id":2503,"status":0},{"id":2505,"status":0},{"id":3162,"status":5},{"id":3561,"status":0},{"id":3595,"status":0},{"id":3611,"status":0},{"id":4033,"status":0},{"id":4220,"status":0},{"id":4298,"status":0},{"id":4419,"status":0},{"id":4623,"status":0},{"id":4748,"status":0},{"id":4771,"status":0},{"id":4868,"status":0},{"id":4879,"status":0},{"id":4970,"status":0},{"id":7242,"status":5},{"id":7687,"status":0},{"id":7946,"status":0},{"id":9277,"status":0},{"id":12360,"status":0},{"id":12400,"status":0},{"id":13048,"status":0},{"id":13280,"status":0},{"id":13566,"status":0}]');

		foreach($data as $d){
			if($d->status==0){
				$this->deactivateLabor($d->id,'deactivate labor');
			}
			if($d->status==5){
				$this->deactivateLabor($d->id,'blacklisted labor');
			}
		}*/
		$this->deactivateLabor(4868,'deactivate labor');
	}

	public function actionsendSMS(){
		$number = '03312326877';
		$message = "خوشحال تھر آفیس تشریف لانے اور اپنی رجسڑئشن کروانے کا شکریہ۔
		آپ کی درخواست کا نمبر 11212  ہے.
		اپنی درخواست کا اسٹیٹس جاننے کے لیے ابھی KT12 لکھ کر    8655   پر بھیج دیں۔";
		/*$url = 'http://pk.eocean.us/APIManagement/API/RequestAPI?user=Khushalthar&pwd=APvWYWVxBy8e9W8%2bCkcrkLMhHhltjZpX8D1Fy9XqDDgTq20XGxMLdSfcICiBGF9R2g%3d%3d&sender=KhushalThar&reciever='.@$number.'&msg-data='.urlencode($message).'&response=string';*/
		$url = 'http://pk.eocean.us/apimanagement/API/RequestAPI?user=khushalthar&pwd=AMCWNo7dIaDuDt%2bU8bAwro8KPsTjcc04R%2fPcKXxi2CTdcoyhkW%2bF28r06baGczi65w%3d%3d&sender=KhushalThar&reciever='.@$number.'&msg-data='.urlencode($message).'&response=string';
		$sms = @file_get_contents($url);
	}
}