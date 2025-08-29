<?php
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT c.*,b.name as brand, cc.name as car_type,b.image_path as brand_img FROM `car_list` c inner join brand_list b on b.id = c.brand_id inner join category_list cc on cc.id = c.category_id where c.id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
    if(is_null($date_updated))
    $date_updated = strtotime($date_created);
    else
    $date_updated = strtotime($date_updated);
}
?>
<style>
    #car-cover-view{
        object-fit:scale-down;
        object-position:center center;
        height:35vh;
        width:50vw;
    }
    #brand-img{
        height:50px;
        width:50px;
        object-fit: scale-down;
        object-position:center center;
        border-radius:50% 50%
    }
    .inquiry-avatar{
        object-fit:cover;
        object-position:center center;
        width:3em;
        height:3em;
        border-radius:50% 50%
    }
    .inquiry-item .col-auto.flex-grow-1{
        max-width:calc(100% - 4em);
    }
</style>
<div class="py-3">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h5 class="card-title">Car Details</h5>
            <div class="card-tools">
                <button class="btn-primary" type="button" onclick="location.replace(document.referrer)"><i class="fa fa-angle-left"></i> Back</button>
            </div>
        </div>
        <div class="card-body">
            <div class="container-fluid">
                <div class="row justify-content-center align-items-end">
                    <div class="col-md-4 text-center">
                        <img src="<?= validate_image(isset($id) ? "uploads/banners/car-{$id}.png?v={$date_updated}" :'') ?>" alt="" id="car-cover-view" class="img-thumbnail bg-dark">
                    </div>
                    <div class="col-md-8">
                        <h2 class='text-purple'><b><?= isset($product_title) ? $product_title : "" ?></b></h2>
                        <hr>
                        <div class="row justify-content-between align-items-top">
                            <div class="col-auto">
                                <div class="d-flex align-items-center">
                                    <span>
                                        <img src="<?= validate_image(isset($brand_img) ? $brand_img : "") ?>" alt="Author Image" id="brand-img" class="img-thumbail border">
                                    </span>
                                    <span class="mx-2 text-muted"><?= isset($brand) ? $brand : "N/A" ?></span>
                                </div>
                            </div>
                            <div class="col-auto">
                                <span class="text-muted">
                                    <i class="fa fa-th-list"></i> <?= $car_type ?>
                                </span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <span class="text-muted">
                                    <i class="fa fa-tags"></i> <?= number_format($price,2) ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row py-3">
                    <div class="col-md-6">
                        <dl>
                            <dt class="text-muted">Model</dt>
                            <dd class="pl-4"><?= isset($model) ? $model : "" ?></dd>
                            <dt class="text-muted">Year</dt>
                            <dd class="pl-4"><?= isset($year) ? $year : "" ?></dd>
                            <dt class="text-muted">Engine</dt>
                            <dd class="pl-4"><?= isset($engine) ? $engine : "" ?></dd>
                        </dl>
                    </div>
                    <div class="col-md-6">
                        <dl>
                            <dt class="text-muted">Fuel</dt>
                            <dd class="pl-4"><?= isset($fuel) ? $fuel : "" ?></dd>
                            <dt class="text-muted">Color</dt>
                            <dd class="pl-4"><?= isset($color) ? $color : "" ?></dd>
                            <dt class="text-muted">Mileage</dt>
                            <dd class="pl-4"><?= isset($mileage) ? number_format($mileage) : "" ?></dd>
                        </dl>
                    </div>
                </div>
                <hr>
                <div class="row py-3">
                    <div class="col-md-12">
                        <div class="text-muted">Description</div>
                        <div><?= isset($description) ? html_entity_decode($description) : "" ?></div>
                    </div>
                </div>
                <hr>
                <div class="row py-3">
                    <div class="col-md-12">
                        <div class="text-muted">Condition</div>
                        <div><?= isset($condition) ? html_entity_decode($condition) : "" ?></div>
                    </div>
                </div>
                <hr>
                <div class="row py-3">
                    <div class="col-md-12">
                        <div class="text-muted">Features</div>
                        <div><?= isset($features) ? html_entity_decode($features) : "" ?></div>
                    </div>
                </div>
                <hr>
                <div class="row py-3">
                    <div class="col-md-12">
                        <div class="text-muted">Other Images</div>
                    </div>
                </div>
                <?php 
                $imgs = scandir(base_app."uploads/cars/{$id}");
                ?>
                <div class="row row-cols-sm-1 row-cols-md-2 row-cols-md-4 justify-content-center">
                    <?php 
                        foreach($imgs as $img):
                            if(in_array($img,array(".","..")))
                            continue;
                    ?>
                    <img src="<?= validate_image("uploads/cars/{$id}/{$img}") ?>" alt="Car Image" class="img-thumbnail car-images mx-2 my-1">
                    <?php endforeach; ?>
                </div>
                <hr class="border-primary">
                <div class="bg-gradient-light shadow px-2 py-3">
                    <h3 class="text-dark">Submit Inquiry</h3>
                    <form action="" id="inquiry-form">
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="car_id" value="<?= $id ?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="fullname" class="control-label">Name</label>
                                    <input type="text" class="form-control " name="fullname" placeholder="John Smith" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email" class="control-label">Email</label>
                                    <input type="email" class="form-control " name="email" required placeholder="test@sample.com">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="contact" class="control-label">Contact</label>
                                    <input type="text" class="form-control " name="contact" placeholder="09xxxxxxx" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="message" class="control-label">Message</label>
                            <textarea name="message" id="message" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group text-right">
                            <button class="btn btn-primary">Sumbit</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('#inquiry-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_inquiry",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
                success:function(resp){
                    if(resp.status == 'success'){
                        if($('#user_id').val() > 0)
                            location.reload();
                        else{
                            alert("Your Inquiry was successfully submitted and we'll reach you as soon as we sees your inquiry. Thank you!")
                            location.reload();
                        }
                    }else if(!!resp.msg){
                        el.addClass("alert-danger")
                        el.text(resp.msg)
                        _this.prepend(el)
                    }else{
                        el.addClass("alert-danger")
                        el.text("An error occurred due to unknown reason.")
                        _this.prepend(el)
                    }
                    el.show('slow')
                    end_loader();
                    $('html, body').animate({scrollTop:_this.offset().top},'fast')
                }
            })
        })
    })
</script>