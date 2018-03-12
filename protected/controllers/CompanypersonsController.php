<?php

class CompanypersonsController extends Controller
{
	public function init()
    {
        $this->checkSession();
    }
	public function actionAdd()
	{
		$this->checkAdmin();
		$this->render('add');
	}

	public function actionIndex()
	{
		$data['persons'] = CompanyPersons::model()->findAll('company_id=:id',array(':id'=>Yii::app()->session['userModel']['user']['id']));
		$this->render('index',$data);
	}

	public function actionSubmit()
	{
		if(/*!empty($_POST['client_code']) && */!empty($_POST['name'])){
			$model = new CompanyPersons;
			$model->attributes = $_POST;
			$length = 10;
	        $chars2 = array_merge(range(0, 9), range('A', 'Z'));
	        shuffle($chars2);
	        $model->code = implode(array_slice($chars2, 0, $length));
			$model->password = $_POST['password'];
			$model->company_id = Yii::app()->session['userModel']['user']['id'];
			$model->status = 1;
			$model->createdOn = date('Y-m-d H:i:s');
			$model->expire = date('Y-m-d', strtotime("+30 days"));
			if($model->save()){
				$model->password = md5($_POST['password']);
				$model->save(false);
				$livePerson = new CompanyPersonsLive;
				$livePerson->attributes = $model->attributes;
				$livePerson->save(false);
				echo json_encode(array('success'=>'Update information successfully.'));
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