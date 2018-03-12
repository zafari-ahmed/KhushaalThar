<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Company Person's</h3>
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
                    <h2>Company Persons<small>All</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped" id="reqdatatable">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Name</th>
                          <th>Email Address</th>
                          <!-- <th>Code</th> -->
                          <th>CNIC</th>
                          <th>Designation</th>
                          <th>Mobile Number</th>
                          <th>Status</th>
                          <!--<th>Action</th>
                          <th>Username</th> -->
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($persons as $v):?>
                      		<tr>
	                          <th scope="row"><?php echo $v->id?></th>
	                          <td><?php echo $v->name?></td>
                            <td><?php echo $v->email_address?></td>
                            <!-- <td><?php //echo $v->code?></td> -->
                            <td><?php echo $v->cnic?></td>
                            <td><?php echo $v->designation?></td>
                            <td><?php echo $v->mobile_number?></td>
                            <td><?php echo ($v->status==1)?'<span class="label label-success">Active</span>':'<span class="label label-success">In-active</span>'?></td>
                            
	                        </tr>
                      	<?php endforeach;?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
        </div>

        
