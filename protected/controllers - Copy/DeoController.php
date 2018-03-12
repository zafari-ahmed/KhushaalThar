<?php

class DeoController extends Controller
{
	public function init()
    {
        $this->checkSession();
    }
	public function actionIndex()
	{
		$data['deos'] = CompanyDeos::model()->findAll();
		$this->render('index',$data);
	}

	public function actionAdd(){
		$this->render('add');
	}


	public function actionEdit($id){
		$data['deo'] = CompanyDeos::model()->findByPk($id);
		$this->render('edit',$data);
	}

	public function actionSavedeo(){
		if(!empty($_POST['name'])){
			$model = new CompanyDeos;
			if(isset($_POST['id'])){
				$model = CompanyDeos::model()->findByPk($_POST['id']);
			} else{
				$model = new CompanyDeos;
			}

			$model->attributes = @$_POST;
			if(!isset($_POST['id'])){
				$model->password = @$_POST['password'];	
			}
			
			$model->status = 1;
			$model->createdOn = date('Y-m-d H:i:s');
			$model->expire = date('Y-m-d', strtotime("+30 days"));
			if($model->save()){
				$model->password = md5(@$_POST['password']);	
				$model->save(false);
				echo json_encode(array('success'=>'Update information successfully.'));
			} else{
				$error = '';
				foreach ($model->getErrors() as $key => $value) {
					$error .= $value[0].'</br>';
				}
				echo json_encode(array('error'=>$error));
			}
		} else{
			echo json_encode(array('error'=>'Please fill all fields.'));
		}
	}

	public function actionDeactivate(){
		$id = $_POST['deo_id'];
		$model = CompanyDeos::model()->findByPk($id);
		if($model){
			if($model->status==0){
				$model->status = 1;
				$model->save(false);
			} else{
				$model->status = 0;
				$model->save(false);
			}
			echo json_encode(array('success'=>'Information updated successfully'));
		} else{
			echo json_encode(array('error'=>'something went wrong.'));	
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