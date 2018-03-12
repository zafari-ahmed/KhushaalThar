<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>User Access Level</h3>
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
                    <h2>Access Level<small>Add</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="usertypeForm" data-parsley-validate class="form-horizontal form-label-left" method="POST">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Access Level
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="user_type"  id="user_type" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$accesslevels->user_type?>">
                          <input type="hidden"  name="id"  id="id" value="<?php echo @$accesslevels->id?>"> 
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Add Applicant
                        </label>
                        <div class="col-md-6">
                          Yes<input type="radio" name="add_labor" value="1" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->add_labor==1)?'checked':''?>>
                          No<input type="radio" name="add_labor" value="0" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->add_labor==0)?'checked':''?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">View Applicant
                        </label>
                        <div class="col-md-6">
                          Yes<input type="radio" name="view_labor" value="1" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->view_labor==1)?'checked':''?>>
                          No<input type="radio" name="view_labor" value="0" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->view_labor==0)?'checked':''?>>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Add Company
                        </label>
                        <div class="col-md-6">
                          Yes<input type="radio" name="add_company" value="1" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->add_company==1)?'checked':''?>>
                          No<input type="radio" name="add_company" value="0" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->add_company==0)?'checked':''?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">View Company
                        </label>
                        <div class="col-md-6">
                          Yes<input type="radio" name="view_company" value="1" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->view_company==1)?'checked':''?>>
                          No<input type="radio" name="view_company" value="0" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->view_company==0)?'checked':''?>>
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Add DEO
                        </label>
                        <div class="col-md-6">
                          Yes<input type="radio" name="add_user" value="1" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->add_user==1)?'checked':''?>>
                          No<input type="radio" name="add_user" value="0" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->add_user==0)?'checked':''?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">View DEO
                        </label>
                        <div class="col-md-6">
                          Yes<input type="radio" name="view_users" value="1" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->view_users==1)?'checked':''?>>
                          No<input type="radio" name="view_users" value="0" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->view_users==0)?'checked':''?>>
                        </div>
                      </div>


                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Settings
                        </label>
                        <div class="col-md-6">
                          Yes<input type="radio" name="settings" value="1" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->settings==1)?'checked':''?>>
                          No<input type="radio" name="settings" value="0" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->settings==0)?'checked':''?>>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">View Requisition
                        </label>
                        <div class="col-md-6">
                          Yes<input type="radio" name="view_requisition" value="1" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->view_requisition==1)?'checked':''?>>
                          No<input type="radio" name="view_requisition" value="0" class="col-md-3" style="    float: none;" <?php echo (@$accesslevels->view_requisition==0)?'checked':''?>>
                        </div>
                      </div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="button" class="btn btn-success" id="usertypeBtn">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <?php if(@$edit==0){?>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>User Access Level<small>All</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Access Level</th>
                          <th>Add Applicant</th>
                          <th>View Applicant</th>

                          <th>Add Company</th>
                          <th>View Company</th>

                          <th>Add Deo</th>
                          <th>View Deo</th>

                          <th>Settings</th>
                          <th>View Requisitions</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($accesslevels as $v):?>
                          <tr>
                            <th scope="row"><?php echo $v->id?></th>
                            <td><?php echo @$v->user_type?></td>
                            <td><?php echo (@$v->add_labor==1)?'True':'False'?></td>
                            <td><?php echo (@$v->view_labor==1)?'True':'False'?></td>

                            <td><?php echo (@$v->add_company==1)?'True':'False'?></td>
                            <td><?php echo (@$v->view_company==1)?'True':'False'?></td>

                            <td><?php echo (@$v->add_user==1)?'True':'False'?></td>
                            <td><?php echo (@$v->view_users==1)?'True':'False'?></td>

                            <td><?php echo (@$v->settings==1)?'True':'False'?></td>
                            <td><?php echo (@$v->view_requisition==1)?'True':'False'?></td>
                            <td><a href="<?php echo Yii::app()->baseUrl.'/settings/editusertype/'.$v->id?>"><button type="button" class="btn btn-success btn-xs">Edit</button></a></td>
                          </tr>
                        <?php endforeach;?>
                        
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
            <?php }?>
            
        </div>