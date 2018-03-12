<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Registered Client Companies
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/allcompany/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/allcompany/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table id="reqdatatable" class="table table-striped table-bordered" >
                        <thead>
                          <tr class="headings">
                            <!-- <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th> -->
                            <th class="column-title">ID</th>
                            <th class="column-title">Company Name</th>
                            <th class="column-title">Code Format</th>
                            <th class="column-title">Allied to</th>
                            <th class="column-title">Status</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($companies as $company):?>
                            <tr class="even pointer">
                              <!-- <td class="a-center ">
                                <input type="checkbox" class="flat" name="id" value="<?php //echo $labor->id?>">
                              </td> -->
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/company/view/id/<?php echo $company->id?>"><?php echo $company->id?></a></td>
                              
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/company/view/id/<?php echo $company->id?>"><?php echo ucfirst($company->company_name)?></a></td>
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/company/view/id/<?php echo $company->id?>"><?php echo $company->code_format?></a></td>
                              <td class=" "><?php if($company->allied_to==1){ echo 'Mining'; } if($company->allied_to==2){ echo 'Power'; }?></td>
                              <td><?php echo ($company->status==1)?'<span class="label label-success">Active</span>':'<span class="label label-danger">In-active</span>'?></td>
                              <td class=" last">
                                <!-- <a href="<?php //echo Yii::app()->baseUrl?>/company/edit/id/<?php //echo $company->id?>"><button type="button" class="btn btn-success btn-xs pull-right" id="addnewwork">Edit</button></a> -->
                                <a href="<?php echo Yii::app()->baseUrl?>/company/edit/<?php echo $company->id?>"><button type="button" class="btn btn-success btn-xs">Edit</button></a>
                                <a href="<?php echo Yii::app()->baseUrl?>/company/view/id/<?php echo $company->id?>" target="_blank"><button type="button" class="btn btn-info btn-xs">View</button></a>&nbsp;
                                <a href="#"><button type="button" class="btn btn-<?php echo ($company->status==1)?'danger':'success'?> btn-xs compdeactivate" data-toggle="modal" data-target="<?php echo ($company->status==1)?'#rejectModal':'#activeModal'?>" rel="<?php echo $company->id?>"><?php echo ($company->status==1)?'Deactivate':'Activate'?></button></a>
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
        <h4 class="modal-title" id="myModalLabel">Deactivate Client Company</h4>
      </div>
      <div class="modal-body">
        <form id="comdecactivateform" class="form-horizontal form-label-left">
          <input type="hidden" name="company_id" class="company_id">
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
        <button type="button" class="btn btn-primary" id="comdecBtn">Deactivate</button>
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
        <h4 class="modal-title" id="myModalLabel">Activate Client Company</h4>
      </div>
      <div class="modal-body">
        <form id="comactivateform" class="form-horizontal form-label-left">
          <input type="hidden" name="company_id" class="company_id">
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
        <button type="button" class="btn btn-primary" id="comactBtn">Activate</button>
      </div>
    </div>
  </div>
</div>