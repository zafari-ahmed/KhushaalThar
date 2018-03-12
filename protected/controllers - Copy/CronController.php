<?php

class CronController extends Controller
{
	public function actionIndex()
	{

		$modelL = LaboursLive::model()->find(array('order'=>'id DESC'));
		$model = Labours::model()->find(array('order'=>'id DESC'));
		$data = Labours::model()->findAll('id > :id',array(':id'=>$modelL->id));

		//echo $model->id.'---'.$modelL->id;exit;
		if($data){
			foreach($data as $d):
				$laborLive = new LaboursLive;
				$liveDeo = CompanyDeosLive::model()->findByPk($d->deo_id);
				if(!$liveDeo){
					$localDeo = CompanyDeos::model()->findByPk($d->deo_id);
					$liveDeo = new CompanyDeosLive;
					$liveDeo->attributes = $localDeo->attributes;
					$liveDeo->save(false);
					$laborLive->deo_id = $liveDeo->id;
				}

				$laborLive->attributes = $d->attributes;
				if($laborLive->save(false)){
					//documents
					$uploadFolder=getcwd().'/uploads/';
					$uploadThumbFolder=getcwd().'/uploads/applicantthumb/';
					$destinationFolder = 'C:\xampp\htdocs\sendLive\uploads';
					$destinationThumbFolder = 'C:\xampp\htdocs\sendLive\uploads\applicantthumb';
					if($d->documents){
						foreach($d->documents as $lSk){
							$laborLiveDoc = new LabourDocumentsLive;
							$laborLiveDoc->attributes = $lSk->attributes;
							$laborLiveDoc->save(false);
							copy($uploadFolder.$lSk->labour_id.'_'.$lSk->name, $destinationFolder.'/'.$lSk->labour_id.'_'.$lSk->name);
						}	
					}
					//avatar
					copy($uploadFolder.$d->avatar, $destinationFolder.'/'.$d->avatar);
					//thumb
					copy($uploadThumbFolder.$d->thumb, $destinationThumbFolder.'/'.$d->thumb);

					$labDr = LabourDrivingLicenses::model()->findAll('labour_id=:id',array(':id'=>$d->id));
					if($labDr){
						foreach($labDr as $lDr){
							$laborLiveDr = new LabourDrivingLicensesLive;
							$laborLiveDr->attributes = $lDr->attributes;
							$laborLiveDr->save(false);		
						}	
					}
					

					$labEd = LabourEducations::model()->findAll('labour_id=:id',array(':id'=>$d->id));
					if($labEd){
						foreach($labEd as $lEd){
							$laborLiveEd = new LabourEducationsLive;
							$laborLiveEd->attributes = $lEd->attributes;
							$laborLiveEd->save(false);		
						}	
					}
					

					$labEm = LabourEmployments::model()->findAll('labour_id=:id',array(':id'=>$d->id));
					if($labEm){
						foreach($labEm as $lEm){
							$laborLiveEm = new LabourEmploymentsLive;
							$laborLiveEm->attributes = $lEm->attributes;
							$laborLiveEm->save(false);		
						}	
					}

					

					$labHSE = LabourHse::model()->findAll('labour_id=:id',array(':id'=>$d->id));
					if($labHSE){
						foreach($labHSE as $lHSE){
							$laborLiveHSE = new LabourHseLive;
							$laborLiveHSE->attributes = $lHSE->attributes;
							$laborLiveHSE->save(false);		
						}	
					}
					

					$labMed = LabourMedical::model()->findAll('labour_id=:id',array(':id'=>$d->id));
					if($labMed){
						foreach($labMed as $lMed){
							$laborLiveMed = new LabourMedicalLive;
							$laborLiveMed->attributes = $lMed->attributes;
							$laborLiveMed->save(false);
						}	
					}
					

					$labPo = LabourPolice::model()->findAll('labour_id=:id',array(':id'=>$d->id));
					if($labPo){
						foreach($labPo as $lPo){
							$laborLivePo = new LabourPoliceLive;
							$laborLivePo->attributes = $lPo->attributes;
							$laborLivePo->save(false);
						}	
					}
					

					$labTr = LabourTraings::model()->findAll('labour_id=:id',array(':id'=>$d->id));
					if($labTr){
						foreach($labTr as $lTr){
							$laborLiveTr = new LabourTraingsLive;
							$laborLiveTr->attributes = $lTr->attributes;
							$laborLiveTr->save(false);
						}	
					}

					$labSk = LabourSkillTest::model()->findAll('labour_id=:id',array(':id'=>$d->id));
					if($labSk){
						foreach($labSk as $lSk){
							$laborLiveSk = new LabourSkillTestLive;
							$laborLiveSk->attributes = $lSk->attributes;
							$laborLiveSk->save(false);
						}	
					}
					
				}
			endforeach;

			echo 'Data updated';
		} else{
			echo 'No new data';
		}

		//$this->actionDbbackup();
	}


	public function actionTestemail(){
		$this->layout = '';
		$data['model'] = ClientCompanyRequisitionDetails::model()->findAll('requisition_id=:id',array(':id'=>4));
		$views = $this->renderPartial('//mail/clientrequisition',$data,true);
		echo $this->mailsend('zafarimemon@gmail.com','zafar','New Requisition',$views);
	}

	public function backup_tables($host,$user,$pass,$name,$tables = '*'){
		
		$link = mysql_connect($host,$user,$pass);
		mysql_select_db($name,$link);
		
		//get all of the tables
		if($tables == '*')
		{
			$tables = array();
			$result = mysql_query('SHOW TABLES');
			while($row = mysql_fetch_row($result))
			{
				$tables[] = $row[0];
			}
		}
		else
		{
			$tables = is_array($tables) ? $tables : explode(',',$tables);
		}
		
		$return = '';
		//cycle through
		foreach($tables as $table)
		{
			if($table!='bioverification'){
				$result = mysql_query('SELECT * FROM '.$table);
				$num_fields = mysql_num_fields($result);
				
				$return.= 'DROP TABLE '.$table.';';
				$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
				$return.= "\n\n".$row2[1].";\n\n";
				
				for ($i = 0; $i < $num_fields; $i++) 
				{
					while($row = mysql_fetch_row($result))
					{
						$return.= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j < $num_fields; $j++) 
						{
							$row[$j] = addslashes($row[$j]);
							$row[$j] = ereg_replace("\n","\\n",$row[$j]);
							if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j < ($num_fields-1)) { $return.= ','; }
						}
						$return.= ");\n";
					}
				}
				$return.="\n\n\n";
			}
		}
		

		//Remote Drive
		$uploadFolder = "Z:\\KTDBBackups/";
		//save file
		$days = 7;  
		// Open the directory  
		if ($handle = opendir($uploadFolder))  
		{  
		    // Loop through the directory  
		    while (false !== ($file = readdir($handle)))  
		    {  
		        // Check if the file is older than X days old  
	            if (filemtime($uploadFolder.$file) < ( time() - ( $days * 24 * 60 * 60 ) ) )  
	            {  
	                // Do the deletion  
	                @unlink($uploadFolder.$file);  
	            } 
		    }  
		} 
		$handle = fopen($uploadFolder.'db-backup-'.date('Y-m-d').'.sql','w+');
		fwrite($handle,$return);
		fclose($handle);

		//F:\KTDBBackups


		//Portable Drive
		$uploadFolder = "F:\\KTDBBackups/";
		//save file
		$days = 7;  
		// Open the directory  
		if ($handle = opendir($uploadFolder))  
		{  
		    // Loop through the directory  
		    while (false !== ($file = readdir($handle)))  
		    {  
		        // Check if the file is older than X days old  
	            if (filemtime($uploadFolder.$file) < ( time() - ( $days * 24 * 60 * 60 ) ) )  
	            {  
	                // Do the deletion  
	                @unlink($uploadFolder.$file);  
	            } 
		    }  
		}
		$handle = fopen($uploadFolder.'db-backup-'.date('Y-m-d').'.sql','w+');
		fwrite($handle,$return);
		fclose($handle);
	}

	public function actionDbbackup(){
		$this->backup_tables('localhost','root','','thar');	
	}


	public function actionRequisitions(){
		//Client companies
		$modelL = ClientCompaniesLive::model()->find(array('order'=>'id DESC'));
		$model = ClientCompanies::model()->find(array('order'=>'id DESC'));
		$data = ClientCompanies::model()->findAll('id > :id',array(':id'=>$modelL->id));
	
		if($data){
			foreach($data as $d):
				$mo = new ClientCompaniesLive;
				$mo->attributes = $d->attributes;
				$mo->save(false);
				if($d->companypersons){
					foreach($d->companypersons as $dp):
						$mp = new CompanyPersonsLive;
						$mp->attributes = $dp->attributes;
						$mp->save(false);
					endforeach;
				}
			endforeach;
		}
		//Client companies requisitions
		$modelL = ClientCompanyRequisitionsLive::model()->find(array('order'=>'id DESC'));
		$model = ClientCompanyRequisitions::model()->find(array('order'=>'id DESC'));
		$data = ClientCompanyRequisitions::model()->findAll('id > :id',array(':id'=>$modelL->id));
	
		if($data){
			foreach($data as $d):
				$mo = new ClientCompanyRequisitionsLive;
				$mo->attributes = $d->attributes;
				$mo->save(false);
				if($d->clientCompanyRequisitionDetails){
					foreach($d->clientCompanyRequisitionDetails as $dp):
						$mp = new ClientCompanyRequisitionDetailsLive;
						$mp->attributes = $dp->attributes;
						$mp->save(false);
					endforeach;
				}
			endforeach;
		}

		//labor requisition
		$modelL = LaborRequisitionsLive::model()->find(array('order'=>'id DESC'));
		$model = LaborRequisitions::model()->find(array('order'=>'id DESC'));
		if($modelL){
			$data = LaborRequisitions::model()->findAll('id > :id',array(':id'=>$modelL->id));	
		} else{
			$data = LaborRequisitions::model()->findAll();
		}
		

		if($data){
			foreach($data as $lr){
				$lmodel = new LaborRequisitionsLive;
				$lmodel->attributes = $lr->attributes;
				$lmodel->save(false);
				 	$lrd = LaborRequisitionDetails::model()->find('labor_requisition_id=:id',array(':id'=>$lr->id));
		          	if($lrd){
		            	$lrdL = new LaborRequisitionDetailsLive;
		            	$lrdL->attributes = $lrd->attributes;
						$lrdL->save(false);
		          	}
			}
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