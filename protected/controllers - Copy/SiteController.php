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
					echo json_encode(array('error'=>'something went wrong. Please try again.'));	
				}
			}
			if($_POST['type']=='person'){
				$model = CompanyPersons::model()->findByPk($_POST['id']);
				if($model){
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
				$this->mailsend(@$model->email_address,'Deo','Reset Password',$views);
				echo json_encode(array('success'=>'Reset password email send to you.'));
			} else if($person){
				$data['link'] = 'http://192.168.34.69'.Yii::app()->baseUrl.'/site/resetpassword/type/person/hash/'.base64_encode(@$person->id);
				$views = $this->renderPartial('//mail/forgot',$data,true);
				$this->mailsend(@$person->email_address,'Deo','Reset Password',$views);
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
		$this->requisitionEmail(497);
	}
}