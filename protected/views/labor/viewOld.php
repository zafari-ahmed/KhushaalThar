<h5 class="formHeading center">PERSONAL INFORMATION RECORD ذاتي معلومات جو ريڪارڊ</h5>
<div class="someAttr">
    <div class="col-xs-9">        
        <div class="row">
            <div class="attrSpan">
                <div class="col-xs-6">
                    <div class="row">
                        <label>Full Name <span>پورو نالو</span></label>
                        <p><?php echo @$model->full_name ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Father's Name <span>پيء جو نالو</span></label>
                        <p> <?php echo @$model->father_name ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label><?php echo (@$model->nicop == 1) ? 'NICOP' : 'CNIC' ?> Number<span>سڃاڻپ ڪارڊ نمبر</span></label>
                        <p><?php echo @$model->cnic ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Religion <span>مذهب</span></label>
                        <p> <?php echo @$model->religion ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Date of Birth<span> ڄم جي تاريخ</span></label>
                        <p><?php echo @$model->dob ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Mobile Number <span> موبائيل نمبر</span></label>
                        <p><?php echo @$model->mobile_number ?></p>
                    </div>
                </div>
                <div class="col-xs-6">
                    <div class="row">
                        <label>Gender <span>???</span></label>
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
                        <label>Marital Status <span>ازدواجي حيثيت</span></label>
                        <p> <?php echo (@$model->martial_status == 1) ? 'Married شادي شده' : 'Un-Married غير شادي شده' ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Number of Kids <span>ٻارن جو تعداد</span></label>
                        <p><?php echo @$model->kids ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Village <span>ڳوٺ جو نالو</span></label>
                        <p><?php echo @$model->village->village ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Tehsil <span>تعلقو/</span></label>
                        <p><?php echo @$model->tehsil->name ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>District <span>ضلعو</span></label>
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
                        <label>Do you know how to Drive? <span>ڇا توهان کي ڊرائيونگ جي ڄاڻ آهي؟</span></label>
                        <p><?php echo (@$model->drive == 1) ? 'Yes ها' : 'No نه' ?></p>
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
                        <label>Type of Vehicle Driven? <span>ڪهڙي گا�?ي هلائيندا رهيا آهيو؟</span></label>
                        <p> <?php echo ucfirst(@$type) ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Driving License <span>ڊرائيونگ لائسنس</span></label>
                        <p><?php echo (@$license == 1) ? 'Yes ها ' : 'No نه' ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>If Yes, License # <span>جيڪ�?هن ها ته لائسنس جو نمبر</span></label>
                        <p> <?php echo @$licenseNumber ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Issue Date <span>جاري ٿيڻ جي تاريخ</span></label>
                        <p><?php echo @$issue ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>Valid Upto <span>ڪارآمد تاريخ</span></label>
                        <p><?php echo @$valid ?></p>
                    </div>
                </div>
                <div class="col-xs-4">
                    <div class="row">
                        <label>License Category <span>لائسنس جو قسم</span></label>
                        <p><?php echo (@$licenseC == 'ltv') ? 'LTV ايل ٽي وي' : 'HTV ايڇ ٽي وي ' ?></p>
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
        <td colspan="5" class="center"><b>PERSONAL INFORMATION RECORD ذاتي معلومات جو ريڪارڊ</b></td>
    </tr>
   <tr>
        <td width="30%">Full Name پورو نالو</td>
        <td><?php echo @$model->full_name ?></td>
        <td width="30%">Father's Name پيء جو نالو</td>
        <td colSpan="3"> <?php echo @$model->father_name ?></td>
    </tr>
    <tr>
        <td><?php echo (@$model->nicop == 1) ? 'NICOP' : 'CNIC' ?> Number سڃاڻپ ڪارڊ نمبر</td>
        <td><?php echo @$model->cnic ?></td>
        <td>Religion مذهب</td>
        <td colSpan="3"> <?php echo @$model->religion ?></td>
    </tr>
    <tr>
        <td>Date of Birth ڄم جي تاريخ</td>
        <td><?php echo @$model->dob ?></td></td>
        <td>Mobile Number موبائيل نمبر</td>
        <td colSpan="3"><?php echo @$model->mobile_number ?></td>
    </tr>
    <tr>
        <td>Applied For ڳوٺ جو نالو</td>
        <td><?php echo @$model->designation ?></td>
        <td>Block 2 تعلقو/ </td>
        <td colSpan="3"><?php echo (@$model->block_2 == 1) ? 'Yes ها' : 'No نه' ?></td>

    </tr> 
    <tr>
        <td>Marital Status ازدواجي حيثيت</td>
        <td>
    <?php echo (@$model->martial_status == 1) ? 'Married شادي شده' : 'Un-Married غير شادي شده' ?>
        </td>
        <td>Number of Kids ٻارن جو تعداد</td>
        <td colSpan="3" > <?php echo @$model->kids ?></td>
    </tr>
    <tr>
        <td>Village ڳوٺ جو نالو</td>
        <td ><?php echo @$model->village->village ?></td>
        <td>Tehsil تعلقو/ </td>
        <td colSpan="3" > <?php echo @$model->tehsil->name ?></td>
    </tr>
    <tr>
        <td>District ضلعو</td>
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
        <td colSpan="2">Type of Vehicle Driven? ڪهڙي گا�?ي هلائيندا رهيا آهيو؟</td>
        <td class="center" colSpan="3"> 
    <?php echo ucfirst(@$type) ?>
           
        </td>
    </tr>
    <tr>
        <td colSpan="2">Driving License ڊرائيونگ لائسنس</td>
        <td colSpan="3" class="center" colSpan="2">
    <?php echo (@$license == 1) ? 'Yes ها ' : 'No نه' ?>
           
        </td>

    </tr>
    <tr>
        <td colSpan="2">If Yes, License # جيڪ�?هن ها ته لائسنس جو نمبر</td>
        <td class="center" colSpan="3"> <?php echo @$licenseNumber ?></td>
    </tr>
    <tr>
        <td colSpan="2">Issue Date جاري ٿيڻ جي تاريخ</td>
        <td class="center" colSpan="3"><?php echo @$issue ?></td>
    </tr>
    <tr>
        <td colSpan="2">Valid Upto ڪارآمد تاريخ</td>
        <td class="center" colSpan="3"> <?php echo @$valid ?></td>
    </tr>
    <tr>
        <td colSpan="2">License Category لائسنس جو قسم</td>
        <td colSpan="3" class="center" colSpan="2">
    <?php echo (@$licenseC == 'ltv') ? 'LTV ايل ٽي وي' : 'HTV ايڇ ٽي وي ' ?>
           
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
        <td colspan="5" class="center"><b>EMPLOYMENT RECORD  ملازمت جو ريڪارڊ</b></td>
    </tr>
    <tr>
        <td colSpan="2">Are you currently working? ڇا توهان هن وقت ڪا ملازمت ڪندا آهيو؟</td>
        <td colSpan="3" class="center" colSpan="2"> 
            <!-- <label for="radio11">Yes ها  </label>
            <input type="radio" id="radio11" name="radios5">
            <label for="radio12">No نه  </label>
            <input type="radio" id="radio12" name="radios5">  -->
            <?php echo (@$working == 1) ? 'Yes ها' : 'No نه' ?>
        </td>
    </tr>
    <tr>
        <td colSpan="2">If No, what is your source of income / livelihood? جيڪ�?هن نه ته آمدني/ گذر س�?ر وسيلو ڪهڙو آهي؟ </td>
        <td colSpan="3" class="center" colSpan="2"><?php echo @$income ?></td>
    </tr>
    <tr>
        <td colSpan="2">If Yes, please share below جيڪ�?هن ها ته هيٺين وضاحت ڪريو </td>
        <td colSpan="3" class="center" colSpan="2"></td>
    </tr>
    <tr>
        <td >Company Name ڪمپنيءجونالو  </td>
        <td >From کان</td>
        <td>To تائين</td>
        <td width="25%">Position عهدو</td>
        <td width="25%">Gross Salary مجموعي پگهار</td>
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
        <td colspan="5" class="center"><b>EDUCATION RECORD  ملازمت جو ريڪارڊ</b></td>
    </tr>
    <tr>
        <td >Examination Passed پاس ڪيل امتحان </td>
        <td >Discipline  </td>
        <td >Passing Year پاس ڪرڻ جو سال </td>
        <td >School /  اسڪول College  /ڪاليج University  يونيورسٽي </td>
        <td >Degree /  ڊگري Certificate  سرٽي�?ڪيٽ</td>
    </tr>
    <?php
    if ($model->educations) {
        foreach ($model->educations as $ed):
            ?>
            <?php
            $edType = '';
            switch ($ed->education_type_id) {
                case '1':
                    $edType = 'Primary   پرائمري';
                    break;
                case '2':
                    $edType = 'Middle   مڊل';
                    break;
                case '3':
                    $edType = 'Matric   مئٽرڪ';
                    break;
                case '4':
                    $edType = 'Intermediate   انٽر';
                    break;
                case '5':
                    $edType = 'Graduation   گريجوئيشن';
                    break;
                case '6':
                    $edType = 'Masters   ماسٽرز';
                    break;
                case '7':
                    $edType = 'Diploma   ماسٽرز';
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
                    <?php echo (@$ed->degree == 1) ? 'Yes ها' : 'No نه ' ?>
                    <!-- <label for="radio13">Yes ها  </label>
                    <input type="radio" id="radio13" name="radios6_<?php echo $ed->id ?>" <?php echo (@$ed->degree == 1) ? 'checked' : '' ?>>
                    <label for="radio14">No نه  </label>
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
    <tr>                    
        <td colSpan="2">Thumb</td>
        <td class="center" colSpan="3"><?php if (!empty($model->avatar)) { ?><img style="width:100px; height:100px;" src="<?php echo Yii::app()->baseUrl ?>/uploads/applicantthumb/<?php echo @$model->thumb ?>" alt="thumb"><?php } ?></td>
    </tr>
</table>
<div class="signature" style="float:right; margin-top:20px">
    Applicant Signature: _____________________
</div>
<script type="text/javascript">
    window.print();
</script>