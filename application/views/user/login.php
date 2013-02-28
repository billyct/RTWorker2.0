<?php include_once __DIR__."/../layout/header.php" ?>


<!-- Start Login -->
<div id="login-content">
	
    <div class="row-fluid">
        <div class="span8 offset2">
			
			<div class="widget">
				<div class="widget-content no-padding">
					<div class="widget-content-inner">
						
						<div class="paper-ring"></div>
						
						<!-- Start Login Form -->
						<div class="login-area">
							<h3>
								<i class="icon iconfa-lock"></i>登录
							</h3>
							<hr />
							
							<form name="form-login" action="<?php echo base_url('user/login') ?>" method="post">
								<?php if(isset($error)) { ?>
									<div class="alert alert-error"><?php echo $error ?></div>
								<?php } ?>
								<input name="account" type="text" placeholder="用户名/邮箱" class="input-block-level" data-validation-engine="validate[required]">
								<input name="password" type="password" placeholder="密码" class="input-block-level" data-validation-engine="validate[required]">
								<label><input type="checkbox" data-style="checkbox"> 记住我</label>
								<br>
								<input type="hidden" name="url" value="<?php echo isset($_GET['url'])?$_GET['url']:''?>" />
								<button type="submit" class="btn" name="login" value="登录">登录</button>
								<div class="clearfix"></div>
							</form>
						</div>
						<!-- End Login Form -->
							
						<!-- Start Register Area -->
						<div class="register-area">
							<h3>还没有账号？</h3><hr>
							<a href="<?php echo base_url('user/register') ?>" class="btn btn-success btn-block">立即注册 &raquo;</a>
							<p align="center" style="margin:0;">或者</p>
							<a href="#" class="btn btn-info btn-block"><i class="icon iconfa-twitter"></i> 新浪微博登录</a>
						</div>
						<!-- End Register Area -->
					</div>
				</div>
			</div>
		</div>
    </div>

</div><!-- End Login-->


<?php include_once __DIR__."/../layout/footer.php" ?>