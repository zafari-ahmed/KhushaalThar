<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registered Applicant
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/alllabor/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/alllabor/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table id="datatable" class="table table-striped table-bordered datatable" >
                        <thead>
                          <tr class="headings">
                            <!-- <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th> -->
                            <th class="column-title">ID</th>
                            <th class="column-title">Name</th>
                            <th class="column-title">CNIC</th>
                            <th class="column-title">Category</th>
                            <th class="column-title">Mobile #</th>
                            <th class="column-title">Block_2</th>
                            <th class="column-title">District</th>
                            <th class="column-title">Applied_for</th>
                            <th class="column-title">Status</th>
                            <th class="column-title">Work Status</th>
                            <th class="column-title no-link last" ><span class="nobr">Action</span>
                            </th>
                           
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($labors as $labor):?>
                            <tr class="even pointer">
                              <!-- <td class="a-center ">
                                <input type="checkbox" class="flat" name="id" value="<?php //echo $labor->id?>">
                              </td> -->
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->id?>"><?php echo $labor->id?></a></td>
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->id?>"><?php echo $labor->full_name?></a></td>
                              <td class=" "><?php echo $labor->cnic?></td>
                              <td class=" "><?php if($labor->category_id==1){ echo 'Skilled'; } if($labor->category_id==2){ echo 'Unskilled'; }?></td>
                              <td class=" "><?php echo $labor->mobile_number?></td>
                              <td class=" "><?php echo ($labor->block_2==1)?'Yes':'No'?></td>
                              <td class=" "><?php echo @$labor->district->name?></td>
                              <td class=" "><?php echo $labor->designation?></td>
                              <td class=" "><?php if($labor->status==1){ echo '<span class="label label-success">Activated</span>'; } if($labor->status==0){ echo '<span class="label label-warning">Deactivated</span><br/>'.$labor->remarks; } if($labor->status==5){ echo '<span class="label label-danger">Blacklisted</span><br/>'.$labor->remarks; }?></td>
                              <td class=" "><?php if($labor->status==1){ echo ($this->Laborstatus($labor->id)==true)?'<span class="label label-info">'.$this->Laborwork($labor->id).'</span>':'<span class="label label-success">Available</span>';} else{ echo '<span class="label label-danger">Un-available</span>';} ?></td>
                              <td class=" last">
                                <!--<a href="#"><button type="button" rel="<?php //echo $labor->id?>" class="btn btn-<?php //echo ($labor->status==1)?'danger':'success'?> btn-xs pull-right deactivate"><?php //echo ($labor->status==1)?'Deactivate':'Activate'?></button></a>-->
                                <!-- <a href="#"><button type="button" class="btn btn-<?php //echo ($labor->status==1)?'danger':'success'?> btn-xs deactivate" data-toggle="modal" data-target="#rejectModal" rel="<?php //echo $labor->id?>"><?php //echo ($labor->status==1)?'Deactivate':'Activate'?></button></a>
                                <a href="#"><button type="button" class="btn btn-danger btn-xs deactivate" data-toggle="modal" data-target="#blacklistModal" rel="<?php ///echo $labor->id?>">Blacklist</button></a>
                                <a href="<?php //echo Yii::app()->baseUrl?>/labor/edit/id/<?php //echo $labor->id?>"><button type="button" class="btn btn-success btn-xs pull-right" id="addnewwork">Edit</button></a> -->
                                <select class="form-control">
                                  <option>Select Action</option>
                                  <option>Edit</option>
                                  <option>Deactivate</option>
                                  <option>Blacklist</option>
                                </select>
                                <!-- <div class="btn-group" role="group" aria-label="Basic example">
                                  <a href="<?php echo Yii::app()->baseUrl?>/labor/edit/id/<?php echo $labor->id?>"><button style="margin:2px"  type="button" class="btn btn-xs btn-primary">Edit</button></a>
                                  <a  href="#"><button style="margin:2px"  type="button" class="btn btn-<?php echo ($labor->status==1)?'danger':'success'?> btn-xs deactivate" data-toggle="modal" data-target="<?php echo ($labor->status==1)?'#rejectModal':'#activeModal'?>" rel="<?php echo $labor->id?>"><?php echo ($labor->status==1)?'Deactivate':'Activate'?></button></a>
                                  <?php if($labor->status!=5){?><a href="#"><button style="margin:2px"  type="button" class="btn btn-warning btn-xs deactivate" data-toggle="modal" data-target="#blacklistModal" rel="<?php echo $labor->id?>">Blacklist</button></a><?php }?>
                                </div> -->
                                <!-- <a href="<?php //echo Yii::app()->baseUrl?>/labor/print/id/<?php //echo $labor->id?>" target="_blank"><button type="button" class="btn btn-info btn-xs pull-right">Print</button></a> -->
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
        <h4 class="modal-title" id="myModalLabel">Deactivate Applicant</h4>
      </div>
      <div class="modal-body">
        <form id="labdecactivateform" class="form-horizontal form-label-left">
          <input type="hidden" name="labor_id" class="labor_id">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reason<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- <input type="text" id="client_code" name="reason" required="required" class="form-control col-md-7 col-xs-12"> -->
                <!-- <textarea class="form-control col-md-7 col-xs-12" name="reason" ></textarea> -->
                <select class="form-control" name="reason">
                  <!-- <option value="Violation of cardinal rules">Violation of cardinal rules</option>
                  <option value="Poor Performance">Poor Performance</option>
                  <option value="Long absentee">Long absentee</option>
                  <option value="Behavioral Issue">Behavioral Issue</option> -->
                  <option value=''>Select Reason</option>
                  <?php foreach($deactivatestatus as $status):?>
                      <option value="<?php echo $status->reason?>"><?php echo $status->reason?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="labdecBtn">Deactivate</button>
      </div>
    </div>
  </div>
</div>
<!-- Reject Modal -->
<div class="modal fade" id="activeModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Activate Applicant</h4>
      </div>
      <div class="modal-body">
        <form id="labactivateform" class="form-horizontal form-label-left">
          <input type="hidden" name="labor_id" class="labor_id">
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
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="labactBtn">Activate</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="blacklistModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Blacklist Applicant</h4>
      </div>
      <div class="modal-body">
        <form id="labblkform" class="form-horizontal form-label-left">
          <input type="hidden" name="labor_id" class="labor_id">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reason<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- <input type="text" id="client_code" name="reason" required="required" class="form-control col-md-7 col-xs-12"> -->
                <!-- <textarea class="form-control col-md-7 col-xs-12" name="reason" ></textarea> -->
                <select class="form-control" name="reason">
                  <option value=''>Select Reason</option>
                  <?php foreach($blackstatus as $status):?>
                      <option value="<?php echo $status->reason?>"><?php echo $status->reason?></option>
                  <?php endforeach;?>
                </select>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="labblkBtn">Blacklist</button>
      </div>
    </div>
  </div>
</div>