<?php

class ApiController extends Controller
{
	public function actionGetsms(){
		$result_array = [];
		parse_str($_SERVER['REQUEST_URI'], $result_array);
		if(empty($result_array['number'])){
			echo json_encode(array('error'=>'Number must be valid.'));
		}
		else if(empty($result_array['operator'])){
			echo json_encode(array('error'=>'Operator must be valid.'));
		}
		else{
			$model = new ReceivedSms;
			$model->number = @$result_array['number'];
			$model->content = @$result_array['content'];;
			$model->operator = @$result_array['operator'];;
			$model->createdOn = date('Y-m-d H:i:s');
			if($model->save()){
				/*$id = substr($model->content, 2);
				$model = Labours::model()->findByPk($id);
				$number = $model->number;
				$message = '';
				if($model){
					if($model->police){
						if($model->police[0]->cleared_date == NULL){
							$message = "محترم $model->full_name \n خوشحال تھر آفیس سے رابطہ کرنے کا شکریہ۔ آپ کا درخواست نمبر          پولیس تصدیق فارم نا جمع کروانے کی صورت میں عارضی طور پر روک دیا گیا ہے
							 آپ سے درخواست کی جاتی ہے فوری طور پے اپنا پولیس تصدیق فارم خوشحال تھر آفیس میں جمع کروایں.
							دیگر معلومات جننے کے لیے  03488326521  نمبر پر رابطہ کیجیے۔ ";
						} else if($model->police[0]->security_date == NULL){
							$message = "محترم $model->full_name \n  خوشحال تھر آفیس سے رابطہ کرنے کا شکریہ۔ آپ کا درخواست نمبر $id زیر عمل ے اور اس وقت ہم آپ کی پولیس کی تصدیق کا عمل مکمل ہونے کا انتظار کر ررہے ہیں۔
							اس عمل کے مثبت نتائج آنے کی صورت میں ہم آپ کو میسر مواقعے سے آگاہ کریں گے۔
							دیگر معلومات جاننے کے لیے  03488326521  نمبر پر رابطہ کیجیے۔ شکریہ";
						} else if($model->traingsActive){
							$message = "محترم $model->full_name \n  خوشحال تھر آفیس سے رابطہ کرنے کا شکریہ۔ اس وقت آپ کا درخواست نمبر        $id       زیر عمل ے، آپ کو مئاسب تربیتی پروگرام میسرہونے کی صورت میں بر وقت آگاہ کر دیا جائےگا۔
				دیگر معلومات جاننے کے لیے 03488326521 نمبر پر رابطہ کیجیے۔ شکریہ";
						} else if($model->police[0]->security_date && $model->traings && !$model->laborRequisitions){
							$message = "محترم $model->full_name \n  خوشحال تھر آفیس سے رابطہ کرنے کا شکریہ۔ اس وقت آپ کا درخواست نمبر         $id        زیر عمل ے، آپ کو مئاسب مواقعے میسر ہونے کی صورت میں بر وقت آگاہ کر دیا جائےگا۔
				دیگر معلومات جاننے کے لیے 03488326521  نمبر پر رابطہ کیجیے۔ ";
						} 
					}
				}
				
				if(!empty($message)){
					$url = 'http://pk.eocean.us/APIManagement/API/RequestAPI?user=Khushalthar&pwd=APvWYWVxBy8e9W8%2bCkcrkLMhHhltjZpX8D1Fy9XqDDgTq20XGxMLdSfcICiBGF9R2g%3d%3d&sender=KhushalThar&reciever='.$number.'&msg-data='.urlencode($message).'&response=string';
					$sms = @file_get_contents($url);
					/*if(@$sms){
						return TRUE;
					} else{
						return FALSE;
					}*/	
				//}
				echo json_encode(array('success'=>'SMS received successfully.'));
			} else{
				$error = '';
				foreach ($model->getErrors() as $key => $value) {
					$error = $value[0];
				}
				echo json_encode(array('error'=>$error));
			}
			
		}
	}


	public function actionSendsms($id){
		$model = Labours::model()->findByPk($id);
		$number = '03312326877';
		$message = "خوشحال تھر آفیس تشریف لانے اور اپنی رجسڑئشن کروانے کا شکریہ۔
		آپ کی درخواست کا نمبر $model->id  ہے.
		اپنی درخواست کا اسٹیٹس جاننے کے لیے ابھی KT$model->id لکھ کر    8655   پر بھیج دیں۔";
		$url = 'http://pk.eocean.us/APIManagement/API/RequestAPI?user=Khushalthar&pwd=APvWYWVxBy8e9W8%2bCkcrkLMhHhltjZpX8D1Fy9XqDDgTq20XGxMLdSfcICiBGF9R2g%3d%3d&sender=KhushalThar&reciever='.$number.'&msg-data='.urlencode($message).'&response=string';
		$sms = @file_get_contents($url);
	}
}