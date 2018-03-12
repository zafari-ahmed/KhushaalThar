<div class="">
            <div class="page-title"></div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Deo's<small>All</small>
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/alldeo/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/alldeo/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped" id="reqdatatable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email Address</th>
                          <th>CNIC</th>
                          <th>Designation</th>
                          <th>Mobile Number</th>
                          <th>Type</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($deos as $v):?>
                      		<tr>
	                          <th scope="row"><?php echo $v->id?></th>
	                          <td><?php echo $v->name?></td>
                            <td><?php echo $v->email_address?></td>
                            <td><?php echo $v->cnic?></td>
                            <td><?php echo $v->designation?></td>
                            <td><?php echo $v->mobile_number?></td>
                            <td><?php echo $v->userType->user_type?></td>
                            <td><?php echo ($v->status==1)?'<span class="label label-success">Active</span>':'<span class="label label-danger">In-active</span>'?></td>
                            <td>
                              <a href="<?php echo Yii::app()->baseUrl?>/deo/edit/<?php echo $v->id?>"><button type="button" class="btn btn-success btn-xs">Edit</button></a>
                              <a href="#"><button type="button" class="btn btn-<?php echo ($v->status==1)?'danger':'success'?> btn-xs deodeactivate" rel="<?php echo $v->id?>"><?php echo ($v->status==1)?'Deactivate':'Activate'?></button></a>
                            </td>
	                        </tr>
                      	<?php endforeach;?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
        </div>