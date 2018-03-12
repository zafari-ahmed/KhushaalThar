<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Client Company Profile</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Client Company <small>Profile</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php echo Yii::app()->baseUrl.'/assets/images/img.jpg'?>" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3><?php echo ucwords(@$company->company_name)?></h3>

                      <ul class="list-unstyled user_data">
                        <!-- <li><i class="fa fa-map-marker user-profile-icon"></i> <?php //echo @$company->client_code?></li> -->
                        <li><i class="fa fa-briefcase user-profile-icon"></i> <?php echo @$company->company_email?></li>
                        <li class="m-top-xs"><i class="fa fa-briefcase user-profile-icon"></i> <?php if(@$company->allied_to==1){ echo 'Mining';} if(@$company->allied_to==2){ echo 'Power';}?></li>
                      </ul>


                      <br />
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      
                      
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Client Companys' Requisitions</a></li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Client Company Person's</a></li>
                          <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){?>
                            <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Add Client Companys' Person</a></li>
                          <?php } ?>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/company/viewreport/id/<?php echo @$company->id?>/type/requisition" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Requisition Code</th>
                                  <th>Type</th>
                                  <th>Skill</th>
                                  <th>HeadCount</th>
                                  <th>Date From</th>
                                  <th>Date End</th>
                                  <th>Remarks</th>
                                  <th>Action</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach(@$company->companyRequisitions as $compr):$models = ClientCompanyRequisitionDetails::model()->findAll('requisition_id =:req',array(':req'=>$compr->id)); foreach($models as $ind=>$m):?>
                                <tr>
                                  <?php
                                  if(@$m->status==0){
                                    $status = '<span class="label label-info">Pending</span>';
                                  }
                                  if(@$m->status==1){
                                    $status = '<span class="label label-success">Open</span>';
                                  }
                                  if(@$m->status==2){
                                    $status = '<span class="label label-danger">Closed</span>';
                                  }
                                  if(@$m->status==3){
                                    $status = '<span class="label label-warning">Under discussion</span>';
                                  }
                                  if(@$m->status==4){
                                    $status = '<span class="label label-primary">In Process</span>';
                                  }
                                  if(@$m->status==5){
                                    $status = '<span class="label label-danger">Rejected</span>';
                                  }

                                  ?>
                                  <td><?php echo @$ind+1?></td>
                                  <td><?php echo @$compr->requisition_code?></td>
                                  <td><?php echo (@$m->type==1)?'Skilled':'Unskilled'?></td>
                                  <td><?php echo @$m->skill?></td>
                                  <td><?php echo @$m->count?></td>
                                  <td><?php echo date('d M,Y',strtotime($m->date_from))?></td>
                                  <td><?php echo date('d M,Y',strtotime($m->date_to))?></td>
                                  <td><?php echo @$status;//(@$compr->status==1)?'Approved':'Pending'?></td>
                                  <td><a href="<?php echo Yii::app()->baseUrl?>/requisitions/<?php echo ($m->status==2)?'viewtemp':'view'?>/id/<?php echo $compr->id?>/type/<?php echo $m->id?>"><button type="button" class="btn btn-info btn-xs pull-right">View</button></a></td>
                                </tr>
                                <?php endforeach;?>
                                <tr><td colspan="9"></td></tr>
                                <?php endforeach;?>
                              </tbody>
                            </table>
                            <!-- end recent activity -->

                          </div>
                          <?php ?>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/company/viewreport/id/<?php echo @$company->id?>/type/person" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                            <table class="data table table-striped no-margin table-bordered">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <!-- <th>Code</th> -->
                                  <th>Name</th>
                                  <th>Email</th>
                                  <th>CNIC</th>
                                  <th>Designation</th>
                                  <th>Mobile Number</th>
                                  <?php if(@Yii::app()->session['userModel']['user']['userType']=='company'){?>
                                  <th></th>
                                  <?php }?>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($company->companypersons as $index=>$deos):?>
                                  <tr>
                                    <td><?php echo $index+1?></td>
                                    <!-- <td><?php echo $deos->code?></td> -->
                                    <td><?php echo $deos->name?></td>
                                    <td><?php echo $deos->email_address?></td>
                                    <td><?php echo $deos->cnic?></td>
                                    <td><?php echo $deos->designation?></td>
                                    <td><?php echo $deos->mobile_number?></td>
                                    <?php if(@Yii::app()->session['userModel']['user']['userType']=='company'){?>
                                    <td>
                                      <a href="<?php echo Yii::app()->baseUrl?>/labor/edit/id/<?php echo $deos->id?>"><button type="button" class="btn btn-danger btn-xs pull-right" id="addnewwork">Delete</button></a>&nbsp;
                                      <a href="<?php echo Yii::app()->baseUrl?>/labor/edit/id/<?php echo $deos->id?>"><button type="button" class="btn btn-success btn-xs pull-right" id="addnewwork">Edit</button></a>
                                    </td>
                                    <?php }?>
                                  </tr>
                                <?php endforeach;?>
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <?php if(@Yii::app()->session['userModel']['user']['userType']=='deo'){ ?>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <div class="row">
                              <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="x_panel">
                                  <div class="x_title">
                                    <h2>Client Company Person <small>Add</small></h2>
                                    <div class="clearfix"></div>
                                  </div>
                                  <div class="x_content">
                                    <br />
                                    
                                    <form id="clientdeoform" class="form-horizontal form-label-left">

                                     <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Person Name<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" id="" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                          <input type="hidden" id="company_id" name="company_id" value="<?php echo @$company->id?>">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Person CNIC<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" id="cnic" name="cnic" required="required" class="form-control col-md-7 col-xs-12" rel="deo">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Person Designation<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" id="" name="designation" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Person Mobile Number<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" id="mobile_number" name="mobile_number" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Person Email<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="text" id="email_address" name="email_address" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                      </div>

                                      <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password<span class="required">*</span>
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input type="password" id="first-name" name="password" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                      </div>
                                      <div class="ln_solid"></div>
                                      <div class="form-group">
                                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                          <button type="button" class="btn btn-primary">Cancel</button>
                                          <button type="button" class="btn btn-success" id="clientdeoformBtn">Submit</button>
                                        </div>
                                      </div>

                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php }?>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>