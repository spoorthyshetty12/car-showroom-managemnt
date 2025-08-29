<?php
require_once('../../config.php');
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `brand_list` where id = '{$_GET['id']}'");
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
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: scale-down;
		object-position: cover cover;
	}
</style>
<div class="container-fluid">
    <form action="" id="brand-form">
        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
        <div class="form-group">
            <input type="text" name="name" id="name" class="form-control form-control-border" placeholder="Brand Name" value ="<?php echo isset($name) ? $name : '' ?>" required>
        </div>
		<div class="form-group">
			<label for="" class="control-label">Image</label>
			<div class="custom-file">
				<input type="file" class="custom-file-input rounded-circle" id="customFile" name="img" onchange="displayImg(this,$(this))">
				<label class="custom-file-label" for="customFile">Choose file</label>
			</div>
		</div>
		<div class="form-group d-flex justify-content-center">
			<img src="<?php echo validate_image(isset($image_path) ? $image_path :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
		</div>
        <div class="form-group">
            <select name="status" id="status" class="form-control form-control-border" required>
                <option value="1" <?= isset($status) && $status == 1 ? "selected" :"" ?>>Active</option>
                <option value="0" <?= isset($status) && $status == 0 ? "selected" :"" ?>>Inactive</option>
            </select>
        </div>
    </form>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
				_this.siblings('label').text(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
			$('#cimg').attr('src', "<?= validate_image('') ?>");
			_this.siblings('label').text("Choose file")
		}
	}
    $(function(){
        $('#uni_modal #brand-form').submit(function(e){
            e.preventDefault();
            var _this = $(this)
            $('.pop-msg').remove()
            var el = $('<div>')
                el.addClass("pop-msg alert")
                el.hide()
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_brand",
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
                        location.reload();
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
                }
            })
        })
    })
</script>