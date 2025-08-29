<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT i.*,c.product_title FROM `inquiry_list` i inner join car_list c on c.id = i.car_id where i.id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k))
            $$k = $v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none !important;
    }
</style>
<div class="container-fluid">
    <dl>
        <dt class="text-muted">Car Inquired</dt>
        <dd class='pl-4 fs-4 fw-bold text-gray'><b><?= isset($product_title) ? $product_title : '' ?></b><a href="<?= base_url."?page=view_product&id=".$car_id ?>" target=_blank class="text-decoration-none text-gray px-2"><b><i class="fa fa-external-link-alt"></i></b></a></dd>
        <dt class="text-muted">Full Name</dt>
        <dd class='pl-4 text-dark fs-4 fw-bold'><?= isset($fullname) ? $fullname : '' ?></dd>
        <dt class="text-muted">Email</dt>
        <dd class='pl-4 text-dark fs-4 fw-bold'><?= isset($email) ? $email : '' ?></dd>
        <dt class="text-muted">Contact</dt>
        <dd class='pl-4 text-dark fs-4 fw-bold'><?= isset($contact) ? $contact : '' ?></dd>
        <dt class="text-muted">Inquiry</dt>
        <dd class='pl-4 text-dark'>
            <p class=""><small><?= isset($message) ? $message : '' ?></small></p>
        </dd>
        <dt class="text-muted">Status</dt>
        <dd class='pl-4 text-dark'>
            <?php
            if(isset($status)):
                switch($status){
                    case '1':
                        echo "<span class='badge badge-success bg-primary badge-pill'>Read</span>";
                        break;
                    case '0':
                        echo "<span class='badge badge-secondary badge-pill'>Unread</span>";
                        break;
                }
            endif;
            ?>
        </dd>
    </dl>
    <div class="col-12 text-right">
        <button class="btn btn-flat btn-sm btn-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>