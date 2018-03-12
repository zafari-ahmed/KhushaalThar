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
            <div class="x_panel contentBg">
                <div class="x_title">
                    <h2>Applicant Registration Form</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">


                    <!-- Smart Wizard -->
                    <!-- <p>This is a basic form wizard example that inherits the colors from the selected scheme.</p> -->
                    <div id="wizard" class="form_wizard wizard_horizontal">
                        <ul class="wizard_steps">
                            <?php if (Yii::app()->controller->action->id == 'edit') { ?>
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
                            <?php } if (Yii::app()->controller->action->id == 'add') { ?>
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
                                            <small>Documents</small>
                                        </span>
                                    </a>
                                </li>
                            <?php } ?>
                        </ul>
                        <div id="step-1">
                            <form class="form-horizontal form-label-left" id="labourRegistrationForm" >
                                <input type="hidden" name="labor_id" class="labor_id">
                                <h5 class="formH5">PERSONAL INFORMATION RECORD  ذاتي معلومات جو ريڪارڊ</h5>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Form ID</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" readonly value="<?php echo ($labor) ? ($labor[0]->id) + 1 : '1' ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">NICOP
                                    </label>
                                    <div class="col-md-6">
                                        Yes<input type="radio" name="nicop" class="col-md-3" value="1" style="    float: none;" >
                                        No<input type="radio" name="nicop" class="col-md-3" value="0" style="    float: none;"  checked>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">CNIC <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="cnic" name="cnic" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Full Name <span class="required">*</span> 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <!-- <input type="text" name="full_name" id="full_name" required="required" class="form-control col-md-7 col-xs-12"> -->
                                        <div class="col-md-4">
                                            <input type="text" name="first_name" id="full_name" placeholder="First Name" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="middle_name" id="full_name" placeholder="Middle Name" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="last_name" id="full_name" placeholder="Last Name" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>

                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Father Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="father_name" name="father_name" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Date Of Birth <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dob" id="dob" required="required" class="date form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <!-- <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Religion <span class="required">*</span>
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" id="religion" name="religion" required="required" class="form-control col-md-7 col-xs-12">
                                  </div>
                                </div> -->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Religion <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <!-- <input type="text" id="religion" name="religion" required="required" class="form-control col-md-7 col-xs-12"> -->
                                        <select id="religion" name="religion" required="required" class="form-control">
                                            <option value=''>Select Religion</option>
                                            <option value='Muslim'>Muslim</option>
                                            <option value="Christian">Christian</option>
                                            <option value="Hindu">Hindu</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <button type="button" class="btn btn-success btn-xs pull-right" id="addnewmobile">Add New</button>
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Mobile Number <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="mobile_number" name="mobile_number[]" required="required" class="form-control col-md-7 col-xs-12 mobile_number">
                                    </div>
                                </div>
                                <div id="mobileBox"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Gender
                                    </label>
                                    <div class="col-md-6">
                                        Male<input type="radio" name="gender" class="col-md-3" value="male" style="    float: none;">
                                        Female<input type="radio" name="gender" class="col-md-3" value="female" style="    float: none;">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Marital Status
                                    </label>
                                    <div class="col-md-6">
                                        Single<input type="radio" name="martial_status" class="col-md-3" value="0" style="    float: none;">
                                        Married<input type="radio" name="martial_status" class="col-md-3" value="1" style="    float: none;">
                                    </div>
                                </div>
                                <div class="form-group" id="kidsBox">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Kids
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="last-name" name="kids" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Category <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                                        <select id="category_id" class="form-control col-md-7 col-xs-12" name="category_id">
                                            <option value=''>Select Category</option>
                                            <option value="1">Skilled</option>
                                            <option value="2">Unskilled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Applied For <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="designation" name="designation" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Block 2 <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        Yes<input type="radio" name="block_2" value="1" class="col-md-3" style="    float: none;">
                                        No<input type="radio" name="block_2" value="0" class="col-md-3" style="    float: none;" checked>
                                    </div>
                                </div>
                                <?php
                                $blk = array(40,112,13,21,3779,3,23,20,3780,1984,3781,3782,3783);
                                $blk = implode(',', $blk);
                                $co = Villages::model()->findAll("id IN ($blk)");  ?>
                                <div id="normalVillage" class="hide">
                                    <option value="">Please Select Village</option>
                                    <?php foreach ($villages as $t): ?>
                                        <option value="<?php echo $t->id ?>"><?php echo $t->village ?></option>
                                    <?php endforeach; ?>
                                </div>

                                <div id="blockVillage" class="hide">
                                    <option value="">Please Select Village</option>
                                    <?php foreach ($co as $t): ?>
                                        <option value="<?php echo $t->id ?>"><?php echo $t->village ?></option>
                                    <?php endforeach; ?>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Village <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                                        <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="village_id" id="village_id">
                                            <option value="">Please Select Village</option>
                                            <?php foreach ($villages as $t): ?>
                                                <option value="<?php echo $t->id ?>"><?php echo $t->village ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Address 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="address" name="address" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Tehsil <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                                        <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="tehsil_id" id="tehsil_id">
                                            <option value="">Please Select Tehsil</option>
                                            <?php foreach ($tehsils as $t): ?>
                                                <option value="<?php echo $t->id ?>"><?php echo $t->name ?></option>
                                            <?php endforeach; ?>
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
                                            <?php foreach ($districts as $t): ?>
                                                <option value="<?php echo $t->id ?>"><?php echo $t->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Can you drive?
                                    </label>
                                    <div class="col-md-6">
                                        Yes<input type="radio" name="drive" value="1" class="col-md-3" style="    float: none;">
                                        No<input type="radio" name="drive" value="0" class="col-md-3" style="    float: none;">
                                    </div>
                                </div>

                                <div class="hide" id="driveBox">
                                    <hr/>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Driving License
                                        </label>
                                        <div class="col-md-6">
                                            Yes<input type="radio" name="driving_license" value="1" class="col-md-3" style="    float: none;">
                                            No<input type="radio" name="driving_license" value="0" class="col-md-3" style="    float: none;">
                                        </div>
                                    </div>
                                    <div class="hide" id="licenseBox">
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Driving License Number
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="last-name" name="driving_license_number" required="required" class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Vehicle Type
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                              <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                                                <select class="form-control col-md-7 col-xs-12" name="vehicle_type">

                                                    <option value="">Please Select Vehicle Type</option>
                                                    <?php foreach ($vehicletypes as $t): ?>
                                                        <option value="<?php echo $t->name ?>"><?php echo $t->name ?></option>
                                                    <?php endforeach; ?>
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
                                                    <option value="ltv">LTV</option>
                                                    <option value="htv">HTV</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Issue Date
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="issue_date" name="issue_date" required="required" class="ddate form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Valid Upto
                                            </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="valid_upto" name="valid_upto" required="required" class="ddate form-control col-md-7 col-xs-12"><p class="hide" id="valid_upto_error" style="color: red;font-weight: bold;"></p>
                                            </div>
                                        </div>
                                        <!-- <div class="form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Valid Upto
                                          </label>
                                          <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="number" id="last-name" name="driving_license_expiry" required="required" class="form-control col-md-7 col-xs-12">
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
                                            <label>Picture</label><div id="results"></div>
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
                                                <label>Picture</label><div id="thumb_results"></div>
                                                <input type="hidden" id="thumbData" name="thumb" value=""/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <h5 class="formH5">EMPLOYMENT RECORD ملازمت جو ريڪارڊ</h5>
                                <hr/>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Currently Working
                                    </label>
                                    <div class="col-md-6">
                                        Yes<input type="radio" name="working" value="1" class="col-md-3" style="    float: none;">
                                        No<input type="radio" name="working" value="0" class="col-md-3" style="    float: none;" checked>
                                    </div>
                                </div>
                                <div class="hide" id="workingBox">
                                    <button type="button" class="btn btn-success btn-xs pull-right" id="addnewwork">Add New</button>
                                    <!-- <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Source Of Income
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="hidden" id="first-name" name="source_of_income[]" required="required" value="salary" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div> -->
                                    <input type="hidden" id="first-name" name="source_of_income[]" required="required" value="salary" class="form-control col-md-7 col-xs-12">
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name 
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" name="company_name[]" required="required" class="form-control col-md-7 col-xs-12 comp">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" name="from_date[]" required="required" class="ddate form-control col-md-7 col-xs-12 date_from">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Till-date
                                        </label>
                                        <div class="col-md-6">
                                            Yes<input type="radio" name="till_date[]" value="1" class="till_date col-md-3" style="    float: none;">
                                            No<input type="radio" name="till_date[]" value="0" class="till_date col-md-3" style="    float: none;" checked>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To Date
                                        </label>

                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" name="to_date[]" required="required" class="ddate form-control col-md-7 col-xs-12 date_too">
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
                                    <div id="newworkingBox"></div>
                                </div>
                                <div id="workingBoxNo">

                                    <div class="form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Current Source of Income
                                        </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="first-name" name="source_of_income" required="required" class="form-control col-md-7 col-xs-12">
                                        </div>
                                    </div>
                                </div>

                                <h5 class="formH5">EDUCATION RECORD ريڪارڊ تعليمي</h5>
                                <hr/>
                                <button type="button" class="btn btn-success btn-xs pull-right" id="addneweducation">Add New</button>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Examination Passed
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                                        <select class="form-control col-md-7 col-xs-12" name="education_type_id[]">
                                            <option value="">Select examination passed</option>
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Passing Year
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                  <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
                                        <select class="form-control col-md-7 col-xs-12" name="passing_year[]">
                                            <option value="">Passing Year</option>
                                            <?php for ($i = 1960; $i <= date('Y'); $i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>	
                                            <?php } ?>
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
                                <hr/>
                                <div id="neweducationBox"></div>
                                <!-- <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Remarks
                                  </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="remarks" class="form-control"></textarea>
                                  </div>
                                </div> -->
                            </form>

                        </div>
                        <!-- <div id="step-2">
                          <h2 class="StepTitle">HSE Medical & Police </h2>
                          <form class="form-horizontal form-label-left" id="verifications" >
                                  <input type="hidden" name="labor_id" class="labor_id">
                                  <div class="form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">HSE Clearance
                                          </label>
                                          <div class="col-md-6">
                                           Yes<input type="radio" name="hse" value="1" class="col-md-3" style="    float: none;">
                                           No<input type="radio" name="hse" value="0" class="col-md-3" style="    float: none;">
                                          </div>
                                  </div>
                                  <div class="form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Medical Clearance
                                          </label>
                                          <div class="col-md-6">
                                           Yes<input type="radio" name="medical" value="1" class="col-md-3" style="    float: none;">
                                           No<input type="radio" name="medical" value="0" class="col-md-3" style="    float: none;">
                                          </div>
                                  </div>
                                  <div class="form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Police Clearance
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
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Training Session
                                          </label>
                                          <div class="col-md-6">
                                           Yes<input type="radio" name="training" value="1" class="col-md-3" style="    float: none;">
                                           No<input type="radio" name="training" value="0" class="col-md-3" style="    float: none;">
                                          </div>
                                  </div>
                                  <div class="form-group">
                                              <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Institute Name
                                              </label>
                                              <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text" id="institute" name="institute" required="required" class="form-control col-md-7 col-xs-12">
                                              </div>
                                            </div>
                                          <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Trade
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="trade" name="trade" required="required" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>
                                   <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Score
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="score" name="score" required="required" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>
                                   <div class="form-group">
                                          <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Result
                                          </label>
                                          <div class="col-md-6">
                                           Pass<input type="radio" name="result" value="pass" class="col-md-3" style="    float: none;">
                                           Fail<input type="radio" name="result" value="fail" class="col-md-3" style="    float: none;">
                                          </div>
                                  </div>
                                   <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Batch No.
                                      </label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="batch_number" name="batch_number" required="required" class="form-control col-md-7 col-xs-12">
                                      </div>
                                    </div>
                                </form>
                        </div> -->
                        <div id="step-2">
                            <h2 class="StepTitle">Document for scan</h2>
                            <form action="<?php echo Yii::app()->baseUrl ?>/labor/uploaddocuments" class="dropzone" id="verification">
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
    
    <input type="hidden" id="first-name" name="source_of_income[]" required="required" value="salary" class="form-control col-md-7 col-xs-12">
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Name 
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="first-name" name="company_name[]" required="required" class="form-control col-md-7 col-xs-12 comp">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">From Date
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="first-name" name="from_date[]" required="required" class="date form-control col-md-7 col-xs-12 date_from">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Till-date
        </label>
        <div class="col-md-6">
            Yes<input type="radio" name="till_date[]" value="1" class="col-md-3" style="    float: none;">
            No<input type="radio" name="till_date[]" value="0" class="col-md-3" style="    float: none;">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">To Date
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="first-name" name="to_date[]" required="required" class="date form-control col-md-7 col-xs-12 date_too">
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
                <option value="">Select examination passed</option>

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
        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Passing Year
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
      <!-- <input type="text" id="first-name" required="required" class="form-control col-md-7 col-xs-12"> -->
            <select class="form-control col-md-7 col-xs-12" name="passing_year[]">
                <option value="">Passing year</option>
                <?php for ($i = 1960; $i <= date('Y'); $i++) { ?>
                    <option value="<?php echo $i ?>"><?php echo $i ?></option>	
                <?php } ?>
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