<?
session_start();
	require_once '../control/admins.php';
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/formValidation.min.css">
	<link rel="stylesheet" type="text/css" href="../css/zeroModal.css">
	<link rel="stylesheet" type="text/css" href="../css/adminTable.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/formValidation.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.js"></script>
	<script type="text/javascript" src="../js/zeroModal.min.js"></script>
	<script type="text/javascript" src="../js/admins.js"></script>
</head>
<body>
<div id="edit" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="gridSystemModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="gridSystemModalLabel">
				<i class="glyphicon glyphicon-pencil"></i> 修改资料(只能修改以下条目)</h4>
			</div>

			<form id="update" method="post" class="form-horizontal" action="../control/updateAdmin.php">
				<div class="modal-body">
					<div class="form-group">
	                    <label for="rid" class="col-sm-3 control-label">所选管理员编号</label>
	                    <div class="col-sm-6">
	                        <input id="gid" type="text" class="form-control" name="gid" readonly="readonly">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="compus" class="col-sm-3 control-label">所在校区</label>
	                    <div class="col-sm-6">
	                        <select id="compus" class="form-control" name="compus">
	                        	<option value="">请选择校区</option>
	                        	<option>松山湖校区</option>
	                        	<option>莞城校区</option>
	                        </select>
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label for="tel" class="col-sm-3 control-label">手机号</label>
	                    <div class="col-sm-6">
	                        <input id="tel" type="text" class="form-control" name="tel" autocomplete="off" maxlength="11">
	                    </div>
	                </div>
	                <div class="form-group">
	                    <label class="col-sm-3 control-label">短号</label>
	                    <div class="col-sm-6">
	                        <input id="cornet" type="cornet" class="form-control" name="cornet" placeholder="若无可不填" autocomplete="off">
	                    </div>
	                </div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
					<button type="submit" class="btn btn-primary">确认修改</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="container">
	<div class="table-responsive">
		<table class="table table-hover table-bordered">
			<thead>
				<tr>
					<th>管理员编号</th>
					<th>昵称</th>
					<th>姓名</th>
					<th>性别</th>
					<th>手机号</th>
					<th>短号</th>
					<th>校区</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
	<?php
		if(isset($rows)){
			foreach($rows as $row){
				echo "<tr><td>".$row['gid']."</td><td>".$row['user']."</td><td>".$row['realname']."</td><td>".$row['sex']."</td><td>".$row['tel']."</td><td>".$row['cornet']."</td><td>".$row['compus']."</td><td><button data-gid='".$row['gid']."' class='revise'>修改</button><button data-gid='".$row['gid']."' class='del'>删除</button></td></tr>";
			}
		}

	?>
			</tbody>
		</table>
	</div>
</div>	

</body>
</html>