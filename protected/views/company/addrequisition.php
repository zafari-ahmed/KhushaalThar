<div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Companies Requisition</h3>
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
                    <h2>Company<small>Add Requisition</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    <form id="clientreqform" class="form-horizontal form-label-left">

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Requisition Code<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="client_code" name="requisition_code" readonly value="<?php echo @$hash?>" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>
                      <?php if(@Yii::app()->session['userModel']['user']['userType']=='company'){?>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Company Person<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <select class="form-control col-md-7 col-xs-12 select2_single" tabindex="-1" name="deo_id">
                          <option value="">Please Select Person</option>
                          <?php foreach($deo as $d):?>
                            <option value="<?php echo $d->id?>"><?php echo $d->name?></option>
                          <?php endforeach;?>
                        </select>
                        </div>
                      </div>
                      <?php } else{?>
                      <input type="hidden" name="deo_id" readonly value="<?php echo Yii::app()->session['userModel']['user']['id']?>">
                      <?php }?>
                      <hr/>
                      <div class="form-group">
                        <button type="button" class="btn btn-success btn-xs pull-right" id="addnewreq">Add New</button>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <div id="gender" class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="type[0]" value="1" data-parsley-multiple="gender" data-parsley-id="1"> &nbsp; Skilled &nbsp;
                            </label>
                            <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                              <input type="radio" name="type[0]" value="2" data-parsley-multiple="gender" data-parsley-id="2"> Un-Skilled
                            </label>
                          </div>
                        </div>
                      </div>
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Skilled Required
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="" name="skilled[]" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Head Count
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="number" id="company_email" name="head[]" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                      </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date Required
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="company_email" name="date_required[]" required="required" class="ddate form-control col-md-7 col-xs-12" value="<?php echo date('Y-m-d')?>"> 
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date Till
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="company_email" name="date_till[]" required="required" class="ddate form-control col-md-7 col-xs-12" value="<?php echo date('Y-m-d')?>">
                        </div>
                      </div>
                      <div id="reqBox"></div>
                      
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                          <button type="button" class="btn btn-primary">Cancel</button>
                          <button type="button" class="btn btn-success" id="clientreqBtn">Submit</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
        </div>


<div class="hide" id="newreqBox">
<div class="form-group">

  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Skilled Required
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="" name="skilled[]" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Head Count
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="company_email" name="head[]" required="required" class="form-control col-md-7 col-xs-12">
  </div>
</div>

<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date Required
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="company_email" name="date_required[]" required="required" class="ddate form-control col-md-7 col-xs-12">
  </div>
</div>
<div class="form-group">
  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Date Till
  </label>
  <div class="col-md-6 col-sm-6 col-xs-12">
    <input type="text" id="company_email" name="date_till[]" required="required" class="ddate  form-control col-md-7 col-xs-12">
  </div>
</div>
</div>