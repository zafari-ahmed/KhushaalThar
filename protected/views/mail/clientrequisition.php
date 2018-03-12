<div class="email-header" style="background-color: #F5F6F7;border-radius: 4px 4px 0px 0px;border: 1px solid #dadedf;text-align:center">
    <img src="https://khushaalthar.com/assets/images/KTLogo.png" alt="img" style="width: 100px;padding: 20px;">
</div>
<div class="email-content" style="border: 1px solid #dadedf;background: #fff;padding: 20px;border-radius: 0px 0px 4px 4px;border-top: 0px!important;">
        <h3 style="color: #666;">Dear <?php echo @$model[0]->requisition->person->name?> [<?php echo @$model[0]->requisition->company->company_name?>],</h3>
        <p style="color: #666;">Your requisition has been received, thank you for trusting us with your manpower requirements!</p>
        <p style="color: #666;">As you know your requisitions has been assigned a reference code <b><?php echo @$model[0]->requisition->requisition_code?></b>,  you can refer to same for necessary tracking or follow-up.</p>
		<p style="color: #666;">You will be notified about assignment of required manpower in due course of time</p>
		<p style="color: #666;"><b style="color: #666;">Regards,<br/>Team Khushaal Thar</b></p>
</div>