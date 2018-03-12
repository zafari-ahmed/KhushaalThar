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
	                              <small>HSE Medical & Police</small>
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
                                              <small>Verification</small>
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
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Full Name <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" name="full_name" id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->full_name?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Father Name <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="last-name" name="father_name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->father_name?>">
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
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date Of Birth<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" name="dob" id="dob" required="required" class="date form-control col-md-7 col-xs-12" value="<?php echo @$labor->dob?>">
	                            </div>
	                          </div>
	                          <!-- <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Religion<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="last-name" name="religion" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->religion?>">
	                            </div>
	                          </div> -->

	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Religion <span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="religion" name="religion" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <select name="religion" required="required" class="form-control">
	                              	<option>Select Religion</option>
	                              	<option value='Islam' <?php echo (@$labor->religion=='Islam')?'selected':''?>>Islam</option>
	                              	<option value="Christian" <?php echo (@$labor->religion=='Christian')?'selected':''?>>Christian</option>
	                              	<option value="Hindu" <?php echo (@$labor->religion=='Hindu')?'selected':''?>>Hindu</option>
	                              </select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mobile Number<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="mobile_number" name="mobile_number" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->mobile_number?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Martial Status<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6">
	                              Single<input type="radio" name="martial_status" class="col-md-3" value="0" style="    float: none;" <?php echo (@$labor->martial_status==0)?'checked':''?>>
	                              Married<input type="radio" name="martial_status" class="col-md-3" value="1" style="    float: none;" <?php echo (@$labor->martial_status==1)?'checked':''?>>
	                            </div>
	                          </div>
	                          <div class="form-group <?php echo (@$labor->martial_status==0)?'hide':''?>" id="kidsBox">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Kids<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="last-name" name="kids" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->kids?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <select class="form-control col-md-7 col-xs-12" name="category_id"><option value="1" <?php echo (@$labor->category_id==1)?'selected':''?>>Skilled</option><option value="2" <?php echo (@$labor->category_id==2)?'selected':''?>>Unskilled</option></select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Applied For<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="last-name" name="designation" class="form-control col-md-7 col-xs-12" value="<?php echo @$labor->designation?>">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block 2<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="block_2" value="1" class="col-md-3" style="    float: none;" <?php echo (@$labor->block_2==1)?'checked':''?>>
	                              No<input type="radio" name="block_2" value="0" class="col-md-3" style="    float: none;" <?php echo (@$labor->block_2==0)?'checked':''?>>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Village<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="village_id">
		                            <option value="">Please Select Village</option>
		                            <?php foreach($villages as $t):?>
		                            	<option value="<?php echo $t->id?>" <?php echo (@$labor->village_id==$t->id)?'selected':''?>><?php echo $t->village?></option>
		                            <?php endforeach;?>
		                          </select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tehsil<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                             <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="tehsil_id">
		                            <option value="">Please Select Tehsil</option>
		                            <?php foreach($tehsils as $t):?>
		                            	<option value="<?php echo $t->id?>" <?php echo (@$labor->tehsil_id==$t->id)?'selected':''?>><?php echo $t->name?></option>
		                            <?php endforeach;?>
		                          </select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">District<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <!-- <select class="form-control col-md-7 col-xs-12"><option>District</option></select> -->
	                              <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="district_id">
		                            <option value="">Please Select Districts</option>
		                            <?php foreach($districts as $t):?>
		                            	<option value="<?php echo $t->id?>" <?php echo (@$labor->district_id==$t->id)?'selected':''?>><?php echo $t->name?></option>
		                            <?php endforeach;?>
		                          </select>
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Can you drive?<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="drive" value="1" class="col-md-3" style="    float: none;" <?php echo (@$labor->drive==1)?'checked':''?>>
	                              No<input type="radio" name="drive" value="0" class="col-md-3" style="    float: none;" <?php echo (@$labor->drive==0)?'checked':''?>>
	                            </div>
	                          </div>

	                          <div class="hide" id="driveBox">
		                          <hr/>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Driving License<span class="required">*</span>
		                            </label>
		                            <div class="col-md-6">
		                              Yes<input type="radio" name="driving_license" value="1" class="col-md-3" style="    float: none;" <?php echo (@$labor->driving_license==1)?'checked':''?>>
		                              No<input type="radio" name="driving_license" value="0" class="col-md-3" style="    float: none;" <?php echo (@$labor->driving_license==0)?'checked':''?>>
		                            </div>
		                          </div>
		                          <div class="hide" id="licenseBox">
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Driving License Number<span class="required">*</span>
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <input type="text" id="last-name" name="driving_license_number" required="required" class="form-control col-md-7 col-xs-12">
			                            </div>
			                          </div>
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle Type<span class="required">*</span>
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
			                              <select class="form-control col-md-7 col-xs-12" name="vehicle_type">
			                              	<option value="">Vehicle Type</option>
			                              	<option value="bus">Bus</option>
			                              	<option value="suv">SUV</option>
			                              	<option value="truck">Truck</option>
			                              	<option value="dumper">Dumper</option>
			                              	<option value="other">Other</option>
			                              </select>
			                            </div>
			                          </div>
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">License Category<span class="required">*</span>
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
			                              <select class="form-control col-md-7 col-xs-12" name="license_category">
			                              	<option value="">License Category</option>
			                              	<option value="ltv">LTV</option>
			                              	<option value="htv">HTV</option>
			                              </select>
			                            </div>
			                          </div>
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Issue Date<span class="required">*</span>
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <input type="text" id="issue_date" name="issue_date" required="required" class="ddate form-control col-md-7 col-xs-12">
			                            </div>
			                          </div>
			                          <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Valid Upto<span class="required">*</span>
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <input type="text" id="valid_upto" name="valid_upto" required="required" class="ddate form-control col-md-7 col-xs-12">
			                            </div>
			                          </div>
			                          <!-- <div class="form-group">
			                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Valid Upto<span class="required">*</span>
			                            </label>
			                            <div class="col-md-6 col-sm-6 col-xs-12">
			                              <input type="number" id="last-name" name="driving_license_expiry" required="required" class="form-control col-md-7 col-xs-12">
			                            </div>
			                          </div> -->
			                      </div>
		                      </div>
		                      <!-- <div class="col-md-12">
						        <div class="col-md-6">
						          <p>
						          <label>Picture</label>
						            <div id="my_camera"></div>
						            <input type='button' value="Take Snapshot" id="take_snapshot">
						          </p>
						        </div>
						        <div class="col-md-6">
						          <div id="results"><label>Picture</label></div>
						        </div>
						      </div> -->
		                      <hr/>
	                          <h5 class="formH5">EMPLOYMENT RECORD ملازمت جو ريڪارڊ</h5>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Currently Working<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="working" value="1" class="col-md-3" style="    float: none;">
	                              No<input type="radio" name="working" value="0" class="col-md-3" style="    float: none;">
	                            </div>
	                          </div>
	                          <div class="hide" id="workingBox">
	                          	<button type="button" class="btn btn-success btn-xs pull-right" id="addnewwork">Add New</button>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Source Of Income<span class="required">*</span>
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input type="text" id="first-name" name="source_of_income[]" required="required" class="form-control col-md-7 col-xs-12">
		                            </div>
		                          </div>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name <span class="required">*</span>
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input type="text" id="first-name" name="company_name[]" required="required" class="form-control col-md-7 col-xs-12">
		                            </div>
		                          </div>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date<span class="required">*</span>
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input type="text" id="first-name" name="from_date[]" required="required" class="date form-control col-md-7 col-xs-12">
		                            </div>
		                          </div>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To Date<span class="required">*</span>
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input type="text" id="first-name" name="to_date[]" required="required" class="date form-control col-md-7 col-xs-12">
		                            </div>
		                          </div>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Position<span class="required">*</span>
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input type="text" id="first-name" name="position[]" required="required" class="form-control col-md-7 col-xs-12">
		                            </div>
		                          </div>
		                          <div class="form-group">
		                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Salary<span class="required">*</span>
		                            </label>
		                            <div class="col-md-6 col-sm-6 col-xs-12">
		                              <input type="text" id="first-name" name="salary[]" required="required" class="form-control col-md-7 col-xs-12">
		                            </div>
		                          </div>
		                          <div id="newworkingBox"></div>
		                      </div>
	                          <hr/>
	                          <h5 class="formH5">EDUCATION RECORD ريڪارڊ تعليمي</h5>
	                          <button type="button" class="btn btn-success btn-xs pull-right" id="addneweducation">Add New</button>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Degree<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
	                              <select class="form-control col-md-7 col-xs-12" name="education_type_id[]">
	                              	<option value="">Education Type</option>
	                              	<option value="1">Primary</option>
	                              	<option value="2">Middle</option>
	                              	<option value="3">Matric</option>
	                              	<option value="4">Intermediate</option>
	                              	<option value="5">Graduation</option>
	                              	<option value="6">Masters</option>
	                              </select>
	                            </div>
	                          </div>
	                          <!-- <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Education Board<span class="required">*</span>
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
	                            <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Passing Year</label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input id="middle-name" class="form-control col-md-7 col-xs-12" type="number" name="passing_year[]">
	                            </div>
	                          </div>
	                          
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12">College / School Name<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="organization_name[]" required="required" type="text">
	                            </div>
	                          </div>
	                          <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Certificate<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6">
	                              Yes<input type="radio" name="degree[0]" value="1" class="col-md-3" style="    float: none;">
	                              No<input type="radio" name="degree[0]" value="0" class="col-md-3" style="    float: none;">
	                            </div>
	                          </div>
	                          <div id="neweducationBox"></div>

                        </form>

                      </div>
                      <div id="step-2">
                        <h2 class="StepTitle">HSE Medical & Police </h2>
                        <form class="form-horizontal form-label-left" id="verifications" >
                        	<input type="hidden" name="labor_id" class="labor_id">
	                        <div class="form-group">
	                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">HSE Clearance<span class="required">*</span>
	                        	</label>
	                        	<div class="col-md-6">
	                         	 Yes<input type="radio" name="hse" value="1" class="col-md-3" style="    float: none;">
	                         	 No<input type="radio" name="hse" value="0" class="col-md-3" style="    float: none;">
	                        	</div>
	                      	</div>
	                      	<div class="form-group">
	                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Medical Clearance<span class="required">*</span>
	                        	</label>
	                        	<div class="col-md-6">
	                         	 Yes<input type="radio" name="medical" value="1" class="col-md-3" style="    float: none;">
	                         	 No<input type="radio" name="medical" value="0" class="col-md-3" style="    float: none;">
	                        	</div>
	                      	</div>
	                      	<div class="form-group">
	                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Police Clearance<span class="required">*</span>
	                        	</label>
	                        	<div class="col-md-6">
	                         	 Yes<input type="radio" name="police" value="1" class="col-md-3" style="    float: none;">
	                         	 No<input type="radio" name="police" value="0" class="col-md-3" style="    float: none;">
	                        	</div>
	                      	</div>
	                      </form>
                      </div>
                      <div id="step-3">
                        <h2 class="StepTitle">Training</h2>
                        <form class="form-horizontal form-label-left" id="traning" >
                        	<input type="hidden" name="labor_id" class="labor_id">
	                        <div class="form-group">
	                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Training Session<span class="required">*</span>
	                        	</label>
	                        	<div class="col-md-6">
	                         	 Yes<input type="radio" name="training" value="1" class="col-md-3" style="    float: none;">
	                         	 No<input type="radio" name="training" value="0" class="col-md-3" style="    float: none;">
	                        	</div>
	                      	</div>
	                      	<div class="form-group">
			                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Institute Name<span class="required">*</span>
			                    </label>
			                    <div class="col-md-6 col-sm-6 col-xs-12">
			                      <input type="text" id="mobile_number" name="mobile_number" required="required" class="form-control col-md-7 col-xs-12">
			                    </div>
			                  </div>
			                <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Trade<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="mobile_number" name="mobile_number" required="required" class="form-control col-md-7 col-xs-12">
	                            </div>
	                          </div>
	                         <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Score<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="mobile_number" name="mobile_number" required="required" class="form-control col-md-7 col-xs-12">
	                            </div>
	                          </div>
	                         <div class="form-group">
	                        	<label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Result<span class="required">*</span>
	                        	</label>
	                        	<div class="col-md-6">
	                         	 Pass<input type="radio" name="training" value="1" class="col-md-3" style="    float: none;">
	                         	 Fail<input type="radio" name="training" value="0" class="col-md-3" style="    float: none;">
	                        	</div>
	                      	</div>
	                         <div class="form-group">
	                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Batch No.<span class="required">*</span>
	                            </label>
	                            <div class="col-md-6 col-sm-6 col-xs-12">
	                              <input type="text" id="mobile_number" name="mobile_number" required="required" class="form-control col-md-7 col-xs-12">
	                            </div>
	                          </div>
	                      </form>
                      </div>
                      <div id="step-4">
                        <h2 class="StepTitle">Document for scan</h2>
                        <form action="<?php echo Yii::app()->baseUrl?>/labor/uploaddocuments" class="dropzone" id="verification">
	                        <input type="hidden" name="labor_id" class="labor_id">
	                    </form>
                      </div>


                    </div>
                    <!-- End SmartWizard Content -->





                  </div>
                </div>
              </div>
            </div>
          </div>



<div id="workingBoxHtml" class="hide">
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Source Of Income<span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="source_of_income[]" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name <span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="company_name[]" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date<span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="from_date[]" required="required" class="date form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To Date<span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="to_date[]" required="required" class="date form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Position<span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="position[]" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div>
<div class="form-group">
<label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Salary<span class="required">*</span>
</label>
<div class="col-md-6 col-sm-6 col-xs-12">
  <input type="text" id="first-name" name="salary[]" required="required" class="form-control col-md-7 col-xs-12">
</div>
</div>
</div>

<div class="hide" id="educationBoxHtml">

	<div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Degree<span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
      <select class="form-control col-md-7 col-xs-12" name="education_type_id[]">
      	<option value="">Education Type</option>
      	<option value="1">Primary</option>
      	<option value="2">Middle</option>
      	<option value="3">Matric</option>
      	<option value="4">Intermediate</option>
      	<option value="5">Graduation</option>
      	<option value="6">Masters</option>
      </select>
    </div>
  </div>
  <!-- <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Education Board<span class="required">*</span>
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
    <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Passing Year</label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="middle-name" class="form-control col-md-7 col-xs-12" type="number" name="passing_year[]">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">College / School Name<span class="required">*</span>
    </label>
    <div class="col-md-6 col-sm-6 col-xs-12">
      <input id="birthday" class="date-picker form-control col-md-7 col-xs-12" name="organization_name[]" required="required" type="text">
    </div>
  </div>
</div>