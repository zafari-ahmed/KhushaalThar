<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Applicant Profile</h3>
              </div>
            </div>
            
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Applicant <small>Profile</small>
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/labor/card/id/<?php echo $labor->id?>" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Print Card</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/labor/print/id/<?php echo $labor->id?>" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Print</button></a>&nbsp;
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="<?php echo (@$labor->avatar=='')?Yii::app()->baseUrl.'/assets/images/img.jpg':Yii::app()->baseUrl.'/uploads/'.@$labor->avatar?>" alt="Avatar" title="Change the avatar">

                        </div>
                      </div>
                      <h3><?php echo ucwords(@$labor->full_name)?></h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker"></i> <?php echo @$labor->village->village.', '.@$labor->tehsil->name.', '.@$labor->district->name?></li>
                        <li><i class="fa fa-phone"></i> <?php echo @$labor->mobile_number?></li>
                        <li><i class="fa fa-credit-card"></i> <?php echo @$labor->cnic?></li>
                        <li><i class="fa fa-bookmark"></i> <?php if(@$labor->category_id==1){ echo 'Skilled';} if(@$labor->category_id==2){ echo 'Unskilled';}?> Labor</li>
                        <li><i class="fa fa-check-square"></i> Block 2: <?php echo (@$labor->block_2==1)?'Yes':'No'?></li>
                        <li><i class="fa fa-car"></i> Drive: <?php echo (@$labor->drive==1)?'Yes':'No'?></li>
                        <?php if(@$labor->drive==1){?><li ><i class="fa fa-credit-card"></i> Driving License Number : <?php echo (@$labor->drivingLicense)?$labor->drivingLicense[0]->driving_license_number:'No'?></li><?php } ?>
                      </ul>

                      <a href="<?php echo Yii::app()->baseUrl?>/labor/edit/<?php echo @$labor->id?>" class="btn btn-info"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <div class="<?php echo (@$labor->status==1)?'hide':''?>">
                        <a href="<?php echo Yii::app()->baseUrl?>/labor/edit/<?php echo @$labor->id?>" class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Activate</a>
                        <p><b>Reason:</b><?php echo @$labor->remarks?></p>
                      </div>
                      <br />
                      <?php if(!isset($_GET['scan'])){?>
                      <div class="col-md-12">
                        <?php $link = 'https://khushaalthar.com/scan/index/id/'.$labor->id.'?scan=1'?>
                        <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $link?>&choe=UTF-8" class="qrcode"/>
                      </div>
                      <?php }?>
                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      
                      
                      <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class="active"><a href="#tab_content1" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true">Current Status</a></li>
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Projects Worked on</a></li>
                          <li role="presentation" class=""><a href="#tab_content4" role="tab" id="profile-tab4" data-toggle="tab" aria-expanded="false">Trainings</a></li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Documents</a></li>
                          <li role="presentation" class=""><a href="#tab_content5" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Educations</a></li>
                          <li role="presentation" class=""><a href="#tab_content6" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Employments</a></li>
                          <li role="presentation" class=""><a href="#tab_content7" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Comments</a></li>
                          <li role="presentation" class=""><a href="#tab_content8" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Verifications</a></li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="home-tab">

                            <!-- start recent activity -->
                            <ul class="messages">
                              <?php if($labor->traingsActive){ $training = LabourTraings::model()->find('labour_id=:id',array(':id'=>$labor->id)); if($training->training->status==0){?>
                              <li>
                                
                                <div class="message_wrapper">
                                  <h4 class="heading"><?php echo ucfirst(@$training->training->training_type)?>&nbsp;<span>( <?php echo date('d M,Y',strtotime(@$training->training->start_date))?></span>&nbsp;<b>To</b>&nbsp;<span> <?php echo date('d M,Y',strtotime(@$training->training->end_date))?></span> )</h4>
                                  <blockquote class="message">attending training  @ <b><?php echo ucfirst(@$training->training->institute_name)?></b> <b>/ Batch #:</b><?php echo @$training->training->batch_no?></blockquote>
                                  <br />
                                </div>
                              </li>
                              <?php } else{ echo '<li>No Active work or training</li>'; } } elseif($labor->laborRequisitionsActive){?>
                              <li>
                                <div class="message_date">
                                  <h3 class="date text-info"><?php echo date('d',strtotime($labor->laborRequisitionsActive[0]->accepted_date))?></h3>
                                  <p class="month"><?php echo date('M',strtotime($labor->laborRequisitionsActive[0]->accepted_date))?></p>
                                </div>
                                <div class="message_wrapper">
                                  <h4 class="heading"><?php echo ucfirst($labor->laborRequisitionsActive[0]->requisition->requisition->company->company_name)?></h4>
                                  <blockquote class="message"><?php echo ($labor->laborRequisitionsActive[0]->status==0)?'Pending at':'Working on'?> requisition # <b><?php echo $labor->laborRequisitionsActive[0]->requisition->requisition->requisition_code?></b></blockquote>
                                  <br />
                                </div>
                              </li>
                              <?php } else{ echo '<li>No Active work or training</li>';}?>
                            </ul>
                            <!-- end recent activity -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/labor/viewpdf/id/<?php echo @$labor->id?>/type/work" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>Company Name</th>
                                  <th>Requisition #</th>
                                  <th>Type</th>
                                  <th>Date From</th>
                                  <th>Date End</th>
                                  <th>Accepted Date</th>
                                  <th>Rejected Date</th>
                                  <th>Release Date</th>
                                  <th>Remarks</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($labor->laborRequisitions as $lr):?>
                                  <tr>
                                    <td><?php echo ucfirst(@$lr->requisition->requisition->company->company_name)?></td>
                                    <?php if(@$lr->status==0){?>
                                      <td><a href="#"><?php echo @$lr->requisition->requisition->requisition_code?></a></td>
                                    <?php } else{?>
                                    <td><a href="<?php echo Yii::app()->baseUrl?>/labor/viewrequisition/id/<?php echo @$lr->id?>"><?php echo @$lr->requisition->requisition->requisition_code?></a></td>
                                    <?php }?>
                                    <td><?php echo @$lr->requisition->skill.' ('.((@$lr->requisition->type==1)?'Skilled':'Unskilled').')';?></td>
                                    <td><?php echo date('d M,Y',strtotime(@$lr->requisition->date_from));?></td>
                                    <td><?php echo date('d M,Y',strtotime(@$lr->requisition->date_to));?></td>
                                    <td><?php echo (@$lr->accepted_date)?(date('d M,Y',strtotime(@$lr->accepted_date))):'-'?></td>
                                    <td><?php echo (@$lr->status==2)?(date('d M,Y',strtotime(@$lr->rejected_date))):'-'?></td>
                                    <td><?php echo (@$lr->status==3)?(date('d M,Y',strtotime(@$lr->rejected_date))):'-'?></td>
                                    <td><?php if(@$lr->status==0){ echo 'Pending';} if(@$lr->status==1){ echo 'Accepted';} if(@$lr->status==2){ echo 'Rejected<br/>'.$lr->reason;} if(@$lr->status==3){ echo 'Job Completed';}?></td>
                                  </tr>
                                <?php endforeach;?>
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content4" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/labor/viewpdf/id/<?php echo @$labor->id?>/type/training" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                            <table class="table table-striped">
                              <thead>
                                <tr>
                                  <th>Name</th>
                                  <th>Type</th>
                                  <th>Batch No.</th>
                                  <th>Start Date</th>
                                  <th>End Date</th>
                                  <!-- <th>Trade</th> -->
                                  <th>Score</th>
                                  <th>Result</th>
                                  <!-- <th>Last Name</th>
                                  <th>Username</th> -->
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($labor->traings as $v): if($v->training){?>
                                  <tr>
                                      <td><?php echo ucfirst($v->training->institute_name)?></td>
                                      <td><?php echo ucfirst($v->training->training_type)?></td>
                                      <td><?php echo $v->training->batch_no?></td>
                                      <td><?php echo $v->training->start_date?></td>
                                      <td><?php echo $v->training->end_date?></td>
                                      <!-- <td><?php //echo $v->trade?></td> -->
                                      <td><?php echo $v->score?></td>
                                      <td><?php echo $v->result?></td>
                                    </tr>
                                <?php } endforeach;?>
                                
                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>File</th>
                                  <th>Link</th>
                                </tr>
                              </thead>
                              <tbody>
                              	<?php foreach($labor->documents as $index=>$ld):?>
                                <tr>
                                  <td><?php echo $index+1?></td>
                                  <td><?php echo $ld->name?></td>
                                  <td><a target="_blank" href="<?php echo Yii::app()->baseUrl?>/uploads/<?php echo $ld->labour_id.'_'.$ld->name?>"><?php echo $ld->name?><a/></td>
                                </tr>
                            	<?php endforeach;?>
                              </tbody>
                            </table>
                          </div>

                          <div role="tabpanel" class="tab-pane fade" id="tab_content5" aria-labelledby="profile-tab">
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Examination Passed</th>
                                  <th>Discipline</th>
                                  <th>Passing Year</th>
                                  <th>College / School Name</th>
                                  <th>Certificate</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php foreach($labor->educations as $index=>$ld):

                                  switch ($ld->education_type_id) {
                                    case '1':
                                      $educationTypeId = 'Primary';
                                      break;
                                    case '2':
                                      $educationTypeId = 'Middle';
                                      break;
                                    case '3':
                                      $educationTypeId = 'Matric';
                                      break;
                                    case '4':
                                      $educationTypeId = 'Intermediate';
                                      break;
                                    case '5':
                                      $educationTypeId = 'Graduation';
                                      break;
                                    case '6':
                                      $educationTypeId = 'Masters';
                                      break;
                                    case '7':
                                      $educationTypeId = 'Diploma';
                                      break;
                                    default:
                                      # code...
                                      break;
                                  }

                                ?>
                                <tr>
                                  <td><?php echo $index+1?></td>
                                  <td><?php echo @$educationTypeId?></td>
                                  <td><?php echo $ld->board?></td>
                                  <td><?php echo $ld->passing_year?></td>
                                  <td><?php echo $ld->organization_name?></td>
                                  <td><?php echo ($ld->degree==1)?'Yes':'No'?></td>
                                </tr>
                              <?php endforeach;?>
                              </tbody>
                            </table>
                          </div>

                          <div role="tabpanel" class="tab-pane fade" id="tab_content6" aria-labelledby="profile-tab">
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Source of income</th>
                                  <th>Company Name</th>
                                  <th>From Date</th>
                                  <th>To Date</th>
                                  <th>Position</th>
                                  <th>Salary</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if($labor->employments){if(@$labor->employments[0]->source_of_income==''){foreach($labor->employments as $index=>$ld): if(!empty($ld->company_name)){?>
                                <tr>
                                  <td><?php echo $index+1?></td>
                                  <td>Job</td>
                                  <td><?php echo $ld->company_name?></td>
                                  <td><?php echo $ld->from_date?></td>
                                  <td><?php echo $ld->to_date?></td>
                                  <td><?php echo $ld->position?></td>
                                  <td><?php echo $ld->salary?></td>
                                </tr>
                              <?php } endforeach;} else{ echo '<tr><td>1</td><td colspan="6">'.((@$labor->employments)?$labor->employments[0]->source_of_income:'').'</td></tr>';}}?>
                              </tbody>
                            </table>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content7" aria-labelledby="profile-tab">
                            <?php $status = explode(',', @$labor->remarks); ?>
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>#</th>
                                  <th>Comment</th>
                                </tr>
                              </thead>
                              <tbody>
                                <?php if(@$status){ foreach($status as $index=>$s):?>
                                <tr>
                                  <td><?php echo $index+1?></td>
                                  <td><?php echo $s?></td>
                                </tr>
                              <?php endforeach;} else{ ?>
                              <tr><td colspan="2">No Comment found</td></tr>
                              <?php }?>
                              </tbody>
                            </table>
                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content8" aria-labelledby="profile-tab">
                            <div class="col-md-12">
                              <h2>HSE</h2>
                            <div class="form-group">
                              <div class="col-md-6">
                              <label style="margin-right:10px" for="last-name">HSE Clearance</label>
                               <!-- Yes<input type="radio" name="hse" value="1" style="    margin:15px;float: none;" <?php echo (@$labor->hse)?((@$labor->hse[0]->hse=='1')?'checked':''):''?> disabled>
                               No<input type="radio" name="hse" value="0" style="    margin:15px;float: none;" <?php echo (@$labor->hse)?((@$labor->hse[0]->hse=='0')?'checked':''):''?> disabled> -->
                               <p><?php echo (@$labor->hse)?((@$labor->hse[0]->hse=='1')?'Yes ها':'No نه'):'-' ?></p>
                              </div>
                            </div>
                            <hr style="width:100%"/>
                            <div class="form-group">
                              <h2>Medicle</h2>
                              <div class="col-md-12">
                              <label style="margin-right:10px" for="last-name">Medical Clearance</label>
                               <!-- Yes<input type="radio" name="medical" value="1" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->medical=='1')?'checked':''):''?> disabled>
                               No<input type="radio" name="medical" value="0" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->medical=='0')?'checked':''):''?> disabled> -->
                               <p><?php echo (@$labor->medical)?((@$labor->medical[0]->medical=='1')?'Yes ها':'No نه'):'-' ?></p>
                              </div>
                              <div class="col-md-12">
                              <label style="margin-right:10px" for="last-name">Medical Type</label>
                               <!-- Basic<input type="radio" name="type" value="basic" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->type=='basic')?'checked':''):''?> disabled>
                               Complete<input type="radio" name="type" value="complete" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->type=='complete')?'checked':''):''?> disabled> -->
                               <p><?php echo (@$labor->medical)?((@$labor->medical[0]->type=='Basic')?'Basic':'Complete'):'-' ?></p>
                              </div>
                              <div class="col-md-12">
                              <label style="margin-right:10px" for="last-name">Medical Status</label>
                               <!-- Fit<input type="radio" name="result" value="fit" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->result=='fit')?'checked':''):''?> disabled>
                               Un-Fit<input type="radio" name="result" value="unfit" style="    margin:15px;float: none;" <?php echo (@$labor->medical)?((@$labor->medical[0]->result=='unfit')?'checked':''):''?> disabled> -->
                               <p><?php echo (@$labor->medical)?((@$labor->medical[0]->result=='fit')?'Fit':'Unfit'):'-' ?></p>
                              </div>
                            </div>
                            <hr style="width:100%"/>
                            <div class="form-group">
                              <h2>Police</h2>
                              <div class="col-md-12">
                              <label style="margin-right:10px" for="last-name">Police Clearance</label>
                               <!-- Yes<input type="radio" name="police" value="1" style="    margin:15px;float: none;" <?php echo (@$labor->police)?((@$labor->police[0]->police_verified=='1')?'checked':''):''?> disabled>
                               No<input type="radio" name="police" value="0" style="    margin:15px;float: none;" <?php echo (@$labor->police)?((@$labor->police[0]->police_verified=='0')?'checked':''):''?> disabled> -->
                               <p><?php echo (@$labor->police)?((@$labor->police[0]->police_verified=='1')?'Yes ها':'No نه'):'-' ?></p>
                              </div>
                              <div class="col-md-12">
                              <label style="margin-right:10px" for="last-name">Police Status</label>
                               <!-- Cleared<input type="radio" name="police_status" value="cleared" style="    margin:15px;float: none;" <?php echo (@$labor->police)?((@$labor->police[0]->police_verified=='1')?'checked':''):''?> disabled>
                               Not-cleared<input type="radio" name="police_status" value="notcleared" style="    margin:15px;float: none;" <?php echo (@$labor->police)?((@$labor->police[0]->police_verified=='0')?'checked':''):''?> disabled> -->
                               <p><?php echo (@$labor->police)?((@$labor->police[0]->police_verified=='1')?'Cleared':'Not-cleared'):'-' ?></p>
                              </div>

                            </div>
                            <hr style="width:100%"/>
                            <div class="form_group">
                              <div class="col-md-12">
                              <h2>Previos Skill Results</h2>
                              <table class="table table-striped table-bordered" style="width:20%">
                                <thead>
                                  <tr class="headings">
                                    <th class="column-title">Date</th>
                                    <th class="column-title">Score</th>
                                    </th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($labor->skill as $sk):?>
                                    <tr>
                                      <td><?php echo $sk->date?></td>
                                      <td><?php echo $sk->result?></td>
                                    </tr>
                                  <?php endforeach;?>
                                </tbody>
                            </table>
                            </div>
                            </div>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>