<h1>Welcome to <?php echo $_settings->info('name') ?></h1>
<hr class="border-info">
<div class="row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-copyright"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">All Brands</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `brand_list` where status = 1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-th-list"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Car Types</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `category_list` where `status` = 1")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-car"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Available Cars</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `car_list` where `status` = 0 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-3">
        <div class="info-box bg-light shadow">
            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-car"></i></span>

            <div class="info-box-content">
            <span class="info-box-text">Sold Cars</span>
            <span class="info-box-number text-right">
                <?php 
                    echo $conn->query("SELECT * FROM `car_list` where `status` = 1 ")->num_rows;
                ?>
            </span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
</div>