<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Training Report</h3>
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
                          <div class="col-md-2">
                            <label for="first-name">Institute Name</label>
                            <input type="text" id="institute_name" name="institute_name" class="form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['institute_name'])?$_REQUEST['institute_name']:''?>">
                          </div>
                          <div class="col-md-2">
                            <label for="first-name">Type</label>
                            <input type="text" id="skill" name="type" class="form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['type'])?$_REQUEST['type']:''?>">
                          </div>
                          <div class="col-md-2">
                            <label for="first-name">Batch</label>
                            <input type="text" id="skill" name="batch" class="form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['batch'])?$_REQUEST['batch']:''?>">
                          </div>
                          <div class="col-md-2 col-sm-3 col-xs-12">
                            <label for="last-name">Date</label>
                            <input type="text" id="end_date" name="start_date" class="ddate form-control col-md-7 col-xs-12" value="<?php echo isset($_REQUEST['start_date'])?$_REQUEST['start_date']:''?>">
                          </div>
                          <div class="col-md-2 col-sm-3 col-xs-12">
                            <label for="last-name">End Date</label>
                            <input type="text" id="end_date" name="end_date" class="ddate form-control col-md-7 col-xs-12 " value="<?php echo isset($_REQUEST['end_date'])?$_REQUEST['end_date']:''?>">
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
                    <h2>Training<small>All</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <div class="table-responsive">
                      <table class="table table-striped">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Name</th>
                              <th>Type</th>
                              <th>Batch No.</th>
                              <th>Start Date</th>
                              <th>End Date</th>
                              <th>Action</th>
                              <!-- <th>Last Name</th>
                              <th>Username</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <?php if(@$trainings){foreach($trainings as $v):?>
                              <tr>
                                  <th scope="row"><a  href="<?php echo Yii::app()->baseUrl?>/training/addapplicant/id/<?php echo $v->id?>"><?php echo $v->id?></a></th>
                                  <td><a href="<?php echo Yii::app()->baseUrl?>/training/addapplicant/id/<?php echo $v->id?>"><?php echo ucfirst($v->institute_name)?></a></td>
                                  <td><?php echo ucfirst($v->training_type)?></td>
                                  <td><?php echo $v->batch_no?></td>
                                  <td><?php echo $v->start_date?></td>
                                  <td><?php echo $v->end_date?></td>
                                  <td><a href="<?php echo Yii::app()->baseUrl?>/training/addapplicant/id/<?php echo $v->id?>"><button type="button" class="btn btn-info btn-xs">View</button></a></td>
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