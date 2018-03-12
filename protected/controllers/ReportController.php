<?php 

ini_set('max_execution_time', 50000);
class ReportController extends Controller
{

    public function init()
    {
        $this->checkSession();
        
    }
    public function actionExcelreport($id=''){
        $this->checkAdmin();
        $model = LaborRequisitions::model()->findByPk($id);
        $detail = LaborRequisitionDetails::model()->find('labor_requisition_id=:id',array(':id'=>$id));
        
        Yii::import('ext.phpexcel.XPHPExcel');      
        $objPHPExcel = XPHPExcel::createPHPExcel();
        // Set properties
        $objPHPExcel->getProperties()->setCreator("ENGRO KT");
        $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
        $objPHPExcel->getProperties()->setTitle("Applicant Requisition Detail");
        $objPHPExcel->getProperties()->setSubject("Applicant Requisition Detail");
        $objPHPExcel->getProperties()->setDescription("Applicant Requisition Detail");
        
        // Active sheet
        $sheet1=$objPHPExcel->setActiveSheetIndex(0);
        $count = 6;
        $headAlpha=0;
        $sheet1->setCellValue('C2', 'Applicant Requisition Detail');
        $sheet1->mergeCells("C2:E2");
        $sheet1->getStyle("C2:E2")->applyFromArray(array("font" => array( "bold" => true)));
        

        
        //Columns
        $sheet1->setCellValue('B4','Company');
        $sheet1->setCellValue('C4', ucfirst(@$model->requisition->requisition->company->company_name).'('.ucfirst((@$model->requisition->requisition->company->allied_to==1)?'Mining':'Power').')');
        $sheet1->setCellValue('D4', 'Requisition Code');
        $sheet1->setCellValue('E4', @$model->requisition->requisition->requisition_code);

        $sheet1->setCellValue('B5', 'Applicant Name');
        $sheet1->setCellValue('C5', ucfirst(@$model->labour->full_name));

        $sheet1->setCellValue('D5', 'Applicant CNIC');
        $sheet1->setCellValue('E5', @$model->labour->cnic);
        if(@$detail->job_type==1){ 
          $jobType = 'Daily';
        } 
        if(@$detail->job_type==2){ 
          $jobType = 'Monthly';
        }
        $sheet1->setCellValue('F5', 'Salary');
        $sheet1->setCellValue('G5', 'PKR '.@number_format($detail->salary).' '.@$jobType);
        
        $sheet1->setCellValue('B6', 'Requisition Type');
        $sheet1->setCellValue('C6', ucfirst(@$model->requisition->skill).' ('.((@$model->requisition->type==1)?'Skilled':'Unskilled').')');
        
        $sheet1->setCellValue('D6', 'Head Count');
        $sheet1->setCellValue('E6', @$model->requisition->count);

        $sheet1->setCellValue('F6', 'Date');
        $sheet1->setCellValue('G6', date('d M,Y',strtotime(@$model->requisition->date_from)).' - '.date('d M,Y',strtotime(@$model->requisition->date_to)));
        $sheet1->getStyle("B4:G4")->applyFromArray(array("font" => array( "bold" => true)));
        $sheet1->getStyle("B5:G5")->applyFromArray(array("font" => array( "bold" => true)));
        $sheet1->getStyle("B6:G6")->applyFromArray(array("font" => array( "bold" => true)));

        $sheet1->getColumnDimension("B")->setAutoSize(true);
        $sheet1->getColumnDimension("C")->setAutoSize(true);
        $sheet1->getColumnDimension("D")->setAutoSize(true);
        $sheet1->getColumnDimension("E")->setAutoSize(true);
        $sheet1->getColumnDimension("F")->setAutoSize(true);
        $sheet1->getColumnDimension("G")->setAutoSize(true);


        $startM = date('m',strtotime(@$model->requisition->date_from));
        $startE = date('m',strtotime(@$model->requisition->date_to));
        //populate data
        
        $alphabet = array('C','D','F','G','I','J','L','M','O','P','R','S','U','V','X','Y','Z');
        
        $cclmn = 0;
        for($i=$startM;$i<=$startE;$i++){
          $count = 8;
          $dcclmn = $alphabet[$cclmn];
          $acclmn = $alphabet[$cclmn + 1];

          $LC = $dcclmn.''.$count;
          $RC = $acclmn.''.$count;
          $sheet1->setCellValue("$LC", date('d M,Y',strtotime(date(date('Y').'-'.sprintf('%02d', $i).'-01'))).' - '.date('d M,Y',strtotime(date(date('Y').'-'.sprintf('%02d', $i).'-'.date('t')))));
          $sheet1->mergeCells("$LC:$RC");
          $sheet1->getStyle("$LC:$RC")->applyFromArray(array("font" => array( "bold" => true)));
          $sheet1->getColumnDimension("$dcclmn")->setAutoSize(true);
          $sheet1->getColumnDimension("$acclmn")->setAutoSize(true);
          $count++;
          $LC = $dcclmn.''.$count;
          $RC = $acclmn.''.$count;
          $sheet1->setCellValue("$LC", 'Date');

          $sheet1->setCellValue("$RC", 'Attendance');
          $dcount = $count + 1;
          $number = cal_days_in_month(CAL_GREGORIAN, sprintf('%02d', $i),date('Y'));
          for($j=1;$j<=$number;$j++){
            $DLC = $dcclmn.''.$dcount;
            $ARC = $acclmn.''.$dcount;
            $date = date('Y').'-'.sprintf('%02d', $i).'-'.$j;
                $a = $this->checkAttandance(@$model->labour->id,@$model->requisition_id,$date);
                $ddate = $j.'-'.sprintf('%02d', $i).'-'.date('Y');
                $sheet1->setCellValue("$DLC", $ddate);
                if($a){
                $sheet1->setCellValue("$ARC",'Present');
              } else{
                $sheet1->setCellValue("$ARC", 'Absent');
              }
                $dcount++;
          }
          $cclmn = $cclmn + 2 ;
          $count = $dcount + 1;
        }
        $sheet1->setTitle('Applicant Requisition Detail');
        /*$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $file = getcwd().'\uploads\report.xlsx';
        $objWriter->save($file);
        echo "<script type='text/javascript'>window.location='".Yii::app()->baseUrl."/uploads/report.xlsx';</script>";*/
        $filename = 'report.xlsx';
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment;filename={$filename}");
        header('Cache-Control: max-age=0');
        $objWriter->save('php://output');
        die;
    }


    public function actionPdfreport($id=''){
            ini_set('max_execution_time', 50000);
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

            $model = LaborRequisitions::model()->findByPk($id);
            $detail = LaborRequisitionDetails::model()->find('labor_requisition_id=:id',array(':id'=>$id));

            
            //generate report data
            
            //$html .= '<table border="2">';
            $html .= '<tr><td colspan="6" style="text-align:center">Applicant Requisition Detail</td></tr>';
            $html .= '<tr><td colspan="2">Company</td><td>'.(ucfirst(@$model->requisition->requisition->company->company_name).'('.ucfirst((@$model->requisition->requisition->company->allied_to==1)?'Mining':'Power').')').'</td><td colspan="2">Requisition Code</td><td>'.(@$model->requisition->requisition->requisition_code).'</td></tr>';
            
        
            if(@$detail->job_type==1){ 
              $jobType = 'Daily';
            } 
            if(@$detail->job_type==2){ 
              $jobType = 'Monthly';
            }
  
            $html .= '<tr><td>Applicant Name</td><td>'.(ucfirst(@$model->labour->full_name)).'</td><td>Applicant CNIC</td><td>'.@$model->labour->cnic.'</td><td>Salary</td><td>'.('PKR '.@number_format($detail->salary).' '.@$jobType).'</td></tr>';
            $html .= '<tr><td>Requisition type</td><td>'.(ucfirst(@$model->requisition->skill).' ('.((@$model->requisition->type==1)?'Skilled':'Unskilled').')').'</td><td>Head Count</td><td>'.@$model->requisition->count.'</td><td>Date</td><td>'.(date('d M,Y',strtotime(@$model->requisition->date_from)).' - '.date('d M,Y',strtotime(@$model->requisition->date_to))).'</td></tr>';
            



            $startM = date('m',strtotime(@$model->requisition->date_from));
            $startE = date('m',strtotime(@$model->requisition->date_to));
            //populate data
            for($i=$startM;$i<=$startE;$i++){
              
              $html .= '<tr><td colspan="6"></td></tr>';
              $html .= '<tr><td colspan="6" style="text-align:center">'.(date('d M,Y',strtotime(date(date('Y').'-'.sprintf('%02d', $i).'-01'))).' - '.date('d M,Y',strtotime(date(date('Y').'-'.sprintf('%02d', $i).'-'.date('t'))))).'</td></tr>';

              $html .= '<tr><td colspan="3">Date</td><td colspan="3">Attendance</td></tr>';
              $number = cal_days_in_month(CAL_GREGORIAN, sprintf('%02d', $i),date('Y'));
              for($j=1;$j<=$number;$j++){
                $date = date('Y').'-'.sprintf('%02d', $i).'-'.$j;
                    $a = $this->checkAttandance(@$model->labour->id,@$model->requisition_id,$date);
                    $ddate = $j.'-'.sprintf('%02d', $i).'-'.date('Y');
                    $html .='<tr><td colspan="3">'.$ddate.'</td><td colspan="3">'.(($a)?'Present':'Absent').'</td></tr>';
              }
            }

            $html .= '</table>';
            //echo $html;exit;
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
            
        }

    public function actionAlllabor($type=''){
        ini_set('max_execution_time', 50000);
        ini_set('memory_limit', '-1');
        $this->checkAdmin();
        //$model = Labours::model()->findAll(array('limit'=>5000));
        //$model = Labours::model()->with('employments','educations','skill','police','medical')->findAll();
        $model = Labours::model()->findAll();
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
            //generate report data
            
            //$html .= '<table border="1">';
            $html .= '<tr><td colspan="9" style="text-align:center">All Applicants</td></tr>';
            
            $html .= '<tr><td colspan="9"></td></tr>';
            $html .= '<tr><td>ID</td><td>Name</td><td>Father Name</td><td>CNIC</td><td>NICOP</td><td>Number</td><td>Gender</td><td>Work Status</td><td>Registered On</td></tr>';

            foreach($model as $m){
              if(@$m->gender==1){
                $gender = 'Male';
              }
              if(@$m->gender==2){
                $gender = 'Female';
              }
              $html .= '<tr><td>'.@$m->id.'</td><td>'.@$m->full_name.'</td><td>'.@$m->father_name.'</td><td>'.@$m->cnic.'</td><td>'.@$m->nicop.'</td><td>'.@$m->mobile_number.'</td><td>'.@$m->gender.'</td><td>'.($this->Laborwork(@$m->id)).'</td><td>'.(date('d M,Y',strtotime(@$m->createdOn))).'</td></tr>';
            }

            $html .= '</table>';
            // output the HTML content
            
            //echo $html;exit;
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
            die;
        }
        if($type=='excel'){
          Yii::import('ext.phpexcel.XPHPExcel');      
          $objPHPExcel = XPHPExcel::createPHPExcel();
          // Set properties
          $objPHPExcel->getProperties()->setCreator("ENGRO KT");
          $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
          $objPHPExcel->getProperties()->setTitle("All Applicants");
          $objPHPExcel->getProperties()->setSubject("All Applicants");
          $objPHPExcel->getProperties()->setDescription("All Applicants");
          
          // Active sheet
          $sheet1=$objPHPExcel->setActiveSheetIndex(0);
          $count = 6;
          $headAlpha=0;
          $sheet1->setCellValue('C2', 'All Applicants');
          $sheet1->mergeCells("C2:F2");
          $sheet1->getStyle("C2:F2")->applyFromArray(array("font" => array( "bold" => true)));
          

          
          //Columns
          $sheet1->setCellValue('A3', 'ID');
          $sheet1->setCellValue('B3', 'Full Name');
          $sheet1->setCellValue('C3', 'Father Name');
          $sheet1->setCellValue('D3', 'CNIC');
          $sheet1->setCellValue('E3', 'NICOP');
          $sheet1->setCellValue('F3', 'Religion');
          $sheet1->setCellValue('G3', 'DOB');
          $sheet1->setCellValue('H3', 'Gender');
          $sheet1->setCellValue('I3', 'Mobile Number');
          $sheet1->setCellValue('J3', 'Martial Status');
          $sheet1->setCellValue('K3', 'Kids');
          $sheet1->setCellValue('L3', 'Block 2');
          $sheet1->setCellValue('M3', 'Village');
          $sheet1->setCellValue('N3', 'Tehsil');
          $sheet1->setCellValue('O3', 'District');
          $sheet1->setCellValue('P3', 'Category');
          $sheet1->setCellValue('Q3', 'Applied For');
          $sheet1->setCellValue('R3', 'Registered');
          $sheet1->setCellValue('S3', 'Remarks');
          $sheet1->setCellValue('T3', 'Work Status');
          $sheet1->setCellValue('U3', 'Drive');
          $sheet1->setCellValue('V3', 'Driving License Number');
          $sheet1->setCellValue('W3', 'Driving License Category');
          $sheet1->setCellValue('X3', 'Vehicle Type');
          $sheet1->setCellValue('Y3', 'Issue Date');
          $sheet1->setCellValue('Z3', 'Valid Upto');
          /*$sheet1->setCellValue('Y3', 'Applicant HSE');
          $sheet1->setCellValue('Z3', 'Applicant Medical Type');
          $sheet1->setCellValue('AA3', 'Applicant Medical Result');
          $sheet1->setCellValue('AB3', 'Applicant Police Verified');*/

          
          $sheet1->setCellValue('AA3', 'Last Job');
          $sheet1->setCellValue('AB3', 'Last Comment');


          $sheet1->setCellValue('AC3', 'Source of Income');
          $sheet1->setCellValue('AD3', 'Company Name');
          $sheet1->setCellValue('AE3', 'Date From ');          
          $sheet1->setCellValue('AF3', 'Date To');          
          $sheet1->setCellValue('AG3', 'Position');          
          $sheet1->setCellValue('AH3', 'Salary');

          $sheet1->setCellValue('AI3', 'Source of Income');
          $sheet1->setCellValue('AJ3', 'Company Name');
          $sheet1->setCellValue('AK3', 'Date From ');          
          $sheet1->setCellValue('AL3', 'Date To');          
          $sheet1->setCellValue('AM3', 'Position');          
          $sheet1->setCellValue('AN3', 'Salary');

          $sheet1->setCellValue('AO3', 'Experience');


          $sheet1->setCellValue('AP3', 'Degree');
          $sheet1->setCellValue('AQ3', 'Board');
          $sheet1->setCellValue('AR3', 'Passing Year');
          $sheet1->setCellValue('AS3', 'Institute Name');
          $sheet1->setCellValue('AT3', 'Certificate');

          $sheet1->setCellValue('AU3', 'Degree');
          $sheet1->setCellValue('AV3', 'Board');
          $sheet1->setCellValue('AW3', 'Passing Year');
          $sheet1->setCellValue('AX3', 'Institute Name');
          $sheet1->setCellValue('AY3', 'Certificate');


          $sheet1->setCellValue('AZ3', 'Applicant HSE');
          $sheet1->setCellValue('BA3', 'Applicant Medical Type');
          $sheet1->setCellValue('BB3', 'Applicant Medical Result');
          $sheet1->setCellValue('BC3', 'Applicant Police Verified');
          $sheet1->setCellValue('BD3', 'Applicant Dumper Skill Test');

          $sheet1->setCellValue('BE3', 'Applicant Dumper Skill Date');
          $sheet1->setCellValue('BF3', 'Police Submitted Date');
          $sheet1->setCellValue('BG3', 'Police Cleared Date');
          $sheet1->setCellValue('BH3', 'Police Security Date');


          
          
          $sheet1->getStyle("A3:BH3")->applyFromArray(array("font" => array( "bold" => true)));
          
          for($col = 'A'; $col !== 'BH'; $col++) {
              $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
          }


          $count = 5;

          foreach($model as $m){
           
            $sheet1->setCellValue("A$count", @$m->id);
            $sheet1->setCellValue("B$count", @$m->full_name);
            $sheet1->setCellValue("C$count", @$m->father_name);
            $sheet1->setCellValue("D$count", @$m->cnic);
            $sheet1->setCellValue("E$count", @$m->nicop);
            $sheet1->setCellValue("F$count", @$m->religion);

            if($m->gender==1){
              $gender = 'Male';
            }
            if($m->gender==2){
              $gender = 'Female';
            }
            
            $sheet1->setCellValue("G$count", date('d-m-Y',strtotime(@$m->dob)));//date('d M,Y',strtotime($m->dob)));
            $sheet1->setCellValue("H$count", @$m->gender);
            $sheet1->setCellValue("I$count", $m->mobile_number);
            
            $sheet1->setCellValue("J$count", (@$m->martial_status==1)?'Married':'Single');
            $sheet1->setCellValue("K$count", @$m->kids);
            $sheet1->setCellValue("L$count", (@$m->block_2==1)?'Yes':'No');
            $sheet1->setCellValue("M$count", @$m->village->village);
            $sheet1->setCellValue("N$count", @$m->tehsil->name);
            $sheet1->setCellValue("O$count", @$m->district->name);
            $sheet1->setCellValue("P$count", (@$m->category_id==1)?'Skilled':'Unskilled');
            $sheet1->setCellValue("Q$count", @$m->designation);
            $sheet1->setCellValue("R$count", date('d-m-Y',strtotime(@$m->createdOn)));
            $sheet1->setCellValue("S$count", @$m->remarks);
            $sheet1->setCellValue("T$count", $this->Laborwork(@$m->id));
            $sheet1->setCellValue("U$count", ($m->drive==1)?'Yes':'No');
            $sheet1->setCellValue("V$count", ($m->drive==1)?((@$m->drivingLicense)?$m->drivingLicense[0]->driving_license_number:'-'):'');
            $sheet1->setCellValue("W$count", ($m->drive==1)?((@$m->drivingLicense)?$m->drivingLicense[0]->license_category:'-'):'');
            $sheet1->setCellValue("X$count", ($m->drive==1)?((@$m->drivingLicense)?$m->drivingLicense[0]->vehicle_type:'-'):'');

            $issuedate = '-';
            if($m->drive==1){
             if(@$m->drivingLicense){
              if($m->drivingLicense[0]->issue_date!='0000-00-00' && $m->drivingLicense[0]->issue_date!=NULL){
                $issuedate = date('d-m-Y',strtotime($m->drivingLicense[0]->issue_date));
              }
             } 
            }

            $valid_upto = '-';
            if($m->drive==1){
             if(@$m->drivingLicense){
              if($m->drivingLicense[0]->valid_upto!='0000-00-00' && $m->drivingLicense[0]->valid_upto!=NULL){
                $valid_upto = date('d-m-Y',strtotime($m->drivingLicense[0]->valid_upto));
              }
             } 
            }
            $sheet1->setCellValue("Y$count", @$issuedate);
            
            $sheet1->setCellValue("Z$count", @$valid_upto);
            /*$sheet1->setCellValue("Y$count", (@$m->hse)?(($m->hse[0]->hse==1)?'Yes':'No'):'-');
            $sheet1->setCellValue("Z$count", (@$m->medical)?$m->medical[0]->type:'-');
            $sheet1->setCellValue("AA$count", (@$m->medical)?$m->medical[0]->result:'-');
            $sheet1->setCellValue("AB$count", (@$m->police)?(($m->police[0]->police_verified==1)?'Yes':'No'):'-');*/



            $sheet1->setCellValue("AA$count", $this->labourLastWork($m->id));
            $sheet1->setCellValue("AB$count", $this->labourLastComment($m->id));


            $employments = $this->getRecentData($m->employments,'employment');
            if(!empty($employments['data'])){
              if (array_key_exists(0, $employments['data'])) {
                $sheet1->setCellValue("AC$count", @$employments['data'][0]['source_of_income']);
                $sheet1->setCellValue("AD$count", @$employments['data'][0]['company_name']);

                $from_date = '-';
                if($employments['data'][0]['from_date']!='0000-00-00' && $employments['data'][0]['from_date']!=NULL){
                  $from_date = date('d-m-Y',strtotime($employments['data'][0]['from_date']));
                }
                $to_date = '-';
                if($employments['data'][0]['to_date']!='0000-00-00' && $employments['data'][0]['to_date']!=NULL){
                  $to_date = date('d-m-Y',strtotime($employments['data'][0]['to_date']));
                }
                $sheet1->setCellValue("AE$count", @$from_date);
                $sheet1->setCellValue("AF$count", @$to_date);
                $sheet1->setCellValue("AG$count", @$employments['data'][0]['position']);
                $sheet1->setCellValue("AH$count", $employments['data'][0]['salary']);  
              }
              if (array_key_exists(1, $employments['data'])) {
                $sheet1->setCellValue("AI$count", @$employments['data'][1]['source_of_income']);
                $sheet1->setCellValue("AJ$count", @$employments['data'][1]['company_name']);
                $from_date = '-';
                if($employments['data'][1]['from_date']!='0000-00-00' && $employments['data'][1]['from_date']!=NULL){
                  $from_date = date('d-m-Y',strtotime(@$employments['data'][1]['from_date']));
                }
                $to_date = '-';
                if($employments['data'][1]['to_date']!='0000-00-00' && $employments['data'][1]['to_date']!=NULL){
                  $to_date = date('d-m-Y',strtotime($employments['data'][1]['to_date']));
                }
                $sheet1->setCellValue("AK$count", @$from_date);
                $sheet1->setCellValue("AL$count", @$to_date);
                $sheet1->setCellValue("AM$count", @$employments['data'][1]['position']);
                $sheet1->setCellValue("AN$count", @$employments['data'][1]['salary']);  
              }
            }
            $sheet1->setCellValue("AO$count", @$employments['experience']);
            
            $educations = $this->getRecentData($m->educations,'education');
            if(!empty($educations)){
              if (array_key_exists(0, $educations)) {
                switch ($educations[0]['education_type_id']) {
                  case '0':
                    $educationTypeId = '';
                    break;
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
                $sheet1->setCellValue("AP$count", @$educationTypeId);
                $sheet1->setCellValue("AQ$count", @$educations[0]['board']);
                $sheet1->setCellValue("AR$count", @$educations[0]['passing_year']);
                $sheet1->setCellValue("AS$count", @$educations[0]['organization_name']);
                $sheet1->setCellValue("AT$count", @$educations[0]['degree']);  
              }
              if (array_key_exists(1, $educations)) {
                switch ($educations[1]['education_type_id']) {
                  case '0':
                    $educationTypeId = '';
                    break;
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
                $sheet1->setCellValue("AU$count", @$$educationTypeId);
                $sheet1->setCellValue("AV$count", @$educations[1]['board']);
                $sheet1->setCellValue("AW$count", @$educations[1]['passing_year']);
                $sheet1->setCellValue("AX$count", @$educations[1]['organization_name']);
                $sheet1->setCellValue("AY$count", @$educations[1]['degree']);  
              }
            }



            $sheet1->setCellValue("AZ$count", (@$m->hse)?(($m->hse[0]->hse==1)?'Yes':'No'):'-');
            $sheet1->setCellValue("BA$count", (@$m->medical)?$m->medical[0]->type:'-');
            $sheet1->setCellValue("BB$count", (@$m->medical)?$m->medical[0]->result:'-');
            $sheet1->setCellValue("BC$count", (@$m->police)?(($m->police[0]->police_verified==1)?'Yes / '.(($m->police[0]->status)?'Cleared':'Not-cleared'):'No'):'-');


            

            $skill = array();
            $skillDate = array();
            if($m->skill){
              foreach($m->skill as $sk):
                array_push($skill,$sk->result);
                $date = ($sk->date)?$sk->date:$sk->createdOn;
                array_push($skillDate,date('Y-m-d',strtotime($date)));
              endforeach;
            }
            $sheet1->setCellValue("BD$count", (@$m->skill)?(implode(',', $skill)):'-');
            $sheet1->setCellValue("BE$count", (@$m->skill)?(implode(',', $skillDate)):'-');
            $sheet1->setCellValue("BF$count", (@$m->police)?(($m->police[0]->submitted_date)?$m->police[0]->submitted_date:'-'):'-');
            $sheet1->setCellValue("BG$count", (@$m->police)?(($m->police[0]->cleared_date)?$m->police[0]->cleared_date:'-'):'-');
            $sheet1->setCellValue("BH$count", (@$m->police)?(($m->police[0]->security_date)?$m->police[0]->security_date:'-'):'-');

            $count++;
          }
          $sheet1->setTitle('All Applicants');
          /*$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          //$file = getcwd().'\uploads\areport.xlsx';
          $file = '/home2/thepaks1/public_html/khushaalthar\uploads/\areport.xlsx';
          //echo $file;exit;
          $objWriter->save($file);*/
          $filename = 'allapplicants.xlsx';
          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment;filename={$filename}");
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
          die;
          //echo "<script type='text/javascript'>window.location='".Yii::app()->baseUrl."/uploads/areport.xlsx';</script>";
        }
        
    }

    public function actionAllcompany($type=''){
        ini_set('max_execution_time', 50000);
        $model = ClientCompanies::model()->findAll();
        
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
            $html .= '<tr><td colspan="6" style="text-align:center">All Client Companies</td></tr>';
            
            $html .= '<tr><td colspan="6"></td></tr>';
            $html .= '<tr><td>ID</td><td>Code</td><td>Name</td><td>Aliied to</td><td>Status</td><td>Created On</td></tr>';

            foreach($model as $m){
              $alied = '';
              if($m->allied_to==1){ $alied='Mining'; } if($m->allied_to==2){ $alied='Power'; }
              if($m->status==1){ $status='Active'; } if($m->status==2){ $status='In-active'; }
              $html .= '<tr><td>'.$m->id.'</td><td>'.$m->code_format.'</td><td>'.$m->company_name.'</td><td>'.@$alied.'</td><td>'.@$status.'</td><td>'.(date('d M,Y',strtotime($m->createdOn))).'</td></tr>';
            }

            $html .= '</table>';
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
        }
        if($type=='excel'){
          Yii::import('ext.phpexcel.XPHPExcel');      
          $objPHPExcel = XPHPExcel::createPHPExcel();
          // Set properties
          $objPHPExcel->getProperties()->setCreator("ENGRO KT");
          $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
          $objPHPExcel->getProperties()->setTitle("All Client Companies");
          $objPHPExcel->getProperties()->setSubject("All Client Companies");
          $objPHPExcel->getProperties()->setDescription("All Client Companies");
          
          // Active sheet
          $sheet1=$objPHPExcel->setActiveSheetIndex(0);
          $count = 6;
          $headAlpha=0;
          $sheet1->setCellValue('C2', 'All Client Companies');
          $sheet1->mergeCells("C2:E2");
          $sheet1->getStyle("C2:E2")->applyFromArray(array("font" => array( "bold" => true)));
          

          
          //Columns
          $sheet1->setCellValue('B3', 'Name');
          $sheet1->setCellValue('C3', 'Email');
          $sheet1->setCellValue('D3', 'Alied To');
          $sheet1->setCellValue('E3', 'Status');
          $sheet1->setCellValue('F3', 'Created On');

          $sheet1->setCellValue('H3', 'Person Name');
          $sheet1->setCellValue('I3', 'Person CNIC');
          $sheet1->setCellValue('J3', 'Person Email Address');
          $sheet1->setCellValue('K3', 'Person Mobile Number');
          $sheet1->setCellValue('L3', 'Person Designation');

          
          
          
          
          $sheet1->getStyle("B3:X3")->applyFromArray(array("font" => array( "bold" => true)));
          
          $sheet1->getColumnDimension("B")->setAutoSize(true);
          $sheet1->getColumnDimension("C")->setAutoSize(true);
          $sheet1->getColumnDimension("D")->setAutoSize(true);
          $sheet1->getColumnDimension('E')->setAutoSize(true);
          $sheet1->getColumnDimension('F')->setAutoSize(true);
          $sheet1->getColumnDimension('G')->setAutoSize(true);
          $sheet1->getColumnDimension('H')->setAutoSize(true);
          $sheet1->getColumnDimension('I')->setAutoSize(true);
          $sheet1->getColumnDimension('J')->setAutoSize(true);
          $sheet1->getColumnDimension('K')->setAutoSize(true);
          $sheet1->getColumnDimension('L')->setAutoSize(true);
          
          


          $count = 5;
          foreach($model as $m){
            if($m->allied_to==1){ $alied='Mining'; } if($m->allied_to==2){ $alied='Power'; }
            if($m->status==1){ $status='Active'; } if($m->status==2){ $status='In-active'; }
            if($m->companypersons){
              foreach($m->companypersons as $comper):
                $sheet1->setCellValue("B$count", $m->company_name);
                $sheet1->setCellValue("C$count", $m->company_email);
                $sheet1->setCellValue("D$count", @$alied);
                $sheet1->setCellValue("E$count", @$status);
                $sheet1->setCellValue("F$count",date('d M,Y',strtotime($m->createdOn)));
                $sheet1->setCellValue("H$count", @$comper->name);
                $sheet1->setCellValue("I$count", @$comper->cnic);
                $sheet1->setCellValue("J$count", @$comper->email_address);
                $sheet1->setCellValue("K$count", @$comper->mobile_number);
                $sheet1->setCellValue("L$count", @$comper->designation);
                $count++;
              endforeach;
            } else{
              $sheet1->setCellValue("B$count", $m->company_name);
              $sheet1->setCellValue("C$count", $m->company_email);
              $sheet1->setCellValue("D$count", @$alied);
              $sheet1->setCellValue("E$count", @$status);
              $sheet1->setCellValue("F$count",date('d M,Y',strtotime($m->createdOn)));
              $count++;
            }
            
          }
          $sheet1->setTitle('All Client Companies');
          $filename = 'companyreport.xlsx';
          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment;filename={$filename}");
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
        }
        
    }


    public function actionAllrequisition($type=''){
        ini_set('max_execution_time', 50000);
        /*if(Yii::app()->session['userModel']['user']['userType']=='deo'){
          $clientcompanyRequisition = ClientCompanyRequisitions::model()->findAll(); 
        } else{
          $clientcompanyRequisition = ClientCompanyRequisitions::model()->findAll('company_id=:id',array(':id'=>Yii::app()->session['userModel']['user']['id']));
        }*/
          //$this->checkAdmin();
          if(Yii::app()->session['userModel']['user']['userType']=='deo'){
            $clientcompanyRequisition = ClientCompanyRequisitions::model()->findAll(array('order'=>'id DESC'));  
          } else if(Yii::app()->session['userModel']['user']['userType']=='person'){
            $person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);
            if($person){
              $clientcompanyRequisition = ClientCompanyRequisitions::model()->findAll('company_id=:id',array(':id'=>$person->company_id),array('order'=>'id DESC')); 
            }
          } else{
            $clientcompanyRequisition = ClientCompanyRequisitions::model()->findAll('company_id=:id',array(':id'=>Yii::app()->session['userModel']['user']['id']),array('order'=>'id DESC'));
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
            $html .= '<tr><td colspan="11" style="text-align:center;font-weight:bold">All Requisitions</td></tr>';
            
            
            $html .= '<tr><td style="font-weight:bold">ID</td><td style="font-weight:bold">Code</td><td style="font-weight:bold">Company Name</td><td style="font-weight:bold">Company Person</td><td style="font-weight:bold">Person Number</td><td style="font-weight:bold">Requisition Creation Date</td><td style="font-weight:bold">Applicant Type</td><td style="font-weight:bold">Skill Required</td><td style="font-weight:bold">HC</td><td style="font-weight:bold">Status</td><td style="font-weight:bold">Requisition Date</td></tr>';
            foreach($clientcompanyRequisition as $requisition){ $deo = CompanyPersons::model()->findByPk($requisition->person_id);
              foreach($requisition->clientCompanyRequisitionDetails as $d){
                //$html .= '<tr><td colspan="11" style="text-align:center;font-weight:bold">Requisition Detail</td></tr>';
                
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
                if($requisition->company->allied_to==1){
                  $alliedto = 'Mining';
                }
                if($requisition->company->allied_to==2){
                  $alliedto = 'Power';
                }
                $html .= '<tr><td >'.$requisition->id.'</td><td>'.$requisition->requisition_code.'</td><td>'.(ucfirst($requisition->company->company_name).' ('.$alliedto).')</td><td>'.(($deo)?ucfirst($deo->name):'-').'</td><td>'.(($deo)?$deo->mobile_number:'-').'</td><td>'.(date('d M,Y',strtotime($requisition->createdOn))).'</td><td>'.@$type.'</td><td>'.@$d->skill.'</td><td>'.@$d->count.'</td><td>'.@$status.'</td><td>'.(date('d M,Y',strtotime($d->date_from)).' - '.date('d M,Y',strtotime($d->date_to))).'</td></tr>'; 
                
              }
            }

            $html .= '</table>';
            echo $html;exit;
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
        }
        if($type=='excel'){
          Yii::import('ext.phpexcel.XPHPExcel');      
          $objPHPExcel = XPHPExcel::createPHPExcel();
          // Set properties
          $objPHPExcel->getProperties()->setCreator("ENGRO KT");
          $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
          $objPHPExcel->getProperties()->setTitle("All Requisitions");
          $objPHPExcel->getProperties()->setSubject("All Requisitions");
          $objPHPExcel->getProperties()->setDescription("All Requisitions");
          
          // Active sheet
          $sheet1=$objPHPExcel->setActiveSheetIndex(0);
          $count = 6;
          $headAlpha=0;
          $sheet1->setCellValue('C2', 'All Requisitions');
          $sheet1->mergeCells("C2:F2");
          $sheet1->getStyle("C2:F2")->applyFromArray(array("font" => array( "bold" => true)));
          

          //Columns
          $sheet1->setCellValue('B3', 'ID');
          $sheet1->setCellValue('C3', 'Code');
          $sheet1->setCellValue('D3', 'Company Name');
          $sheet1->setCellValue('E3', 'Company Person');
          $sheet1->setCellValue('F3', 'Person Number');
          $sheet1->setCellValue('G3', 'Requisition Creation Date');
          $sheet1->setCellValue('H3', 'Applicant Type');
          $sheet1->setCellValue('I3', 'Skill Required');
          $sheet1->setCellValue('J3', 'HC');
          $sheet1->setCellValue('K3', 'Status');
          $sheet1->setCellValue('L3', 'Requisition Start Date');
          $sheet1->setCellValue('M3', 'Requisition End Date');
          

          
          
          $sheet1->getStyle("B3:M3")->applyFromArray(array("font" => array( "bold" => true)));
          
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
          $sheet1->getColumnDimension("L")->setAutoSize(true);
          $sheet1->getColumnDimension("M")->setAutoSize(true);
          
          $count = 5;
          foreach($clientcompanyRequisition as $requisition){ $deo = CompanyPersons::model()->findByPk($requisition->person_id);
              foreach($requisition->clientCompanyRequisitionDetails as $d){
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
                if($requisition->company->allied_to==1){
                  $alliedto = 'Mining';
                }
                if($requisition->company->allied_to==2){
                  $alliedto = 'Power';
                }


                $sheet1->setCellValue("B$count", $requisition->id);
                $sheet1->setCellValue("C$count", $requisition->requisition_code);
                $sheet1->setCellValue("D$count", (ucfirst($requisition->company->company_name).' ('.$alliedto).')');
                $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->name):'-'));
                $sheet1->setCellValue("F$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                $sheet1->setCellValue("G$count", date('d M,Y',strtotime($requisition->createdOn)));
                $sheet1->setCellValue("H$count", @$type);
                $sheet1->setCellValue("I$count", @$d->skill);
                $sheet1->setCellValue("J$count", @$d->count);
                $sheet1->setCellValue("K$count", @$status);
                $sheet1->setCellValue("L$count", (date('d M,Y',strtotime($d->date_from))));
                $sheet1->setCellValue("M$count", (date('d M,Y',strtotime($d->date_to))));
                $count++;
                
              }
              
          }
          $sheet1->setTitle('All Requisitions');
          $filename = 'allrequisitionreport.xlsx';
          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment;filename={$filename}");
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
          die;
        }
    }

    public function actionRequisitionbyid($id='',$type=''){
        ini_set('max_execution_time', 50000);
        $clientcompanyRequisition = ClientCompanyRequisitions::model()->findByPk($id); 

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
            $html .= '<tr><td colspan="11" style="text-align:center;font-weight:bold">Requisition</td></tr>';
            
            
            
            //foreach($clientcompanyRequisition->clientCompanyRequisitionDetails as $requisition){ 
              $deo = CompanyPersons::model()->findByPk($clientcompanyRequisition->person_id);
              foreach($clientcompanyRequisition->clientCompanyRequisitionDetails as $d){
                //$html .= '<tr><td colspan="11" style="text-align:center;font-weight:bold">Requisition Detail</td></tr>';
                $html .= '<tr><td style="font-weight:bold">ID</td><td style="font-weight:bold">Code</td><td style="font-weight:bold">Company Name</td><td style="font-weight:bold">Company Person</td><td style="font-weight:bold">Person Number</td><td style="font-weight:bold">Requisition Creation Date</td><td style="font-weight:bold">Applicant Type</td><td style="font-weight:bold">Skill Required</td><td style="font-weight:bold">HC</td><td style="font-weight:bold">Status</td><td style="font-weight:bold">Requisition Date</td></tr>';
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
                  $status='Closed "'.$d->remarks.'" @ '.$d->close_date.' by '.$this->closeName($d->person_id,$d->person);
                }
                if($clientcompanyRequisition->company->allied_to==1){
                  $alliedto = 'Mining';
                }
                if($clientcompanyRequisition->company->allied_to==2){
                  $alliedto = 'Power';
                }
                $html .= '<tr><td >'.$clientcompanyRequisition->id.'</td><td>'.$clientcompanyRequisition->requisition_code.'</td><td>'.(ucfirst($clientcompanyRequisition->company->company_name).' ('.$alliedto).')</td><td>'.(($deo)?ucfirst($deo->name):'-').'</td><td>'.(($deo)?$deo->mobile_number:'-').'</td><td>'.(date('d M,Y',strtotime($clientcompanyRequisition->createdOn))).'</td><td>'.@$type.'</td><td>'.@$d->skill.'</td><td>'.@$d->count.'</td><td>'.@$status.'</td><td>'.(date('d M,Y',strtotime($d->date_from)).' - '.date('d M,Y',strtotime($d->date_to))).'</td></tr>'; 
                $html .= '<tr><td colspan="11"></td></tr>';
                
                if($d->laborRequisitions){
                  $html .= '<tr><td colspan="11" style="font-weight:bold">Applicants Detail</td></tr>';
                  $html .= '<tr ><td style="font-weight:bold">ID</td><td colspan="2" style="font-weight:bold">Name</td><td style="font-weight:bold" colspan="2">Father Name</td><td style="font-weight:bold">CNIC</td><td style="font-weight:bold">Number</td><td style="font-weight:bold">Work Status</td><td style="font-weight:bold">Accepted Date</td><td style="font-weight:bold">Rejected / Release Date</td><td style="font-weight:bold">Reason</td></tr>';
                  foreach($d->laborRequisitions as $lr){
                    if($lr->status==0){
                      $statuss="Pending";
                    }
                    if($lr->status==1){
                      $statuss="Accepted";
                    }
                    if($lr->status==2){
                      $statuss="Rejected";
                    }
                    if($lr->status==3){
                      $statuss="Job Completed";
                    }
                    if($lr->status==4){
                      $statuss="Temporary";
                    }
                    $html .= '<tr><td>'.$lr->labour->id.'</td>';
                    $html .= '<td colspan="2">'.$lr->labour->full_name.'</td>';
                    $html .= '<td colspan="2">'.$lr->labour->father_name.'</td>';
                    $html .= '<td>'.$lr->labour->cnic.'</td>';
                    $html .= '<td>'.$lr->labour->mobile_number.'</td>';
                    $html .= '<td>'.@$statuss.'</td>';
                    $html .= '<td>'.$lr->accepted_date.'</td>';
                    $html .= '<td>'.$lr->rejected_date.'</td>';
                    $html .= '<td>'.$lr->reason.'</td></tr>';
                  }
                  $html .= '<tr><td colspan="11"></td></tr>';
                }
              }
            //}

            $html .= '</table>';
            
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
        }
        if($type=='excel'){
          Yii::import('ext.phpexcel.XPHPExcel');      
          $objPHPExcel = XPHPExcel::createPHPExcel();
          // Set properties
          $objPHPExcel->getProperties()->setCreator("ENGRO KT");
          $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
          $objPHPExcel->getProperties()->setTitle("All Requisitions");
          $objPHPExcel->getProperties()->setSubject("All Requisitions");
          $objPHPExcel->getProperties()->setDescription("All Requisitions");
          
          // Active sheet
          $sheet1=$objPHPExcel->setActiveSheetIndex(0);
          $count = 6;
          $headAlpha=0;
          $sheet1->setCellValue('C2', 'All Requisitions');
          $sheet1->mergeCells("C2:G2");
          $sheet1->getStyle("C2:G2")->applyFromArray(array("font" => array( "bold" => true)));

          $sheet1->setCellValue('B3', 'Code');
          $sheet1->setCellValue('C3', 'Company Name');
          $sheet1->setCellValue('D3', 'Company Person');
          $sheet1->setCellValue('E3', 'Person Number');
          $sheet1->setCellValue('F3', 'Requisition Creation Date');
          $sheet1->setCellValue('G3', 'Applicant Type');
          $sheet1->setCellValue('H3', 'Skill Required');
          $sheet1->setCellValue('I3', 'HC');
          $sheet1->setCellValue('J3', 'Requisition Status');
          $sheet1->setCellValue('K3', 'Requisition Start Date');
          $sheet1->setCellValue('L3', 'Requisition End Date');
          $sheet1->setCellValue("M3", 'Applicant ID');
          
          $sheet1->setCellValue("N3", 'Accepted Date');
          $sheet1->setCellValue("O3", 'Rejected / Release Date');
          $sheet1->setCellValue("P3", 'Reason');
          $sheet1->setCellValue("Q3", 'Status');

          $sheet1->setCellValue('R3', 'Full Name');
          $sheet1->setCellValue('S3', 'Father Name');
          $sheet1->setCellValue('T3', 'CNIC');
          $sheet1->setCellValue('U3', 'Religion');
          $sheet1->setCellValue('V3', 'DOB');
          $sheet1->setCellValue('W3', 'Mobile Number');
          $sheet1->setCellValue('X3', 'District');
          /*$sheet1->setCellValue('X3', 'Martial Status');
          $sheet1->setCellValue('Y3', 'Kids');
          $sheet1->setCellValue('Z3', 'Block 2');
          $sheet1->setCellValue('AA3', 'Village');
          $sheet1->setCellValue('AB3', 'Tehsil');
          $sheet1->setCellValue('AC3', 'District');
          $sheet1->setCellValue('AD3', 'Category');
          $sheet1->setCellValue('AE3', 'Applied For');
          $sheet1->setCellValue('AF3', 'Registered');
          $sheet1->setCellValue('AG3', 'Remarks');
          //$sheet1->setCellValue('AG3', 'Work Status');
          $sheet1->setCellValue('AH3', 'Drive');
          $sheet1->setCellValue('AI3', 'Driving License Number');
          $sheet1->setCellValue('AJ3', 'Driving License Category');
          $sheet1->setCellValue('AK3', 'Vehicle Type');
          $sheet1->setCellValue('AL3', 'Issue Date');
          $sheet1->setCellValue('AM3', 'Valid Upto');
          $sheet1->setCellValue('AN3', 'Applicant HSE');
          $sheet1->setCellValue('AO3', 'Applicant Medical Type');
          $sheet1->setCellValue('AP3', 'Applicant Medical Result');
          $sheet1->setCellValue('AQ3', 'Applicant Police Verified');

          $sheet1->setCellValue('AR3', 'Source of Income');
          $sheet1->setCellValue('AS3', 'Company Name');
          $sheet1->setCellValue('AT3', 'Date From ');          
          $sheet1->setCellValue('AU3', 'Date To');          
          $sheet1->setCellValue('AV3', 'Position');          
          $sheet1->setCellValue('AW3', 'Salary');

          $sheet1->setCellValue('AX3', 'Source of Income');
          $sheet1->setCellValue('AY3', 'Company Name');
          $sheet1->setCellValue('AZ3', 'Date From ');          
          $sheet1->setCellValue('BA3', 'Date To');          
          $sheet1->setCellValue('BB3', 'Position');          
          $sheet1->setCellValue('BC3', 'Salary');

          $sheet1->setCellValue('BD3', 'Experience');


          $sheet1->setCellValue('BE3', 'Degree');
          $sheet1->setCellValue('BF3', 'Board');
          $sheet1->setCellValue('BG3', 'Passing Year');
          $sheet1->setCellValue('BH3', 'Institute Name');
          $sheet1->setCellValue('BI3', 'Certificate');

          $sheet1->setCellValue('BJ3', 'Degree');
          $sheet1->setCellValue('BK3', 'Board');
          $sheet1->setCellValue('BL3', 'Passing Year');
          $sheet1->setCellValue('BM3', 'Institute Name');
          $sheet1->setCellValue('BN3', 'Certificate');*/
          

          $sheet1->getStyle("B3:X3")->applyFromArray(array("font" => array( "bold" => true)));
        
          
          for($col = 'B'; $col !== 'X'; $col++) {
              $objPHPExcel->getActiveSheet()->getColumnDimension($col)->setAutoSize(true);
          }

          $count = 5;
          //foreach($clientcompanyRequisition as $requisition){ 
            $deo = CompanyPersons::model()->findByPk($clientcompanyRequisition->person_id);
              foreach($clientcompanyRequisition->clientCompanyRequisitionDetails as $d){
                if($d->laborRequisitions){
                    if($d->type==1){
                      $type="Skilled";
                    }
                    if($d->type==2){
                      $type="Unskilled";
                    }
                    if(@$d->status==0){
                      $status = 'Pending';
                    }
                    if(@$d->status==1){
                      $status = 'Open';
                    }
                    if(@$d->status==2){
                      $status = 'Closed';
                    }
                    if(@$d->status==3){
                      $status = 'Under discussion';
                    }
                    if(@$d->status==4){
                      $status = 'In Process';
                    }
                    if(@$d->status==5){
                      $status = 'Rejected';
                    }
                    if($clientcompanyRequisition->company->allied_to==1){
                      $alliedto = 'Mining';
                    }
                    if($clientcompanyRequisition->company->allied_to==2){
                      $alliedto = 'Power';
                    }

                    foreach($d->laborRequisitions as $lr){
                      $sheet1->setCellValue("B$count", $clientcompanyRequisition->requisition_code);
                      $sheet1->setCellValue("C$count", (ucfirst($clientcompanyRequisition->company->company_name).' ('.$alliedto).')');
                      $sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
                      $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                      $sheet1->setCellValue("F$count", date('d-m-Y',strtotime($clientcompanyRequisition->createdOn)));
                      $sheet1->setCellValue("G$count", @$type);
                      $sheet1->setCellValue("H$count", @$d->skill);
                      $sheet1->setCellValue("I$count", @$d->count);
                      $sheet1->setCellValue("J$count", @$status);
                      $sheet1->setCellValue("K$count", (date('d-m-Y',strtotime($d->date_from))));
                      $sheet1->setCellValue("L$count", (date('d-m-Y',strtotime($d->date_to))));
                        if($lr->status==0){
                          $statuss="Pending";
                        }
                        if($lr->status==1){
                          $statuss="Accepted";
                        }
                        if($lr->status==2){
                          $statuss="Rejected";
                        }
                        if($lr->status==3){
                          $statuss="Job Completed";
                        }
                        if($lr->status==4){
                          $statuss="Temporary";
                        }
                        
                      $sheet1->setCellValue("M$count", @$lr->labour->id);
                      
                      $sheet1->setCellValue("N$count", ($lr->accepted_date)?(date('d-m-Y',strtotime(@$lr->accepted_date))):'');
                      $sheet1->setCellValue("O$count", ($lr->rejected_date)?(date('d-m-Y',strtotime(@$lr->rejected_date))):'');
                      $sheet1->setCellValue("P$count", $lr->reason);
                      $sheet1->setCellValue("Q$count", $statuss);

                      $sheet1->setCellValue("R$count", @$lr->labour->full_name);
                      $sheet1->setCellValue("S$count", @$lr->labour->father_name);
                      $sheet1->setCellValue("T$count", @$lr->labour->cnic);
                      $sheet1->setCellValue("U$count", @$lr->labour->religion);
                      $sheet1->setCellValue("V$count", date('d-m-Y',strtotime(@$lr->labour->dob)));//date('d M,Y',strtotime(@$lr->labour->dob)));
                      $sheet1->setCellValue("W$count", @$lr->labour->mobile_number);
                      $sheet1->setCellValue("X$count", @$lr->labour->district->name);
                      /*$sheet1->setCellValue("X$count", (@$lr->labour->martial_status==1)?'Married':'Single');
                      $sheet1->setCellValue("Y$count", @$lr->labour->kids);
                      $sheet1->setCellValue("Z$count", (@$lr->labour->block_2==1)?'Yes':'No');
                      $sheet1->setCellValue("AA$count", @$lr->labour->village->village);
                      $sheet1->setCellValue("AB$count", @$lr->labour->tehsil->name);
                      $sheet1->setCellValue("AC$count", @$lr->labour->district->name);
                      $sheet1->setCellValue("AD$count", (@$lr->labour->category_id==1)?'Skilled':'Unskilled');
                      $sheet1->setCellValue("AE$count", @$lr->labour->designation);
                      $sheet1->setCellValue("AF$count", date('d-m-Y',strtotime(@$lr->labour->createdOn)));
                      $sheet1->setCellValue("AG$count", @$lr->labour->remarks);
                      //$sheet1->setCellValue("AH$count", $this->Laborwork(@$lr->labour->id));
                      $sheet1->setCellValue("AH$count", (@$lr->labour->drive==1)?'Yes':'No');
                      $sheet1->setCellValue("AI$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->driving_license_number:'-');
                      $sheet1->setCellValue("AJ$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->license_category:'-');
                      $sheet1->setCellValue("AK$count", (@$lr->labour->drivingLicense)?@$lr->labour->drivingLicense[0]->vehicle_type:'-');
                      $sheet1->setCellValue("AL$count", (@$lr->labour->drivingLicense)?(date('d-m-Y',strtotime(@$lr->labour->drivingLicense[0]->issue_date))):'-');
                      $sheet1->setCellValue("AM$count", (@$lr->labour->drivingLicense)?(date('d-m-Y',strtotime(@$lr->labour->drivingLicense[0]->valid_upto))):'-');
                      $sheet1->setCellValue("AN$count", (@$lr->labour->hse)?((@$lr->labour->hse[0]->hse==1)?'Yes':'No'):'-');
                      $sheet1->setCellValue("AO$count", (@$lr->labour->medical)?@$lr->labour->medical[0]->type:'-');
                      $sheet1->setCellValue("AP$count", (@$lr->labour->medical)?@$lr->labour->medical[0]->result:'-');
                      $sheet1->setCellValue("AQ$count", (@$lr->labour->police)?((@$lr->labour->police[0]->police_verified==1)?'Yes':'No'):'-');



                      $employments = $this->getRecentData(@$lr->labour->id,'employment');
                      if(!empty($employments['data'])){
                        if (array_key_exists(0, $employments['data'])) {
                          $sheet1->setCellValue("AR$count", $employments['data'][0]['source_of_income']);
                          $sheet1->setCellValue("AS$count", $employments['data'][0]['company_name']);
                          $sheet1->setCellValue("AT$count", date('d-m-Y',strtotime($employments['data'][0]['from_date'])));
                          $sheet1->setCellValue("AU$count", date('d-m-Y',strtotime($employments['data'][0]['to_date'])));
                          $sheet1->setCellValue("AV$count", $employments['data'][0]['position']);
                          $sheet1->setCellValue("AW$count", $employments['data'][0]['salary']);  
                        }
                        if (array_key_exists(1, $employments['data'])) {
                          $sheet1->setCellValue("AX$count", $employments['data'][1]['source_of_income']);
                          $sheet1->setCellValue("AY$count", $employments['data'][1]['company_name']);
                          $sheet1->setCellValue("AZ$count", date('d-m-Y',strtotime($employments['data'][1]['from_date'])));
                          $sheet1->setCellValue("BA$count", date('d-m-Y',strtotime($employments['data'][1]['to_date'])));
                          $sheet1->setCellValue("BB$count", $employments['data'][1]['position']);
                          $sheet1->setCellValue("BC$count", $employments['data'][1]['salary']);  
                        }
                      }
                      $sheet1->setCellValue("BD$count", $employments['experience']);
                      
                      $educations = $this->getRecentData(@$lr->labour->id,'education');
                      if(!empty($educations)){
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
                          $sheet1->setCellValue("BE$count", @$$educationTypeId);
                          $sheet1->setCellValue("BF$count", $educations[0]['board']);
                          $sheet1->setCellValue("BG$count", $educations[0]['passing_year']);
                          $sheet1->setCellValue("BH$count", $educations[0]['organization_name']);
                          $sheet1->setCellValue("BI$count", $educations[0]['degree']);  
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
                          $sheet1->setCellValue("BJ$count", @$$educationTypeId);
                          $sheet1->setCellValue("BK$count", $educations[1]['board']);
                          $sheet1->setCellValue("BL$count", $educations[1]['passing_year']);
                          $sheet1->setCellValue("BM$count", $educations[1]['organization_name']);
                          $sheet1->setCellValue("BN$count", $educations[1]['degree']);  
                        }
                      }*/
                      
                      
                      $count++;
                    }
                } else{
                    if($d->type==1){
                      $type="Skilled";
                    }
                    if($d->type==2){
                      $type="Unskilled";
                    }
                    if(@$d->status==0){
                      $status = 'Pending';
                    }
                    if(@$d->status==1){
                      $status = 'Open';
                    }
                    if(@$d->status==2){
                      $status = 'Closed';
                    }
                    if(@$d->status==3){
                      $status = 'Under discussion';
                    }
                    if(@$d->status==4){
                      $status = 'In Process';
                    }
                    if(@$d->status==5){
                      $status = 'Rejected';
                    }
                    if($clientcompanyRequisition->company->allied_to==1){
                      $alliedto = 'Mining';
                    }
                    if($clientcompanyRequisition->company->allied_to==2){
                      $alliedto = 'Power';
                    }
                  $sheet1->setCellValue("B$count", $clientcompanyRequisition->requisition_code);
                  $sheet1->setCellValue("C$count", (ucfirst($clientcompanyRequisition->company->company_name).' ('.$alliedto).')');
                  $sheet1->setCellValue("D$count", (($deo)?ucfirst($deo->name):'-'));
                  $sheet1->setCellValue("E$count", (($deo)?ucfirst($deo->mobile_number):'-'));
                  $sheet1->setCellValue("F$count", date('d M,Y',strtotime($clientcompanyRequisition->createdOn)));
                  $sheet1->setCellValue("G$count", @$type);
                  $sheet1->setCellValue("H$count", @$d->skill);
                  $sheet1->setCellValue("I$count", @$d->count);
                  $sheet1->setCellValue("J$count", @$status);
                  $sheet1->setCellValue("K$count", (date('d M,Y',strtotime($d->date_from))));
                  $sheet1->setCellValue("L$count", (date('d M,Y',strtotime($d->date_to))));
                  $count++; 
                } 
              }
          //}
          $sheet1->setTitle('Requisitions Report');
          /*$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          $file = getcwd().'\uploads\rreport.xlsx';
          $objWriter->save($file);
          echo "<script type='text/javascript'>window.location='".Yii::app()->baseUrl."/uploads/rreport.xlsx';</script>";*/
          $filename = 'singlerequisitionreport.xlsx';
          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment;filename={$filename}");
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
          die;
        }
    }

    public function actionAlldeo($type=''){
        ini_set('max_execution_time', 50000);
        $deos = CompanyDeos::model()->findAll();
        $this->checkAdmin();
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
            $html .= '<tr><td colspan="10" style="text-align:center">All Deo</td></tr>';
            
    
            $html .= '<tr><td colspan="10"></td></tr>';
            $html .= '<tr><td>ID</td><td>Name</td><td>Email Address</td><td>CNIC</td><td>Designation</td><td>Mobile Number</td><td>Access Type</td><td>Status</td><td>Created On</td></tr>';
            foreach($deos as $m){
              if($m->status==1){ $status='Active'; } if($m->status==2){ $status='In-active'; }
              $html .= '<tr><td class="red" style="text-align:center;font-weight:normal;vertical-align:middle;font-style:normal">'.$m->id.'</td><td>'.$m->name.'</td><td>'.$m->email_address.'</td><td>'.$m->cnic.'</td><td>'.$m->designation.'</td><td>'.$m->mobile_number.'</td><td>'.$m->userType->user_type.'</td><td>'.@$status.'</td><td>'.date('d M,Y',strtotime($m->createdOn)).'</td></tr>';
            }


            $html .= '</table>';
            //echo $html;exit;
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
        }
        if($type=='excel'){
          Yii::import('ext.phpexcel.XPHPExcel');      
          $objPHPExcel = XPHPExcel::createPHPExcel();
          // Set properties
          $objPHPExcel->getProperties()->setCreator("ENGRO KT");
          $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
          $objPHPExcel->getProperties()->setTitle("All DEO's");
          $objPHPExcel->getProperties()->setSubject("All DEO's");
          $objPHPExcel->getProperties()->setDescription("All DEO's");
          
          // Active sheet
          $sheet1=$objPHPExcel->setActiveSheetIndex(0);
          $count = 6;
          $headAlpha=0;
          $sheet1->setCellValue('C2', "All DEO's");
          $sheet1->mergeCells("C2:E2");
          $sheet1->getStyle("C2:E2")->applyFromArray(array("font" => array( "bold" => true)));
          

          
          //Columns
          $sheet1->setCellValue('B3', 'Name');
          $sheet1->setCellValue('C3', 'Email Address');
          $sheet1->setCellValue('D3', 'CNIC');
          //$sheet1->setCellValue('E3', 'Code');
          $sheet1->setCellValue('E3', 'Designation');
          $sheet1->setCellValue('F3', 'Mobile Number');
          $sheet1->setCellValue('G3', 'Access Type');
          $sheet1->setCellValue('H3', 'Status');
          $sheet1->setCellValue('I3', 'Created On');
          
          
          
          $sheet1->getStyle("B3:I3")->applyFromArray(array("font" => array( "bold" => true)));
          
          $sheet1->getColumnDimension("B")->setAutoSize(true);
          $sheet1->getColumnDimension("C")->setAutoSize(true);
          $sheet1->getColumnDimension("D")->setAutoSize(true);
          $sheet1->getColumnDimension('E')->setAutoSize(true);
          $sheet1->getColumnDimension('F')->setAutoSize(true);
          $sheet1->getColumnDimension('G')->setAutoSize(true);
          $sheet1->getColumnDimension('H')->setAutoSize(true);
          $sheet1->getColumnDimension('I')->setAutoSize(true);
          


          $count = 5;
          foreach($deos as $m){
            $sheet1->setCellValue("B$count", $m->name);
            $sheet1->setCellValue("C$count", $m->email_address);
            $sheet1->setCellValue("D$count", $m->cnic);
            //$sheet1->setCellValue("E$count", $m->code);
            $sheet1->setCellValue("E$count", $m->designation);
            $sheet1->setCellValue("F$count", $m->mobile_number);
            $sheet1->setCellValue("G$count", $m->userType->user_type);
            if($m->status==1){ $status='Active'; } if($m->status==2){ $status='In-active'; }
            $sheet1->setCellValue("H$count", @$status);
            $sheet1->setCellValue("I$count",date('d M,Y',strtotime($m->createdOn)));
            $count++;
          }
          $sheet1->setTitle("All DEO's");
          $filename = 'alldeoreport.xlsx';
          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment;filename={$filename}");
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
          die;
        }
        
    }

    public function actionAlltraining($type=''){
        ini_set('max_execution_time', 50000);
        $model = Trainings::model()->findAll();
$this->checkAdmin();
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
            $html .= '<tr><td colspan="6" style="text-align:center;font-weight:bold">All Training</td></tr>';
            
            
            $html .= '<tr><td style="font-weight:bold">Training Type</td><td style="font-weight:bold">Institute Name</td><td style="font-weight:bold">Batch No</td><td style="font-weight:bold">Start Date</td><td style="font-weight:bold">End Date</td><td style="font-weight:bold">Status</td></tr>';
            foreach($model as $t):
              $html .= '<tr><td >'.$t->training_type.'</td><td>'.ucfirst($t->institute_name).'</td><td>'.$t->batch_no.'</td><td>'.(date('d M,Y',strtotime($t->start_date))).'</td><td>'.(date('d M,Y',strtotime($t->end_date))).'</td><td>'.((@$t->status==0)?'Open':'End').'</td></tr>'; 
            endforeach;

            $html .= '</table>';
            
            // output the HTML content
            $pdf->writeHTML($html, true, true, true, true, '');
            $pdf->Output("result.pdf", "I");
        }
        if($type=='excel'){
          Yii::import('ext.phpexcel.XPHPExcel');      
          $objPHPExcel = XPHPExcel::createPHPExcel();
          // Set properties
          $objPHPExcel->getProperties()->setCreator("ENGRO KT");
          $objPHPExcel->getProperties()->setLastModifiedBy("ENGRO KT");
          $objPHPExcel->getProperties()->setTitle("All Training");
          $objPHPExcel->getProperties()->setSubject("All Training");
          $objPHPExcel->getProperties()->setDescription("All Training");
          
          // Active sheet
          $sheet1=$objPHPExcel->setActiveSheetIndex(0);
          $count = 6;
          $headAlpha=0;
          $sheet1->setCellValue('C2', 'All Training');
          $sheet1->mergeCells("C2:F2");
          $sheet1->getStyle("C2:F2")->applyFromArray(array("font" => array( "bold" => true)));
          

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
          
          $count = 5;
          
          foreach ($model as $key => $training) {
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



                      //$employments = $this->getRecentData(@$lrr->labor->id, 'employment');
                      $employments = $this->getRecentData($lrr->labor->employments,'employment');
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
                      //$educations = $this->getRecentData(@$lrr->labor->id, 'education');
                      $educations = $this->getRecentData(@$lrr->labor->educations,'education');
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
          $sheet1->setTitle('All Trainings');
          
          $filename = 'applicanttraining.xlsx';
          $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
          header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
          header("Content-Disposition: attachment;filename={$filename}");
          header('Cache-Control: max-age=0');
          $objWriter->save('php://output');
          die;
        }
    }
}
?>