<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Deo's</h3>
              </div>
          </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Deo<small>Edit</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="deoForm" data-parsley-validate class="form-horizontal form-label-left" method="POST">

                     
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="name"  id="name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $deo->name?>">
                          <input type="hidden"  name="id"  id="id" value="<?php echo $deo->id?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email Address
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="email_address"  id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $deo->email_address?>">
                        </div>
                      </div>
                      <!-- <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="password"  name="password"  id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $deo->id?>">
                        </div>
                      </div> -->
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CNIC
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="cnic"  id="cnic" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $deo->cnic?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Designation
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="designation"  id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $deo->designation?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile Number
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="mobile_number"  id="mobile_number" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $deo->mobile_number?>">
                        </div>
                      </div>
                      <?php $userType = UserTypes::model()->findAll();?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Type
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <select name="user_type_id" class="form-control">
                            <?php foreach($userType as $u):?>
                              <option value="<?php echo $u->id?>" <?php echo ($deo->user_type_id==$u->id)?'selected':''?>><?php echo $u->user_type?></option>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <!-- <button type="submit" class="btn btn-primary">Cancel</button> -->
                          <button type="button" class="btn btn-success" id="submitDeo">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
        </div>