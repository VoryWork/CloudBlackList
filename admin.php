<?php
	function auth($config) {
		$username = $_SERVER['PHP_AUTH_USER'];
		$password = $_SERVER['PHP_AUTH_PW'];
		if ($config['adminuser'] == $username && $config['adminpass'] == md5($password)) return true;
		else return false;
	}
	$config = json_decode(file_get_contents("data.db"),true);
	$auth = auth($config);
	if (!$auth) {
		header('WWW-Authenticate: Basic realm="Please Login"');
	}
	else {
		//处理操作
		switch ($_GET['action']) {
			case 'deluser' :
				foreach ($config['user'] as $name => $pass) {
					if ($name == $_GET['username']) unset($config['user'][$name]);
				}
				file_put_contents('data.db',json_encode($config));
				break;
			case 'adduser' :
				$username = $_GET['username'];
				if (strpos($username,"\t") === false && strpos($username,"\n") === false) {
					$tmp["reason"]=$_GET['reason'];
					$tmp["level"]=$_GET['level'];
					$config['user'][$username] = $tmp;
					file_put_contents('data.db',json_encode($config));
				}
				break;
			case 'passwd' :
				if ($_GET['password1'] == $_GET['password2']) {
					$config['adminpass'] = md5($_GET['password2']);
					file_put_contents('data.db',json_encode($config));
				}
				else $msg = "密码校验不匹配。";
				break;
		}
	}
?>
<!DOCTYPE html>
<html lang="en"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>VoryWork云黑控制台</title>
    <link href="swiftmodders.css?v=bdd01b" rel="stylesheet">
    	<?php if ($msg) { ?>
	<script type="text/javascript">
		alert("<?php echo $msg ?>");
	</script>
	<?php } ?>
    </head>
    <body data-phone-cc-input="1" class="loaded">
    
    <div id="sm-mmenu-helper" class="mm-page mm-slideout">
    
    <div class="sm-page-container">
    
    <div class="sm-content-container">
    <div class="sm-content sidebar-active main-content">
    <div class="sm-page-heading">
    <h1>简单云黑</h1>
    <ol class="breadcrumb">
    <li>
    Design by xmmpps </li>
    
    
    
    </ol>
    </div>
    <div class="panel panel-default">
    <div class="panel-body">
    <div class="tab-content margin-bottom">
    <h3>云黑状态</h3>
    <hr>
    <div class="row">
    <div class="col-sm-5">
    登录者
    </div>
    <div class="col-sm-7">
    <?php if ($auth) echo $_SERVER['PHP_AUTH_USER']; else echo "验证失败"; ?>
    </div>
    </div>
    <div class="row">
    <div class="col-sm-5">
    最后编辑时间
    </div>
    <div class="col-sm-7">
    <?php
	$time = filemtime("data.db");
	echo $time;
?>
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
        <th class="text-center sorting" tabindex="0" rowspan="1" colspan="1" style="width: 57px;" aria-label="操作: activate to sort column ascending">操作</th></tr>
    </thead>
    <tbody>
    <?php
		if ($auth) {
			$usertable = $config['user'];
			foreach ($usertable as $name => $data) {
				?><tr role="row" class="odd">
                <td class="text-center sorting_1" tabindex="0">
                <span class="label status status-active">已生效</span></td>
					<td class=" text-center"><?php echo htmlspecialchars($name); ?></td>
                    <td class=" text-center"><?php echo htmlspecialchars($data["level"]); ?></td>
					<td class=" text-center"><?php echo htmlspecialchars($data["reason"]); ?></td>
					<td class=" text-center">
						<span><a class="btn btn-danger mb-2" href="?action=deluser&username=<?php echo $name; ?>">删除</a></span>
					</td>
				</tr><?php
			}
		}
	?>
        </tbody></table></div></div></div></div>
    </div>
    </div>
    <hr>
    <div class="row">
    </div>
    <form name="adduser" action="" method="get" autocomplete="off" style="">
        <div class="row">
        <input type="text" name="action" value="adduser" hidden>
        <div class="col-md-2 mb-3">
        <input type="text" class="form-control" placeholder="用户名"  name="username" id="username">
        </div>
        <div class="col-md-2 mb-3">
        <input type="text" class="form-control" placeholder="封禁等级" name="level">
        </div>
        <div class="col-md-2 mb-3">
        <input type="text" class="form-control" placeholder="封禁原因" style="width: 680px;" name="reason" data-toggle="tooltip" data-placement="top" title="">
        </div>
        </div>
        <div class="row" style="margin-top: 15px;">
        <div class="col-xs-offset-5 col-md-1 mb-3">
        <input type="submit" class="btn btn-primary mb-2" value="确定">
        </div>
        <div class="col-md-1 mb-3">
        <input class="btn btn-danger mb-2" type="reset" value="取消">
        </div>
        </div>
        </form>
    
    </div>
    <div class="row">
    <form class="form-horizontal using-password-strength" name="passwd" action="" method="get" autocomplete="off" role="form">
    <input type="password" style="display: none;"/>
		<input type="text" name="action" value="passwd" hidden>
    <div id="newPassword1" class="form-group has-feedback">
        <label for="inputNewPassword1" class="col-sm-5 control-label">修改管理员新密码</label>
        <div class="col-sm-6">
        <input class="form-control" type="password" name="password1" autocomplete="off">
        <span class="form-control-feedback glyphicon"></span>
    </div>
    </div>
    <div id="newPassword2" class="form-group has-feedback">
    <label for="inputNewPassword2" class="col-sm-5 control-label">确认管理员新密码</label>
    <div class="col-sm-6">
    <input class="form-control" type="password" name="password2" autocomplete="off">
    <div id="inputNewPassword2Msg"> </div>
    </div>
    </div>
    <div class="form-group">
        <div class="row" style="margin-top: 15px;">
            <div class="col-xs-offset-5 col-md-1 mb-3">
                <input class="btn btn-primary mb-2" type="submit" value="修改">
            </div>
            <div class="col-md-1 mb-3">
                <input class="btn btn-danger mb-2" type="reset" value="取消">
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