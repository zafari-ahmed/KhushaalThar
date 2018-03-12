<div class="email-header" style="background-color: #F5F6F7;border-radius: 4px 4px 0px 0px;border: 1px solid #dadedf;text-align:center">
    <img src="https://khushaalthar.com/assets/images/KTLogo.png" alt="img" style="width: 100px;padding: 20px;">
</div>
<div class="email-content" style="border: 1px solid #dadedf;background: #fff;padding: 20px;border-radius: 0px 0px 4px 4px;border-top: 0px!important;">
        <h3 style="color: #666;">Dear KT Admin,</h3>
        <p style="color: #666;">Here is the status of manpower assigned to <b><?php echo @$model->requisition->requisition_code?></b> for <?php echo @$model->requisition->person->name?></b>, <?php echo @$model->requisition->company->company_name?></b> on <b><?php echo date('m/d/Y',strtotime(@$model->requisition->createdOn))?></b>.</p>
		<p style="color: #666;"><?php echo number_format(@$model->count)?> = Total number of manpower required against <?php echo @$model->requisition->requisition_code?></p>
		<p style="color: #666;"><?php echo number_format(LaborRequisitions::model()->count("requisition_id = $model->id"))?> = Total number of manpower assigned against <?php echo @$model->requisition->requisition_code?></p>
		<p style="color: #666;"><?php echo number_format(LaborRequisitions::model()->count("requisition_id = $model->id AND status = 1"))?> = Total number of acceptance</p>
		<p style="color: #666;"><?php echo number_format(LaborRequisitions::model()->count("requisition_id = $model->id AND status = 2"))?> = Total number of rejected</p>
		<p style="color: #666;"><?php echo number_format(LaborRequisitions::model()->count("requisition_id = $model->id AND status = 0"))?> = Total number of pending</p>
		
        <p style="color: #666;"><b style="color: #666;">Regards,<br/>Team Khushaal Thar</b></p>
</div>