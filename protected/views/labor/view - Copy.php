<?php if(!empty($model->avatar)){?>
<div class="profilePic"><img src="<?php echo Yii::app()->baseUrl?>/uploads/<?php echo @$model->avatar?>" style="width: 150px;margin-bottom: 20px;"></div>
<?php }?>
            <table class="table table-bordered">
                <tr>
                    <td colSpan="29" class="center"><b>PERSONAL INFORMATION RECORD ذاتي معلومات جو ريڪارڊ</b></td>
                </tr>
                <tr>
                    <td>Full Nameپورو نالو</td>
                    <td colSpan="15"><?php echo @$model->full_name?></td>
                    <td>Father's Nameپيء جو نالو</td>
                    <td colSpan="12"> <?php echo @$model->father_name?></td>
                </tr>
                <tr>
                    <td>CNIC Numberسڃاڻپ ڪارڊ نمبر</td>
                    <td><?php echo @$model->cnic[0]?></td>
                    <td><?php echo @$model->cnic[1]?></td>
                    <td><?php echo @$model->cnic[2]?></td>
                    <td><?php echo @$model->cnic[3]?></td>
                    <td><?php echo @$model->cnic[4]?></td>
                    <td class="center">-</td>
                    <td><?php echo @$model->cnic[6]?></td>
                    <td><?php echo @$model->cnic[7]?></td>
                    <td><?php echo @$model->cnic[8]?></td>
                    <td><?php echo @$model->cnic[9]?></td>
                    <td><?php echo @$model->cnic[10]?></td>
                    <td><?php echo @$model->cnic[11]?></td>
                    <td><?php echo @$model->cnic[12]?></td>
                    <td class="center">-</td>
                    <td><?php echo @$model->cnic[14]?></td>
                    <td>Religion مذهب</td>
                    <td colSpan="12"> <?php echo @$model->religion?></td>
                </tr>
                <tr>
                    <td>Date of Birthڄم جي تاريخ</td>
                    <td colSpan="15"><?php echo @$model->dob?></td></td>
                    <td>Mobile Numberموبائيل نمبر</td>
                    <td><?php echo @$model->mobile_number[0]?></td>
                    <td><?php echo @$model->mobile_number[1]?></td>
                    <td><?php echo @$model->mobile_number[2]?></td>
                    <td><?php echo @$model->mobile_number[3]?></td>
                    <td class="center">-</td>
                    <td><?php echo @$model->mobile_number[5]?></td>
                    <td><?php echo @$model->mobile_number[6]?></td>
                    <td><?php echo @$model->mobile_number[7]?></td>
                    <td><?php echo @$model->mobile_number[8]?></td>
                    <td><?php echo @$model->mobile_number[9]?></td>
                    <td><?php echo @$model->mobile_number[10]?></td>
                    <td><?php echo @$model->mobile_number[11]?></td>
                </tr>
                <tr>
                    <td>Applied Forڳوٺ جو نالو</td>
                    <td colSpan="15"><?php echo @$model->designation?></td>
                    <td>Block 2 تعلقو/ </td>
                    <td colSpan="12"><?php echo (@$model->block_2==1)?'Yes ها':'No نه'?></td>

                </tr>
                <tr>
                    <td>Marital Statusازدواجي حيثيت</td>
                    <td colSpan="15">
                        <!-- <div>
                            <label for="radio1">Marriedشادي شده  </label>
                            <input type="radio" id="radio1" name="radios">
                        </div>
                        <div>
                            <label for="radio2">Un-Marriedغير شادي شده  </label>
                            <input type="radio" id="radio2" name="radios">    
                        </div> -->
                        <?php echo (@$model->martial_status==1)?'Marriedشادي شده':'Un-Marriedغير شادي شده'?>
                    </td>
                    <td>Number of Kidsٻارن جو تعداد</td>
                    <td colSpan="12"> <?php echo @$model->kids?></td>
                </tr>
                <tr>
                    <td>Villageڳوٺ جو نالو</td>
                    <td colSpan="15"><?php echo @$model->village->village?></td>
                    <td>Tehsil تعلقو/ </td>
                    <td colSpan="12"> <?php echo @$model->tehsil->name?></td>
                </tr>
                <tr>
                    <td>Districtضلعو</td>
                    <td colSpan="15"><?php echo @$model->district->name?></td>
                    <td>Category</td>
                    <td class="center" colSpan="12"> 
                        <!-- <label for="radio3">Skilled</label>
                        <input type="radio" id="radio3" name="radios1">
                        <label for="radio4">Un-Skilled</label>
                        <input type="radio" id="radio4" name="radios1">  -->
                        <?php echo (@$model->category_id==1)?'Skilled':'Un-Skilled'?>    
                    </td>
                </tr>
                <tr>
                    <td colSpan="16">Do you know how to Drive?ڇا توهان کي ڊرائيونگ جي ڄاڻ آهي؟ </td>
                    <td class="center" colSpan="13"> 
                        <?php echo (@$model->drive==1)?'Yes ها':'No نه'?>
                        <!-- <label for="radio5">Yes ها  </label>
                        <input type="radio" id="radio5" name="radios2">
                        <label for="radio6">No نه  </label>
                        <input type="radio" id="radio6" name="radios2">  -->
                    </td>
                </tr>
                <?php

                if($model->drivingLicense){
                    $type = @$model->drivingLicense[0]->vehicle_type;
                    $license = @$model->drivingLicense[0]->driving_license;
                    $licenseNumber = @$model->drivingLicense[0]->driving_license_number;
                    $issue = @$model->drivingLicense[0]->issue_date;
                    $valid = @$model->drivingLicense[0]->valid_upto;
                    $licenseC = @$model->drivingLicense[0]->license_category;
                    $expiry = @$model->drivingLicense[0]->driving_license_expiry;
                } else{
                    $type = '';
                    $license = '';
                    $licenseNumber = '';
                    $issue = '';
                    $valid = '';
                    $licenseC = '';
                    $expiry = '';
                }   
                ?>
                <tr>
                    <td colSpan="16">Type of Vehicle Driven? ڪهڙي گاڏي هلائيندا رهيا آهيو؟</td>
                    <td colSpan="13"> 
                        <?php echo ucfirst(@$type)?>
                        <!-- <label for="check1">TRUCK ٽرڪ </label>
                        <input type="checkbox" id="check1">
                        <label for="check2">SUV  ننڍي گاڏي</label>
                        <input type="checkbox" id="check2">
                        <label for="check3">BUS بس  </label>
                        <input type="checkbox" id="check3">
                        <label for="check4">CAR ڪار  </label>
                        <input type="checkbox" id="check4">                     
                        <label for="check5">Dumper ڊمپر  </label>
                        <input type="checkbox" id="check5">                        
                        <label>OTHER يا ڪا ٻي   </label>   --> 
                    </td>
                </tr>
                <tr>
                    <td colSpan="16">Driving License ڊرائيونگ لائسنس</td>
                    <td class="center" colSpan="13">
                        <?php echo (@$license==1)?'Yes ها ':'No نه'?>
                        <!-- <label for="radio7">Yes ها  </label>
                        <input type="radio" id="radio7" name="radios3">
                        <label for="radio8">No نه  </label>
                        <input type="radio" id="radio8" name="radios3"> -->
                    </td>

                </tr>
                <tr>
                    <td colSpan="16">If Yes, License # جيڪڏهن ها ته لائسنس جو نمبر</td>
                    <td colSpan="13"> <?php echo @$licenseNumber?></td>
                </tr>
                <tr>
                    <td colSpan="16">Issue Date جاري ٿيڻ جي تاريخ</td>
                    <td colSpan="13"><?php echo @$issue?></td>
                </tr>
                <tr>
                    <td colSpan="16">Valid Upto ڪارآمد تاريخ</td>
                    <td colSpan="13"> <?php echo @$valid?></td>
                </tr>
                <tr>
                    <td colSpan="16">License Category لائسنس جو قسم</td>
                    <td class="center" colSpan="13">
                        <?php echo (@$licenseC=='ltv')?'LTV ايل ٽي وي':'HTV ايڇ ٽي وي '?>
                        <!-- <label for="radio9">LTV ايل ٽي وي  </label>
                        <input type="radio" id="radio9" name="radios4">
                        <label for="radio10">HTV ايڇ ٽي وي </label>
                        <input type="radio" id="radio10" name="radios4"> -->
                    </td>
                </tr>
                <!-- <tr>                    
                    <td colSpan="16">Driving Exp in Yrs</td>
                    <td colSpan="13"> </td>
                </tr> -->
                <?php
                if($model->employments){
                    $working = @$model->employments[0]->working;
                    $income = @$model->employments[0]->source_of_income;
                    $working = @$model->employments[0]->working;
                    
                } else{
                    $working = '';
                    $income = '';
                }   
                ?>
                <tr>
                    <td colSpan="29" class="center"><b>EMPLOYMENT RECORD  ملازمت جو ريڪارڊ</b></td>
                </tr>
                <tr>
                    <td colSpan="16">Are you currently working?ڇا توهان هن وقت ڪا ملازمت ڪندا آهيو؟</td>
                    <td class="center" colSpan="13"> 
                        <!-- <label for="radio11">Yes ها  </label>
                        <input type="radio" id="radio11" name="radios5">
                        <label for="radio12">No نه  </label>
                        <input type="radio" id="radio12" name="radios5">  -->
                        <?php echo (@$working==1)?'Yes ها':'No نه'?>
                    </td>
                </tr>
                <tr>
                    <td colSpan="16">If No, what is your source of income / livelihood? جيڪڏهن نه ته آمدني/ گذر سفر وسيلو ڪهڙو آهي؟ </td>
                    <td class="center" colSpan="13"><?php echo @$income?></td>
                </tr>
                <tr>
                    <td colSpan="16">If Yes, please share below جيڪڏهن ها ته هيٺين وضاحت ڪريو </td>
                    <td class="center" colSpan="13"></td>
                </tr>
                <tr>
                    <td colSpan="6">Company Nameڪمپنيءجونالو  </td>
                    <td colSpan="6">Fromکان</td>
                    <td colSpan="6">Toتائين</td>
                    <td colSpan="6">Position عهدو</td>
                    <td colSpan="5">Gross Salary مجموعي پگهار</td>
                </tr>
                <?php if($model->employments){ foreach($model->employments as $em):if($em->company_name!=''){?>
                    <tr>
                        <td colSpan="6"><?php echo @$em->company_name?></td>
                        <td colSpan="6"><?php echo @$em->from_date?></td>
                        <td colSpan="6"><?php echo @$em->to_date?></td>
                        <td colSpan="6"><?php echo @$em->position?></td>
                        <td colSpan="5"><?php echo @$em->salary?></td>
                    </tr>
                <?php }endforeach; }?>
                <tr>
                    <td colSpan="29" class="center"><b>EDUCATION RECORD  ملازمت جو ريڪارڊ</b></td>
                </tr>
                <tr>
                    <td colSpan="8">Examination Passed پاس ڪيل امتحان </td>
                    <td colSpan="4">Discipline  </td>
                    <td colSpan="4">Passing Year پاس ڪرڻ جو سال </td>
                    <td colSpan="10">School /  اسڪول College  /ڪاليج University  يونيورسٽي </td>
                    <td colSpan="3">Degree /  ڊگري Certificate  سرٽيفڪيٽ</td>
                </tr>
                <?php if($model->educations){ foreach($model->educations as $ed):?>
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
                        <td colSpan="8"><?php echo @$edType?></td>
                        <td colSpan="4"><?php echo @$ed->board?></td>
                        <td colSpan="4"><?php echo @$ed->passing_year?></td>
                        <td colSpan="10"><?php echo @$ed->organization_name?></td>
                        <td class="center" colSpan="3"> 
                            <?php echo (@$ed->degree==1)?'Yes ها':'No نه '?>
                            <!-- <label for="radio13">Yes ها  </label>
                            <input type="radio" id="radio13" name="radios6_<?php echo $ed->id?>" <?php echo (@$ed->degree==1)?'checked':''?>>
                            <label for="radio14">No نه  </label>
                            <input type="radio" id="radio14" name="radios6_<?php echo $ed->id?>" <?php echo (@$ed->degree==0)?'checked':''?>>  -->
                        </td>
                    </tr>
                <?php endforeach; }?>
                <!-- <tr>                    
                    <td colSpan="16">NIC <b>Front</b></td>
                    <td colSpan="13"> </td>
                </tr>
                <tr>                    
                    <td colSpan="16">NIC <b>Back</b></td>
                    <td colSpan="13"> </td>
                </tr> -->
                <tr>                    
                    <td colSpan="16">Thumb</td>
                    <td colSpan="13"> </td>
                </tr>
                <tr>
                    <td colSpan="29" class="center"><b>Remarks</b></td>
                </tr>
                <tr>
                    <td colSpan="29"><?php echo @$model->remarks?></td>
                </tr>

            </table>

<script type="text/javascript">
//window.print();
</script>