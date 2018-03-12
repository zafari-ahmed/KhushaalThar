<h5 class="formHeading center">PERSONAL INFORMATION RECORD Ø°Ø§ØªÙŠ Ù…Ø¹Ù„ÙˆÙ…Ø§Øª Ø¬Ùˆ Ø±ÙŠÚªØ§Ø±ÚŠ</h5>
<div class="someAttr">
    <div class="col-xs-10">        
        <div class="row">
            <div class="attrSpan">
                <div class="col-xs-6">
                    <div class="row">
                        <label>Full Name <span>Ù¾ÙˆØ±Ùˆ Ù†Ø§Ù„Ùˆ</span></label>
                        <p><?php echo @$model->full_name ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Father's Name <span>Ù¾ÙŠØ¡ Ø¬Ùˆ Ù†Ø§Ù„Ùˆ</span></label>
                        <p> <?php echo @$model->father_name ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label><?php echo (@$model->nicop == 1) ? 'NICOP' : 'CNIC' ?> Number<span>Ø³ÚƒØ§Ú»Ù¾ ÚªØ§Ø±ÚŠ Ù†Ù…Ø¨Ø±</span></label>
                        <p><?php echo @$model->cnic ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Religion <span>Ù…Ø°Ù‡Ø¨</span></label>
                        <p> <?php echo @$model->religion ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Date of Birth<span> Ú„Ù… Ø¬ÙŠ ØªØ§Ø±ÙŠØ®</span></label>
                        <p><?php echo @$model->dob ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Mobile Number <span> Ù…ÙˆØ¨Ø§Ø¦ÙŠÙ„ Ù†Ù…Ø¨Ø±</span></label>
                        <p><?php echo @$model->mobile_number ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Gender <span>جنس</span></label>
                        <p> <?php echo @$model->gender ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Block 2 <span>???? </span></label>
                        <p>yes</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (!empty($model->avatar)) { ?>
    <div class="profilePic"><img src="<?php echo Yii::app()->baseUrl ?>/uploads/<?php echo @$model->avatar ?>"></div>
<?php } ?>
<div class="someAttr">
    <div class="col-xs-12">        
        <div class="row">
            <div class="attrSpan">
                <div class="col-xs-4">
                    <div class="row">
                        <label>Marital Status <span>Ø§Ø²Ø¯ÙˆØ§Ø¬ÙŠ Ø­ÙŠØ«ÙŠØª</span></label>
                        <p> <?php echo (@$model->martial_status == 1) ? 'Married Ø´Ø§Ø¯ÙŠ Ø´Ø¯Ù‡' : 'Un-Married ØºÙŠØ± Ø´Ø§Ø¯ÙŠ Ø´Ø¯Ù‡' ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Number of Kids <span>Ù»Ø§Ø±Ù† Ø¬Ùˆ ØªØ¹Ø¯Ø§Ø¯</span></label>
                        <p><?php echo @$model->kids ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Village <span>Ú³ÙˆÙº Ø¬Ùˆ Ù†Ø§Ù„Ùˆ</span></label>
                        <p><?php echo @$model->village->village ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Tehsil <span>ØªØ¹Ù„Ù‚Ùˆ/</span></label>
                        <p><?php echo @$model->tehsil->name ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>District <span>Ø¶Ù„Ø¹Ùˆ</span></label>
                        <p><?php echo @$model->district->name ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Category<span>???? ????</span></label>
                        <p><?php echo (@$model->category_id == 1) ? 'Skilled' : 'Un-Skilled' ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="someAttr">
    <div class="col-xs-12">        
        <div class="row">
            <div class="attrSpan">
                <div class="col-xs-4">
                    <div class="row">
                        <label>Do you know how to Drive? <span>Ú‡Ø§ ØªÙˆÙ‡Ø§Ù† Ú©ÙŠ ÚŠØ±Ø§Ø¦ÙŠÙˆÙ†Ú¯ Ø¬ÙŠ Ú„Ø§Ú» Ø¢Ù‡ÙŠØŸ</span></label>
                        <p><?php echo (@$model->drive == 1) ? 'Yes Ù‡Ø§' : 'No Ù†Ù‡' ?></p>
                    </div>
                </div>
                <?php
                if ($model->drivingLicense) {
                    $type = @$model->drivingLicense[0]->vehicle_type;
                    $license = @$model->drivingLicense[0]->driving_license;
                    $licenseNumber = @$model->drivingLicense[0]->driving_license_number;
                    $issue = @$model->drivingLicense[0]->issue_date;
                    $valid = @$model->drivingLicense[0]->valid_upto;
                    $licenseC = @$model->drivingLicense[0]->license_category;
                    $expiry = @$model->drivingLicense[0]->driving_license_expiry;
                } else {
                    $type = '';
                    $license = '';
                    $licenseNumber = '';
                    $issue = '';
                    $valid = '';
                    $licenseC = '';
                    $expiry = '';
                }
                ?>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Type of Vehicle Driven? <span>ÚªÙ‡Ú™ÙŠ Ú¯Ø§Ú?ÙŠ Ù‡Ù„Ø§Ø¦ÙŠÙ†Ø¯Ø§ Ø±Ù‡ÙŠØ§ Ø¢Ù‡ÙŠÙˆØŸ</span></label>
                        <p> <?php echo ucfirst(@$type) ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Driving License <span>ÚŠØ±Ø§Ø¦ÙŠÙˆÙ†Ú¯ Ù„Ø§Ø¦Ø³Ù†Ø³</span></label>
                        <p><?php echo (@$license == 1) ? 'Yes Ù‡Ø§ ' : 'No Ù†Ù‡' ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>License # <span>?????? ?? ????</span></label>
                        <p> <?php echo @$licenseNumber ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Issue Date <span>Ø¬Ø§Ø±ÙŠ Ù¿ÙŠÚ» Ø¬ÙŠ ØªØ§Ø±ÙŠØ®</span></label>
                        <p><?php echo @$issue ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Valid Upto <span>ÚªØ§Ø±Ø¢Ù…Ø¯ ØªØ§Ø±ÙŠØ®</span></label>
                        <p><?php echo @$valid ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>License Category <span>Ù„Ø§Ø¦Ø³Ù†Ø³ Ø¬Ùˆ Ù‚Ø³Ù…</span></label>
                        <p><?php echo (@$licenseC == 'ltv') ? 'LTV Ø§ÙŠÙ„ Ù½ÙŠ ÙˆÙŠ' : 'HTV Ø§ÙŠÚ‡ Ù½ÙŠ ÙˆÙŠ ' ?></p>
                    </div>
                </div>
                <?php
                if ($model->employments) {
                    $working = @$model->employments[0]->working;
                    $income = @$model->employments[0]->source_of_income;
                    $working = @$model->employments[0]->working;
                } else {
                    $working = '';
                    $income = '';
                }
                ?>
            </div>
        </div>
    </div>
</div>
<table class="table table-bordered">
   <!--  <tr>
        <td colspan="5" class="center"><b>PERSONAL INFORMATION RECORD Ø°Ø§ØªÙŠ Ù…Ø¹Ù„ÙˆÙ…Ø§Øª Ø¬Ùˆ Ø±ÙŠÚªØ§Ø±ÚŠ</b></td>
    </tr>
   <tr>
        <td width="30%">Full Name Ù¾ÙˆØ±Ùˆ Ù†Ø§Ù„Ùˆ</td>
        <td><?php echo @$model->full_name ?></td>
        <td width="30%">Father's Name Ù¾ÙŠØ¡ Ø¬Ùˆ Ù†Ø§Ù„Ùˆ</td>
        <td colSpan="3"> <?php echo @$model->father_name ?></td>
    </tr>
    <tr>
        <td><?php echo (@$model->nicop == 1) ? 'NICOP' : 'CNIC' ?> Number Ø³ÚƒØ§Ú»Ù¾ ÚªØ§Ø±ÚŠ Ù†Ù…Ø¨Ø±</td>
        <td><?php echo @$model->cnic ?></td>
        <td>Religion Ù…Ø°Ù‡Ø¨</td>
        <td colSpan="3"> <?php echo @$model->religion ?></td>
    </tr>
    <tr>
        <td>Date of Birth Ú„Ù… Ø¬ÙŠ ØªØ§Ø±ÙŠØ®</td>
        <td><?php echo @$model->dob ?></td></td>
        <td>Mobile Number Ù…ÙˆØ¨Ø§Ø¦ÙŠÙ„ Ù†Ù…Ø¨Ø±</td>
        <td colSpan="3"><?php echo @$model->mobile_number ?></td>
    </tr>
    <tr>
        <td>Applied For Ú³ÙˆÙº Ø¬Ùˆ Ù†Ø§Ù„Ùˆ</td>
        <td><?php echo @$model->designation ?></td>
        <td>Block 2 ØªØ¹Ù„Ù‚Ùˆ/ </td>
        <td colSpan="3"><?php echo (@$model->block_2 == 1) ? 'Yes Ù‡Ø§' : 'No Ù†Ù‡' ?></td>

    </tr> 
    <tr>
        <td>Marital Status Ø§Ø²Ø¯ÙˆØ§Ø¬ÙŠ Ø­ÙŠØ«ÙŠØª</td>
        <td>
    <?php echo (@$model->martial_status == 1) ? 'Married Ø´Ø§Ø¯ÙŠ Ø´Ø¯Ù‡' : 'Un-Married ØºÙŠØ± Ø´Ø§Ø¯ÙŠ Ø´Ø¯Ù‡' ?>
        </td>
        <td>Number of Kids Ù»Ø§Ø±Ù† Ø¬Ùˆ ØªØ¹Ø¯Ø§Ø¯</td>
        <td colSpan="3" > <?php echo @$model->kids ?></td>
    </tr>
    <tr>
        <td>Village Ú³ÙˆÙº Ø¬Ùˆ Ù†Ø§Ù„Ùˆ</td>
        <td ><?php echo @$model->village->village ?></td>
        <td>Tehsil ØªØ¹Ù„Ù‚Ùˆ/ </td>
        <td colSpan="3" > <?php echo @$model->tehsil->name ?></td>
    </tr>
    <tr>
        <td>District Ø¶Ù„Ø¹Ùˆ</td>
        <td ><?php echo @$model->district->name ?></td>
        <td>Category</td>
        <td colSpan="3"> 
    
    </td>
 </tr>-->
    <?php
    if ($model->drivingLicense) {
        $type = @$model->drivingLicense[0]->vehicle_type;
        $license = @$model->drivingLicense[0]->driving_license;
        $licenseNumber = @$model->drivingLicense[0]->driving_license_number;
        $issue = @$model->drivingLicense[0]->issue_date;
        $valid = @$model->drivingLicense[0]->valid_upto;
        $licenseC = @$model->drivingLicense[0]->license_category;
        $expiry = @$model->drivingLicense[0]->driving_license_expiry;
    } else {
        $type = '';
        $license = '';
        $licenseNumber = '';
        $issue = '';
        $valid = '';
        $licenseC = '';
        $expiry = '';
    }
    ?>
    <!--<tr>
        <td colSpan="2">Type of Vehicle Driven? ÚªÙ‡Ú™ÙŠ Ú¯Ø§Ú?ÙŠ Ù‡Ù„Ø§Ø¦ÙŠÙ†Ø¯Ø§ Ø±Ù‡ÙŠØ§ Ø¢Ù‡ÙŠÙˆØŸ</td>
        <td class="center" colSpan="3"> 
    <?php echo ucfirst(@$type) ?>
           
        </td>
    </tr>
    <tr>
        <td colSpan="2">Driving License ÚŠØ±Ø§Ø¦ÙŠÙˆÙ†Ú¯ Ù„Ø§Ø¦Ø³Ù†Ø³</td>
        <td colSpan="3" class="center" colSpan="2">
    <?php echo (@$license == 1) ? 'Yes Ù‡Ø§ ' : 'No Ù†Ù‡' ?>
           
        </td>

    </tr>
    <tr>
        <td colSpan="2">If Yes, License # Ø¬ÙŠÚªÚ?Ù‡Ù† Ù‡Ø§ ØªÙ‡ Ù„Ø§Ø¦Ø³Ù†Ø³ Ø¬Ùˆ Ù†Ù…Ø¨Ø±</td>
        <td class="center" colSpan="3"> <?php echo @$licenseNumber ?></td>
    </tr>
    <tr>
        <td colSpan="2">Issue Date Ø¬Ø§Ø±ÙŠ Ù¿ÙŠÚ» Ø¬ÙŠ ØªØ§Ø±ÙŠØ®</td>
        <td class="center" colSpan="3"><?php echo @$issue ?></td>
    </tr>
    <tr>
        <td colSpan="2">Valid Upto ÚªØ§Ø±Ø¢Ù…Ø¯ ØªØ§Ø±ÙŠØ®</td>
        <td class="center" colSpan="3"> <?php echo @$valid ?></td>
    </tr>
    <tr>
        <td colSpan="2">License Category Ù„Ø§Ø¦Ø³Ù†Ø³ Ø¬Ùˆ Ù‚Ø³Ù…</td>
        <td colSpan="3" class="center" colSpan="2">
    <?php echo (@$licenseC == 'ltv') ? 'LTV Ø§ÙŠÙ„ Ù½ÙŠ ÙˆÙŠ' : 'HTV Ø§ÙŠÚ‡ Ù½ÙŠ ÙˆÙŠ ' ?>
           
        </td>
    </tr>
   
    <?php
    if ($model->employments) {
        $working = @$model->employments[0]->working;
        $income = @$model->employments[0]->source_of_income;
        $working = @$model->employments[0]->working;
    } else {
        $working = '';
        $income = '';
    }
    ?>-->
    <tr>
        <td colspan="5" class="center"><h5 class="formHeading">EMPLOYMENT RECORD  Ù…Ù„Ø§Ø²Ù…Øª Ø¬Ùˆ Ø±ÙŠÚªØ§Ø±ÚŠ</h5></td>
    </tr>
    <tr>
        <td colSpan="2">Are you currently working? Ú‡Ø§ ØªÙˆÙ‡Ø§Ù† Ù‡Ù† ÙˆÙ‚Øª ÚªØ§ Ù…Ù„Ø§Ø²Ù…Øª ÚªÙ†Ø¯Ø§ Ø¢Ù‡ÙŠÙˆØŸ</td>
        <td colSpan="3" class="center" colSpan="2"> 
            <!-- <label for="radio11">Yes Ù‡Ø§  </label>
            <input type="radio" id="radio11" name="radios5">
            <label for="radio12">No Ù†Ù‡  </label>
            <input type="radio" id="radio12" name="radios5">  -->
            <?php echo (@$working == 1) ? 'Yes Ù‡Ø§' : 'No Ù†Ù‡' ?>
        </td>
    </tr>
    <tr>
        <td colSpan="2">If No, what is your source of income / livelihood? Ø¬ÙŠÚªÚ?Ù‡Ù† Ù†Ù‡ ØªÙ‡ Ø¢Ù…Ø¯Ù†ÙŠ/ Ú¯Ø°Ø± Ø³Ù?Ø± ÙˆØ³ÙŠÙ„Ùˆ ÚªÙ‡Ú™Ùˆ Ø¢Ù‡ÙŠØŸ </td>
        <td colSpan="3" class="center" colSpan="2"><?php echo @$income ?></td>
    </tr>
   <!-- <tr>
        <td colSpan="2">If Yes, please share below Ø¬ÙŠÚªÚ?Ù‡Ù† Ù‡Ø§ ØªÙ‡ Ù‡ÙŠÙºÙŠÙ† ÙˆØ¶Ø§Ø­Øª ÚªØ±ÙŠÙˆ </td>
        <td colSpan="3" class="center"></td>
    </tr>-->
    <tr>
        <td >Company Name ÚªÙ…Ù¾Ù†ÙŠØ¡Ø¬ÙˆÙ†Ø§Ù„Ùˆ  </td>
        <td >From Ú©Ø§Ù†</td>
        <td>To ØªØ§Ø¦ÙŠÙ†</td>
        <td>Position Ø¹Ù‡Ø¯Ùˆ</td>
        <td>Gross Salary Ù…Ø¬Ù…ÙˆØ¹ÙŠ Ù¾Ú¯Ù‡Ø§Ø±</td>
    </tr>
    <?php
    if ($model->employments) {
        foreach ($model->employments as $em):if ($em->company_name != '') {
                ?>
                <tr>
                    <td ><?php echo @$em->company_name ?></td>
                    <td ><?php echo @$em->from_date ?></td>
                    <td ><?php echo @$em->to_date ?></td>
                    <td ><?php echo @$em->position ?></td>
                    <td ><?php echo @$em->salary ?></td>
                </tr>
                <?php
            }endforeach;
    }
    ?>
    <tr>
        <td colspan="5" class="center"><h5 class="formHeading">EDUCATION RECORD  Ù…Ù„Ø§Ø²Ù…Øª Ø¬Ùˆ Ø±ÙŠÚªØ§Ø±ÚŠ</h5></td>
    </tr>
    <tr>
        <td >Examination Passed Ù¾Ø§Ø³ ÚªÙŠÙ„ Ø§Ù…ØªØ­Ø§Ù† </td>
        <td >Discipline  </td>
        <td >Passing Year Ù¾Ø§Ø³ ÚªØ±Ú» Ø¬Ùˆ Ø³Ø§Ù„ </td>
        <td >School /  Ø§Ø³ÚªÙˆÙ„ College  /ÚªØ§Ù„ÙŠØ¬ University  ÙŠÙˆÙ†ÙŠÙˆØ±Ø³Ù½ÙŠ </td>
        <td >Degree /  ÚŠÚ¯Ø±ÙŠ Certificate  Ø³Ø±Ù½ÙŠÙ?ÚªÙŠÙ½</td>
    </tr>
    <?php
    if ($model->educations) {
        foreach ($model->educations as $ed):
            ?>
            <?php
            $edType = '';
            switch ($ed->education_type_id) {
                case '1':
                    $edType = 'Primary   Ù¾Ø±Ø§Ø¦Ù…Ø±ÙŠ';
                    break;
                case '2':
                    $edType = 'Middle   Ù…ÚŠÙ„';
                    break;
                case '3':
                    $edType = 'Matric   Ù…Ø¦Ù½Ø±Úª';
                    break;
                case '4':
                    $edType = 'Intermediate   Ø§Ù†Ù½Ø±';
                    break;
                case '5':
                    $edType = 'Graduation   Ú¯Ø±ÙŠØ¬ÙˆØ¦ÙŠØ´Ù†';
                    break;
                case '6':
                    $edType = 'Masters   Ù…Ø§Ø³Ù½Ø±Ø²';
                    break;
                case '7':
                    $edType = 'Diploma   Ù…Ø§Ø³Ù½Ø±Ø²';
                    break;
                default:
                    $edType = '';
                    break;
            }
            ?>
            <tr>
                <td ><?php echo @$edType ?></td>
                <td ><?php echo @$ed->board ?></td>
                <td ><?php echo @$ed->passing_year ?></td>
                <td ><?php echo @$ed->organization_name ?></td>
                <td class="center" > 
                    <?php echo (@$ed->degree == 1) ? 'Yes Ù‡Ø§' : 'No Ù†Ù‡ ' ?>
                    <!-- <label for="radio13">Yes Ù‡Ø§  </label>
                    <input type="radio" id="radio13" name="radios6_<?php echo $ed->id ?>" <?php echo (@$ed->degree == 1) ? 'checked' : '' ?>>
                    <label for="radio14">No Ù†Ù‡  </label>
                    <input type="radio" id="radio14" name="radios6_<?php echo $ed->id ?>" <?php echo (@$ed->degree == 0) ? 'checked' : '' ?>>  -->
                </td>
            </tr>
            <?php
        endforeach;
    }
    ?>
<!-- <tr>                    
<td colSpan="2">NIC <b>Front</b></td>
<td colSpan="2"> </td>
</tr>
<tr>                    
<td colSpan="2">NIC <b>Back</b></td>
<td colSpan="2"> </td>
</tr> -->

</table>
<div class="thumb">                    
    <label>Thumb</label>
    <span><?php if (!empty($model->avatar)) { ?><img style="width:100px; height:100px;" src="<?php echo Yii::app()->baseUrl ?>/uploads/applicantthumb/<?php echo @$model->thumb ?>" alt="thumb"><?php } ?></span>
    <label> Applicant Signature:</label>
    <span>_____________________</span>
</div>
<div class="signature" style="float:right; margin-top:20px">

</div>
<script type="text/javascript">
    window.print();
</script>