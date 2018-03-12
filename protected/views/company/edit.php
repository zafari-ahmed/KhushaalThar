<div class="">
    <div class="page-title">
        <div class="title_left">
            <h3>Client Companies</h3>
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
            <div class="x_panel contentBg">
                <div class="x_title">
                    <h2>Client Company<small>Edit</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <br />
                    <form id="clientform" class="form-horizontal form-label-left">

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="hidden" name="id" value="<?php echo $company->id?>">
                                <input type="text" name="company_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $company->company_name?>" >
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Code Format<span class="required">*</span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="first-name" name="code_format" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $company->code_format?>" readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Allied to</label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div id="gender" class="btn-group" data-toggle="buttons">
                                    <label class="btn btn-default <?php echo ($company->allied_to==1)?'active':''?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="allied_to" value="1" <?php echo ($company->allied_to==1)?'checked':''?> data-parsley-multiple="gender" data-parsley-id="1"> &nbsp; Mining &nbsp;
                                    </label>
                                    <label class="btn btn-default <?php echo ($company->allied_to==2)?'active':''?>" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="allied_to" value="2" <?php echo ($company->allied_to==2)?'checked':''?> data-parsley-multiple="gender" data-parsley-id="2"> Power
                                    </label>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <h3>Company Person Information</h3>
                        <?php foreach($company->companypersons as $cp):?>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="hidden"  name="company[id][]"  value="<?php echo $cp->id?>">
                                    <input type="text"  name="company[name][]"  id="name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $cp->name?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email Address
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"  name="company[email_address][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $cp->email_address?>">
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password"  name="company[password][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $cp->name?>">
                                </div>
                            </div> -->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CNIC
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"  name="company[cnic][]" required="required" class="cnic form-control col-md-7 col-xs-12"  value="<?php echo $cp->cnic?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Designation
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"  name="company[designation][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12"  value="<?php echo $cp->designation?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile Number
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text"  name="company[mobile_number][]"  id="mobile_number" required="required" class="mobile_number form-control col-md-7 col-xs-12"  value="<?php echo $cp->mobile_number?>">
                                </div>
                            </div>
                            <hr/>
                        <?php endforeach;?>
                        <!-- <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[name][]"  id="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email Address
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[email_address][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password"  name="company[password][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CNIC
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[cnic][]" required="required" class=" cnic form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Designation
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[designation][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile Number
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[mobile_number][]"  id="mobile_number" required="required" class=" mobile_number form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <hr/>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[name][]"  id="name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email Address
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[email_address][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Password
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="password"  name="company[password][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">CNIC
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[cnic][]" required="required" class=" cnic form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Designation
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[designation][]"  id="first-name" required="required" class="form-control col-md-7 col-xs-12">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Mobile Number
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text"  name="company[mobile_number][]"  id="mobile_number" required="required" class=" mobile_number form-control col-md-7 col-xs-12">
                            </div>
                        </div> -->

                        <div class="ln_solid"></div>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                                <button type="button" class="btn btn-primary">Cancel</button>
                                <button type="button" class="btn btn-success" id="clientformBtn">Submit</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>