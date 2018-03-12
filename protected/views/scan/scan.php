<header class="scanHeader"> 
    <img src="<?php echo Yii::app()->baseUrl ?>/assets/print/images/logo.png" alt="img"/>
</header>
<div class="container">
    <div class="contentScan">
        <h3>Personal Information</h3>
        <ul>
            <li><label>Name:</label><p> <?php echo @$model->full_name ?></p></li>
            <li><label>Block-2:</label><p> <?php echo (@$model->block_2 == 1) ? 'Yes' : 'No' ?></p></li>
            <li><label>CNIC:</label><p> <?php echo @$model->cnic ?></p></li>
            <li><label>Address:</label><p> <?php echo @$model->village->village.', '.@$model->tehsil->name.', '.@$model->district->name?></p></li>
            <li><label>Driving License:</label><p> <?php if(@$model->drive==1){ echo (@$model->drivingLicense)?$model->drivingLicense[0]->driving_license_number:'No'; } else{ echo 'No';} ?></p></li>
            <li><label>Client:</label><p><?php echo ($this->Laborstatus($model->id) == true) ?$this->Laborwork($model->id):'-';?></p></li>
            <li><label>Status:</label>
                <p>
                    <?php 
                    if ($model->status == 1) {
                        echo 'Activated';
                    } if ($model->status == 0) {
                        echo 'Deactivated';
                    } if ($model->status == 5) {
                        echo 'Blacklisted';
                    }
                    ?>
                </p>
            </li>
        </ul>
    </div>
</div>