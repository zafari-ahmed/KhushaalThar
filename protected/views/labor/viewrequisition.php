<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Applicant Requisition Detail
                      <div class="pull-right">
                        <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/excelreport/id/<?php echo @$model->id?>" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                        <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/pdfreport/id/<?php echo @$model->id?>" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                        <!-- <a href="#" onClick="window.print()" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Print</button></a>&nbsp; -->
                      </div>
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="companySpecs">
                    <div class="col-xs-12">
                      <h3><?php echo ucfirst(@$model->requisition->requisition->company->company_name)?><span>(<?php echo ucfirst((@$model->requisition->requisition->company->allied_to==1)?'Mining':'Power')?>)</span></h3>
                      <p class="companyCode"><?php echo @$model->requisition->requisition->requisition_code?></p>
                    </div>
                    <div class="col-xs-4"><p><b>Person Name:</b> <?php echo ucfirst(@$model->requisition->requisition->person->name)?></p></div>
                    <div class="col-xs-4"><p><b>Person Contact:</b> <?php echo ucfirst(@$model->requisition->requisition->person->mobile_number)?></p></div>
                    <div class="col-xs-4"><p><b>Requisition Date:</b> <?php echo date('d M,Y',strtotime($model->requisition->requisition->createdOn))?></p></div>
                    

                    
                    <div class="col-xs-4"><p><b>Applicant Name:</b> <?php echo ucfirst(@$model->labour->full_name)?></p></div>
                    <div class="col-xs-4"><p><b>Applicant Nic:</b> <?php echo @$model->labour->cnic?></p></div>
                    <div class="col-xs-4"><p><b>Applicant Salary:</b> PKR <?php echo @number_format($detail->salary)?>&nbsp; <?php if(@$detail->job_type==1){ echo 'Daily';} if(@$detail->job_type==2){ echo 'Monthly';} ?></p></div>

                    <div class="col-xs-4"><p><b>Applicant Required:</b> <?php echo ucfirst(@$model->requisition->skill).' ('.((@$model->requisition->type==1)?'Skilled':'Unskilled').')'?></p></div>
                    <div class="col-xs-4"><p><b>Head Count:</b> <?php echo @$model->requisition->count?></p></div>
                    <div class="col-xs-4"><p><b>Required Period:</b> <?php echo date('d M,Y',strtotime(@$model->requisition->date_from)).' - '.date('d M,Y',strtotime(@$model->requisition->date_to))?></p></div>

                    <?php 

                    $startM = date('m',strtotime(@$model->requisition->date_from));
                    $startE = date('m',strtotime(@$model->requisition->date_to));
                    //echo $startM.' '.$startE;
                    for($i=$startM;$i<=$startE;$i++){ //sprintf('%02d', $i)?>
                      <h3><?php echo date('d M,Y',strtotime(date(date('Y').'-'.sprintf('%02d', $i).'-01'))).' - '.date('d M,Y',strtotime(date(date('Y').'-'.sprintf('%02d', $i).'-'.date('t'))));?></h3>
                      <?php $attandances = LabourAttendances::model()->findAll('labour_id = :labor AND requisition_id=:id',array(':labor'=>$model->labour_id,':id'=>$model->requisition_id));?>
                      <?php $number = cal_days_in_month(CAL_GREGORIAN, sprintf('%02d', $i),date('Y')); ?>
                      <div class="x_content">
                        <div class="table-responsive">
                          <table class="table table-striped table-bordered" >
                            <thead>
                              <tr class="headings">
                                  <?php 
                                    for($j=1;$j<=$number;$j++){
                                      echo '<th class="column-title">'.$j.'</th>';
                                    }
                                  ?>
                                  <th>Total Present</th>
                                <!-- <th class="column-title">Category</th>
                                <th class="column-title">Mobile Number</th>
                                <th class="column-title">Form Status</th> -->
                                <!-- <th class="column-title no-link last"><span class="nobr">Action</span> -->
                              </tr>
                            </thead>

                            <tbody>
                                  <tr>
                                  <?php 
                                    $lp=0;
                                    for($j=1;$j<=$number;$j++){
                                      //echo '<td>'.$j.'</td>';
                                      $date = date('Y').'-'.sprintf('%02d', $i).'-'.$j;
                                      $a = $this->checkAttandance(@$model->labour->id,@$model->requisition_id,$date);
                                      //echo "<td>".(($a)?'P':'A')."</td>";
                                      if($a){
                                        echo "<td>P</td>";
                                        $lp++;
                                      } else{
                                        echo "<td>A</td>";
                                      }
                                    }
                                  ?>
                                  <td><?php echo @$lp;?></td>
                                  </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                    <?php } ?>
                  </div>
                  <hr/>
                </div>
              </div>