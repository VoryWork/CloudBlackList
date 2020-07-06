<?php
	$config = json_decode(file_get_contents("data.db"),true);
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VoryWork云黑</title>
    <link href="swiftmodders.css?v=bdd01b" rel="stylesheet">
    </head>
    <body data-phone-cc-input="1" class="loaded">
    
    <div id="sm-mmenu-helper" class="mm-page mm-slideout">
    
    <div class="sm-page-container">
    
    <div class="sm-content-container">
    <div class="sm-content sidebar-active main-content">
    <div class="sm-page-heading">
    <h1>搭建成功</h1>
    <ol class="breadcrumb">
    <li>
    Design by xmmpps </li>
    
    
    
    </ol>
    </div>
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="tab-content margin-bottom">
    <h3>恭喜，云黑已经正常搭建</h3>
    <hr>
    <div class="row">
    <div class="col-sm-5">
    默认用户名
    </div>
    <div class="col-sm-7">
    admin
    </div>
    </div>
    <div class="row">
    <div class="col-sm-5">
    默认密码
    </div>
    <div class="col-sm-7">
    admin
    </div>
    </div>
    <div class="row">
    <div class="col-sm-5">
    查全部云黑
    </div>
    <div class="col-sm-7">
    <a href="getblack.php">点击查询</a>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-5">
    查修改时间
    </div>
    <div class="col-sm-7">
    <a href="getversion.php">点击查询</a>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-5">
    提示
    </div>
    <div class="col-sm-7">
    若不想用户脱库，请删除getblack.php、index.php和getversion.php
    </div>
    </div>
    <div class="row">
    <div class="col-sm-5">
    查询API
    </div>
    <div class="col-sm-7">
    <a href="query.php?username=TestUser">点击测试1</a>
    <a href="query.php?username=None">点击测试2</a>
    </div>
    </div>
    
    
    
    
    
    <hr>
    <h3>熊孩子列表</h3>
    <hr>
    <div class="row">
    <div id="tableServicesList_wrapper" class="table-container clearfix" style="width:100%">
    <div class="table-fluid">
        <div id="datetable_table_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
            <div class="row"><div class="col-sm-6">
                </div>
                <div class="col-sm-6">
                    </div></div><div class="row"><div class="col-sm-12"><table id="datetable_table" class="table table-list dataTable no-footer dtr-inline" style="width: 100%;" role="grid" aria-describedby="datetable_table_info">
    <thead>
    <tr role="row">
        <th class="text-center sorting_asc" tabindex="0" rowspan="1" colspan="1" style="width: 64px;" aria-sort="ascending" aria-label="状态: activate to sort column descending">状态</th>
        <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1" style="width: 200px;" aria-label="被转发IP/域名: activate to sort column ascending">用户名</th>
        <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1" style="width: 100px;" aria-label="端口: activate to sort column ascending">封禁等级</th>
        <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1" style="width: 300px;" aria-label="转发IP: activate to sort column ascending">封禁原因</th>
    </thead>
    <tbody>
    <?php
			$usertable = $config['user'];
			foreach ($usertable as $name => $data) {
				?><tr role="row" class="odd">
                <td class="text-center sorting_1" tabindex="0">
                <span class="label status status-active">已生效</span></td>
					<td class=" text-center"><?php echo htmlspecialchars($name); ?></td>
                    <td class=" text-center"><?php echo htmlspecialchars($data["level"]); ?></td>
					<td class=" text-center"><?php echo htmlspecialchars($data["reason"]); ?></td>
				</tr><?php
			}
	?>
        </tbody></table></div></div></div></div>
    </div>
    </div>
    <hr>
    <div class="row">
    </div>
    
    </div>
    <div class="row">
    <form class="form-horizontal using-password-strength" name="passwd" action="admin.php" method="get">
    </div>
    <div class="form-group">
        <div class="row" style="margin-top: 15px;">
            <div class="col-xs-offset-5 col-md-1 mb-3">
                <input class="btn btn-primary mb-2" type=submit value="点击进入管理页面">
            </div>
            </div>
    </form>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
     <div class="clear"></div>
    <div class="sm-footer">
    <div class="sm-copyright">Copyright © 2020 VoryWork. All Rights Reserved.</div>
    </div>
    </div>
    </div>
    
    
    
    
    </body></html>