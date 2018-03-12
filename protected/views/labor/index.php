<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Table design <small>Custom design</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>

                  <div class="x_content">
                    <div class="table-responsive">
                      <table class="table table-striped jambo_table bulk_action">
                        <thead>
                          <tr class="headings">
                            <th>
                              <input type="checkbox" id="check-all" class="flat">
                            </th>
                            <th class="column-title">ID</th>
                            <th class="column-title">Name</th>
                            <th class="column-title">CNIC</th>
                            <th class="column-title">Category</th>
                            <th class="column-title">Mobile Number</th>
                            <th class="column-title">Form Status</th>
                            <th class="column-title">Work Status</th>
                            <th class="column-title no-link last"><span class="nobr">Action</span>
                            </th>
                            <th class="bulk-actions" colspan="7">
                              <a class="antoo" style="color:#fff; font-weight:500;">Bulk Actions ( <span class="action-cnt"> </span> ) <i class="fa fa-chevron-down"></i></a>
                            </th>
                          </tr>
                        </thead>

                        <tbody>
                          <?php foreach($labors as $labor):?>
                            <tr class="even pointer">
                              <td class="a-center ">
                                <input type="checkbox" class="flat" name="id" value="<?php echo $labor->id?>">
                              </td>
                              <td class=" "><?php echo $labor->id?></td>
                              <td class=" "><?php echo $labor->full_name?></td>
                              <td class=" "><?php echo $labor->cnic?></td>
                              <td class=" "><?php if($labor->category_id==1){ echo 'Skilled'; } if($labor->category_id==2){ echo 'Unskilled'; }?></td>
                              <td class=" "><?php echo $labor->mobile_number?></td>
                              <td class=" "><?php if($labor->status==0){ echo 'Non Verified'; } if($labor->status==1){ echo 'Verified'; }?></td>
                              <td class=" ">On duty</td>
                              <td class=" last"><a href="#">View</a>
                              </td>
                            </tr>
                          <?php endforeach;?>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>