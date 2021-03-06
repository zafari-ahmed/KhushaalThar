<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Requisition Detail
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$model->clientCompanyRequisitionDetails[0]->id?>/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$model->clientCompanyRequisitionDetails[0]->id?>/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <!-- <p>Code: <?php //echo @$model->requisition_code?></p>
                  <input type="hidden" id="requisition_id" value="<?php //echo @$model->id?>">
                  <p>Deo: <?php //echo ucfirst(@$model->deo->name)?></p>
                  <p>Skill: <?php //echo @$model->clientCompanyRequisitionDetails[0]->skill?></p>
                  <p>HeadCount: <?php //echo @$model->clientCompanyRequisitionDetails[0]->count?></p> -->


                  <div class="companySpecs">
                    <input type="hidden" id="requisition_id" value="<?php echo @$model->clientCompanyRequisitionDetails[0]->id?>">
                    <div class="col-md-12">
                      <h3><?php echo ucfirst(@$model->company->company_name)?><span>(<?php echo ucfirst((@$model->company->allied_to==1)?'Mining':'Power')?>)</span></h3>
                      <p class="companyCode"><?php echo @$model->requisition_code?></p>
                    </div>
                    <div class="col-md-4"><p><b>Person Name:</b> <?php echo ucfirst(@$model->person->name)?></p></div>
                    <div class="col-md-4"><p><b>Person Contact:</b> <?php echo ucfirst(@$model->person->mobile_number)?></p></div>
                    <div class="col-md-4"><p><b>Requisition Date:</b> <?php echo date('d M,Y H:i',strtotime(@$model->createdOn))?></p></div>
                    
                    <div class="col-md-4"><p><b>Labor Required:</b> <?php echo ucfirst(@$model->clientCompanyRequisitionDetails[0]->skill).' ('.((@$model->clientCompanyRequisitionDetails[0]->type==1)?'Skilled':'Unskilled').')'?></p></div>
                    <div class="col-md-4"><p><b>Head Count:</b> <?php echo @$model->clientCompanyRequisitionDetails[0]->count?></p></div>
                    <div class="col-md-4"><p><b>Required Period:</b> <?php echo date('d M,Y',strtotime(@$model->clientCompanyRequisitionDetails[0]->date_from)).' - '.date('d M,Y',strtotime(@$model->clientCompanyRequisitionDetails[0]->date_to))?></p></div>
                  </div>
                  <hr/>
                  <div class="form-group">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                      <label for="first-name">Status</label>
                      <select name="requisition_status" id="requisition_status" <?php echo (@$model->clientCompanyRequisitionDetails[0]->status==2)?'disabled':''?>>
                        <option value="0" <?php echo (@$model->clientCompanyRequisitionDetails[0]->status==0)?'selected':''?>>Pending</option>
                        <option value="1" <?php echo (@$model->clientCompanyRequisitionDetails[0]->status==1)?'selected':''?>>Open</option>
                        <option value="2" <?php echo (@$model->clientCompanyRequisitionDetails[0]->status==2)?'selected':''?>>Closed</option>
                        <option value="3" <?php echo (@$model->clientCompanyRequisitionDetails[0]->status==3)?'selected':''?>>Under discussion</option>
                        <option value="4" <?php echo (@$model->clientCompanyRequisitionDetails[0]->status==4)?'selected':''?>>In Process</option>
                        <option value="5" <?php echo (@$model->clientCompanyRequisitionDetails[0]->status==5)?'selected':''?>>Reject</option>
                      </select>
                    </div>
                  <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/viewtemp/id/<?php echo @$id?>/type/<?php echo @$type?>" class="pull-right"><button type="button" class="btn btn-info btn-xs">View Temporary applicants</button></a>
                  </div>
                  
                  
                  <?php

                  $criteria = new CDbCriteria;
                  $criteria->addCondition("t.status = 1");  
                  $criteria->order = 'id ASC';
                  $labors = Labours::model()->findAll($criteria);

                  
                  ?>
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped table-bordered datatable" >
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
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php //foreach($labors as $labor): $lr = LaborRequisitions::model()->find('labour_id=:id AND requisition_id = :req AND status != 2 AND status != 3',array(':id'=>$labor->id,':req'=>@$type)); $tlr = LaborRequisitionsTemp::model()->find('labour_id=:id AND requisition_id=:req AND status != 2 AND status != 3',array(':id'=>$labor->id,':req'=>@$type)); $lrtr = LabourTraings::model()->with('training')->find('training.status = 0 AND t.labour_id=:id',array(':id'=>$labor->id));if(empty($lr) && empty($tlr) && empty($lrtr)){ /*if(!$labor->traingsActive){*/?>
                          <?php //foreach($labors as $labor): $lr = LaborRequisitions::model()->find('labour_id=:id AND status != 2 AND status != 3',array(':id'=>$labor->id)); $tlr = LaborRequisitionsTemp::model()->find('labour_id=:id AND status != 2 AND status != 3',array(':id'=>$labor->id)); $lrtr = LabourTraings::model()->with('training')->find('training.status = 0 AND t.labour_id=:id',array(':id'=>$labor->id));if(empty($lr) && empty($tlr) && empty($lrtr)){ /*if(!$labor->traingsActive){*/?>
                          <?php foreach($labors as $labor): $lr = LaborRequisitions::model()->find('labour_id=:id AND status != 2 AND status != 3',array(':id'=>$labor->id)); $lrtr = LabourTraings::model()->with('training')->find('training.status = 0 AND t.labour_id=:id AND t.status = 0',array(':id'=>$labor->id));if(empty($lr) && empty($tlr) && empty($lrtr)){ /*if(!$labor->traingsActive){*/?>
                            <tr class="even pointer">
                              <td class="a-center ">
                                <input type="checkbox" name="requisitionLabor[]" value="<?php echo $labor->id?>">
                              </td>
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->id?>"><?php echo $labor->id?></a></td>
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->id?>"><?php echo $labor->full_name?></a></td>
                              <td class=" "><?php echo $labor->cnic?></td>
                              <td class=" "><?php if($labor->category_id==1){ echo 'Skilled'; } if($labor->category_id==2){ echo 'Unskilled'; }?></td>
                              <td class=" "><?php echo $labor->mobile_number?></td>
                              <td class=" "><?php echo ($labor->block_2==1)?'Yes':'No'?></td>
                              <td class=" "><?php echo @$labor->district->name?></td>
                              <td class=" "><?php echo $labor->designation?></td>
                            </tr>
                          <?php /*}*/}endforeach;?>
                          
                        </tbody>
                      </table>
                      <?php if(@$model->clientCompanyRequisitionDetails[0]->status!=2){?>
                      <div class="col-md-12" style="margin-top:10px">
                        <button type="button" class="btn btn-success" id="reguisitionBtn">Add to temporary list</button>
                      </div>
                      <?php }?>
                    </div>
                  </div>
                </div>
              </div>