

<div class="cardPrint card">
    <img class="cardBg" src="../../../assets/card/images/card_bg.png" alt=""/>
    <div class="cardData">
        <div class="logo">
            <h2>Khushaal Thar - ID # <span><?php echo @$model->id ?></span></h2>
            <img src="<?php echo Yii::app()->baseUrl ?>/assets/print/images/logo.png" alt="img"/>
        </div>
        <div class="profilePic">
            <img src="<?php echo (@$model->avatar == '') ? Yii::app()->baseUrl . '/assets/print/images/profilePic.jpg' : Yii::app()->baseUrl . '/uploads/' . @$model->avatar ?>" alt="img"/>
        </div>
        <div class="profileInfo">
            <div class="info">
                <label>Full Name پورو نالو</label>
                <p><?php echo @$model->full_name ?></p>
            </div>
            <div class="info">
                <label>Father's Name پيء جو نالو</label>
                <p><?php echo @$model->father_name ?></p>
            </div>
            <div class="info">
                <label>CNIC: سڃاڻپ ڪارڊ نمبر</label>
                <p><?php echo @$model->cnic ?></p>
            </div>
        </div>
    </div>
</div>

<div class="cardPrint card">
    <img class="cardBg" src="../../../assets/card/images/card_bg.png" alt=""/>
    <div class="cardData">
        <div class="qrCode center">
            <?php $link = 'https://khushaalthar.com/scan/index/id/' . $model->id . '?scan=1' ?>
            <img src="https://chart.googleapis.com/chart?chs=200x200&cht=qr&chl=<?php echo $link ?>&choe=UTF-8" class="qrcode"/>
        </div>
        <ul class="cardBackData">
            <li>District:<span> <?php echo @$model->district->name ?></span></li>
            <!-- <li>Tehsil:<span> <?php echo @$model->tehsil->name ?></span></li>
            <li>Village:<span> <?php echo @$model->village->village ?></span></li> 
            <li>Category:<span> <?php echo (@$model->category_id == 1) ? 'Skilled' : 'Unskilled' ?></span></li>-->
            <li>Mobile Number:<span> <?php
                    $m = explode(',', @$model->mobile_number);
                    echo @$m[0]
                    ?></span></li>       
        </ul>

    </div>
    <p class="ifFound">If found, please return to:<b><br/> Khushaal Thar, Site Office,<br/> Block II, Islamkot, Tharparkar. </b></p>
</div>

<script type="text/javascript">
    window.print();
</script>
