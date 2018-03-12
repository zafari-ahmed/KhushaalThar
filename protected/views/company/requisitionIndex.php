<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Client Companys' Requisitions
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/allrequisition/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
                      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/allrequisition/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
                    </h2>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table id="reqdatatable" class="table table-striped table-bordered" >
                        <thead>
                          <tr class="headings">
                            <!-- <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th> -->
                            <th class="column-title">ID</th>
                            <th class="column-title">Code</th>
                            <th class="column-title">Company Name</th>
                            <th class="column-title">Company Person</th>
                            <th class="column-title">Requisition Date</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($clientcompanyRequisitions as $requisition): $deo = CompanyPersons::model()->findByPk($requisition->person_id);?>
                            <tr class="even pointer">
                              <!-- <td class="a-center ">
                                <input type="checkbox" class="flat" name="id" value="<?php //echo $labor->id?>">
                              </td> -->
                              <td class=" "><?php echo $requisition->id?></td>
                              <td class=" "><?php echo $requisition->requisition_code?></td>
                              <td class=" "><?php echo ucfirst($requisition->company->company_name)?></td>
                              <td class=" "><?php echo ($deo)?ucfirst($deo->name):'-'?></td>
                              <td class=" "><?php echo date('d M,Y H:i',strtotime($requisition->createdOn))?></td>
                              <td class=" last">
                                
                                <!-- <a href="<?php echo Yii::app()->baseUrl?>/requisitions/viewreport/id/<?php echo $requisition->id?>/type/pdf/"><button type="button" class="btn btn-info btn-xs pull-right">PDF</button></a>&nbsp;
                                <a href="<?php echo Yii::app()->baseUrl?>/requisitions/viewreport/id/<?php echo $requisition->id?>/type/excel"><button type="button" class="btn btn-info btn-xs pull-right">Excel</button></a>&nbsp; -->
                                <a href="<?php echo Yii::app()->baseUrl?>/requisitions/view/id/<?php echo $requisition->id?>"><button type="button" class="btn btn-success btn-xs pull-right">View</button></a>&nbsp;
                              </td>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>