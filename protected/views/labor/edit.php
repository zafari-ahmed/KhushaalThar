<style type="text/css">
	ul li a, ul li a span{
		cursor: pointer;
	}
</style>
<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Applicant Registration Form</h3>
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
                    <h2>Applicant Registration Form</h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <!-- Smart Wizard -->
                    <!-- <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p> -->
                    <div id="wizard" class="form_wizard wizard_horizontal">
                      <ul class="wizard_steps">
                        <li>
                          <a href="#step-1">
                            <span class="step_no">1</span>
                            <span class="step_descr">
                              Step 1<br />
                              <small>Personal Information</small>
                          	</span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-2">
                            <span class="step_no">2</span>
                            <span class="step_descr">
	                              Step 2<br />
	                              <small>Verifications</small>
	                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-3">
                            <span class="step_no">3</span>
                            <span class="step_descr">
                                              Step 3<br />
                                              <small>Training</small>
                                          </span>
                          </a>
                        </li>
                        <li>
                          <a href="#step-4">
                            <span class="step_no">4</span>
                            <span class="step_descr">
                                              Step 4<br />
                                              <small>Document Upload</small>
                                          </span>
                          </a>
                        </li>
                      </ul>
                      <div id="step-1">
                        <form class="form-horizontal form-label-left" id="labourRegistrationForm" >
                        	<input type="hidden" name="labor_id" class="labor_id" value="<?php echo @$labor->id?>">
                        	<h5 class="formH5">PERSONAL INFORMATION RECORD  ذاتي معلومات جو ريڪارڊ</h5>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Form ID</label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" readonly value="<?php echo @$labor->id?>" class="form-control col-md-7 col-xs-12">
	                            </div>
	                          </div>

	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NICOP
	                            </label>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="nicop" class="col-md-3" value="1" style="    float: none;" <?php echo (@$labor->nicop==1)?'checked':''?>>
	                              No<input type="radio" name="nicop" class="col-md-3" value="0" style="    float: none;"  <?php echo (@$labor->nicop==0)?'checked':''?>>
	                            </div>
	                          </div>

	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">CNIC <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="cnic" name="cnic" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->cnic?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Full Name <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" name="full_name" id="full_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->full_name?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Father Name <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="father_name" name="father_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->father_name?>">
	                            </div>
	                          </div>
	                          <?php $dob = explode('-', $labor->dob);$db = $dob[2].'-'.$dob[1].'-'.$dob['0'];?>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date Of Birth <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="dob" name="dob" required="required" class=" form-control col-md-7 col-xs-12" value="<?php echo @$db;//@$labor->dob?>">
	                            </div>
	                          </div>
	                          <!-- <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Religion <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="religion" name="religion" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->religion?>">
	                            </div>
	                          </div> -->
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Religion <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="religion" name="religion" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <select id="religion" name="religion" required="required" class="form-control">
	                              	<option value=''>Select Religion</option>
	                              	<option value='Muslim' <?php echo (@$labor->religion=='Muslim')?'selected':''?>>Muslim</option>
	                              	<option value="Christian" <?php echo (@$labor->religion=='Christian')?'selected':''?>>Christian</option>
	                              	<option value="Hindu" <?php echo (@$labor->religion=='Hindu')?'selected':''?>>Hindu</option>
	                              </select>
	                            </div>
	                          </div>
	                          <?php $mobiles = explode(',',$labor->mobile_number); foreach($mobiles as $index=>$m):?>
	                          <div class="form-group" id="mobile_<?php echo $index?>">
	                          	<?php if($index==0){?>
		                          	<button type="button" class="btn btn-success btn-xs pull-right" id="addnewmobile">Add New</button>
		                          <?php } else{?>
		                          <button type="button" class="btn btn-success btn-xs pull-right removenewmobile" rel="<?php echo $index?>">Remove</button>
		                          <?php } ?>
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mobile Number <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="mobile_number" name="mobile_number[]" required="required" class="form-control col-md-7 col-xs-12 mobile_number" value="<?php echo @$m?>">
	                            </div>
	                          </div>
	                          <?php endforeach;?>
	                          <div id="mobileBox"></div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Gender
	                            </label>
	                            <div class="col-md-6">
	                              Male<input type="radio" name="gender" class="col-md-3" value="male" style="    float: none;" <?php echo (@$labor->gender=='male')?'checked':''?>>
	                              Female<input type="radio" name="gender" class="col-md-3" value="female" style="    float: none;" <?php echo (@$labor->gender=='female')?'checked':''?>>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Marital Status
	                            </label>
	                            <div class="col-md-6">
	                              Single<input type="radio" name="martial_status" class="col-md-3" value="0" style="    float: none;" <?php echo (@$labor->martial_status==0)?'checked':''?>>
	                              Married<input type="radio" name="martial_status" class="col-md-3" value="1" style="    float: none;" <?php echo (@$labor->martial_status==1)?'checked':''?>>
	                            </div>
	                          </div>
	                          <div class="form-group <?php echo (@$labor->martial_status==0)?'hide':''?>" id="kidsBox">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Kids
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="last-name" name="kids" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->kids?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <select id="category_id" class="form-control col-md-7 col-xs-12" name="category_id">
	                              <option value=''>Select category</option>
	                              <option value="1" <?php echo (@$labor->category_id==1)?'selected':''?>>Skilled</option><option value="2" <?php echo (@$labor->category_id==2)?'selected':''?>>Unskilled</option></select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Applied For
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="designation" name="designation" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->designation?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block 2 <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="block_2" value="1" class="col-md-3" style="    float: none;" <?php echo (@$labor->block_2==1)?'checked':''?>>
	                              No<input type="radio" name="block_2" value="0" class="col-md-3" style="    float: none;" <?php echo (@$labor->block_2==0)?'checked':''?>>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Village <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="village_id" id="village_id">
		                            <option value="">Please Select Village</option>
		                            <?php foreach($villages as $t):?>
		                            	<option value="<?php echo $t->id?>" <?php echo (@$labor->village_id==$t->id)?'selected':''?>><?php echo $t->village?></option>
		                            <?php endforeach;?>
		                          </select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address 
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="address" name="address" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->address?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tehsil <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                             <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="tehsil_id" id="tehsil_id">
		                            <option value="">Please Select Tehsil</option>
		                            <?php foreach($tehsils as $t):?>
		                            	<option value="<?php echo $t->id?>" <?php echo (@$labor->tehsil_id==$t->id)?'selected':''?>><?php echo $t->name?></option>
		                            <?php endforeach;?>
		                          </select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">District <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <!-- <select class="form-control col-md-7 col-xs-12"><option>District</option></select> -->
	                              <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="district_id" id="district_id">
		                            <option value="">Please Select Districts</option>
		                            <?php foreach($districts as $t):?>
		                            	<option value="<?php echo $t->id?>" <?php echo (@$labor->district_id==$t->id)?'selected':''?>><?php echo $t->name?></option>
		                            <?php endforeach;?>
		                          </select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Can you drive?
	                            </label>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="drive" value="1" class="col-md-3" style="    float: none;" <?php echo (@$labor->drive==1)?'checked':''?>>
	                              No<input type="radio" name="drive" value="0" class="col-md-3" style="    float: none;" <?php echo (@$labor->drive==0)?'checked':''?>>
	                            </div>
	                          </div>

	                          <div class="<?php echo (@$labor->drive==0)?'hide':''?>" id="driveBox">
		                          <hr/>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Driving License
		                            </label>
		                            <div class="col-md-6">
		                              Yes<input type="radio" name="driving_license" value="1" class="col-md-3" style="    float: none;" <?php echo (@$labor->drivingLicense[0]->driving_license==1)?'checked':''?>>
		                              No<input type="radio" name="driving_license" value="0" class="col-md-3" style="    float: none;" <?php echo (@$labor->drivingLicense[0]->driving_license==0)?'checked':''?>>
		                            </div>
		                          </div>
		                          <div class="<?php echo (@$labor->drivingLicense[0]->driving_license==0)?'hide':''?>" id="licenseBox">
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Driving License Number
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <input type="text" id="last-name" name="driving_license_number" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->drivingLicense[0]->driving_license_number?>">
			                            </div>
			                          </div>
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle Type
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
			                              <!-- <select class="form-control col-md-7 col-xs-12" name="vehicle_type">
			                              	<option value="">Vehicle Type</option>
			                              	<option value="bus" <?php //echo (@$labor->drivingLicense[0]->vehicle_type=='bus')?'selected':''?>>Bus</option>
			                              	<option value="suv" <?php //echo (@$labor->drivingLicense[0]->vehicle_type=='suv')?'selected':''?>>SUV</option>
			                              	<option value="truck" <?php //echo (@$labor->drivingLicense[0]->vehicle_type=='truck')?'selected':''?>>Truck</option>
			                              	<option value="dumper" <?php //echo (@$labor->drivingLicense[0]->vehicle_type=='dumper')?'selected':''?>>Dumper</option>
			                              	<option value="other" <?php //echo (@$labor->drivingLicense[0]->vehicle_type=='other')?'selected':''?>>Other</option>
			                              </select> -->
			                              <select class="form-control col-md-7 col-xs-12" name="vehicle_type">
			                              	
			                              	<option value="">Please Select Vehicle Type</option>
				                            <?php foreach($vehicletypes as $t):?>
				                            	<option value="<?php echo $t->name?>" <?php echo (@$labor->drivingLicense[0]->vehicle_type==@$t->name)?'selected':''?>><?php echo @$t->name?></option>
				                            <?php endforeach;?>
			                              </select>
			                            </div>
			                          </div>
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">License Category
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
			                              <select class="form-control col-md-7 col-xs-12" name="license_category">
			                              	<option value="">License Category</option>
			                              	<option value="ltv" <?php echo (strtolower(@$labor->drivingLicense[0]->license_category)=='ltv')?'selected':''?>>LTV</option>
			                              	<option value="htv" <?php echo (@strtolower($labor->drivingLicense[0]->license_category)=='htv')?'selected':''?>>HTV</option>
			                              </select>
			                            </div>
			                          </div>
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Issue Date
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <input type="text" id="issue_date" name="issue_date" required="required" class="ddate form-control col-md-7 col-xs-12" value="<?php echo (@$labor->drivingLicense)?(($labor->drivingLicense[0]->driving_license==1)?((@$labor->drivingLicense[0]->issue_date!='0000-00-00')?$labor->drivingLicense[0]->issue_date:''):''):''?>">
			                            </div>
			                          </div>
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Valid Upto
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <input type="text" id="valid_upto" name="valid_upto" required="required" class="ddate form-control col-md-7 col-xs-12" value="<?php echo (@$labor->drivingLicense)?(($labor->drivingLicense[0]->driving_license==1)?((@$labor->drivingLicense[0]->valid_upto!='0000-00-00')?@$labor->drivingLicense[0]->valid_upto:''):''):''?>"><p class="hide" id="valid_upto_error" style="color: red;font-weight: bold;"></p>
			                            </div>
			                          </div>
			                          <!-- <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Valid Upto
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <input type="number" id="last-name" name="driving_license_expiry" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->drivingLicense[0]->driving_license_expiry?>">
			                            </div>
			                          </div> -->
			                      </div>
		                      </div>
		                      <div class="form-group">
		                      	<div class="col-md-12">
							        <div class="col-md-6 center">
							          <p><label>Picture</label><div id="my_camera"></div></p>
							          <input type='button' value="Take Snapshot" id="take_snapshot" />
							        </div>
							        <div class="col-md-6 center">
							          <label>Picture</label>
							          <div id="results"><img style="width: 250px;height: 190px;margin-top: 10px;"src="<?php echo Yii::app()->baseUrl.'/uploads/'.$labor->avatar?>"/></div>
							        </div>
							    </div>
		                      </div>
		                      <div class="form-group">
		                      	<div class="form-group">
		                      	<div class="col-md-12">
							        <div class="col-md-6 center">
							          <input type='button' value="Get Thumb" id="take_thumb" />
							        </div>
							        <div class="col-md-6 center">
							          <label>Picture</label><div id="thumb_results"><img style="height: 190px;margin-top: 10px;"src="<?php echo Yii::app()->baseUrl.'/uploads/applicantthumb/'.$labor->thumb?>"/></div>
							          <input type="hidden" id="thumbData" name="thumb" value="<?php echo @$labor->thumb?>"/>
							        </div>
							    </div>
		                      </div>
		                      </div>
		                      <hr/>
	                          <h5 class="formH5">EMPLOYMENT RECORD ملازمت جو ريڪارڊ</h5>
	                          <hr/>
	                          <button type="button" class="btn btn-success btn-xs pull-right" id="addnewwork">Add New</button>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Currently Working
	                            </label>
	                            <?php $employment = count($labor->employments);?>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="working" value="1" class="col-md-3" style="    float: none;" <?php echo (@$labor->employments[0]->working == 1)?'checked':''?>>
	                              No<input type="radio" name="working" value="0" class="col-md-3" style="    float: none;" <?php echo (@$labor->employments[0]->working==0)?'checked':''?>>
	                            </div>
	                          </div>
	                          <hr/>
	                          <div class="<?php echo (@$labor->employments[0]->working == 0)?'hide':''?>" id="workingBox">
	                          		<?php if(@$labor->employments[0]->working==1){foreach($labor->employments as $index=>$LE): ?>
		                          		<div id="working_<?php echo $index?>">
		                          		<button type="button" class="btn btn-success btn-xs pull-right removework"  rel="<?php echo $index?>">Remove</button>
		                      			<!-- <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Source Of Income
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="source_of_income[<?php //echo $index?>]" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$LE->source_of_income?>">
				                            </div>
				                          </div> -->
				                          <?php if(@$LE->company_name!=''){?>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name 
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="company_name[<?php echo $index?>]" required="required" class="form-control col-md-7 col-xs-12 comp" value="<?php echo @$LE->company_name?>">
				                            </div>
				                          </div>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="from_date[<?php echo $index?>]" required="required" class="ddate form-control col-md-7 col-xs-12 date_from" value="<?php echo @$LE->from_date?>">
				                            </div>
				                          </div>
				                          <div class="form-group">
	                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Till-date
	                                        </label>
	                                        <div class="col-md-6">
	                                            Yes<input type="radio" name="till_date[<?php echo $index?>]" value="1" class="till_date col-md-3" style="    float: none;" <?php echo (@$LE->to_date==NULL)?'checked':''?>>
	                                            No<input type="radio"  name="till_date[<?php echo $index?>]" value="0" class="till_date col-md-3" style="    float: none;" <?php echo (@$LE->to_date!=NULL)?'checked':''?>>
	                                        </div>
	                                    </div>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To Date
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="to_date[<?php echo $index?>]" required="required" class="ddate form-control col-md-7 col-xs-12 date_too" value="<?php echo @$LE->to_date?>">
				                            </div>
				                          </div>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Position
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="position[<?php echo $index?>]" required="required" class="form-control col-md-7 col-xs-12 position" value="<?php echo @$LE->position?>">
				                            </div>
				                          </div>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Salary
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="salary[<?php echo $index?>]" required="required" class="form-control col-md-7 col-xs-12 salary" value="<?php echo @$LE->salary?>">
				                            </div>
				                          </div>
				                          <hr/>
				                      </div>	
				                     <?php } else{?>     
				                     <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Source Of Income
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="source_of_income" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$LE->source_of_income?>">
				                            </div>
				                          </div>
		                      		<?php } endforeach;} else{?>
		                      			<!-- <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Source Of Income
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="source_of_income[]" required="required" class="form-control col-md-7 col-xs-12" >
				                            </div>
				                          </div> -->
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name 
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="company_name[]" required="required" class="form-control col-md-7 col-xs-12 comp" >
				                            </div>
				                          </div>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="from_date[]" required="required" class="ddate form-control col-md-7 col-xs-12 date_from" >
				                            </div>
				                          </div>
				                          <div class="form-group">
	                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Till-date
	                                        </label>
	                                        <div class="col-md-6">
	                                            Yes<input type="radio" name="till_date[]" value="1" class="till_date col-md-3" style="    float: none;">
	                                            No<input type="radio"  name="till_date[]" value="0" class="till_date col-md-3" style="    float: none;" checked>
	                                        </div>
	                                    </div>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To Date
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="to_date[]" required="required" class="ddate form-control col-md-7 col-xs-12 date_too" >
				                            </div>
				                          </div>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Position
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="position[]" required="required" class="form-control col-md-7 col-xs-12 position" >
				                            </div>
				                          </div>
				                          <div class="form-group">
				                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Salary
				                            </label>
				                            <div class="col-md-6 col-sm-6 col-xs-12">
				                              <input type="text" id="first-name" name="salary[]" required="required" class="form-control col-md-7 col-xs-12 salary" >
				                            </div>
				                          </div>
		                      		<?php }?>
		                          <div id="newworkingBox"></div>
		                      </div>
	                          <div id="workingBoxNo" class="<?php echo (@$labor->employments[0]->working == 1)?'hide':''?>">
		                      	
		                      	<div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Current Source of Income
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input type="text" id="first-name" name="source_of_income" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (@$labor->employments)?$labor->employments[0]->source_of_income:''?>">
		                            </div>
		                          </div>
		                      </div>
	                          <h5 class="formH5">EDUCATION RECORD ريڪارڊ تعليمي<button type="button" class="btn btn-success btn-xs pull-right" id="addneweducation">Add New</button></h5>
	                          <hr/>
	                          
	                          	<?php if($labor->educations){foreach($labor->educations as $index=>$le):?>
	                          		<div id="education_<?php echo $index?>">
		                          	<button type="button" class="btn btn-success btn-xs pull-right removeeduc"  rel="<?php echo $index?>">Remove</button>
	                      			<div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Examination Passed
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
		                              <select class="form-control col-md-7 col-xs-12" name="education_type_id[<?php echo $index?>]">
		                              	<option value="">Education Type</option>
		                              	<option value="1" <?php echo ($le->education_type_id=='1')?'selected':''?>>Primary</option>
		                              	<option value="2" <?php echo ($le->education_type_id=='2')?'selected':''?>>Middle</option>
		                              	<option value="3" <?php echo ($le->education_type_id=='3')?'selected':''?>>Matric</option>
		                              	<option value="7" <?php echo ($le->education_type_id=='7')?'selected':''?>>Diploma</option>
		                              	<option value="4" <?php echo ($le->education_type_id=='4')?'selected':''?>>Intermediate</option>
		                              	<option value="5" <?php echo ($le->education_type_id=='5')?'selected':''?>>Graduation</option>
		                              	<option value="6" <?php echo ($le->education_type_id=='6')?'selected':''?>>Masters</option>
		                              </select>
		                            </div>
		                          </div>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discipline
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="board[<?php echo $index?>]" required="required" type="text" value="<?php echo @$le->board?>">
		                            </div>
		                          </div>
		                          <div class="form-group">
		                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Passing Year</label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <!-- <input id="middle-name" class="form-control col-md-7 col-xs-12" type="number" name="passing_year[<?php echo $index?>]" value="<?php echo @$le->passing_year?>"> -->
		                              <select class="form-control col-md-7 col-xs-12" name="passing_year[<?php echo $index?>]">
							      		<option value="">Passing year</option>
							      		<?php for($i=1960;$i<=date('Y');$i++){?>
							      			<option value="<?php echo $i?>" <?php echo ($le->passing_year==$i)?'selected':''?>><?php echo $i?></option>	
							      		<?php }?>
							      	</select>
		                            </div>
		                          </div>
		                          
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12">College / School Name
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="organization_name[<?php echo $index?>]" required="required" type="text" value="<?php echo @$le->organization_name?>">
		                            </div>
		                          </div>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Certificate
		                            </label>
		                            <div class="col-md-6">
		                              Yes<input type="radio" name="degree[<?php echo $index?>]" value="1" class="col-md-3" style="    float: none;" <?php echo ($le->degree=='1')?'checked':''?>>
		                              No<input type="radio" name="degree[<?php echo $index?>]" value="0" class="col-md-3" style="    float: none;" <?php echo ($le->degree!='')?(($le->degree=='0')?'checked':''):'checked'?>>
		                            </div>
		                          </div>	
		                          <hr/>
		                          </div>
	                      		<?php endforeach;} else{?>
	                      		<div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Examination Passed
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <select class="form-control col-md-7 col-xs-12" name="education_type_id[]">
	                              	<option value="">Examination passed</option>
	                              	<option value="1">Primary</option>
	                              	<option value="2">Middle</option>
	                              	<option value="3">Matric</option>
	                              	<option value="7">Diploma</option>
	                              	<option value="4">Intermediate</option>
	                              	<option value="5">Graduation</option>
	                              	<option value="6">Masters</option>
	                              </select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Discipline
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="board[]" required="required" type="text">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Passing Year</label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input id="middle-name" class="form-control col-md-7 col-xs-12" type="number" name="passing_year[]"> -->
	                              	<select class="form-control col-md-7 col-xs-12" name="passing_year[]">
							      		<option value="">Passing year</option>
							      		<?php for($i=1960;$i<=date('Y');$i++){?>
							      			<option value="<?php echo $i?>"><?php echo $i?></option>	
							      		<?php }?>
							      	</select>
	                            </div>
	                          </div>
	                          
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12">College / School Name
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="organization_name[]" required="required" type="text">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Certificate
	                            </label>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="degree[0]" value="1" class="col-md-3" style="    float: none;">
	                              No<input type="radio" name="degree[0]" value="0" class="col-md-3" style="    float: none;" checked>
	                            </div>
	                          </div>

	                      		<?php }?>
	                          <div id="neweducationBox"></div>
	                          <!-- <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Remarks
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <textarea name="remarks" class="form-control"><?php //echo $labor->remarks?></textarea>
	                            </div>
	                          </div> -->
                        </form>

                      </div>
                      <div id="step-2">

                        <!-- <h2 class="StepTitle">HSE Medical & Police </h2> -->
                        <form class="form-horizontal form-label-left" id="verifications" >
                        	<input type="hidden" name="labor_id" class="labor_id" value="<?php echo @$labor->id?>">
	                        <div class="form-group">
	                        	<h2>HSE</h2>
	                        	<div class="col-md-6">
	                        	<label style="margin-right:10px" for="last-name">HSE Clearance</label>
	                         	 Yes<input type="radio" name="hse" value="1" style="    margin:15px;float: none;" <?php echo (@$labor->hse)?((@$labor->hse[0]->hse=='1')?'checked':''):''?>>
	                         	 No<input type="radio" name="hse" value="0" style="    margin:15px;float: none;" <?php echo (@$labor->hse)?((@$labor->hse[0]->hse=='0')?'checked':''):''?>>
	                        	</div>
	                      	</div>
	                      	<hr/>
	                      	<div class="form-group">
	                      		<h2>Medicle</h2>
	                        	<div class="col-md-12">
	                         	<label style="margin-right:10px" for="last-name">Medical Clearance</label>
	                         	 Yes<input type="radio" name="medical" value="1" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->medical=='1')?'checked':''):''?>>
	                         	 No<input type="radio" name="medical" value="0" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->medical=='0')?'checked':''):''?>>
	                        	</div>
	                        	<div class="col-md-12">
	                        	<label style="margin-right:10px" for="last-name">Medical Type</label>
	                         	 Basic<input type="radio" name="type" value="basic" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->type=='basic')?'checked':''):''?>>
	                         	 Complete<input type="radio" name="type" value="complete" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->type=='complete')?'checked':''):''?>>
	                         	</div>
	                        	<div class="col-md-12">
	                        	<label style="margin-right:10px" for="last-name">Medical Status</label>
	                         	 Fit<input type="radio" name="result" value="fit" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->result=='fit')?'checked':''):''?>>
	                         	 Un-Fit<input type="radio" name="result" value="unfit" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->result=='unfit')?'checked':''):''?>>
	                        	</div>
	                      	</div>
	                      	<hr/>
	                      	<div class="form-group">
	                      		<h2>Police</h2>
	                        	<div class="form-group col-md-6">
	                            	<label >Submitted Date</label>
	                              	<input type="text" id="submitted_date" name="submitted_date" required="required" class="ddate form-control col-md-7 col-xs-12" value="<?php echo (@$labor->police)?@$labor->police[0]->submitted_date:''?>">
	                            
	                          </div>
	                          <div class="form-group col-md-6">
	                            	<label >Security Date</label>
	                              	<input type="text" id="security_date" name="security_date" required="required" class="ddate form-control col-md-7 col-xs-12" value="<?php echo (@$labor->police)?@$labor->police[0]->security_date:''?>">
	                            
	                          </div>
	                          <div class="form-group col-md-6">
	                            	<label >Cleared Date</label>
	                              	<input type="text" id="cleared_date" name="cleared_date" required="required" class="ddate form-control col-md-7 col-xs-12" value="<?php echo (@$labor->police)?@$labor->police[0]->cleared_date:''?>">
	                            
	                          </div>
	                        	<div class="col-md-12">
	                        	<label style="margin-right:10px" for="last-name">Police Clearance</label>
	                         	 Yes<input type="radio" name="police" value="1" style="    margin:15px;float: none;" <?php echo (@$labor->police)?((@$labor->police[0]->police_verified=='1')?'checked':''):''?>>
	                         	 No<input type="radio" name="police" value="0" style="    margin:15px;float: none;" <?php echo (@$labor->police)?((@$labor->police[0]->police_verified=='0')?'checked':''):''?>>
	                        	</div>
	                        	<div class="col-md-12">
	                        	<label style="margin-right:10px" for="last-name">Police Status</label>
	                         	 Cleared<input type="radio" name="police_status" value="cleared" style="    margin:15px;float: none;" <?php echo (@$labor->police)?((@$labor->police[0]->status=='1')?'checked':''):''?>>
	                         	 Not-cleared<input type="radio" name="police_status" value="notcleared" style="    margin:15px;float: none;" <?php echo (@$labor->police)?((@$labor->police[0]->status=='0')?'checked':''):''?>>
	                        	</div>
							</div>
							<hr/>
	                      	<div class="form-group">
	                      		<?php if($labor->skill){?>
	                      		<div class="col-md-12">
	                      			<h2>Previos Skill Results</h2>
	                      			<table class="table table-striped table-bordered" style="width:20%">
				                        <thead>
				                          <tr class="headings">
				                            <th class="column-title">Date</th>
				                            <th class="column-title">Score</th>
				                            <th class="column-title">Action</th>
				                            </th>
				                          </tr>
				                        </thead>
				                        <tbody>
				                        	<?php foreach($labor->skill as $sk):?>
				                        		<tr>
				                        			<td><?php echo $sk->date?></td>
				                        			<td><?php echo $sk->result?></td>
				                        			<td><a href="javascript:void()"><button type="button" class="btn btn-danger btn-xs deleteSkill" rel="<?php echo @$sk->id?>">Delete</button></a></td>
				                        		</tr>
				                        	<?php endforeach;?>
				                        </tbody>
				                    </table>
	                      		</div>
	                      		<?php }?>
	                        	<div class="form-group col-md-6">
	                            <h2>Dumper Skill Test</h2>
	                            	<label >Date</label>
	                              	<input type="text" id="skill_date" name="skill_date" required="required" class="ddate form-control col-md-7 col-xs-12">
	                            
	                          </div>
	                        	<div class="col-md-12">
	                        	<label style="margin-right:10px" for="last-name">Score</label>
	                         	 A<input type="radio" name="skill" value="A" style="    margin:15px;float: none;">
	                         	 B<input type="radio" name="skill" value="B" style="    margin:15px;float: none;">
	                         	 C<input type="radio" name="skill" value="C" style="    margin:15px;float: none;">
	                        	</div>
							</div>
	                      </form>
                      </div>
                      <div id="step-3">
                        <h2 class="StepTitle">Training</h2>
                        <form class="form-horizontal form-label-left" id="traning" >
                        	<input type="hidden" name="labor_id" class="labor_id" value="<?php echo @$labor->id?>">
	                        <div class="form-group">
	                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Training Session
	                        	</label>
	                        	<div class="col-md-6">
	                         	 Yes<input type="radio" name="training" value="1" class="col-md-3" style="    float: none;" <?php echo (@$labor->traings)?((@$labor->traings[0]->traings=='1')?'checked':''):''?>>
	                         	 No<input type="radio" name="training" value="0" class="col-md-3" style="    float: none;" <?php echo (@$labor->traings)?((@$labor->traings[0]->traings=='0')?'checked':''):''?>>
	                        	</div>
	                      	</div>
	                      	<div class="form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Training 
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                              <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="training_id" id="training_id" disabled>
	                            <option value="">Please Select training</option>
	                            <?php foreach($trainings as $t):?>
	                            	<option value="<?php echo $t->id?>" <?php echo (@$labor->traings)?((@$labor->traings[0]->training_id==$t->id)?'selected':''):''?>><?php echo $t->institute_name?></option>
	                            <?php endforeach;?>
	                          </select>
                            </div>
                          </div>
	                      	
			                	<!-- <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Trade
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="trade" name="trade" required="required" class="form-control col-md-7 col-xs-12" value="<?php //echo (@$labor->traings)?@$labor->traings[0]->trade:''?>">

	                            </div>
	                          </div> -->
	                          <input type="hidden" id="trade" name="trade" value="">
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
	                         	 Pass<input type="radio" name="result" value="pass" class="col-md-3" style="    float: none;" <?php echo (@$labor->traings)?((@$labor->traings[0]->result=='pass')?'checked':''):''?>>
	                         	 Fail<input type="radio" name="result" value="fail" class="col-md-3" style="    float: none;" <?php echo (@$labor->traings)?((@$labor->traings[0]->result=='fail')?'checked':''):''?>>
	                        	</div>
	                      	</div>
	                         <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Batch No.
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="batch_number" name="batch_number" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo (@$labor->traings)?@$labor->traings[0]->batch_number:''?>">
	                            </div>
	                          </div>
	                      </form>
                      </div>
                      <div id="step-4">
                        <h2 class="StepTitle">Document for scan</h2>
                        <form action="<?php echo Yii::app()->baseUrl?>/labor/uploaddocuments" class="dropzone" id="verification">
	                        <input type="hidden" name="labor_id" class="labor_id" value="<?php echo @$labor->id?>">
	                    </form>

	                    <h3>Applicants Documents</h3>
	                    <table class="table table-striped">
	                      <thead>
	                        <tr>
	                          <th>#</th>
	                          <th>File</th>
	                          <th>Link</th>
	                          <th>Action</th>
	                          
	                        </tr>
	                      </thead>
	                      <tbody>
	                        <?php foreach($labor->documents as $index=>$v):?>
	                      		<tr id="file_<?php echo $v->id?>">
		                          <th scope="row"><?php echo $index+1?></th>
		                          <td><?php echo $v->name?></td>
	                            <td><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/uploads/<?php echo $v->labour_id.'_'.$v->name?>"><?php echo $v->name?><a/></td>
	                            <!-- <td><?php //echo $v->code?></td> -->
	                            <td><a href="javascript:void()" class="deleteFile" rel="<?php echo $v->id?>">Delete<a/></td>
	                            </tr>
	                      	<?php endforeach;?>
	                      </tbody>
	                    </table>
                      </div>


                    </div>
                    <!-- End SmartWizard Content -->





                  </div>
                </div>
              </div>
            </div>
          </div>



<div id="workingBoxHtml" class="hide">
<!-- <div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Source Of Income
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="source_of_income[]" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div> -->
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name 
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="company_name[]" required="required" class="comp form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="from_date[]" required="required" class="date_from date form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Till-date
    </label>
    <div class="col-md-6">
        Yes<input type="radio" name="till_date[]" value="1" class="till_date col-md-3" style="    float: none;">
        No<input type="radio" name="till_date[]" value="0" class="till_date col-md-3" style="    float: none;">
    </div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To Date
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="to_date[]" required="required" class="date_too date form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Position
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="position[]" required="required" class="position form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Salary
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="salary[]" required="required" class="salary form-control col-md-7 col-xs-12">
</div>
</div>
</div>

<div class="hide" id="educationBoxHtml">

	<div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Examination Passed
    	</label>
    	<div class="col-md-6 col-sm-6 col-xs-12">
      <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
      	<select class="form-control col-md-7 col-xs-12" name="education_type_id[]">
      		<!-- <option value="">Education Type</option> -->
      	
      		<option value="1">Primary</option>
      		<option value="2">Middle</option>
      		<option value="3">Matric</option>
      		<option value="7">Diploma</option>
      		<option value="4">Intermediate</option>
      		<option value="5">Graduation</option>
      		<option value="6">Masters</option>
      	</select>
    	</div>
  </div>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Discipline
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="board[]" required="required" type="text">
    </div>
  </div>
  <!-- <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Education Board
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <select class="form-control col-md-7 col-xs-12" name="board[]">
      	<option>Education Board</option>
      	<option value="sindh board">Sindh Board</option>
      	<option value="punjab board">Punjab Board</option>
      	<option value="karachi board">Karachi Board</option>
      </select>
    </div>
  </div> -->
  <div class="form-group">
    	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Passing Year
    	</label>
    	<div class="col-md-6 col-sm-6 col-xs-12">
      <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
      	<select class="form-control col-md-7 col-xs-12" name="passing_year[]">
      		<option value="">Select passing year</option>
      		<?php for($i=1960;$i<=date('Y');$i++){?>
      			<option value="<?php echo $i?>"><?php echo $i?></option>	
      		<?php }?>
      	</select>
    	</div>
  	</div>
  
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">College / School Name
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="organization_name[]" required="required" type="text">
    </div>
  </div>
</div>