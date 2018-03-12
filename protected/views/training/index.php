<div class="col-md-12 col-sm-12 col-xs-12">
<div class="x_panel">
  <div class="x_title">
    <h2>Trainings<small>All</small>
      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/alltraining/type/excel" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">Excel Report</button></a>&nbsp;
      <a target="_blank" href="<?php echo Yii::app()->baseUrl?>/report/alltraining/type/pdf" class="pull-right no-print"><button type="button" class="btn btn-info btn-xs">PDF Report</button></a>&nbsp;
    </h2>
    <div class="clearfix"></div>
  </div>
  <div class="x_content">

    <table class="table table-striped" id="reqdatatable">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Type</th>
          <th>Batch No.</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Status</th>
          <th>Action</th>
          <!-- <th>Last Name</th>
          <th>Username</th> -->
        </tr>
      </thead>
      <tbody>
      	<?php foreach($trainings as $v):?>
      		<tr>
              <th scope="row"><a  href="<?php echo Yii::app()->baseUrl?>/training/addapplicant/id/<?php echo $v->id?>"><?php echo $v->id?></a></th>
              <td><a href="<?php echo Yii::app()->baseUrl?>/training/addapplicant/id/<?php echo $v->id?>"><?php echo ucfirst($v->institute_name)?></a></td>
              <td><?php echo ucfirst($v->training_type)?></td>
              <td><?php echo $v->batch_no?></td>
              <td><?php echo $v->start_date?></td>
              <td><?php echo $v->end_date?></td>
              <td class=" "><?php if($v->status==1){ echo '<span class="label label-danger">Closed</span>'; } if($v->status==0){ echo '<span class="label label-success">Open</span>'; }?></td>
              <td><a href="<?php echo Yii::app()->baseUrl?>/training/addapplicant/id/<?php echo $v->id?>"><button type="button" class="btn btn-info btn-xs">View</button></a></td>
            </tr>
      	<?php endforeach;?>
        
      </tbody>
    </table>

  </div>
</div>
</div>