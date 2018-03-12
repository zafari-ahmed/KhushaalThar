<div class="">
            <div class="page-title"></div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Requisition<small>List</small></h2>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">

                    <table class="table table-striped" id="reqdatatable">
                      <thead>
                        <tr>
                            <th>#</th>
                            <th>Requisition Code</th>
                            <th>Type</th>
                            <th>Skill</th>
                            <th>HeadCount</th>
                            <th>Assigned</th>
                            <th>Date From</th>
                            <th>Date End</th>
                            <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                      <?php foreach($requisitions as $ind=>$req):?>
                        <tr>
                          <td><?php echo @$ind+1?></td>
                            <td><?php echo @$req->requisition->requisition_code?></td>
                            <td><?php echo (@$req->type==1)?'Skilled':'Unskilled'?></td>
                            <td><?php echo @$req->skill?></td>
                            <td><?php echo @$req->count?></td>
                            <td><?php echo @$req->laborRequisitionsCount?></td>
                            <td><?php echo date('d M,Y',strtotime($req->date_from))?></td>
                            <td><?php echo date('d M,Y',strtotime($req->date_to))?></td>
                            <td>
                              <?php //echo (@$reqodel->status==1)?'<span class="label label-success">Approved</span>':'<span class="label label-info">Pending</span>'?>
                              <?php
                              if(@$req->status==0){
                                echo '<span class="label label-info">Pending</span>';
                              }
                              if(@$req->status==1){
                                echo '<span class="label label-success">Open</span>';
                              }
                              if(@$req->status==2){
                                echo '<span class="label label-danger">Closed</span>';
                              }
                              if(@$req->status==3){
                                echo '<span class="label label-warning">Under discussion</span>';
                              }
                              if(@$req->status==4){
                                echo '<span class="label label-primary">In Process</span>';
                              }
                              if(@$req->status==5){
                                echo '<span class="label label-danger">Rejected</span>';
                              }

                              ?>
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