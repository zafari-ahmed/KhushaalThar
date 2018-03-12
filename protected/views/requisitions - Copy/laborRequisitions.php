<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Requisition Detail
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$detail_id?>/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/requisitions/Viewreport/id/<?php echo @$detail_id?>/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
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
                  <a href="javascipt:void()" ><button id="allRows" type="button" class="btn btn-primary btn-xs">All</button></a>
                  <a href="javascipt:void()" ><button id="pendingRow" type="button" class="btn btn-primary btn-xs">Pending</button></a>
                  <a href="javascipt:void()" ><button id="acceptRow" type="button" class="btn btn-primary btn-xs">Accepted</button></a>
                  <a href="<?php echo Yii::app()->baseUrl?>/requisitions/requisitiondetail/id/<?php echo @$detail_id?>" class="pull-right"><button type="button" class="btn btn-info btn-xs">Requisition Applicant Details</button></a>
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
                            <th class="column-title">Status</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($model as $labor):?>
                            <tr class="even pointer tr_<?php echo $labor->status?>">
                              <td class="a-center">
                                <?php if($labor->status==1){?>
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
                              <td class=" "><?php if($labor->status==0){ echo '<span class="label label-info">Pending</span>'; } if($labor->status==1){ echo '<span class="label label-success">Accepted</span>'; } if($labor->status==2){ echo '<span class="label label-danger">Rejected</span>'; } if($labor->status==3){ echo '<span class="label label-success">Job Completed</span>'; }?></td>
                              <td class=" last">
                                <?php if($labor->status!=3){ if($labor->status!=2){?>
                                <?php if($labor->status!=1){?>
                                <a href="#"><button type="button" class="btn btn-success btn-xs reqstatusBtn" data-toggle="modal" data-target="#acceptModal" rel="<?php echo $labor->labour->id?>">Accept</button></a>
                                <?php }?>
                                <a href="#"><button type="button" class="btn btn-info btn-xs reqstatusBtn" data-toggle="modal" data-target="#rejectModal" rel="<?php echo $labor->labour->id?>">Reject</button></a>
                                <?php } else{?>
                                  <?php echo '<p>'.$labor->reason.'</p>'?>
                                <?php }} else{?>
                                  <span class="label label-success">Job Completed</span>
                                <?php }?>
                              </td>
                            </tr>
                          <?php endforeach;?>
                          
                        </tbody>
                      </table>
                      <div class="form-group">
                        <label class="control-label col-md-12 col-sm-12 col-xs-12" for="last-name">Date<span class="required">*</span>
                        </label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                          <input type="text" name="date" id="date" required="required" class="ddate form-control col-md-6">
                        </div>
                      </div>
                      <div class="col-md-12" style="margin-top:10px">
                        <button type="button" class="btn btn-success" id="reguisitionAttnBtn">Submit Attandance</button>
                        <button type="button" class="btn btn-danger" id="reguisitionDehireBtn">Dehire Applicant</button>
                      </div>
                    </div>
                  </div>
                </div>
              </div>



        

<!-- Accept Modal -->
<div class="modal fade" id="acceptModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Accept Applicant</h4>
      </div>
      <div class="modal-body">
        <form id="labreqacceptform" class="form-horizontal form-label-left">
            <input type="hidden" name="labor_id" class="labor_id">
            <input type="hidden" name="requisition_id" value="<?php echo @$detail_id?>">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Accept Date<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="accept_date" name="accept_date" required="required" class="ddate form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Job Type<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- <input type="text" id="client_code" name="client_code" required="required" class="form-control col-md-7 col-xs-12"> -->
                <select name="job_type" class="form-control">
                  <option value="1">Daily</option>
                  <option value="2">Monthly</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Salary<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" id="client_code" name="salary" required="required" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="labreqacceptBtn">Accepted</button>
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
        <h4 class="modal-title" id="myModalLabel">Reject Applicant</h4>
      </div>
      <div class="modal-body">
        <form id="labreqrejectform" class="form-horizontal form-label-left">
          <input type="hidden" name="labor_id" class="labor_id">
          <input type="hidden" name="requisition_id" value="<?php echo @$detail_id?>">
            <div class="form-group">
              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reason<span class="required">*</span>
              </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <!-- <input type="text" id="client_code" name="reason" required="required" class="form-control col-md-7 col-xs-12"> -->
                <!-- <textarea class="form-control col-md-7 col-xs-12" name="reason" ></textarea> -->
                <select class="form-control" name="reason">
                  <option value="">Select reason</option>
                  <option value="Skill Variation">Skill Variation</option>
                  <option value="Physically Unfit">Physically Unfit</option>
                  <option value="Behavioral Issue">Behavioral Issue</option>
                  <option value="CNIC/License Issue">CNIC/License Issue</option>
                </select>
              </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="labreqrejectBtn">Rejected</button>
      </div>
    </div>
  </div>
</div>