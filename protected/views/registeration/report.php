<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Applicant Report</h3>
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
                    <h2>Report<small>Filters</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="applicantReportForm" class="form-horizontal form-label-left" method="GET">

                      <div class="form-group">
                        
                        <div class="col-md-2 col-sm-3 col-xs-12">
                            <label for="first-name">District</label>
                            <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="district_id" id="district_id">
                              <option value="">Select District</option>
                              <?php foreach($districts as $t):?>
                                <option value="<?php echo $t->id?>" <?php echo isset($_REQUEST['district_id'])?(($_REQUEST['district_id']==$t->id)?'selected':''):''?>><?php echo $t->name?></option>
                              <?php endforeach;?>
                            </select>
                          </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                          <label for="first-name">Tehsil</label>
                          <select class="form-control select2_single" tabindex="-1" name="tehsil_id" id="tehsil_id">
                              <option value="">Select Tehsil</option>
                              <?php foreach($tehsils as $t):?>
                                <option value="<?php echo $t->id?>" <?php echo isset($_REQUEST['tehsil_id'])?(($_REQUEST['tehsil_id']==$t->id)?'selected':''):''?>><?php echo $t->name?></option>
                              <?php endforeach;?>
                            </select>
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                          <label for="first-name">Village</label>
                          <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="village_id" id="village_id">
                            <option value="">Select Village</option>
                            <?php foreach($villages as $t):?>
                              <option value="<?php echo $t->id?>" <?php echo isset($_REQUEST['village_id'])?(($_REQUEST['village_id']==$t->id)?'selected':''):''?>><?php echo $t->village?></option>
                            <?php endforeach;?>
                          </select>
                        </div>

                        


                        <div class="col-md-2">
                          <label for="first-name">Category </label>
                          <select id="category_id" class="form-control col-md-7 col-xs-12" name="category_id"><option value=''>Select category</option><option value="1" <?php echo isset($_REQUEST['category_id'])?(($_REQUEST['category_id']==1)?'selected':''):''?>>Skilled</option><option value="2" <?php echo isset($_REQUEST['category_id'])?(($_REQUEST['category_id']==2)?'selected':''):''?>>Unskilled</option></select>
                        </div>

                        <div class="col-md-2 col-sm-3 col-xs-12">
                          <label for="last-name">From Date</label>
                          <input type="text" id="createdOn" name="createdOnf" class="ddate form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['createdOnf'])?$_REQUEST['createdOnf']:''?>">
                        </div>
                        <div class="col-md-2 col-sm-3 col-xs-12">
                          <label for="last-name">End Date</label>
                          <input type="text" id="createdOn" name="createdOne" class="ddate form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['createdOne'])?$_REQUEST['createdOne']:''?>">
                        </div>

                        
                      </div>
                      
                      <div class="form-group">
                        <div class="col-md-2">
                          <label for="last-name" style="display:block">Block 2 </label>
                          <!-- Yes<input type="radio" name="block_2" value="1" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo (isset($_REQUEST['block_2']))?((@$_REQUEST['block_2']==1)?'checked':''):''?>>
                          No<input type="radio" name="block_2" value="0" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo (isset($_REQUEST['block_2']))?((@$_REQUEST['block_2']==0)?'checked':''):''?>> -->
                          <select class="form-control col-md-7 col-xs-12" name="block_2">
                            <option value="">Block 2</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="last-name" style="display:block">Gender</label>
                          <!-- Male<input type="radio" name="gender" value="male" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo isset($_REQUEST['gender'])?((@$_REQUEST['gender']=='male')?'checked':''):''?>>
                          Female<input type="radio" name="gender" value="female" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo isset($_REQUEST['gender'])?((@$_REQUEST['gender']=='female')?'checked':''):''?>> -->
                          <select class="form-control col-md-7 col-xs-12" name="gender">
                            <option value="">Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="last-name" style="display:block">Marital Status</label>
                          <!-- Single<input type="radio" name="martial_status" value="0" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo isset($_REQUEST['martial_status'])?((@$_REQUEST['martial_status']==0)?'checked':''):''?>>
                          Married<input type="radio" name="martial_status" value="1" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo isset($_REQUEST['martial_status'])?((@$_REQUEST['martial_status']==1)?'checked':''):''?>> -->
                          <select class="form-control col-md-7 col-xs-12" name="martial_status">
                            <option value="">Marital Status</option>
                            <option value="0">Single</option>
                            <option value="1">Married</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="last-name" style="display:block">Nicop</label>
                          <!-- Yes<input type="radio" name="nicop" value="1" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo isset($_REQUEST['nicop'])?((@$_REQUEST['nicop']==1)?'checked':''):''?>>
                          No<input type="radio" name="nicop" value="0" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo isset($_REQUEST['nicop'])?((@$_REQUEST['nicop']==0)?'checked':''):''?>> -->
                          <select class="form-control col-md-7 col-xs-12" name="nicop">
                            <option value="">Nicop</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>

                        <div class="col-md-2">
                          <label for="last-name" style="display:block">Drive</label>
                          <!-- Yes<input type="radio" name="drive" value="1" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo isset($_REQUEST['drive'])?((@$_REQUEST['drive']==1)?'checked':''):''?>>
                          No<input type="radio" name="drive" value="0" style="        float: none;margin-left: 5px;vertical-align: middle;margin-top: 0px;" <?php echo isset($_REQUEST['drive'])?((@$_REQUEST['drive']==0)?'checked':''):''?>> -->
                          <select class="form-control col-md-7 col-xs-12" name="drive">
                            <option value="">Drive</option>
                            <option value="1">Yes</option>
                            <option value="0">No</option>
                          </select>
                        </div>
                        <div class="col-md-2">
                          <label for="first-name">License Category </label>
                          <select class="form-control col-md-7 col-xs-12" name="license_category">
                            <option value="">License Category</option>
                            <option value="ltv">LTV</option>
                            <option value="htv">HTV</option>
                          </select>
                        </div>
                      </div>
                      
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 ">
                          <button type="submit" name="submit" class="btn btn-success">Search</button>
                          <button type="submit" name="excel" class="btn btn-success">Excel</button>
                          <button type="submit" name="pdf" class="btn btn-success">PDF</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Applicants<small>All</small>
                      <!-- <a target="_blank" href="<?php //echo Yii::app()->baseUrl?>/registeration/excelreport" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php //echo Yii::app()->baseUrl?>/registeration/pdfreport" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp; -->
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="table-responsive">
                      <table id="datatable" class="table table-striped table-bordered datatable" >
                        <thead>
                          <tr class="headings">
                            <!-- <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th> -->
                            <th class="column-title">ID</th>
                            <th class="column-title">Name</th>
                            <th class="column-title">CNIC</th>
                            <th class="column-title">Category</th>
                            <th class="column-title">Mobile Number</th>
                            <th class="column-title">Block_2</th>
                            <th class="column-title">District</th>
                            <th class="column-title">Tehsil</th>
                            <th class="column-title">Village</th>
                            <th class="column-title">Applied_for</th>
                            <th class="column-title">Status</th>
                            <th class="column-title">Work Status</th>
                            <!-- <th class="column-title no-link last"><span class="nobr">Action</span> -->
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php if(@$applicants){foreach(@$applicants as $labor):?>
                            <tr class="even pointer">
                              <!-- <td class="a-center ">
                                <input type="checkbox" class="flat" name="id" value="<?php //echo $labor->id?>">
                              </td> -->
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->id?>"><?php echo $labor->id?></a></td>
                              <td class=" "><a href="<?php echo Yii::app()->baseUrl?>/labor/view/id/<?php echo $labor->id?>"><?php echo $labor->full_name?></a></td>
                              <td class=" "><?php echo $labor->cnic?></td>
                              <td class=" "><?php if($labor->category_id==1){ echo 'Skilled'; } if($labor->category_id==2){ echo 'Unskilled'; }?></td>
                              <td class=" "><?php echo $labor->mobile_number?></td>
                              <td class=" "><?php echo ($labor->block_2==1)?'Yes':'No'?></td>
                              <td class=" "><?php echo @$labor->district->name?></td>
                              <td class=" "><?php echo @$labor->tehsil->name?></td>
                              <td class=" "><?php echo @$labor->village->village?></td>
                              <td class=" "><?php echo $labor->designation?></td>
                              <td class=" "><?php if($labor->status==1){ echo '<span class="label label-success">Activated</span>'; } if($labor->status==0){ echo '<span class="label label-warning">De-activated</span><br/>'.$labor->remarks; } if($labor->status==5){ echo '<span class="label label-danger">Blacklisted</span><br/>'.$labor->remarks; }?></td>
                              <td class=" "><?php /*echo $this->Laborstatus($labor->id);*/echo ($this->Laborstatus($labor->id)==true)?'<span class="label label-info">'.$this->Laborwork($labor->id).'</span>':'<span class="label label-success">Available</span>' ?></td>
                            </tr>
                          <?php endforeach;}?>
                          
                        </tbody>
                      </table>
                    </div>

                  </div>
                </div>
              </div>
            </div>
        </div>