
<div class="container">
<div class="card">
	<div class="card-body p-0">
		<div class="row no-gutters">
			<!-- <div class="col-lg-6 align-self-stretch bg-img-cover d-none d-lg-flex" style='background-image: url("https://source.unsplash.com/npxXWgQ33ZQ/1200x800")'></div> -->
			<div class="col-lg-6 p-5 col-lg-offset-2">
				<h3>Login aplikasi</h3>
				<form action="" class='form-login' target="" method="post">
				<p class='error-message'></p>
				<input class="form-control mb-2" name="username" type="email" placeholder="Masukkan Email">
				<input class="form-control mb-2" name="password" type="password" placeholder="Masukkan Password">
				<!-- <div class="g-recaptcha" data-sitekey="<?=$site_key;?>"></div> -->
				<button type="submit" class="btn btn-primary">Login</button>
				<a class="float-right" href="<?php echo site_url('page/registrasi'); ?>">Lupa Password?</a>
				</form>
				<!-- <hr class="my-5">
				<h3>Belum memiliki akun?</h3>
				<a href="<?php //echo site_url('page/registrasi'); ?>">Klik Disini untuk Registrasi</a> -->
			</div>
			<div class="col-lg-6">
				<img src="<?=base_url('assets/img/login-banner.jpg')?>" width="80%" alt="">
			</div>
		</div>
	</div>
</div>
</div>

@script
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="<?php echo base_url()?>js/scripts-admin.js"></script>

<script>
	$(document).ready(function(){
		$(document).on('submit','.form-login',function(e){
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('user/do_login');?>/",
                data: new CSRFFormData(this),
                dataType:'json',
                processData: false,
                contentType: false,
                success: function (response){                    
					document.location.href=response.redirect;
                },
                error: function(xhr){     
					$('.error-message').html(xhr.responseJSON.message);
                }
            });
        });
	});
</script>
@endscript