<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Client Requisition Report</h3>
              </div>

              <!-- <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-default" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div> -->
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Report<small>Filters</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="applicantReportForm" class="form-horizontal form-label-left" method="GET">

                      <div class="form-group">
                        <div class="col-md-2 col-sm-4 col-xs-12">
                          <label for="first-name">Company</label>
                          <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="company_id">
                            <option value="">Select company</option>
                            <?php foreach($company as $t):?>
                              <option value="<?php echo $t->id?>" <?php echo isset($_REQUEST['company_id'])?(($_REQUEST['company_id']==$t->id)?'selected':''):''?>><?php echo $t->company_name?></option>
                            <?php endforeach;?>
                          </select>
                        </div>
                          <div class="col-md-2 col-sm-4 col-xs-12">
                            <label for="first-name">Type</label>
                            <select id="category_id" class="form-control col-md-7 col-xs-12 select2_single" name="type"><option value="">Select skill type</option><option value="1" <?php echo isset($_REQUEST['type'])?(($_REQUEST['type']==1)?'selected':''):''?>>Skilled</option><option value="2" <?php echo isset($_REQUEST['type'])?(($_REQUEST['type']==2)?'selected':''):''?>>Unskilled</option></select>
                          </div>
                          <div class="col-md-2 col-sm-4 col-xs-12">
                            <label for="first-name">Skill</label>
                            <input type="text" id="skill" name="skill" class="form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['skill'])?$_REQUEST['skill']:''?>">
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12">
                            <label for="last-name">Date From</label>
                            <input type="text" id="createdOn" name="date_from" class="ddate form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['date_from'])?$_REQUEST['date_from']:''?>">
                          </div>
                          <div class="col-md-2 col-sm-6 col-xs-12">
                            <label for="last-name">Date End</label>
                            <input type="text" id="createdOn" name="date_end" class="ddate form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['date_end'])?$_REQUEST['date_end']:''?>">
                          </div>
                          <div class="col-md-2 col-sm-4 col-xs-12">
                            <label for="first-name">Status </label>
                            <select id="category_id" class="form-control col-md-7 col-xs-12 select2_single" name="status">
                                <option value="all" <?php echo isset($_REQUEST['status'])?(($_REQUEST['status']=='all')?'selected':''):''?>>Select Status</option>
                                <option value="00" <?php echo isset($_REQUEST['status'])?(($_REQUEST['status']=='00')?'selected':''):''?>>Pending</option>
                                <option value="1" <?php echo isset($_REQUEST['status'])?(($_REQUEST['status']=='1')?'selected':''):''?>>Open</option>
                                <option value="2" <?php echo isset($_REQUEST['status'])?(($_REQUEST['status']=='2')?'selected':''):''?>>Closed</option>
                                <option value="3" <?php echo isset($_REQUEST['status'])?(($_REQUEST['status']=='3')?'selected':''):''?>>Under discussion</option>
                                <option value="4" <?php echo isset($_REQUEST['status'])?(($_REQUEST['status']=='4')?'selected':''):''?>>In Process</option>
                                <option value="5" <?php echo isset($_REQUEST['status'])?(($_REQUEST['status']=='5')?'selected':''):''?>>Reject</option>
                            </select>
                          </div>
                      </div>
                      
                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <button type="submit" name="submit" class="btn btn-success">Search</button>
                          <button type="submit" name="excel" class="btn btn-success">Excel</button>
                          <button type="submit" name="pdf" class="btn btn-success">PDF</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Companies Requisitions<small>All</small></h2>
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
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php /*$models = ClientCompanyRequisitionDetails::model()->findAll('requisition_id =:req',array(':req'=>$model->id)); */if(@$requisitions){foreach(@$requisitions as $ind=>$m):?>
                          <tr>
                            <td><?php echo @$ind+1?></td>
                            <td><?php echo @$m->requisition->requisition_code?></td>
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
                                echo '<span class="label label-danger">In Process</span>';
                              }
                              if(@$m->status==5){
                                echo '<span class="label label-danger">Rejected</span>';
                              }

                              ?>
                            </td>
                            <td>
                              <a href="<?php echo Yii::app()->baseUrl?>/requisitions/view/id/<?php echo $m->requisition->id?>/type/<?php echo $m->id?>"><button type="button" class="btn btn-info btn-xs pull-right">View</button></a>&nbsp;
                            </td>
                          </tr>
                          <?php endforeach;}?>
                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            </div>
        </div>