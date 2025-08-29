<h3>Car Brands That We Have</h3>
<hr>
<style>
    .car-brand-img{
        width:calc(100%);
        border-radius:.5em;
        transition:transform 2px ease-in;
    }
    .brand-item:hover .car-brand-img{
        transform: scale(.95);
    }
</style>
<div class="col-12">
    <div class="row row-cols-sm-1 row-cols-md-2 row-cols-xl-4 justify-content-center">
        <?php 
        $brands = $conn->query("SELECT * FROM `brand_list` where status = 1");
        while($row= $brands->fetch_assoc()):
            if(is_null($row['date_updated'])){
                $row['date_updated'] = strtotime($row['date_created']);
            }else{
                $row['date_updated'] = strtotime($row['date_updated']);
            }
        ?>
        <a href="./?page=product_per_brand&bid=<?= $row['id'] ?>" class="text-decoration-none text-dark p-2 brand-item">
            <img src="<?= validate_image("uploads/brands/brand-{$row['id']}.png?v={$row['date_updated']}") ?>" alt="Car Brand Image" class="car-brand-img rounded"><br>
            <center><large><b><?= ucwords($row['name']) ?></b></large></center>
        </a>
        <?php endwhile; ?>
    </div>
</div>