<div class="email-header" style="background-color: #F5F6F7;border-radius: 4px 4px 0px 0px;border: 1px solid #dadedf;text-align:center">
    <img src="https://khushaalthar.com/assets/images/KTLogo.png" alt="img" style="width: 100px;padding: 20px;">
</div>
<div class="email-content" style="border: 1px solid #dadedf;background: #fff;padding: 20px;border-radius: 0px 0px 4px 4px;border-top: 0px!important;">
        <h3 style="color: #666;">Dear KT Admin,</h3>
        <p style="color: #666;">This is to inform you that <b><?php echo @$model[0]->requisition->company->company_name?></b> has raised a new requisition <b><?php echo @$model[0]->requisition->requisition_code?></b> on <b><?php echo date('m/d/Y',strtotime(@$model[0]->requisition->createdOn))?></b> as per following details.</p>
		<?php foreach($model as $m):?>

			<p style="color: #666;">Skill required: <?php echo @$m->skill?></p>
			<p style="color: #666;">Number of manpower: <?php echo @$m->count?></p>
			<p style="color: #666;">From Date: <?php echo date('m/d/Y',strtotime(@$m->date_from))?></p>
			<p style="color: #666;">To Date: <?php echo date('m/d/Y',strtotime(@$m->date_to))?></p>
			<hr/>
		<?php endforeach;?>
		
        <p style="color: #666;"><b style="color: #666;">Regards,<br/>Team Khushaal Thar</b></p>
</div>