<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Dismiss/Reject</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dismiss/Reject<small>Add</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" action="<?php echo Yii::app()->baseUrl?>/settings/savereject">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Reason<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text"  name="reason"  id="first-name" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo @$status->reason?>">
                          <input type="hidden"  name="id" value="<?php echo @$status->id?>">
                        </div>
                      </div>
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="submit" class="btn btn-primary">Cancel</button>
                          <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
            <?php if(!@$status->id){?>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dismiss/Reject Status<small>All</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Reason</th>
                          <th>Action</th>
                          <!-- <th>Last Name</th>
                          <th>Username</th> -->
                        </tr>
                      </thead>
                      <tbody>
                      	<?php foreach($status as $v):?>
                      		<tr>
	                          <th scope="row"><?php echo $v->id?></th>
	                          <td><?php echo $v->reason?></td>
                            <td>
                              <a href="<?php echo Yii::app()->baseUrl?>/settings/reject/id/<?php echo $v->id?>"><button type="button" class="btn btn-success btn-xs">Edit</button></a>
                              <a href="#"><button type="button" class="btn btn-danger btn-xs deletereject" rel="<?php echo $v->id?>">Delete</button></a>
                            </td>
	                        </tr>
                      	<?php endforeach;?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
            <?php } ?>
        </div>