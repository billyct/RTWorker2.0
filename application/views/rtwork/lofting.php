<?php include_once __DIR__."/../layout/header.php" ?>

<script id="component-info-tmpl" type="text/template">
<div class="media" id="component-{{=it.component_id}}">
    <a id="btn-remove-component-info" class="close pull-right" href="javascript:void(0)">&times;</a>
    <a class="pull-left" href="javascript:void(0)">
        <img class="media-object" alt="{{=it.component_name}}" style="width: 64px; height: 64px; " src="{{=it.path_thumb}}" component-id="{{=it.component_id}}">
    </a>
    <div class="media-body">
        <h4 class="media-heading">{{=it.component_name}}</h4>
        <p>{{=it.formula}}</p>
    </div>
</div>
</script>

<script id="component-config-tmpl" type="text/template">
<div class="widget dark span6" id="component-config-panel">
    <div class="widget-head">
        <span class="title">{{=it.component_name}}</span>
        <div class="toolbar">
            <button id="btn-hide-config" class="btn">
                <i class="icon-white icon-chevron-down"></i>
            </button>
            <button id="btn-remove-component-config" class="btn" href="<?php echo base_url('lofting/delete_data') ?>" lofting-component-id="{{=(it.lofting_component_id)?it.lofting_component_id:''}}">
                <i class="icon-white icon-remove"></i>
            </button>
        </div>
    </div>
    <div class="widget-content">
        <div class="widget-content-inner">
            <div class="media">
                <a class="picture pull-left" href="javascript:void(0);">
                    <img class="media-object img-polaroid" alt="{{=it.component_name}}" style="width: 64px; height: 64px; " src="{{=it.path_thumb}}">
                </a>
                <div class="media-body">
                    <ul class="notepad">
                        {{ for (var i = it.options.length - 1; i >= 0; i--) { }}
                            <li>
                                <div class="input-prepend input-append">
                                    <span class="add-on">{{=it.options[i].option_name}}</span>
                                    <input class="input-mini" data-type="number" value="{{=(it.options[i].value)?it.options[i].value:''}}" lofting-data-id="{{=(it.options[i].lofting_data_id)?it.options[i].lofting_data_id:''}}" option-id="{{=it.options[i].option_id}}" type="text" placeholder="{{=it.options[i].option_name}}">
                                </div>
                            </li>
                        {{ }; }}
                    </ul>
                </div>
                <div class="media-body">
                    <ul class="notepad">
                        {{ for (var i = it.works.length - 1; i >= 0; i--) { }}
                            <li class="type-select-li" lofting-typedata-id="{{=(it.works[i].lofting_typedata_id)?it.works[i].lofting_typedata_id:''}}" work-id="{{=(it.works[i].id)?it.works[i].id:it.works[i].work_id}}">
                                <span class="pull-left">{{=it.works[i].formula}}</span>
                                <select id="type" class="type-select span6" val="{{=it.works[i].type?it.works[i].type:''}}">
                                    <optgroup label="一级钢">
                                        <?php foreach ($reforced_type as $num) { ?>
                                            <option value="A<?php echo $num ?>" data-image="<?php echo base_url('images/reforced/1ji') ?>"><?php echo $num ?></option>
                                        <?php } ?>
                                    </optgroup>
                                    <optgroup label="二级钢">
                                        <?php foreach ($reforced_type as $num) { ?>
                                            <option value="B<?php echo $num ?>" data-image="<?php echo base_url('images/reforced/2ji') ?>"><?php echo $num ?></option>
                                        <?php } ?>
                                    </optgroup>
                                    <optgroup label="三级钢">
                                        <?php foreach ($reforced_type as $num) { ?>
                                            <option value="C<?php echo $num ?>" data-image="<?php echo base_url('images/reforced/3ji') ?>"><?php echo $num ?></option>
                                            
                                        <?php } ?>
                                    </optgroup>
                                </select>
                                <input class="span3" type="text" name="sum" id="sum" value="{{=(it.works[i].sum)?it.works[i].sum:''}}" placeholder="根数"/>
                            </li>
                        {{ }; }}
                        
                    </ul>
                </div>
                
                <a id="btn-save-config" href="<?php echo base_url('lofting/save_data') ?>" href-total="<?php echo base_url('lofting/get_total') ?>" lofting-component-id="{{=(it.lofting_component_id)?it.lofting_component_id:''}}" component-id="{{=it.component_id}}" class="btn btn-block btn-primary">保存</a>
            </div>
        </div>
    </div>
</div>
</script>

<script id="lofting-li-tmpl" type="text/template">
<li><a id="lofting-link" href-total="<?php echo base_url('lofting/get_total') ?>" data="{{=it.id}}" href="<?php echo base_url('lofting/get_lofting')?>/{{=it.id}}"><span class="icon iconfugue16-projection-screen--pencil"></span> {{=it.name}}</a></li>
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
        
        <!-- Start 管理菜单 -->
        <li class="accordion-group">
            <a href="<?php echo base_url('rtwork/manage') ?>">
            	<span class="icon iconfa-home"></span>
            	<span class="text">@管理</span>
            </a>
        </li>
        <!-- End 管理菜单 -->

        <!-- 翻样菜单 -->
        <li class="accordion-group">
            <a data-toggle="collapse" data-parent="#nav-mainmenu" href="#lofting-list" class="active">
            	<span class="icon iconfa-beaker"></span>
            	<span class="text">@翻样</span>
            </a>
            <!-- 翻样子菜单 -->
            <ul class="nav-submenu collapse in" id="lofting-list">
            	<li>
					<button class="btn btn-large btn-show-lofting-dialog" id="btn-show-lofting-dialog">添加翻样项目</button>
                    <button href="<?php echo base_url('lofting/delete_lofting') ?>" class="btn btn-large btn-show-lofting-dialog disabled" id="icon-delete-lofting"><h2 class="icon iconfa-trash"></h2>  拖动项目删除</button>
                    
                    
                    
                    <div id="dialog-add-lofting" title="添加项目" style="display:none;">
                        <form action="<?php echo base_url('lofting/add_lofting') ?>" method="post" name="form-lofting">
                            <input type="text" id="lofting-name" name="lofting-name" placeholder="项目名" /><br />
                            <input type="submit" class="btn" id="btn-add-lofting" name="btn-add-lofting" value="添加项目" />
                        </form>
                    </div>

            	</li>
                
                <?php foreach ($loftings as $key => $lofting) { ?>
                    <li>
                        <a id="lofting-link" href-total="<?php echo base_url('lofting/get_total') ?>" data="<?php echo $lofting['id'] ?>" href="<?php echo base_url('lofting/get_lofting/'.$lofting['id'])?>" class="<?php echo $key==0?'active':'' ?>">
                            <span class="icon iconfugue16-projection-screen--pencil"></span> <?php echo $lofting['name']?>
                        </a>
                    </li>
                <?php } ?>
            </ul>
            <!-- End 翻样子菜单 -->
        </li>
        <!-- End 翻样菜单 -->
        
    </ul><!-- End Main Menu -->

</div>
<!-- End Sidebar -->

<div id="main-content">
    <p>&nbsp;</p>

    <!-- Start Breadcrumb -->
    <ul class="breadcrumb">
        <li><a href="#">@翻样</a></li>
        <!-- <li><a id="breadcrumb-title" href="#">构件管理</a></li> -->
    </ul>
    <!-- End Breadcrumb -->
    <hr class="style1">

    <!-- Start Main Content -->

    <div class="row-fluid">
		<div class="span12">
        	
			<!-- Start Dashboard Statistic -->
            <div class="row-fluid">
                <!-- 左边 项目信息平台-->
                <div class="span4">
                    <!-- 构件集 -->
                    <div class="widget dark">
                        <div class="widget-head">
                            <span class="title"><span class="icon icon-white icon-align-justify"></span> 构件</span>

                            <div class="toolbar">
                                <button id="btn-hide-component-panel" class="btn" rel="tooltip" data-placement="right" title="隐藏/显示">
                                    <i class="icon-white icon-chevron-down"></i>
                                </button>
                            </div>
                        </div>
                        <div class="widget-content no-padding">

                            <div class="widget-content-inner">
                                <div class="component-panel" id="component-panel">
                                    <input type="text" class="input-medium search-component" id="search-component-name" placeholder="搜索构件">
                                    <div class="accordion" id="components-accordion">
                                        <?php foreach ($categorys as $category) { ?>
                                            <div class="accordion-group">
                                                <div class="accordion-heading">
                                                    <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#components-accordion" href="#category-<?php echo $category['id'] ?>">
                                                        <span class="icon iconfugue16-category"></span>
                                                        <?php echo $category['name']?>
                                                        <span class="caret pull-right"></span>
                                                    </a>
                                                </div>
                                                <div id="category-<?php echo $category['id']?>" class="accordion-body collapse" style="height: 0px; ">
                                                    <div class="accordion-inner">
                                                        <ul class="summary-list">
                                                            <?php foreach ($components as $component) { ?>
                                                                <?php if ($component['category_id'] == $category['id']) { ?>
                                                                <li id="component-draggable" data="<?php echo $component['component_id']?>" href="<?php echo base_url('component/get_component/'.$component['component_id'])?>">
                                                                    <span class="title">
                                                                        <span class="icon iconfugue16-ruler"></span> <?php echo $component['component_name']?>
                                                                    </span>
                                                                    <br />
                                                                    <span class="text">
                                                                        <?php echo $component['formula'] ?>
                                                                    </span>
                                                                </li>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                           
                                        <?php } ?>
                              
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 项目汇总信息 -->
                    <div class="widget">
                        <div class="widget-content">
                            <div class="widget-content-inner">
                                <div class="google-summary">
                                    <span class="title">总重量</span>
                                    <span id="total-value" class="value">0</span>
                                    <ul id="formula-list">

                                    </ul>
                                    <span class="subtitle"><a href="javascript:void(0);" work-href="<?php echo base_url('rtwork/work') ?>" id="goto_print_work" target="blank">单击进入打印界面</a></span>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 右边 项目构件具体信息操作平台-->
            	<div class="span8">
                	<div class="widget">
                    	<div class="widget-content">
                        	<div class="widget-content-inner">
								<div class="paper-ring"></div>
                            	<div class="row-fluid">
                                	<div class="span12">
                                    	<div id="lofting-panel" class="lofting-panel">

                                            

                                        </div>
                                        
                                	</div>
                            	</div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
            <!-- Start Dashboard Statistic -->
            
		</div>
	</div>
		
</div>


<?php include_once __DIR__."/../layout/footer.php" ?>