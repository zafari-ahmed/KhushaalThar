<div class="email-header" style="background-color: #F5F6F7;border-radius: 4px 4px 0px 0px;border: 1px solid #dadedf;text-align:center">
    <img src="https://khushaalthar.com/assets/images/KTLogo.png" alt="img" style="width: 100px;padding: 20px;">
</div>
<div class="email-content" style="border: 1px solid #dadedf;background: #fff;padding: 20px;border-radius: 0px 0px 4px 4px;border-top: 0px!important;">
        <h3 style="color: #666;">Dear All Users, [<?php echo @$model[0]->requisition->company->company_name?>]</h3>
        <p style="color: #666;">The requisition number <b><?php echo @$model[0]->requisition->requisition_code?></b> raised by <b><?php echo @$model[0]->requisition->person->name?></b> has been <b><?php echo @$status?></b> required manpower. The manpower will be made available as per defined procedure and schedule.</p>
		<p style="color: #666;">You are requested to visit software portal page to acknowledge the reception and acceptance of manpower once taken onboard.</p>
		<p style="color: #666;">Its been a pleasure providing services to you, looking forward for a long lasting relationship!</p>
		<p style="color: #666;"><b style="color: #666;">Regards,<br/>Team Khushaal Thar</b></p>
</div>