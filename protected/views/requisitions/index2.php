<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Requisition Detail
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/requisitionbyid/id/<?php echo @$model->id?>/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/requisitionbyid/id/<?php echo @$model->id?>/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  
                  
                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="data table table-striped no-margin">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Requisition Code</th>
                            <th>Type</th>
                            <th>Skill</th>
                            <th>HeadCount</th>
                            <th>Assigned</th>
                            <th>Date From</th>
                            <th>Date End</th>
                            <th>Status</th>
                            <th style="width:10%">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $models = ClientCompanyRequisitionDetails::model()->findAll('requisition_id =:req',array(':req'=>$model->id),array('order'=>'id DESC')); foreach($models as $ind=>$m):?>
                          <tr>
                            <td><?php echo @$ind+1?></td>
                            <td><?php echo @$model->requisition_code?></td>
                            <td><?php echo (@$m->type==1)?'Skilled':'Unskilled'?></td>
                            <td><?php echo @$m->skill?></td>
                            <td><?php echo @$m->count?></td>
                            <td><?php echo @$m->laborRequisitionsCount?></td>
                            <td><?php echo date('d M,Y',strtotime($m->date_from))?></td>
                            <td><?php echo date('d M,Y',strtotime($m->date_to))?></td>
                            <td>
                              <?php //echo (@$model->status==1)?'<span class="label label-success">Approved</span>':'<span class="label label-info">Pending</span>'?>
                              <?php
                              if(@$m->status==0){
                                echo '<span class="label label-info">Pending</span>';
                              }
                              if(@$m->status==1){
                                echo '<span class="label label-success">Open</span>';
                              }
                              if(@$m->status==2){
                                echo '<span class="label label-danger">Closed</span>';
                              }
                              if(@$m->status==3){
                                echo '<span class="label label-warning">Under discussion</span>';
                              }
                              if(@$m->status==4){
                                echo '<span class="label label-primary">In Process</span>';
                              }
                              if(@$m->status==5){
                                echo '<span class="label label-danger">Rejected</span>';
                              }

                              ?>
                            </td>
                            <td>
                              <?php if(Yii::app()->session['userModel']['user']['userType']=='deo'){ ?>
                              <?php if($m->status==2){?>
                                <a href="<?php echo Yii::app()->baseUrl?>/requisitions/viewtemp/id/<?php echo $model->id?>/type/<?php echo $m->id?>"><button type="button" class="btn btn-info btn-xs">View</button></a>&nbsp;
                              <?php } else{?>
                                <a href="<?php echo Yii::app()->baseUrl?>/requisitions/view/id/<?php echo $model->id?>/type/<?php echo $m->id?>"><button type="button" class="btn btn-info btn-xs">View</button></a>&nbsp;
                              <?php } } else{ ?>
                                <a href="<?php echo Yii::app()->baseUrl?>/requisitions/view/id/<?php echo $model->id?>/type/<?php echo $m->id?>"><button type="button" class="btn btn-info btn-xs">View</button></a>&nbsp;
                              <?php } ?>
                              <?php if(Yii::app()->session['userModel']['user']['userType']=='person'){ if($model->person_id==@Yii::app()->session['userModel']['user']['id'] && $m->status!=2){?>
                                <a href="#"><button type="button" class="btn btn-danger btn-xs closed cancelReq" data-toggle="modal" data-target="#rejectModal" rel="<?php echo $m->id?>">Close</button></a>
                              <?php } }?>
                              <?php if(Yii::app()->session['userModel']['user']['userType']=='deo' && $m->status!=2){ ?>
                                <a href="#"><button type="button" class="btn btn-danger btn-xs closed cancelReq" data-toggle="modal" data-target="#rejectModal" rel="<?php echo $m->id?>">Close</button></a>
                              <?php }?>
                              <?php if($m->status==2){ echo '<span class="label label-info" style="display: block;white-space: initial;line-height: 1.2;">'.$m->remarks.' @ '.$m->close_date.' by '.$this->closeName($m->person_id,$m->person).'</span>'; }?>
                              <?php /*if($m->status==1){if(Yii::app()->session['userModel']['user']['userType']=='person'){ if($model->person_id==@Yii::app()->session['userModel']['user']['id']){?>
                                <!-- <a href="#"><button rel="<?php //echo $m->id?>" type="button" class="btn btn-danger btn-xs pull-right cancelReq">Close requisition</button></a>&nbsp; -->
                                <a href="#"><button type="button" class="btn btn-danger btn-xs closed cancelReq" data-toggle="modal" data-target="#rejectModal" rel="<?php echo $m->id?>">Close</button></a>
                              <?php }}} else{ if($m->status==2){echo '<span class="label label-info" style="display: block;white-space: initial;line-height: 1.2;">'.$m->remarks.' @ '.$m->close_date.'</span>';} } ?> 
                              <?php if(Yii::app()->session['userModel']['user']['userType']=='deo' && $m->status!=2){ ?>
                              <!-- <a href="#"><button rel="<?php echo $m->id?>" type="button" class="btn btn-danger btn-xs pull-right cancelReq">Close requisition</button></a>&nbsp; -->
                              <a href="#"><button type="button" class="btn btn-danger btn-xs closed cancelReq" data-toggle="modal" data-target="#rejectModal" rel="<?php echo $m->id?>">Close</button></a>
                              <?php }*/?>
                            </td>
                          </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>

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
        <h4 class="modal-title" id="myModalLabel">Close Requisition</h4>
      </div>
      <div class="modal-body">
        <form id="closedReqForm" class="form-horizontal form-label-left">
          <input type="hidden" name="requisition_id" class="requisition_id">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reason<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- <input type="text" id="client_code" name="reason" required="required" class="form-control col-md-7 col-xs-12"> -->
                <textarea class="form-control col-md-7 col-xs-12" name="reason" ></textarea>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="closedReqBtn">Closed</button>
      </div>
    </div>
  </div>
</div>