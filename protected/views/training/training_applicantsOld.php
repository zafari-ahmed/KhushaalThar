<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Training Applicants
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/training/Viewreport/id/<?php echo @$training->id?>/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/training/Viewreport/id/<?php echo @$training->id?>/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <!-- <p>Code: <?php //echo @$model->requisition_code?></p>
                  <input type="hidden" id="requisition_id" value="<?php //echo @$model->id?>">
                  <p>Deo: <?php //echo ucfirst(@$model->deo->name)?></p>
                  <p>Skill: <?php //echo @$model->clientCompanyRequisitionDetails[0]->skill?></p>
                  <p>HeadCount: <?php //echo @$model->clientCompanyRequisitionDetails[0]->count?></p> -->


                  <div class="companySpecs">
                    <input type="hidden" id="training_id" value="<?php echo @$training->id?>">
                    <div class="col-md-12">
                      <h3><?php echo ucfirst(@$training->institute_name)?><span>(<?php echo ucfirst(@$training->training_type)?>)</span></h3>
                      <p class="companyCode"><?php echo (@$training->status == 0)?'Open':'End'?></p>
                    </div>
                    <div class="col-md-4"><p><b>Batch No.:</b> <?php echo ucfirst(@$training->batch_no)?></p></div>
                    <div class="col-md-4"><p><b>Start Date:</b> <?php echo date('d M,Y H:i',strtotime($training->start_date))?></p></div>
                    <div class="col-md-4"><p><b>End Date:</b> <?php echo date('d M,Y H:i',strtotime($training->end_date))?></p></div>
                    
                  </div>
                  <hr/>
                  <?php if($training->status==0){?>
                  <a href="javascript:void()" ><button id="no_training" type="button" class="btn btn-primary btn-xs">All Applicants</button></a><?php }?>
                  <a href="javascript:void()" ><button id="training" type="button" class="btn btn-primary btn-xs">Training Applicants</button></a>
                  <div class="x_content">
                    <div class="table-responsive">
                      <?php if($training->status==0){?>
                      <button type="button" class="btn btn-success hide pull-right" id="trainingBtn">Add for training</button>
                      <button type="button" class="btn btn-success pull-right" id="endtrainingBtn">End training</button>
                      <button type="button" class="btn btn-success pull-right" id="removetrainingBtn">Remove from training</button>
                      <?php }?>
                      <div id="tr_0" class="hide">
                          <table class="table table-striped table-bordered datatable">
                            <thead>
                              <tr class="headings">
                                <th>
                                  <input type="checkbox" class="check-all">
                                </th>
                                <th class="column-title">ID</th>
                                <th class="column-title">Name</th>
                                <th class="column-title">CNIC</th>
                                <th class="column-title">Category</th>
                                <th class="column-title">Mobile Number</th>
                                <th class="column-title no-link last"><span class="nobr">Action</span>
                                </th>
                              </tr>
                            </thead>

                            <tbody>
                              <?php foreach($labors as $labor): ?><?php if($this->Laborstatus($labor->id)==false){ if(!$labor->traings){?>
                                <tr class="even pointer"  >
                                  <td class="a-center "><?php //if(!$labor->traings){?>
                                    <input type="checkbox" name="trainingLabor[]" value="<?php echo $labor->id?>">
                                    <?php //}?>
                                  </td>
                                  <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->id?>"><?php echo $labor->id?></a></td>
                                  <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->id?>"><?php echo $labor->full_name?></a></td>
                                  <td class=" "><?php echo $labor->cnic?></td>
                                  <td class=" "><?php if($labor->category_id==1){ echo 'Skilled'; } if($labor->category_id==2){ echo 'Unskilled'; }?></td>
                                  <td class=" "><?php echo $labor->mobile_number?></td>
                                  <td><?php if(@$training->status==1){?><a href="#" class="addtrainingResult" data-toggle="modal" data-target="#rejectModal" rel="<?php echo $labor->id?>"><button type="button" class="btn btn-info btn-xs">Add Result</button></a><?php }?></td>
                                </tr>
                              <?php }}  endforeach;?>
                              
                            </tbody>
                          </table>
                      </div>
                      




                      <?php $lt = LabourTraings::model()->findAll('training_id=:training',array(':training'=>$training->id));?>
                      <div id="tr_1">
                        <table class="table table-striped table-bordered datatable">
                          <thead>
                            <tr class="headings">
                              <th>
                                <input type="checkbox" class="check-all">
                              </th>
                              <th class="column-title">ID</th>
                              <th class="column-title">Name</th>
                              <th class="column-title">CNIC</th>
                              <th class="column-title">Category</th>
                              <th class="column-title">Mobile Number</th>
                              <th class="column-title">Block 2</th>
                              <th class="column-title">District</th>
                              <th class="column-title">Applied For</th>
                              <th class="column-title no-link last"><span class="nobr">Action</span>
                              <th class="column-title no-link last"><span class="nobr">Result</span>
                              </th>
                            </tr>
                          </thead>

                          <tbody>
                            <?php if($lt){ foreach($lt as $labor): ?>
                              <tr class="even pointer "  >
                                <td class="a-center"> <?php if($labor->status==0){?>
                                  <input type="checkbox" name="removetrainingLabor[]" value="<?php echo $labor->labor->id?>">
                                  <?php }?>
                                </td>
                                <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->labor->id?>"><?php echo $labor->labor->id?></a></td>
                                <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->labor->id?>"><?php echo $labor->labor->full_name?></a></td>
                                <td class=" "><?php echo $labor->labor->cnic?></td>
                                <td class=" "><?php if($labor->labor->category_id==1){ echo 'Skilled'; } if($labor->labor->category_id==2){ echo 'Unskilled'; }?></td>
                                <td class=" "><?php echo $labor->labor->mobile_number?></td>
                                <td class=" "><?php echo ($labor->labor->block_2==1)?'Yes':'No'?></td>
                                <td class=" "><?php echo @$labor->labor->district->name?></td>
                                <td class=" "><?php echo $labor->labor->designation?></td>
                                <td><?php if((@$training->status==1 || $labor->status==1) && empty(@$labor->result)){?><a href="#" class="addtrainingResult" data-toggle="modal" data-target="#rejectModal" rel="<?php echo $labor->labor->id?>"><button type="button" class="btn btn-info btn-xs">Add Result</button></a><?php }?></td>
                                <td class=" "><?php echo (@$labor->status==1 && !empty(@$labor->result))?ucfirst(@$labor->result).' / '.@$labor->score:'-'?></td>
                              </tr>
                            <?php endforeach; }?>
                            
                          </tbody>
                        </table>
                      </div>
                    
                    </div>
                  </div>
                </div>
              </div>


<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Training Result</h4>
      </div>
      <div class="modal-body">
        <form id="trainingResultForm" class="form-horizontal form-label-left">
          <input type="hidden" name="labor_id" class="labor_id">
          <input type="hidden" name="training_id" value="<?php echo @$training->id?>">
            <div class="form-group">
              <!-- <div class="col-md-4 col-sm-6 col-xs-12">
                <label for="first-name">Trade</label>
                <input type="text" id="client_code" name="trade" required="required" class="form-control col-md-7 col-xs-12">
              </div> -->
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Score
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="score" name="score" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (@$labor->traings)?@$labor->traings[0]->score:''?>">
                </div>
              </div>
             <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Result
              </label>
              <div class="col-md-6">
               Pass<input type="radio" name="result" value="pass" class="col-md-3" style="    float: none;">
               Fail<input type="radio" name="result" value="fail" class="col-md-3" style="    float: none;">
              </div>
            </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="trainingResult">Submit</button>
      </div>
    </div>
  </div>
</div>