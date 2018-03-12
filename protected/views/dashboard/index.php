<!-- top tiles -->

<?php if (Yii::app()->session['userModel']['user']['userType'] == 'deo' /*&& Yii::app()->session['userModel']['user']['id'] == 1*/) { ?>
    <div class="row tile_count">
        <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Registered Applicants</span>
            <div class="count marginal-10"><?php echo number_format(Labours::model()->count()) ?></div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
            <span class="count_top bold"><center>Thari Applicants</center></span>
            <div class="count"><?php //echo number_format(Labours::model()->count('district_id=1'))    ?></div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 center">
                <span class="count_top"  style="font-size:14px"><i class="fa fa-user"></i> Skilled</span>
                <div class="count"  style="font-size:30px"><?php echo number_format(Labours::model()->count('category_id=1 AND district_id=1')) ?></div>
            </div>       
            <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-0 col-sm-6 col-xs-6 center">
                <span class="count_top"  style="font-size:14px"><i class="fa fa-user"></i> Unskilled</span>
                <div class="count"  style="font-size:30px"><?php echo number_format(Labours::model()->count('category_id=2 AND district_id=1')) ?></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
            <span class="count_top bold"><center>Non-Thari Applicants</center></span>
            <div class="count green"><?php //echo number_format(Labours::model()->count('district_id!=1'))    ?></div> 
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 center">
                <span class="count_top" style="font-size:14px"><i class="fa fa-user"></i> Skilled</span>
                <div class="count" style="font-size:30px"><?php echo number_format(Labours::model()->count('category_id=1 AND district_id!=1')) ?></div>
            </div>
            <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-0 col-sm-6 col-xs-6 center">
                <span class="count_top"  style="font-size:14px"><i class="fa fa-user"></i> Unskilled</span>
                <div class="count"  style="font-size:30px"><?php echo number_format(Labours::model()->count('category_id=2 AND district_id!=1')) ?></div>
            </div>     
        </div>
        
        <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
            <a href="<?php echo Yii::app()->baseUrl?>/requisitions/Requisitionbystatus/status/1"><span class="count_top"><i class="fa fa-user"></i> Open Requisitions</span></a>
            <div class="count marginal-10"><?php echo number_format(ClientCompanyRequisitionDetails::model()->count('status=1')) ?></div>
        </div>
    </div>
    <hr/>
    <div class="row tile_count">
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Currently Onboard</span>
            <!-- <div class="count"><?php echo number_format(@$this->totalHired2()); ?></div> -->
            <div class="count"><?php echo number_format(LaborRequisitions::model()->count('status=1')) ?></div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
            <span class="count_top bold"><center>Thari Applicants</center></span>
            <div class="count"></div>
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 center">
                <span class="count_top"  style="font-size:14px"><i class="fa fa-user"></i> Skilled</span>
                <!-- <div class="count"  style="font-size:30px"><?php //echo (@$this->totalHired2detail(1,1))?></div> -->
                <div class="count"  style="font-size:30px"><?php echo number_format(LaborRequisitions::model()->with('labour')->count('t.status=1 AND labour.category_id=1 AND labour.district_id=1')) ?></div>
            </div>       
            <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-0 col-sm-6 col-xs-6 center">
                <span class="count_top"  style="font-size:14px"><i class="fa fa-user"></i> Unskilled</span>
                <!-- <div class="count"  style="font-size:30px"><?php //echo (@$this->totalHired2detail(1,2))?></div> -->
                <div class="count"  style="font-size:30px"><?php echo number_format(LaborRequisitions::model()->with('labour')->count('t.status=1 AND labour.category_id=2 AND labour.district_id=1')) ?></div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
            <span class="count_top bold"><center>Non-Thari Applicants</center></span>
            <div class="count green"></div> 
            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 center">
                <span class="count_top" style="font-size:14px"><i class="fa fa-user"></i> Skilled</span>
                <!-- <div class="count"  style="font-size:30px"><?php //echo (@$this->totalHired2detail(2,1))?></div> -->
                <div class="count"  style="font-size:30px"><?php echo number_format(LaborRequisitions::model()->with('labour')->count('t.status=1 AND labour.category_id=1 AND labour.district_id!=1')) ?></div>
            </div>
            <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-0 col-sm-6 col-xs-6 center">
                <span class="count_top"  style="font-size:14px"><i class="fa fa-user"></i> Unskilled</span>
                <!-- <div class="count"  style="font-size:30px"><?php //echo (@$this->totalHired2detail(2,2))?></div> -->
                <div class="count"  style="font-size:30px"><?php echo number_format(LaborRequisitions::model()->with('labour')->count('t.status=1 AND labour.category_id=2 AND labour.district_id!=1')) ?></div>
            </div>     
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 tile_stats_count">
            <a href="<?php echo Yii::app()->baseUrl?>/requisitions/Requisitionbystatus/status/2"><span class="count_top"><i class="fa fa-user"></i> Close Requisitions</span></a>
            <div class="count marginal-10"><?php echo number_format(ClientCompanyRequisitionDetails::model()->count('status=2')) ?></div>
        </div>
    </div>
<?php } ?>
<?php
if (Yii::app()->session['userModel']['user']['userType'] == 'person') {
    //$id = Yii::app()->session['userModel']['user']['id'];
    $person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);
    $id = $person->company_id;
    $criteria = new CDbCriteria;
    $criteria->addCondition("requisition.company_id = {$id}");
    $criteria->addCondition("t.status = '1'");
    $openReq = ClientCompanyRequisitionDetails::model()->with('requisition')->count($criteria);
    $criteria = new CDbCriteria;
    $criteria->addCondition("requisition.company_id = {$id}");
    $criteria->addCondition("t.status = '2'");
    $closeReq = ClientCompanyRequisitionDetails::model()->with('requisition')->count($criteria);

    ?>
    <div class="row tile_count">
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Currently Onboard</span>
            <div class="count"><?php echo number_format($this->totalHired($id)); ?></div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Open Requisitions</span>
            <div class="count"><?php echo number_format($openReq) ?></div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-clock-o"></i> Closed Requisitions</span>
            <div class="count"><?php echo number_format($closeReq) ?></div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
            <span class="count_top"><i class="fa fa-user"></i> Client Compnay Person's</span>
            <div class="count green"><?php echo number_format(CompanyPersons::model()->count("company_id=$id")) ?></div>      
        </div>
    </div>
    <?php
}

if (@$_GET['viewmonth']) {
    $month = $_GET['viewmonth'];
} else {
    $month = date('m');
}
?>
<!-- /top tiles -->

<?php if (Yii::app()->session['userModel']['user']['userType'] == 'deo' /*&& Yii::app()->session['userModel']['user']['id'] == 1*/) { ?>
    <?php if(Yii::app()->session['userModel']['user']['user_type_id'] == 1){?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="dashboard_graph">

                <div class="row x_title">
                    <div class="row">
                        <div class="col-md-12 no-float">
                            <h3>Thari & Non-Thari Applicants</h3>
                            <div class="pull-right margin-3">
                                <span class="notifyThari"> Thari</span>
                                <span class="notifyNonThari"> Non-Thari</span>
                            </div>
                            <div class="pull-right">
                                <select class="form-control" name="graph_month" id="graph_month">
                                    <option value="01" <?php echo (@$month == 01) ? 'selected' : '' ?>>January</option>
                                    <option value="02" <?php echo (@$month == 02) ? 'selected' : '' ?>>Febuary</option>
                                    <option value="03" <?php echo (@$month == 03) ? 'selected' : '' ?>>March</option>
                                    <option value="04" <?php echo (@$month == 04) ? 'selected' : '' ?>>April</option>
                                    <option value="05" <?php echo (@$month == 05) ? 'selected' : '' ?>>May</option>
                                    <option value="06" <?php echo (@$month == 06) ? 'selected' : '' ?>>June</option>
                                    <option value="07" <?php echo (@$month == 07) ? 'selected' : '' ?>>July</option>
                                    <option value="08" <?php echo (@$month == 08) ? 'selected' : '' ?>>August</option>
                                    <option value="09" <?php echo (@$month == 09) ? 'selected' : '' ?>>September</option>
                                    <option value="10" <?php echo (@$month == 10) ? 'selected' : '' ?>>October</option>
                                    <option value="11" <?php echo (@$month == 11) ? 'selected' : '' ?>>November</option>
                                    <option value="12" <?php echo (@$month == 12) ? 'selected' : '' ?>>December</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 col-sm-12 col-xs-12">

                    <div style="width: 100%;">
                        <div id="canvas_dahs" class="demo-placeholder" style="width: 100%; height:270px;"></div>
                    </div>
                    <!-- <div id="chart_div" style="width: 100%; height: 500px;"></div> -->
                </div>

                <div class="clearfix"></div>
            </div>
        </div>

    </div>
    <br />
    <?php }?>

    <div class="row hide">


        

        


        

    </div>


    <div class="row">
        <?php if(Yii::app()->session['userModel']['user']['user_type_id'] == 1){?>
        <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Client Company Requisitions'</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="dashboard-widget-content">
                        <?php
                        $requisition = ClientCompanyRequisitions::model()->findAll(array(
                            'order' => "id DESC",
                            'limit' => 5,
                        ));
                        ?>
                        <ul class="list-unstyled timeline widget">
                            <?php foreach ($requisition as $req): ?>
                                <li>
                                    <div class="block">
                                        <div class="block_content">
                                            <h2 class="title">
                                                <a href="<?php echo Yii::app()->baseUrl ?>/requisitions/view/id/<?php echo @$req->id ?>"><?php echo @$req->requisition_code ?></a>
                                            </h2>
                                            <div class="byline">
                                                <span><?php echo date('d M,Y H:i', strtotime(@$req->createdOn)) ?></span> by <a><?php echo @$req->person->name . ' from ' . @$req->company->company_name ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>


        <!-- Start to do list -->
        <div class="col-md-8 col-sm-8 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Trainings</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    $trainings = Trainings::model()->findAll(array(
                        'order' => "id DESC",
                    ));
                    ?>
                    <div class="">
                        <ul class="to_do">
                            <?php foreach (@$trainings as $noti): $st = (date('Y-m-d') >= $noti->start_date) ? 'Started' : 'Starting' ?>
                                <li>
                                  <a href="<?php echo Yii::app()->baseUrl ?>/training/addapplicant/id/<?php echo $noti->id ?>"><p><!-- <input type="checkbox" class="flat"> --> <?php echo ucfirst($noti->training_type) . ' @ ' . $noti->institute_name . ' ' . $st . '  from ' . date('d M, o', strtotime($noti->start_date)) ?></p></a>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php
        if (@$_GET['notification_date']) {
            $DD = new DateTime($_GET['notification_date']);
            $date = $DD->format('Y-m-d');
        } else {
            $date = date('Y-m-d');
        }
        ?>
        <div class="col-md-12 col-sm-8 col-xs-12">
            <div class="x_panel notificationPanel">
                <div class="x_title">
                    <h2 style="width:100%">Notifications
                        <div class="pull-right">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label >Notification Date</label>
                                    <input type="text" name="notification_date" id="notification_date" class="noti form-control col-md-7 col-xs-12" value="<?php echo @$date ?>">
                                </div>
                            </div>
                        </div>
                    </h2>

                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <?php
                    $notifications = RequisitionNotifications::model()->findAll(array(
                        'condition' => "createdOn LIKE '%$date%'",
                        'order' => "id DESC",
                    ));
                    ?>
                    <div class="">
                        <ul class="to_do">
                            <?php foreach (@$notifications as $noti): ?>
                                <li>
                                  <a href="<?php echo $noti->link//$this->notiLink($noti->requisition_id); ?>"><p><!-- <input type="checkbox" class="flat"> --> <?php echo $noti->text ?></p></a>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else{?>
<?php
if (@$_GET['notification_date']) {
    $DD = new DateTime($_GET['notification_date']);
    $date = $DD->format('Y-m-d');
} else {
    $date = date('Y-m-d');
}
$person = CompanyPersons::model()->findByPk(Yii::app()->session['userModel']['user']['id']);

?>
<div class="col-md-12 col-sm-8 col-xs-12">
    <div class="x_panel">
        <div class="x_title">
            <h2 style="width:100%">Notifications
                <div class="pull-right">
                    <div class="form-group">
                        <div class="col-md-6">
                            <label >Notification Date</label>
                            <input type="text" name="notification_date" id="notification_date" class="noti form-control col-md-7 col-xs-12" value="<?php echo @$date ?>">
                        </div>
                    </div>
                </div>
            </h2>

            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <?php
            $notifications = RequisitionNotifications::model()->findAll(array(
                'condition' => "company_id =:company AND createdOn LIKE '%$date%'",
                'params'=>array(':company'=>@$person->company_id),
                'order' => "id DESC",
            ));
            ?>
            <div class="">
                <ul class="to_do">
                    <?php foreach (@$notifications as $noti): ?>
                        <li>
                          <a href="<?php echo $noti->link//$this->notiLink($noti->requisition_id); ?>"><p><!-- <input type="checkbox" class="flat"> --> <?php echo $noti->text ?></p></a>
                        </li>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
    </div>
</div>
<?php } ?>
</div>
</div>
