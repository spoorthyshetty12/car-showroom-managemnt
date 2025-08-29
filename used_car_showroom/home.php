<style>
    .car-cover{
        width:10em;
    }
    .car-item .col-auto{
        max-width: calc(100% - 12em) !important;
    }
    .car-item:hover{
        transform:translate(0, -4px);
        background:#a5a5a521;
    }
    .banner-img-holder{
        height:25vh !important;
        width: calc(100%);
        overflow: hidden;
    }
    .banner-img{
        object-fit:scale-down;
        height: calc(100%);
        width: calc(100%);
        transition:transform .3s ease-in;
    }
    .car-item:hover .banner-img{
        transform:scale(1.3)
    }
</style>
<?php if(!isset($_GET['q'])): ?>
<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<?php else: ?>
<h1>Search Result for <b>"<?= $_GET['q'] ?>"</b> keyword.</h1>
<?php endif; ?>
<div class="card card-outline card-primary shadow">
    <div class="card-body">
        <div class="container-fluid">
            <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-4">
            <?php 
                $search = "";
                if(isset($_GET['q'])){
                    $search = " and (c.product_title LIKE '%{$_GET['q']}%' OR c.description LIKE '%{$_GET['q']}%' or cc.name LIKE '%{$_GET['q']}%' or b.name LIKE '%{$_GET['q']}%') ";
                }
                $cars = $conn->query("SELECT c.*,b.name as brand, b.image_path as brand_img, cc.name as cat_name, cc.description as car_desc FROM `car_list` c inner join brand_list b on b.id = c.brand_id inner join category_list cc on cc.id = c.category_id where c.`status` = 0 {$search} order by unix_timestamp(c.date_created) desc");
                while($row = $cars->fetch_assoc()):
                    $row['description'] = strip_tags(html_entity_decode($row['description']));
                    if(is_null($row['date_updated'])){
                        $row['date_updated'] = strtotime($row['date_created']);
                    }else{
                        $row['date_updated'] = strtotime($row['date_updated']);
                    }
            ?>
            <a href="./?page=view_product&id=<?= $row['id'] ?>" class="card text-decoration-none text-dark car-item m-2">
                <div class="banner-img-holder">
                    <img src="<?= validate_image("uploads/banners/car-{$row['id']}.png?v={$row['date_updated']}") ?>" alt="" class="img-top banner-img bg-gradient-dark">
                </div>
                <div class="card-body">
                    <div class="col-12">
                        <h5 class="text-dark"><?= $row['product_title'] ?></h5>
                        <hr class="border-primary mb-0">
                            <div>
                                <span class="text-muted">Brand: <?= ucwords($row['brand']) ?></span><br>
                                <span class="text-muted">Category: <?= ucwords($row['cat_name']) ?></span><br>
                                <span class="text-muted"><i class="fa fa-tags"></i> <?= number_format($row['price'],2) ?></span>
                            </div>
                        <p class='truncate-3'>
                            <?= substr($row['description'],0,500) ?>
                        </p>
                    </div>
                </div>
            </a>
            <?php endwhile; ?>
            <?php if($cars->num_rows < 1): ?>
                <center><span class="text-muted">No Car Listed Yet.</span></center>
            <?php endif; ?>
            </div>
        </div>
    </div>
</div>