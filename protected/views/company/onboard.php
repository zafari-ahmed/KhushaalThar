<?php $model = ClientCompanies::model()->findByPk($company_id); ?>

<div class="">
            <div class="page-title"></div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Currently<small>on board</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped" id="reqdatatable">
                      <thead>
                        <tr>
                          <th>ID</th>
                          <th>Name</th>
                          <th>Father Name</th>
                          <th>CNIC</th>
                          <th>Mobile Number</th>
                          <th>District</th>
                          <th>Work Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        if($model){
							foreach($model->companyRequisitions as $cr){
								if($cr->clientCompanyRequisitionDetails){
									foreach($cr->clientCompanyRequisitionDetails as $crd){
										if($crd->laborRequisitions){
											foreach($crd->laborRequisitions as $lr){ ?>
											<tr>
												<td><?php echo @$lr->labour_id?></td>
												<td><?php echo @$lr->labour->full_name?></td>
												<td><?php echo @$lr->labour->father_name?></td>
												<td><?php echo @$lr->labour->cnic?></td>
												<td><?php echo @$lr->labour->mobile_number?></td>
												<td><?php echo @$lr->labour->district->name?></td>
												<td><span class="label label-success"><?php echo @$lr->requisition->requisition->requisition_code?></span></td>
											</tr>
											<?php }
										}
									}
								}
							}
						}
                        ?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
            </div>
        </div>