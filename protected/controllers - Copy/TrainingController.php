<?php

class TrainingController extends Controller {

    public function init() {
        $this->checkSession();
    }

    public function actionAdd() {
        $this->render('add');
    }

    public function actionIndex() {
        $data['trainings'] = Trainings::model()->findAll();
        $this->render('index', $data);
    }

    public function actionSubmit() {
        if (!empty($_POST['institute_name'])) {
            $model = new Trainings;
            $model->attributes = $_POST;
            $model->createdOn = date('Y-m-d H:i:s');
            $model->save(false);
            $this->redirect(Yii::app()->baseUrl . '/training');
        }
        //$this->render('submit');
    }

    public function actionEndtraining() {
        if (!empty($_POST['training_id'])) {
            $training = Trainings::model()->findByPk($_POST['training_id']);
            if ($training) {
                $training->status = 1;
                if ($training->save()) {
                    $model = LabourTraings::model()->findAll('training_id=:id', array(':id' => $_POST['training_id']));
                    if ($model) {
                        foreach ($model as $key => $m) {
                            $m->status = 1;
                            $m->save(false);
                        }
                    }
                    echo json_encode(array('success' => 'Information updated successfully.'));
                } else {
                    echo json_encode(array('error' => 'Something went wrong.'));
                }
            } else {
                echo json_encode(array('error' => 'Something went wrong.'));
            }
        } else {
            echo json_encode(array('error' => 'Something went wrong.'));
        }
    }

    public function actionAddapplicant($id) {
        /*$criteria = new CDbCriteria;
        $criteria->addCondition("t.status = 1");
        $criteria->order = 'id ASC';
        $data['labors'] = Labours::model()->findAll($criteria);*/
        $data['training'] = Trainings::model()->findByPk($id);
        $this->render('training_applicants', $data);
    }

    public function actionGettraningapplicants(){
        /*$criteria = new CDbCriteria;
        $criteria->addCondition("t.status = 1");
        $criteria->order = 'id ASC';
        $model = Labours::model()->findAll($criteria);*/


        $result_array = [];
        parse_str($_SERVER['REQUEST_URI'], $result_array);
        //$result_array['order'][0]['column'];
        switch ($result_array['order'][0]['column']) {
            case '0':
                $result_array['order'][0]['column'] = 'id';
                break;
            default:
                $result_array['order'][0]['column'] = 'id';
                break;
        }
        $sort = $result_array['order'][0]['column'];
        $order = $result_array['order'][0]['dir'];
        if(empty($result_array['search']['value'])){
            $model = Labours::model()->findAll(array(
                'condition'=>'t.status = 1',
                'order' => "$sort $order",
                'limit' =>$result_array['length'],
                'offset' => $result_array['start'],
            ));
            $student = Labours::model()->findAll(array('condition'=>'t.status = 1'));
        } else{
            $model = Labours::model()->findAll(array(
                'condition' => '(id LIKE  :id) OR (full_name LIKE  :name) OR (cnic LIKE :cnic) OR (mobile_number LIKE :number) OR (designation LIKE :designation) AND status = 1',
                'params' => array(':id'=>$result_array['search']['value'],':name'=>$result_array['search']['value'].'%',':cnic'=>'%'.$result_array['search']['value'].'%',':number'=>'%'.$result_array['search']['value'].'%',':designation'=>$result_array['search']['value'].'%'),
                'order' => "$sort $order",
                'limit' =>$result_array['length'],
                'offset' => $result_array['start'],
            ));
            $student = Labours::model()->findAll(array(
                'condition' => '(id LIKE  :id) OR (full_name LIKE  :name) OR (cnic LIKE :cnic) OR (mobile_number LIKE :number) OR (designation LIKE :designation) AND status = 1',
                'params' => array(':id'=>$result_array['search']['value'],':name'=>$result_array['search']['value'].'%',':cnic'=>'%'.$result_array['search']['value'].'%',':number'=>'%'.$result_array['search']['value'].'%',':designation'=>$result_array['search']['value'].'%'),
            ));
        }
        
        $result = array();
        //print_r($result_array);exit;
        $i=0;
        $result['draw'] = $result_array['draw'];
        $result['recordsTotal'] = count($student);
        $result['recordsFiltered'] = count($student);
        $result['data'] = '';
        if($model){
            foreach($model as $labor): 
                if($this->Laborstatus($labor->id)==false){ 
                    if(!$labor->traings){
                
                        $result['data'][$i][] = '<input type="checkbox" name="trainingLabor[]" value="'.$labor->id.'">';
                        $result['data'][$i][] = '<a href="'.Yii::app()->baseUrl.'/labor/view/id/'.$labor->id.'">'.$labor->id.'</a>';
                        $result['data'][$i][] = '<a href="'.Yii::app()->baseUrl.'/labor/view/id/'.$labor->id.'">'.$labor->full_name.'</a>';
                        $result['data'][$i][] = $labor->cnic;
                        if($labor->category_id==1){ 
                            $cat = 'Skilled'; 
                        }
                        if($labor->category_id==2){ 
                            $cat ='Unskilled'; 
                        }
                        $result['data'][$i][] = $cat ;
                        $result['data'][$i][] = $labor->mobile_number;
                        if(@$training->status==1){
                            $btn = '<a href="#" class="addtrainingResult" data-toggle="modal" data-target="#rejectModal" rel="'.$labor->id.'"><button type="button" class="btn btn-info btn-xs">Add Result</button></a>';
                        } else{
                            $btn = '';
                        }
                        $result['data'][$i][] =  $btn;
                        $i++;
                    }
                }  
            endforeach; 
        }
        
        echo json_encode($result);
    }

    public function actionRemovefromtraining() {
        if (!empty($_POST['training_id'])) {
            if (!empty($_POST['labors'])) {
                $training = Trainings::model()->findByPk($_POST['training_id']);
                foreach ($_POST['labors'] as $l):
                    //$model = new LabourTraings;
                    $model = LabourTraings::model()->find('labour_id=:id', array(':id' => $l));
                    if ($model) {
                        /*$model->status = 1;
                        $model->save(false);*/
                        $model->delete();
                    }
                endforeach;
                echo json_encode(array('success' => count($_POST['labors']) . ' Applicants are removed from training.'));
            } else {
                echo json_encode(array('error' => 'Please select atleat one applicant.'));
            }
        } else {
            echo json_encode(array('error' => 'Something went wrong.'));
        }
    }

    public function actionSubmittrainingdata() {
        if (!empty($_POST['training_id'])) {
            if (!empty($_POST['labors'])) {
                $training = Trainings::model()->findByPk($_POST['training_id']);
                foreach ($_POST['labors'] as $l):
                    //$model = new LabourTraings;
                    $model = LabourTraings::model()->find('labour_id=:id', array(':id' => $l));
                    if (!$model) {
                        $model = new LabourTraings;
                    }
                    $model->labour_id = $l;
                    $model->traings = '1';
                    $model->training_id = $_POST['training_id'];
                    $model->institute = $training->institute_name;
                    $model->trade = '';
                    $model->score = '';
                    $model->result = '';
                    $model->status = 0;
                    $model->batch_number = $training->batch_no;
                    $model->save(false);
                endforeach;
                echo json_encode(array('success' => count($_POST['labors']) . ' Persons are assigned to training.'));
            } else {
                echo json_encode(array('error' => 'Please select atleat one applicant.'));
            }
        } else {
            echo json_encode(array('error' => 'Something went wrong.'));
        }
    }

    public function actionViewreport($id, $type) {
        if ($type == 'pdf') {
            $training = Trainings::model()->findByPk($id);

            $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'L', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("ENGRO");
            $pdf->SetTitle("Training Report");
            $pdf->SetSubject("Training Report");
            $pdf->SetKeywords("Training,Report,");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            $pdf->SetFont("times", "N", 9);


            $html = '<style>.table-pdf td{text-align:center;font-weight:normal;vertical-align:middle;font-style:normal;padding:10px}</style>';
            //generate report data

            $html .= '<table class="table-pdf" border="1">';
            $html .= '<tr><td colspan="7" style="text-align:center">Training Report</td></tr>';

            $html .= '<tr><td colspan="7"></td></tr>';
            $html .= '<tr><td >ID</td><td>Name</td><td>Type</td><td>Batch No.</td><td>Start Date</td><td>End Date</td><td>Status</td></tr>';
            if ($training) {
                //foreach($training as $d){ $deo = CompanyPersons::model()->findByPk($d->requisition->person_id);
                //foreach($requisition->clientCompanyRequisitionDetails as $d){
                $html .= '<tr><td >' . $training->id . '</td><td>' . $training->institute_name . '</td><td>' . $training->training_type . '</td><td>' . $training->batch_no . '</td><td>' . $training->start_date . '</td><td>' . $training->end_date . '</td><td>' . (($training->status == 0) ? 'Open' : 'End') . '</td></tr>';
                $html .= '<tr><td colspan="7"></td></tr>';

                $labors = LabourTraings::model()->findAll('training_id=:training', array(':training' => $training->id));
                if ($labors) {
                    $html .= '<tr><td colspan="7">Applicants</td></tr>';
                    $html .= '<tr><td >ID</td><td>Name</td><td>CNIC</td><td>Category</td><td>Mobile Number</td><td>Score</td><td>Result</td></tr>';
                    foreach ($labors as $labor):
                        $cate = '';
                        if ($labor) {
                            if ($labor->labor->category_id == 1) {
                                $cate = 'Skilled';
                            } if ($labor->labor->category_id == 2) {
                                $cate = 'Unskilled';
                            }
                            $html .= '<tr><td >' . $labor->labor->id . '</td><td>' . $labor->labor->full_name . '</td><td>' . $labor->labor->cnic . '</td><td>' . ($cate) . '</td><td>' . $labor->labor->mobile_number . '</td><td>' . $labor->score . '</td><td>' . $labor->result . '</td></tr>';
                        }
                    endforeach;
                }
            }

            $html .= '</table>';
            // output the HTML content
            //echo $html;exit;
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
        }
        if ($type == 'excel') {
            $training = Trainings::model()->findByPk($id);

            Yii::import('ext.phpexcel.XPHPExcel');
            $objPHPExcel = XPHPExcel::createPHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("ENGRO KT");
            $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
            $objPHPExcel->getProperties()->setTitle("Training Report");
            $objPHPExcel->getProperties()->setSubject("Training Report");
            $objPHPExcel->getProperties()->setDescription("Training Report");

            // Active sheet
            $sheet1 = $objPHPExcel->setActiveSheetIndex(0);
            $count = 6;
            $headAlpha = 0;
            $sheet1->setCellValue('C2', 'Training Report');
            $sheet1->mergeCells("C2:F2");
            $sheet1->getStyle("C2:F2")->applyFromArray(array("font" => array("bold" => true)));

            $sheet1->setCellValue('B3', 'Training Type');
            $sheet1->setCellValue('C3', 'Institute Name');
            $sheet1->setCellValue('D3', 'Batch No');
            $sheet1->setCellValue('E3', 'Start Date');
            $sheet1->setCellValue('F3', 'End Date');
            $sheet1->setCellValue('G3', 'status');

            $sheet1->setCellValue("H3", 'Applicant ID');
            

            $sheet1->setCellValue("I3", 'Score');
            $sheet1->setCellValue("J3", 'Result');

            $sheet1->setCellValue('K3', 'Full Name');
            $sheet1->setCellValue('L3', 'Father Name');
            $sheet1->setCellValue('M3', 'CNIC');
            $sheet1->setCellValue('N3', 'Religion');
            $sheet1->setCellValue('O3', 'DOB');
            $sheet1->setCellValue('P3', 'Mobile Number');
            $sheet1->setCellValue('Q3', 'Martial Status');
            $sheet1->setCellValue('R3', 'Kids');
            $sheet1->setCellValue('S3', 'Block 2');
            $sheet1->setCellValue('T3', 'Village');
            $sheet1->setCellValue('U3', 'Tehsil');
            $sheet1->setCellValue('V3', 'District');
            $sheet1->setCellValue('W3', 'Category');
            $sheet1->setCellValue('X3', 'Applied For');
            $sheet1->setCellValue('Y3', 'Registered');
            $sheet1->setCellValue('Z3', 'Remarks');
            //$sheet1->setCellValue('AG3', 'Work Status');
            $sheet1->setCellValue('AA3', 'Drive');
            $sheet1->setCellValue('AB3', 'Driving License Number');
            $sheet1->setCellValue('AC3', 'Driving License Category');
            $sheet1->setCellValue('AD3', 'Vehicle Type');
            $sheet1->setCellValue('AE3', 'Issue Date');
            $sheet1->setCellValue('AF3', 'Valid Upto');
            $sheet1->setCellValue('AG3', 'Applicant HSE');
            $sheet1->setCellValue('AH3', 'Applicant Medical Type');
            $sheet1->setCellValue('AI3', 'Applicant Medical Result');
            $sheet1->setCellValue('AJ3', 'Applicant Police Verified');

            $sheet1->setCellValue('AK3', 'Source of Income');
            $sheet1->setCellValue('AL3', 'Company Name');
            $sheet1->setCellValue('AM3', 'Date From ');
            $sheet1->setCellValue('AN3', 'Date To');
            $sheet1->setCellValue('AO3', 'Position');
            $sheet1->setCellValue('AP3', 'Salary');

            $sheet1->setCellValue('AQ3', 'Source of Income');
            $sheet1->setCellValue('AR3', 'Company Name');
            $sheet1->setCellValue('AS3', 'Date From ');
            $sheet1->setCellValue('AT3', 'Date To');
            $sheet1->setCellValue('AU3', 'Position');
            $sheet1->setCellValue('AV3', 'Salary');

            $sheet1->setCellValue('AW3', 'Experience');


            $sheet1->setCellValue('AX3', 'Degree');
            $sheet1->setCellValue('AY3', 'Board');
            $sheet1->setCellValue('AZ3', 'Passing Year');
            $sheet1->setCellValue('BA3', 'Institute Name');
            $sheet1->setCellValue('BB3', 'Certificate');

            $sheet1->setCellValue('BC3', 'Degree');
            $sheet1->setCellValue('BD3', 'Board');
            $sheet1->setCellValue('BE3', 'Passing Year');
            $sheet1->setCellValue('BF3', 'Institute Name');
            $sheet1->setCellValue('BG3', 'Certificate');

            $sheet1->getStyle("B3:BG3")->applyFromArray(array("font" => array("bold" => true)));

            
            for ($col = 'B'; $col !== 'BG'; $col++) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
            }


            if ($training) {
                $count = 5;
                $lr = LabourTraings::model()->findAll('training_id=:id', array(':id' => $training->id));
                if ($lr) {
                    foreach ($lr as $lrr) {
                        $sheet1->setCellValue("B$count", @$training->training_type);
                        $sheet1->setCellValue("C$count", @$training->institute_name);
                        $sheet1->setCellValue("D$count", @$training->batch_no);
                        $sheet1->setCellValue("E$count", @$training->start_date);
                        $sheet1->setCellValue("F$count", @$training->end_date);
                        $sheet1->setCellValue("G$count", (@$training->status == 0) ? 'Open' : 'End');
                        $sheet1->setCellValue("H$count", @$lrr->labor->id);

                        $sheet1->setCellValue("I$count", @$lrr->score);
                        $sheet1->setCellValue("J$count", @$lrr->result);

                        $sheet1->setCellValue("K$count", @$lrr->labor->full_name);
                        $sheet1->setCellValue("L$count", @$lrr->labor->father_name);
                        $sheet1->setCellValue("M$count", @$lrr->labor->cnic);
                        $sheet1->setCellValue("N$count", @$lrr->labor->religion);
                        $sheet1->setCellValue("O$count", date('d-m-Y', strtotime(@$lrr->labor->dob))); //date('d M,Y',strtotime(@$lrr->labor->dob)));
                        $sheet1->setCellValue("P$count", @$lrr->labor->mobile_number);
                        $sheet1->setCellValue("Q$count", (@$lrr->labor->martial_status == 1) ? 'Married' : 'Single');
                        $sheet1->setCellValue("R$count", @$lrr->labor->kids);
                        $sheet1->setCellValue("S$count", (@$lrr->labor->block_2 == 1) ? 'Yes' : 'No');
                        $sheet1->setCellValue("T$count", @$lrr->labor->village->village);
                        $sheet1->setCellValue("U$count", @$lrr->labor->tehsil->name);
                        $sheet1->setCellValue("V$count", @$lrr->labor->district->name);
                        $sheet1->setCellValue("W$count", (@$lrr->labor->category_id == 1) ? 'Skilled' : 'Unskilled');
                        $sheet1->setCellValue("X$count", @$lrr->labor->designation);
                        $sheet1->setCellValue("Y$count", date('d-m-Y', strtotime(@$lrr->labor->createdOn)));
                        $sheet1->setCellValue("Z$count", @$lrr->labor->remarks);
                        //$sheet1->setCellValue("AH$count", $this->Laborwork(@$lrr->labor->id));
                        $sheet1->setCellValue("AA$count", (@$lrr->labor->drive == 1) ? 'Yes' : 'No');
                        $sheet1->setCellValue("AB$count", (@$lrr->labor->drivingLicense) ? @$lrr->labor->drivingLicense[0]->driving_license_number : '-');
                        $sheet1->setCellValue("AC$count", (@$lrr->labor->drivingLicense) ? @$lrr->labor->drivingLicense[0]->license_category : '-');
                        $sheet1->setCellValue("AD$count", (@$lrr->labor->drivingLicense) ? @$lrr->labor->drivingLicense[0]->vehicle_type : '-');
                        $sheet1->setCellValue("AE$count", (@$lrr->labor->drivingLicense) ? (date('d-m-Y', strtotime(@$lrr->labor->drivingLicense[0]->issue_date))) : '-');
                        $sheet1->setCellValue("AF$count", (@$lrr->labor->drivingLicense) ? (date('d-m-Y', strtotime(@$lrr->labor->drivingLicense[0]->valid_upto))) : '-');
                        $sheet1->setCellValue("AG$count", (@$lrr->labor->hse) ? ((@$lrr->labor->hse[0]->hse == 1) ? 'Yes' : 'No') : '-');
                        $sheet1->setCellValue("AH$count", (@$lrr->labor->medical) ? @$lrr->labor->medical[0]->type : '-');
                        $sheet1->setCellValue("AI$count", (@$lrr->labor->medical) ? @$lrr->labor->medical[0]->result : '-');
                        $sheet1->setCellValue("AJ$count", (@$lrr->labor->police) ? ((@$lrr->labor->police[0]->police_verified == 1) ? 'Yes' : 'No') : '-');



                        $employments = $this->getRecentData(@$lrr->labor->id, 'employment');
                        if (!empty($employments['data'])) {
                            if (array_key_exists(0, $employments['data'])) {
                                $sheet1->setCellValue("AK$count", $employments['data'][0]['source_of_income']);
                                $sheet1->setCellValue("AL$count", $employments['data'][0]['company_name']);
                                $sheet1->setCellValue("AM$count", date('d-m-Y', strtotime($employments['data'][0]['from_date'])));
                                $sheet1->setCellValue("AN$count", date('d-m-Y', strtotime($employments['data'][0]['to_date'])));
                                $sheet1->setCellValue("AO$count", $employments['data'][0]['position']);
                                $sheet1->setCellValue("AP$count", $employments['data'][0]['salary']);
                            }
                            if (array_key_exists(1, $employments['data'])) {
                                $sheet1->setCellValue("AQ$count", $employments['data'][1]['source_of_income']);
                                $sheet1->setCellValue("AR$count", $employments['data'][1]['company_name']);
                                $sheet1->setCellValue("AS$count", date('d-m-Y', strtotime($employments['data'][1]['from_date'])));
                                $sheet1->setCellValue("AT$count", date('d-m-Y', strtotime($employments['data'][1]['to_date'])));
                                $sheet1->setCellValue("AU$count", $employments['data'][1]['position']);
                                $sheet1->setCellValue("AV$count", $employments['data'][1]['salary']);
                            }
                        }
                        $sheet1->setCellValue("AW$count", @$employments['experience']);

                        $educations = $this->getRecentData(@$lrr->labor->id, 'education');
                        if (!empty($educations)) {
                            if (array_key_exists(0, $educations)) {
                                switch ($educations[0]['education_type_id']) {
                                    case '1':
                                        $educationTypeId = 'Primary';
                                        break;
                                    case '2':
                                        $educationTypeId = 'Middle';
                                        break;
                                    case '3':
                                        $educationTypeId = 'Matric';
                                        break;
                                    case '4':
                                        $educationTypeId = 'Intermediate';
                                        break;
                                    case '5':
                                        $educationTypeId = 'Graduation';
                                        break;
                                    case '6':
                                        $educationTypeId = 'Masters';
                                        break;
                                    case '7':
                                        $educationTypeId = 'Diploma';
                                        break;
                                    default:
                                        # code...
                                        break;
                                }
                                $sheet1->setCellValue("AX$count", @$$educationTypeId);
                                $sheet1->setCellValue("AY$count", $educations[0]['board']);
                                $sheet1->setCellValue("AZ$count", $educations[0]['passing_year']);
                                $sheet1->setCellValue("BA$count", $educations[0]['organization_name']);
                                $sheet1->setCellValue("BB$count", $educations[0]['degree']);
                            }
                            if (array_key_exists(1, $educations)) {
                                switch ($educations[1]['education_type_id']) {
                                    case '1':
                                        $educationTypeId = 'Primary';
                                        break;
                                    case '2':
                                        $educationTypeId = 'Middle';
                                        break;
                                    case '3':
                                        $educationTypeId = 'Matric';
                                        break;
                                    case '4':
                                        $educationTypeId = 'Intermediate';
                                        break;
                                    case '5':
                                        $educationTypeId = 'Graduation';
                                        break;
                                    case '6':
                                        $educationTypeId = 'Masters';
                                        break;
                                    case '7':
                                        $educationTypeId = 'Diploma';
                                        break;
                                    default:
                                        # code...
                                        break;
                                }
                                $sheet1->setCellValue("BC$count", @$$educationTypeId);
                                $sheet1->setCellValue("BD$count", $educations[1]['board']);
                                $sheet1->setCellValue("BE$count", $educations[1]['passing_year']);
                                $sheet1->setCellValue("BF$count", $educations[1]['organization_name']);
                                $sheet1->setCellValue("BG$count", $educations[1]['degree']);
                            }
                            $count++;
                        } else {
                            $sheet1->setCellValue("B$count", @$training->training_type);
                            $sheet1->setCellValue("C$count", @$training->institute_name);
                            $sheet1->setCellValue("D$count", @$training->batch_no);
                            $sheet1->setCellValue("E$count", @$training->start_date);
                            $sheet1->setCellValue("F$count", @$training->end_date);
                            $sheet1->setCellValue("G$count", (@$training->status == 0) ? 'Open' : 'End');
                            $count++;
                        }
                    }
                }
            }
            $sheet1->setTitle('Training Report');
            /* $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
              $file = getcwd().'\uploads\rreport.xlsx';
              $objWriter->save($file);
              echo "<script type='text/javascript'>window.location='".Yii::app()->baseUrl."/uploads/rreport.xlsx';</script>"; */
            $filename = 'trainingreport.xlsx';
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename={$filename}");
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            die;
        }
    }

    public function actionReport() {
        $data = array();
        if (isset($_REQUEST['submit'])) {
            $criteria = new CDbCriteria;

            if (@$_REQUEST['institute_name']) {
                $criteria->addCondition("institute_name LIKE '%{$_REQUEST['institute_name']}%'");
            }
            if (@$_REQUEST['type']) {
                $criteria->addCondition("training_type = '{$_REQUEST['type']}'");
            }
            if (@$_REQUEST['batch_no']) {
                $criteria->addCondition("batch_no = {$_REQUEST['batch_no']}");
            }
            if (@$_REQUEST['start_date']) {
                $criteria->addCondition("t.createdOn >= '{$_REQUEST['start_date']}'");
            }
            if (@$_REQUEST['end_date']) {
                $criteria->addCondition("t.createdOn <= '{$_REQUEST['end_date']}'");
            }

            $data['trainings'] = Trainings::model()->findAll($criteria);
        }
        if (isset($_REQUEST['pdf'])) {
            $criteria = new CDbCriteria;

            if (@$_REQUEST['institute_name']) {
                $criteria->addCondition("institute_name LIKE '%{$_REQUEST['institute_name']}%'");
            }
            if (@$_REQUEST['type']) {
                $criteria->addCondition("training_type = '{$_REQUEST['type']}'");
            }
            if (@$_REQUEST['batch_no']) {
                $criteria->addCondition("batch_no = {$_REQUEST['batch_no']}");
            }
            if (@$_REQUEST['start_date']) {
                $criteria->addCondition("t.createdOn >= '{$_REQUEST['start_date']}'");
            }
            if (@$_REQUEST['end_date']) {
                $criteria->addCondition("t.createdOn <= '{$_REQUEST['end_date']}'");
            }

            $trainings = Trainings::model()->findAll($criteria);

            $pdf = Yii::createComponent('application.extensions.tcpdf.ETcPdf', 'L', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("ENGRO");
            $pdf->SetTitle("Report");
            $pdf->SetSubject("Report");
            $pdf->SetKeywords("Report,");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            $pdf->AddPage();
            $pdf->SetFont("times", "N", 9);


            $html = '<style>.table-pdf td{text-align:center;font-weight:normal;vertical-align:middle;font-style:normal;padding:10px}</style>';
            //generate report data

            $html .= '<table class="table-pdf" border="1">';
            $html .= '<tr><td colspan="7" style="text-align:center">Training Report</td></tr>';

            $html .= '<tr><td colspan="7"></td></tr>';
            if ($trainings) {
                foreach ($trainings as $d) {
                    $html .= '<tr><td >ID</td><td>Name</td><td>Type</td><td>Batch No.</td><td>Start Date</td><td>End Date</td><td>Status</td></tr>';
                    //foreach($requisition->clientCompanyRequisitionDetails as $d){
                    $html .= '<tr><td >' . $d->id . '</td><td>' . $d->institute_name . '</td><td>' . $d->training_type . '</td><td>' . $d->batch_no . '</td><td>' . $d->start_date . '</td><td>' . $d->end_date . '</td><td>' . (($d->status == 0) ? 'Open' : 'End') . '</td></tr>';
                    $html .= '<tr><td colspan="7"></td></tr>';

                    $labors = LabourTraings::model()->findAll('training_id=:training', array(':training' => $d->id));
                    if ($labors) {
                        $html .= '<tr><td colspan="7">Applicants</td></tr>';
                        $html .= '<tr><td >ID</td><td>Name</td><td>CNIC</td><td>Category</td><td>Mobile Number</td><td>Score</td><td>Result</td></tr>';
                        foreach ($labors as $labor):
                            $cate = '';
                            if ($labor) {
                                if ($labor->labor->category_id == 1) {
                                    $cate = 'Skilled';
                                } if ($labor->labor->category_id == 2) {
                                    $cate = 'Unskilled';
                                }
                                $html .= '<tr><td >' . $labor->labor->id . '</td><td>' . $labor->labor->full_name . '</td><td>' . $labor->labor->cnic . '</td><td>' . ($cate) . '</td><td>' . $labor->labor->mobile_number . '</td><td>' . $labor->score . '</td><td>' . $labor->result . '</td></tr>';
                            }
                        endforeach;
                    }
                }
            }
            $html .= '</table>';
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
            die;
        }
        if (isset($_REQUEST['excel'])) {
            $criteria = new CDbCriteria;

            if (@$_REQUEST['institute_name']) {
                $criteria->addCondition("institute_name LIKE '%{$_REQUEST['institute_name']}%'");
            }
            if (@$_REQUEST['type']) {
                $criteria->addCondition("training_type = '{$_REQUEST['type']}'");
            }
            if (@$_REQUEST['batch_no']) {
                $criteria->addCondition("batch_no = {$_REQUEST['batch_no']}");
            }
            if (@$_REQUEST['start_date']) {
                $criteria->addCondition("t.start_date >= '{$_REQUEST['start_date']}'");
            }
            if (@$_REQUEST['end_date']) {
                $criteria->addCondition("t.end_date <= '{$_REQUEST['end_date']}'");
            }

            $trainings = Trainings::model()->findAll($criteria);
            Yii::import('ext.phpexcel.XPHPExcel');
            $objPHPExcel = XPHPExcel::createPHPExcel();
            // Set properties
            $objPHPExcel->getProperties()->setCreator("ENGRO KT");
            $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
            $objPHPExcel->getProperties()->setTitle("Training Reports");
            $objPHPExcel->getProperties()->setSubject("Training Reports");
            $objPHPExcel->getProperties()->setDescription("Training Reports");

            // Active sheet
            $sheet1 = $objPHPExcel->setActiveSheetIndex(0);
            $count = 6;
            $headAlpha = 0;
            $sheet1->setCellValue('C2', 'Training Reports');
            $sheet1->mergeCells("C2:F2");
            $sheet1->getStyle("C2:F2")->applyFromArray(array("font" => array("bold" => true)));



            //Columns
            $sheet1->setCellValue('B3', 'Training Type');
            $sheet1->setCellValue('C3', 'Institute Name');
            $sheet1->setCellValue('D3', 'Batch No');
            $sheet1->setCellValue('E3', 'Start Date');
            $sheet1->setCellValue('F3', 'End Date');
            $sheet1->setCellValue('G3', 'status');

            $sheet1->setCellValue("H3", 'Applicant ID');
            

            $sheet1->setCellValue("I3", 'Score');
            $sheet1->setCellValue("J3", 'Result');

            $sheet1->setCellValue('K3', 'Full Name');
            $sheet1->setCellValue('L3', 'Father Name');
            $sheet1->setCellValue('M3', 'CNIC');
            $sheet1->setCellValue('N3', 'Religion');
            $sheet1->setCellValue('O3', 'DOB');
            $sheet1->setCellValue('P3', 'Mobile Number');
            $sheet1->setCellValue('Q3', 'Martial Status');
            $sheet1->setCellValue('R3', 'Kids');
            $sheet1->setCellValue('S3', 'Block 2');
            $sheet1->setCellValue('T3', 'Village');
            $sheet1->setCellValue('U3', 'Tehsil');
            $sheet1->setCellValue('V3', 'District');
            $sheet1->setCellValue('W3', 'Category');
            $sheet1->setCellValue('X3', 'Applied For');
            $sheet1->setCellValue('Y3', 'Registered');
            $sheet1->setCellValue('Z3', 'Remarks');
            //$sheet1->setCellValue('AG3', 'Work Status');
            $sheet1->setCellValue('AA3', 'Drive');
            $sheet1->setCellValue('AB3', 'Driving License Number');
            $sheet1->setCellValue('AC3', 'Driving License Category');
            $sheet1->setCellValue('AD3', 'Vehicle Type');
            $sheet1->setCellValue('AE3', 'Issue Date');
            $sheet1->setCellValue('AF3', 'Valid Upto');
            $sheet1->setCellValue('AG3', 'Applicant HSE');
            $sheet1->setCellValue('AH3', 'Applicant Medical Type');
            $sheet1->setCellValue('AI3', 'Applicant Medical Result');
            $sheet1->setCellValue('AJ3', 'Applicant Police Verified');

            $sheet1->setCellValue('AK3', 'Source of Income');
            $sheet1->setCellValue('AL3', 'Company Name');
            $sheet1->setCellValue('AM3', 'Date From ');
            $sheet1->setCellValue('AN3', 'Date To');
            $sheet1->setCellValue('AO3', 'Position');
            $sheet1->setCellValue('AP3', 'Salary');

            $sheet1->setCellValue('AQ3', 'Source of Income');
            $sheet1->setCellValue('AR3', 'Company Name');
            $sheet1->setCellValue('AS3', 'Date From ');
            $sheet1->setCellValue('AT3', 'Date To');
            $sheet1->setCellValue('AU3', 'Position');
            $sheet1->setCellValue('AV3', 'Salary');

            $sheet1->setCellValue('AW3', 'Experience');


            $sheet1->setCellValue('AX3', 'Degree');
            $sheet1->setCellValue('AY3', 'Board');
            $sheet1->setCellValue('AZ3', 'Passing Year');
            $sheet1->setCellValue('BA3', 'Institute Name');
            $sheet1->setCellValue('BB3', 'Certificate');

            $sheet1->setCellValue('BC3', 'Degree');
            $sheet1->setCellValue('BD3', 'Board');
            $sheet1->setCellValue('BE3', 'Passing Year');
            $sheet1->setCellValue('BF3', 'Institute Name');
            $sheet1->setCellValue('BG3', 'Certificate');

            $sheet1->getStyle("B3:BG3")->applyFromArray(array("font" => array("bold" => true)));

            for ($col = 'B'; $col !== 'BG'; $col++) {
                $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
            }

            if ($trainings) {
                $count = 5;
                foreach ($trainings as $key => $training) {
                    $lr = LabourTraings::model()->findAll('training_id=:id', array(':id' => $training->id));
                    if ($lr) {
                        foreach ($lr as $lrr) {
                            $sheet1->setCellValue("B$count", @$training->training_type);
                            $sheet1->setCellValue("C$count", @$training->institute_name);
                            $sheet1->setCellValue("D$count", @$training->batch_no);
                            $sheet1->setCellValue("E$count", @$training->start_date);
                            $sheet1->setCellValue("F$count", @$training->end_date);
                            $sheet1->setCellValue("G$count", (@$training->status == 0) ? 'Open' : 'End');
                            $sheet1->setCellValue("H$count", @$lrr->labor->id);

                            $sheet1->setCellValue("I$count", @$lrr->score);
                            $sheet1->setCellValue("J$count", @$lrr->result);

                            $sheet1->setCellValue("K$count", @$lrr->labor->full_name);
                            $sheet1->setCellValue("L$count", @$lrr->labor->father_name);
                            $sheet1->setCellValue("M$count", @$lrr->labor->cnic);
                            $sheet1->setCellValue("N$count", @$lrr->labor->religion);
                            $sheet1->setCellValue("O$count", date('d-m-Y', strtotime(@$lrr->labor->dob))); //date('d M,Y',strtotime(@$lrr->labor->dob)));
                            $sheet1->setCellValue("P$count", @$lrr->labor->mobile_number);
                            $sheet1->setCellValue("Q$count", (@$lrr->labor->martial_status == 1) ? 'Married' : 'Single');
                            $sheet1->setCellValue("R$count", @$lrr->labor->kids);
                            $sheet1->setCellValue("S$count", (@$lrr->labor->block_2 == 1) ? 'Yes' : 'No');
                            $sheet1->setCellValue("T$count", @$lrr->labor->village->village);
                            $sheet1->setCellValue("U$count", @$lrr->labor->tehsil->name);
                            $sheet1->setCellValue("V$count", @$lrr->labor->district->name);
                            $sheet1->setCellValue("W$count", (@$lrr->labor->category_id == 1) ? 'Skilled' : 'Unskilled');
                            $sheet1->setCellValue("X$count", @$lrr->labor->designation);
                            $sheet1->setCellValue("Y$count", date('d-m-Y', strtotime(@$lrr->labor->createdOn)));
                            $sheet1->setCellValue("Z$count", @$lrr->labor->remarks);
                            //$sheet1->setCellValue("AH$count", $this->Laborwork(@$lrr->labor->id));
                            $sheet1->setCellValue("AA$count", (@$lrr->labor->drive == 1) ? 'Yes' : 'No');
                            $sheet1->setCellValue("AB$count", (@$lrr->labor->drivingLicense) ? @$lrr->labor->drivingLicense[0]->driving_license_number : '-');
                            $sheet1->setCellValue("AC$count", (@$lrr->labor->drivingLicense) ? @$lrr->labor->drivingLicense[0]->license_category : '-');
                            $sheet1->setCellValue("AD$count", (@$lrr->labor->drivingLicense) ? @$lrr->labor->drivingLicense[0]->vehicle_type : '-');
                            $sheet1->setCellValue("AE$count", (@$lrr->labor->drivingLicense) ? (date('d-m-Y', strtotime(@$lrr->labor->drivingLicense[0]->issue_date))) : '-');
                            $sheet1->setCellValue("AF$count", (@$lrr->labor->drivingLicense) ? (date('d-m-Y', strtotime(@$lrr->labor->drivingLicense[0]->valid_upto))) : '-');
                            $sheet1->setCellValue("AG$count", (@$lrr->labor->hse) ? ((@$lrr->labor->hse[0]->hse == 1) ? 'Yes' : 'No') : '-');
                            $sheet1->setCellValue("AH$count", (@$lrr->labor->medical) ? @$lrr->labor->medical[0]->type : '-');
                            $sheet1->setCellValue("AI$count", (@$lrr->labor->medical) ? @$lrr->labor->medical[0]->result : '-');
                            $sheet1->setCellValue("AJ$count", (@$lrr->labor->police) ? ((@$lrr->labor->police[0]->police_verified == 1) ? 'Yes' : 'No') : '-');



                            $employments = $this->getRecentData(@$lrr->labor->id, 'employment');
                            if (!empty($employments['data'])) {
                                if (array_key_exists(0, $employments['data'])) {
                                    $sheet1->setCellValue("AK$count", $employments['data'][0]['source_of_income']);
                                    $sheet1->setCellValue("AL$count", $employments['data'][0]['company_name']);
                                    $sheet1->setCellValue("AM$count", date('d-m-Y', strtotime($employments['data'][0]['from_date'])));
                                    $sheet1->setCellValue("AN$count", date('d-m-Y', strtotime($employments['data'][0]['to_date'])));
                                    $sheet1->setCellValue("AO$count", $employments['data'][0]['position']);
                                    $sheet1->setCellValue("AP$count", $employments['data'][0]['salary']);
                                }
                                if (array_key_exists(1, $employments['data'])) {
                                    $sheet1->setCellValue("AQ$count", $employments['data'][1]['source_of_income']);
                                    $sheet1->setCellValue("AR$count", $employments['data'][1]['company_name']);
                                    $sheet1->setCellValue("AS$count", date('d-m-Y', strtotime($employments['data'][1]['from_date'])));
                                    $sheet1->setCellValue("AT$count", date('d-m-Y', strtotime($employments['data'][1]['to_date'])));
                                    $sheet1->setCellValue("AU$count", $employments['data'][1]['position']);
                                    $sheet1->setCellValue("AV$count", $employments['data'][1]['salary']);
                                }
                            }
                            $sheet1->setCellValue("AW$count", @$employments['experience']);
                            $educations = $this->getRecentData(@$lrr->labor->id, 'education');
                            if (!empty($educations)) {
                                if (array_key_exists(0, $educations)) {
                                    switch ($educations[0]['education_type_id']) {
                                        case '1':
                                            $educationTypeId = 'Primary';
                                            break;
                                        case '2':
                                            $educationTypeId = 'Middle';
                                            break;
                                        case '3':
                                            $educationTypeId = 'Matric';
                                            break;
                                        case '4':
                                            $educationTypeId = 'Intermediate';
                                            break;
                                        case '5':
                                            $educationTypeId = 'Graduation';
                                            break;
                                        case '6':
                                            $educationTypeId = 'Masters';
                                            break;
                                        case '7':
                                            $educationTypeId = 'Diploma';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                    $sheet1->setCellValue("AX$count", @$$educationTypeId);
                                    $sheet1->setCellValue("AY$count", $educations[0]['board']);
                                    $sheet1->setCellValue("AZ$count", $educations[0]['passing_year']);
                                    $sheet1->setCellValue("BA$count", $educations[0]['organization_name']);
                                    $sheet1->setCellValue("BB$count", $educations[0]['degree']);
                                }
                                if (array_key_exists(1, $educations)) {
                                    switch ($educations[1]['education_type_id']) {
                                        case '1':
                                            $educationTypeId = 'Primary';
                                            break;
                                        case '2':
                                            $educationTypeId = 'Middle';
                                            break;
                                        case '3':
                                            $educationTypeId = 'Matric';
                                            break;
                                        case '4':
                                            $educationTypeId = 'Intermediate';
                                            break;
                                        case '5':
                                            $educationTypeId = 'Graduation';
                                            break;
                                        case '6':
                                            $educationTypeId = 'Masters';
                                            break;
                                        case '7':
                                            $educationTypeId = 'Diploma';
                                            break;
                                        default:
                                            # code...
                                            break;
                                    }
                                    $sheet1->setCellValue("BC$count", @$$educationTypeId);
                                    $sheet1->setCellValue("BD$count", $educations[1]['board']);
                                    $sheet1->setCellValue("BE$count", $educations[1]['passing_year']);
                                    $sheet1->setCellValue("BF$count", $educations[1]['organization_name']);
                                    $sheet1->setCellValue("BG$count", $educations[1]['degree']);
                                }
                            }
                            $count++;
                        }
                    } else {
                            $sheet1->setCellValue("B$count", @$training->training_type);
                            $sheet1->setCellValue("C$count", @$training->institute_name);
                            $sheet1->setCellValue("D$count", @$training->batch_no);
                            $sheet1->setCellValue("E$count", @$training->start_date);
                            $sheet1->setCellValue("F$count", @$training->end_date);
                            $sheet1->setCellValue("G$count", (@$training->status == 0) ? 'Open' : 'End');
                            $count++;
                    }
                }
            }
            $sheet1->setTitle('Training Reports');
            $filename = 'trainingreport.xlsx';
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header("Content-Disposition: attachment;filename={$filename}");
            header('Cache-Control: max-age=0');
            $objWriter->save('php://output');
            die;
        }

        $this->render('report', $data);
    }

    public function actionSubmitresult() {
        if (!empty($_POST['training_id'])) {
            if (!empty($_POST['labor_id'])) {
                //$training = Trainings::model()->findByPk($_POST['training_id']);
                //foreach($_POST['labors'] as $l):
                //$model = new LabourTraings;
                $model = LabourTraings::model()->find('labour_id=:id AND training_id=:training', array(':id' => $_POST['labor_id'], ':training' => $_POST['training_id']));
                if (!$model) {
                    $model = new LabourTraings;
                }
                $model->traings = '1';
                $model->score = $_POST['score'];
                $model->result = $_POST['result'];
                $model->status = 1;
                $model->save(false);
                //endforeach;
                echo json_encode(array('success' => 'Information updated successfully.'));
            } else {
                echo json_encode(array('error' => 'Please select atleat one applicant.'));
            }
        } else {
            echo json_encode(array('error' => 'Something went wrong.'));
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
