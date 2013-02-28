<?php include_once __DIR__."/../layout/header.php" ?>

<script id="option_tmpl" type="text/template">
    <div class="well well-small option-well" dataid="{{=it.id}}">
		<span>{{=it.name}}</span>
		<a id="btn-close-option" class="close pull-right" href="javascript:void(0)">&times;</a>
	</div>
</script>

<script id="component_tr_tmpl" type="text/template">
<tr>
	<td>{{=it.id}}</td>
	<td>{{=it.name}}</td>
	<td><img src="{{=it.path_thumb}}" /> </td>
	<td>{{=it.formula}}</td>
	<td><a id="btn-remove-component" dataid="{{=it.id}}" class="close pull-right" href="<?php echo base_url('component/delete_component') ?>">&times;</a></td>
</tr>
</script>

<script id="category_tr_tmpl" type="text/template">
<tr>
	<td>{{=it.id}}</td>
	<td>{{=it.name}}</td>
	<td><a id="btn-remove-category" data="{{=it.id}}" class="close delete-link" href="<?php echo base_url('category/delete_category') ?>">&times;</a></td>
</tr>
</script>

<script id="item-row-tmpl" type="text/template">
<tr class="item-row">
    <td>
    	<div class="delete-wpr">
    		<a id="delete-row" class="delete" href="javascript:;" title="删除该行">x</a>
    	</div>
    </td>
    <td>
    	<a id="add-shape" class="btn" href="javascript:;" title="添加形状">
    		<i class="icon iconfugue16-image--plus"></i>
    	</a>
    </td>
    <td class="row-formula">
    	<textarea id="formula" class="formula"></textarea>
    </td>

</tr>
</script>



<!-- Start Sidebar -->
<div id="sidebar">

    <!-- Start Profile Panel -->
    <div class="profile" data-detach="profile">
        <div class="profile-pic"><img src="<?php echo base_url('img/avatar/40x40/avatar5.png') ?>"></div>
        <div class="profile-info">
            <span class="name"><?php echo $user_session['username']?></span>
            <span class="job">RTWorker</span>
        </div>
    </div><!-- End Profile Panel -->
    
    <!-- Start Main Menu -->
    <ul class="nav-mainmenu" id="nav-mainmenu">
        <!-- Start GENERALS Menu -->
        <li class="accordion-group">
            <a data-toggle="collapse" data-parent="#nav-mainmenu" href="#manage" class="active">
            	<span class="icon iconfa-home"></span>
            	<span class="text">@管理</span>
            </a>
            <!-- Start GENERALS Sub Menu -->
            <ul class="nav-submenu collapse in" id="manage">
                <li><a href="#div_component" class="link_side active"><span class="icon iconfugue16-ruler"></span> 构件管理</a></li>
                <li><a class="link_side" href="#div_category"><span class="icon iconfugue16-category"></span> 构件类别管理</a></li>
            </ul>
            <!-- End GENERALS Sub Menu -->
        </li>
        <!-- End GENERALS Menu -->
        
        <!-- Start COMPONENTS Menu -->
        <li class="accordion-group">
            <a href="<?php echo base_url('rtwork/lofting') ?>">
            	<span class="icon iconfa-beaker"></span>
            	<span class="text">@翻样</span>
            </a>
        </li>
        <!-- End COMPONENTS Menu -->
        
    </ul><!-- End Main Menu -->

</div>
<!-- End Sidebar -->

<!-- Start Main Content -->
<div id="main-content">
    <p>&nbsp;</p>

    <!-- Start Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="#">@管理</a></li>
        <li><a id="breadcrumb-title" href="#">构件管理</a></li>
    </ul><!-- End Breadcrumb -->

    <hr class="style1">

    <!-- Start Main Content -->
    <div class="row-fluid div_href" id="div_component">
		
    	<!-- Start 构件管理 -->
		<div class="span12" >
            <div class="row-fluid">
            	<div class="span6">
                	<div class="widget">
                    	<div class="widget-content">
                        	<div class="widget-content-inner">
								<div class="paper-ring"></div>
								<form class="form-horizontal" action="<?php echo base_url('component/add_component') ?>" method="post" name="form-component">
									<div class="control-group">
									    <label class="control-label" for="component-category">构件类别:</label>
									    <div class="controls">
									    	<select class="span12" id="component-category">
									    		<?php foreach ($categorys as $category) { ?>
									    		<option value="<?php echo $category['id']?>"><?php echo $category['name']?></option>
									    		<?php } ?>
									    	</select>
									   
									    </div>
									</div>
									<div class="control-group">
									    <label class="control-label" for="component-name">构件名称:</label>
									    <div class="controls">
									      <input type="text" class="span12" id="component-name" placeholder="">
									    </div>
									</div>
									<div class="control-group">
									    <label class="control-label" for="component-image">构件图片:</label>
									    <div class="controls">
									    	<div id="component-image-fineuploader" class="span12" ></div>
									    </div>
									</div>
									<div class="control-group">
									    <label class="control-label" for="component-option">属性:</label>
									    <div class="controls">
									    	<input type="text" id="component-option" class="span12" placeholder="" action="<?php echo base_url('option/add_option') ?>" search="<?php echo base_url('option/search_option') ?>">
										    
									    	<br />
									    	<div id="option-tags">
											</div>
									    </div>
									</div>
									<div class="control-group">
									    <label class="control-label" for="component-formula">公式:</label>
									    <div class="controls">
									      <input type="text" id="component-formula" class="span12" placeholder="">
									    </div>
									</div>
									<div id="invoice-page-wrapper">
										<table id="items" align="center">
	                                        <tr>
	                                            <th>#</th>
	                                            <th>形状</th>
	                                            <th>公式</th>
	                                        </tr>
	                                      
	                                        <tr class="item-row">
											    <td>
											    	<div class="delete-wpr">
											    		<a id="delete-row" class="delete" href="javascript:;" title="删除该行">x</a>
											    	</div>
											    </td>
											    <td>
											    	<a id="add-shape" class="btn" href="javascript:;" title="添加形状">
											    		<i class="icon iconfugue16-image--plus"></i>
											    	</a>
											    </td>
											    <td class="row-formula">
											    	<textarea id="formula" class="formula"></textarea>
											    </td>
											</tr>
	                                      
	                                        <tr id="hiderow">
	                                            <td colspan="5">
	                                            	<a class="btn" id="add-row" href="javascript:;" title="添加一行">
	                                            		<i class="icon icon-plus"></i> 添加一行
	                                            	</a>
	                                            </td>
	                                        </tr>
	                                    </table>
	                                </div>

									<div class="control-group">
									    <div class="controls">
									      <input type="submit" class="btn btn-large btn-primary" id="btn-add-component" name="btn-add-component" value="保存" />
									    </div>
									</div>
								</form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="span6">
	            	<div class="widget">
						<div class="widget-content">
							<div class="widget-content-inner">
								<table id="table-components" class="table table-hover">
									<thead>
										<tr>
									    	<th>#</th>
									    	<th>构件名称</th>
									    	<th>图</th>
									    	<th>公式</th>
									    	<th>操作</th>
									    </tr>
									</thead>
									<tbody>
										<?php foreach ($components as $component) { ?>
											<tr>
												<td><?php echo $component['component_id']?> </td>
												<td><?php echo $component['component_name']?> </td>
												<td><img src="<?php echo $component['path_thumb']?>" /> </td>
												<td><?php echo $component['formula']?> </td>
												<td><a id="btn-remove-component" data="<?php echo $component['component_id']?>" class="close delete-link" href="<?php echo base_url('component/delete_component') ?>">&times;</a></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
            </div>

            
            <!-- Start 构件管理 -->
		</div>
	</div>		
	<div class="row-fluid div_href" id="div_category" style="display:none">
		<!-- Start 构件类型管理 -->
        <div class="span12" >
			<div class="row-fluid">
				<div class="span6">
                	<div class="widget">
                    	<div class="widget-content">
                        	<div class="widget-content-inner">
								<div class="paper-ring"></div>
								<form action="<?php echo base_url('category/add_category') ?>" method="post" name="form-category">
									<input type="text" id="category-name" name="category-name" placeholder="构件类别名" /><br />
									<input type="submit" class="btn" id="btn-add-category" name="btn-add-category" value="添加类别" />
								</form>
							</div>
						</div>
					</div>
				</div>

				<div class="span4">
                	<div class="widget">
                    	<div class="widget-content no-padding">
                        	<div class="widget-content-inner">
                            	<table class="table" data-responsive="table" id="categorys">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>类别名</th>
                                            <th>操作</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php foreach ($categorys as $category) { ?>
                                		<tr>
                                            <td><?php echo $category['id'] ?></td>
                                            <td><?php echo $category['name'] ?></td>
                                            <td><a id="btn-remove-category" data="<?php echo $category['id'] ?>" class="close delete-link" href="<?php echo base_url('category/delete_category') ?>">&times;</a></td>
                                        </tr>
                                    	<?php } ?>
                                        
                                    </tbody>
                                </table>
                            </div>
                		</div>
                    </div>
            	</div>
			</div>
		</div>
        <!-- Start 构件类型管理 -->
			
    </div><!-- End -->
</div>
<!-- End Main Content -->

<?php include_once __DIR__."/../layout/footer.php" ?>