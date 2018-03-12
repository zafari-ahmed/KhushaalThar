<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Requisition Detail</h2>
                    <div class="clearfix"></div>
                  </div>
                  <?php $month = (isset($_GET['month']))?$_GET['month']:date('m');?>
                  <div class="companySpecs">
                    <input type="hidden" id="requisition_id" value="<?php echo @$detail_id?>">
                    <div class="col-md-12" id="sheetReq">
                      <h3><?php echo ucfirst(@$company->company->company_name)?><span>(<?php echo ucfirst((@$company->company->allied_to==1)?'Mining':'Power')?>)</span></h3>
                      <p class="companyCode"><?php echo @$company->requisition_code?></p>
                    </div>
                    <div id="sheetReqinfo">
                      <div class="col-md-4"><p><b>Person Name:</b> <?php echo ucfirst(@$company->person->name)?></p></div>
                      <div class="col-md-4"><p><b>Person Contact:</b> <?php echo ucfirst(@$company->person->mobile_number)?></p></div>
                      <div class="col-md-4"><p><b>Requisition Date:</b> <?php echo date('d M,Y',strtotime($company->createdOn))?></p></div>
                      
                      <div class="col-md-4"><p><b>Applicant Required:</b> <?php echo ucfirst(@$company->clientCompanyRequisitionDetails[0]->skill).' ('.((@$company->clientCompanyRequisitionDetails[0]->type==1)?'Skilled':'Unskilled').')'?></p></div>
                      <div class="col-md-4"><p><b>Head Count:</b> <?php echo @$company->clientCompanyRequisitionDetails[0]->count?></p></div>
                      <div class="col-md-4"><p><b>Required Period:</b> <?php echo date('d M,Y',strtotime(@$company->clientCompanyRequisitionDetails[0]->date_from)).' - '.date('d M,Y',strtotime(@$company->clientCompanyRequisitionDetails[0]->date_to))?></p></div>
                    </div>
                  </div>
                  <hr/>
                  <div class="col-md-4">
                    <label>Select Month: </label>
                    <select class="form-control" id="att_month">
                      <option value="1" <?php echo (@$month==1)?'selected':''?>>January</option>
                      <option value="2" <?php echo (@$month==2)?'selected':''?>>Febuary</option>
                      <option value="3" <?php echo (@$month==3)?'selected':''?>>March</option>
                      <option value="4" <?php echo (@$month==4)?'selected':''?>>April</option>
                      <option value="5" <?php echo (@$month==5)?'selected':''?>>May</option>
                      <option value="6" <?php echo (@$month==6)?'selected':''?>>June</option>
                      <option value="7" <?php echo (@$month==7)?'selected':''?>>July</option>
                      <option value="8" <?php echo (@$month==8)?'selected':''?>>August</option>
                      <option value="9" <?php echo (@$month==9)?'selected':''?>>September</option>
                      <option value="10" <?php echo (@$month==10)?'selected':''?>>October</option>
                      <option value="11" <?php echo (@$month==11)?'selected':''?>>November</option>
                      <option value="12" <?php echo (@$month==12)?'selected':''?>>December</option>
                    </select>
                  </div>
                  <a href="#" class="pull-right" id="printTable"><button type="button" class="btn btn-info btn-xs">Print</button></a>
                  <div class="x_content">
                    <div class="table-responsive">
                      
                      <h3 id="sheetDate"><?php echo date('d F,o',strtotime(date('Y').'-'.$month.'-01')).' - '.date('d F,o',strtotime(date('Y').'-'.$month.'-'.date('t')));?></h3>
                      <table class="table table-striped table-bordered" id="attandanceSheet">
                        <thead>
                          <tr class="headings">
                            <th class="column-title">Name</th>
                            <th class="column-title">Job Type</th>
                            <th class="column-title">Salary</th>
                            <?php $number = cal_days_in_month(CAL_GREGORIAN, $month,date('Y')); 
                              for($i=1;$i<=$number;$i++){
                                echo '<th>'.$i.'</th>';
                              }
                            ?>
                            <th>Total</th>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($company->clientCompanyRequisitionDetails[0]->laborRequisitionsActive as $lr):$lp=0; $lrDetail = LaborRequisitionDetails::model()->find('labor_requisition_id=:id',array(':id'=>$lr->id));?>
                            <tr class="even pointer">
                              <td class=" "><?php echo @$lr->labour->full_name?></td>
                              <td class=" "><?php echo ($lrDetail)?@(($lrDetail->job_type==1)?'Daily':'Monthly'):'-'?></td>
                              <td class=" "><?php echo ($lrDetail)?@$lrDetail->salary:'-'?></td>
                              <?php for($i=1;$i<=$number;$i++){
                                $date = date('Y').'-'.$month.'-'.$i;
                                $a = $this->checkAttandance($lr->labour->id,$lr->requisition_id,$date);
                                //echo "<td>".(($a)?'P':'A')."</td>";
                                if($a){
                                  echo "<td>P</td>";
                                  $lp++;
                                } else{
                                  echo "<td>A</td>";
                                }
                              }?>
                              <td><?php echo @$lp?></td>
                            </tr>
                          <?php endforeach;?>
                          
                        </tbody>
                      </table>
                      
                    </div>
                  </div>
                </div>
              </div>