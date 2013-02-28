<?php include_once __DIR__."/../layout/header.php" ?>


<div id="login-content">
	<div class="row">
		<div class="span8 offset2">
			<form action="<?php echo base_url('user/register') ?>" method="post">
				<legend id="yh_text">注册</legend>
				
				<?php if(isset($error)) { ?>
					<div class="alert alert-error"><?php echo $error ?></div>
				<?php } ?>
				<div class="control-group">
					<div class="controls">
						<input type="text" name="username" class="register_input" placeholder="用户名">
						<div class="help-inline">
							<i class="icon-info-sign"></i>
							<span>
								使用你在网上常用昵称，小于12个字符
							</span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="email" name="email" class="register_input" placeholder="邮箱">
						<div class="help-inline">
							<i class="icon-info-sign"></i>
							<span>用来登录应用,建议使用常用Email</span>
						</div>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<input type="password" id="password_reg" name="password" class="register_input" placeholder="密码">
						<div class="help-inline">
							<i class="icon-info-sign"></i>
							<span>6-16个字符</span>
						</div>
					</div>
				</div>
				<p>
					<button type="submit" class="btn btn-primary" name="register" value="注册">注册</button>
				</p>
				<p>
					已经拥有账号<a href="<?php echo base_url('user/login') ?>" class="">立即登录 &raquo;</a>
				</p>
			</form>
		</div>
<!-- 
		<div class="span4">
			<p><a href="#" class="btn btn-block">新浪微博</a></p>
			<button type="submit" class="btn btn-block">人人网</button>
		</div> -->
	</div>
</div>

<?php include_once __DIR__."/../layout/footer.php" ?>