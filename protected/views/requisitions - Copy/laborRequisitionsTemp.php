<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <?php if($company->clientCompanyRequisitionDetails[0]->status==2){?>
                      <h2>Requisition Detail<small>Closed</small>
                        <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$company->clientCompanyRequisitionDetails[0]->id?>/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                        <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$company->clientCompanyRequisitionDetails[0]->id?>/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                      </h2>
                    <?php } elseif(Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                    <h2>Temporary Requisition Detail
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$company->clientCompanyRequisitionDetails[0]->id?>/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$company->clientCompanyRequisitionDetails[0]->id?>/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
                    <?php } else {?>
                      <h2>Requisition Detail<small>Closed</small>
                        <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$company->clientCompanyRequisitionDetails[0]->id?>/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$company->clientCompanyRequisitionDetails[0]->id?>/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                      </h2>
                    <?php }?>
                    
                    <div class="clearfix"></div>
                  </div>
                  
                  <div class="companySpecs">
                    <input type="hidden" id="requisition_id" value="<?php echo @$detail_id?>">
                    <div class="col-md-12">
                      <h3><?php echo ucfirst(@$company->company->company_name)?><span>(<?php echo ucfirst((@$company->company->allied_to==1)?'Mining':'Power')?>)</span></h3>
                      <p class="companyCode"><?php echo @$company->requisition_code?></p>
                    </div>
                    <div class="col-md-4"><p><b>Person Name:</b> <?php echo ucfirst(@$company->person->name)?></p></div>
                    <div class="col-md-4"><p><b>Person Contact:</b> <?php echo ucfirst(@$company->person->mobile_number)?></p></div>
                    <div class="col-md-4"><p><b>Requisition Date:</b> <?php echo date('d M,Y H:i',strtotime($company->createdOn))?></p></div>
                    
                    <div class="col-md-4"><p><b>Applicant Required:</b> <?php echo ucfirst(@$company->clientCompanyRequisitionDetails[0]->skill).' ('.((@$company->clientCompanyRequisitionDetails[0]->type==1)?'Skilled':'Unskilled').')'?></p></div>
                    <div class="col-md-4"><p><b>Head Count:</b> <?php echo @$company->clientCompanyRequisitionDetails[0]->count?></p></div>
                    <div class="col-md-4"><p><b>Required Period:</b> <?php echo date('d M,Y',strtotime(@$company->clientCompanyRequisitionDetails[0]->date_from)).' - '.date('d M,Y',strtotime(@$company->clientCompanyRequisitionDetails[0]->date_to))?></p></div>
                  </div>
                  <hr/>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered" >
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all">
                            </th>
                            <th class="column-title">ID</th>
                            <th class="column-title">Name</th>
                            <th class="column-title">CNIC</th>
                            <th class="column-title">Category</th>
                            <th class="column-title">Mobile Number</th>
                            <th class="column-title">Block 2</th>
                            <th class="column-title">District</th>
                            <th class="column-title">Applied For</th>
                            <th class="column-title no-link last"><span class="nobr">Status</span>
                            <th class="column-title" style="width:10%">Remarks</th>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php if($company->clientCompanyRequisitionDetails[0]->status==2){ $lrclosed = LaborRequisitions::model()->findAll('requisition_id = :req',array(':req'=>$detail_id)); if($lrclosed){ foreach($lrclosed as $lrc):?>

                            <tr class="even pointer">
                              <td class="a-center">
                                
                              </td>
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $lrc->labour->id?>"><?php echo $lrc->labour->id?></a></td>
                              
                              <td class=" "><a href="#"><?php echo $lrc->labour->full_name?></a></td>
                              <td class=" "><?php echo $lrc->labour->cnic?></td>
                              <td class=" "><?php if($lrc->labour->category_id==1){ echo '<span class="label label-info">Skilled</span>'; } if($lrc->labour->category_id==2){ echo '<span class="label label-info">Unskilled</span>'; }?></td>
                              <td class=" "><?php echo $lrc->labour->mobile_number?></td>
                              <td class=" "><?php echo ($lrc->labour->block_2==1)?'Yes':'No'?></td>
                              <td class=" "><?php echo @$lrc->labour->district->name?></td>
                              <td class=" "><?php echo $lrc->labour->designation?></td>
                              <td class=" last">

                                  <?php
                                    if(@$lrc->status==0){
                                      echo '<span class="label label-info">Pending</span>';
                                    }
                                    if(@$lrc->status==1){
                                      echo '<span class="label label-success">Accepted</span>';
                                    }
                                    if(@$lrc->status==2){
                                      echo '<span class="label label-danger">Rejected</span><br/>';
                                      //echo '<p style="font-size: 8px;">'.@$lr->reason.'</p>';
                                    }
                                    if(@$lrc->status==3){
                                      echo '<span class="label label-success">Job Completed</span><br/>';
                                      //echo '<p style="font-size: 8px;">'.@$lr->reason.'</p>';
                                    }
                                  ?>
                              </td>
                              <td class=" last">
                                <?php if(@$lrc->status==2){ echo @$lr->reason; }?>
                              </td>
                            </tr>

                          <?php endforeach; }}  else { foreach($model as $labor): $lr = LaborRequisitions::model()->find('labour_id=:id AND requisition_id = :req',array(':id'=>$labor->labour_id,':req'=>$detail_id));?>
                            <tr class="even pointer tr_<?php echo $labor->status?>">
                              <td class="a-center">
                                <?php if(empty($lr)){?>
                                  <input type="checkbox" name="requisitionLabor[]" value="<?php echo $labor->labour->id?>">
                                <?php }?>
                              </td>
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->labour->id?>"><?php echo $labor->labour->id?></a></td>
                              <?php if($labor->status==1){?>
                                <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/viewrequisition/id/<?php echo $labor->id?>"><?php echo $labor->labour->full_name?></a></td>
                              <?php } else{?>
                              <td class=" "><a href="#"><?php echo $labor->labour->full_name?></a></td>
                              <?php }?>
                              <td class=" "><?php echo $labor->labour->cnic?></td>
                              <td class=" "><?php if($labor->labour->category_id==1){ echo '<span class="label label-info">Skilled</span>'; } if($labor->labour->category_id==2){ echo '<span class="label label-info">Unskilled</span>'; }?></td>
                              <td class=" "><?php echo $labor->labour->mobile_number?></td>
                              <td class=" "><?php echo ($labor->labour->block_2==1)?'Yes':'No'?></td>
                              <td class=" "><?php echo @$labor->labour->district->name?></td>
                              <td class=" "><?php echo $labor->labour->designation?></td>
                              <td class=" last">
                                <?php if($lr){?>

                                  <?php
                                    if(@$lr->status==0){
                                      echo '<span class="label label-info">Pending</span>';
                                    }
                                    if(@$lr->status==1){
                                      echo '<span class="label label-success">Accepted</span>';
                                    }
                                    if(@$lr->status==2){
                                      echo '<span class="label label-danger">Rejected</span><br/>';
                                      //echo '<p style="font-size: 8px;">'.@$lr->reason.'</p>';
                                    }
                                    if(@$lr->status==3){
                                      echo '<span class="label label-success">Job Completed</span><br/>';
                                      //echo '<p style="font-size: 8px;">'.@$lr->reason.'</p>';
                                    }
                                  ?>
                                <?php }?>
                              </td>
                              <td class=" last">
                                <?php if(@$lr->status==2){ echo @$lr->reason; }?>
                              </td>
                            </tr>
                          <?php endforeach;} ?>
                          
                        </tbody>
                      </table>
                      <?php if($company->clientCompanyRequisitionDetails[0]->status!=2){?>
                        <div class="col-md-12" style="margin-top:10px">
                          <button type="button" class="btn btn-danger" id="tempreguisitionremoveBtn">Remove</button>
                          <button type="button" class="btn btn-success" id="tempreguisitionassignBtn">Assign</button>
                        </div>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>