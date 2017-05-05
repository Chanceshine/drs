<?php
	session_start();
	require_once("../control/showNotice.php");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>报修记录</title>
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">
	<link rel="stylesheet" type="text/css" href="../css/tabs-vertical.css">
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">		
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-table.css">
	<link rel="stylesheet" type="text/css" href="../css/zeroModal.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
	<link rel="stylesheet" type="text/css" href="../css/foot.css">
	<link rel="stylesheet" type="text/css" href="../css/record.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/record.js"></script>
	<script type="text/javascript" src="../js/bootstrap-table.js"></script>
	<script type="text/javascript" src="../js/bootstrap-table-zh-CN.min.js"></script>
	<script type="text/javascript" src="../js/zeroModal.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>	
</head>
<body>
<!-- 头部 -->
<?php include 'header.php';?>

<div class="modal fade" id="appeal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="exampleModalLabel">报修申诉</h4>
			</div>
			<div class="modal-body">
				<form>
					<div class="form-group">
						<label for="message-text" class="control-label">申诉理由(300字以内):</label>
						<textarea class="form-control" id="reason" placeholder="请填写您的申诉理由"></textarea>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
				<button type="button" id="pass" class="btn btn-primary">提交申诉</button>
			</div>
		</div>
	</div>
</div>

<div id="box">
	<center><h1>个人报修记录</h1></center>
	<div class="tabs-vertical">
		<ul id="nav">
			<li>
				<a class="tab-active" data-index="0" href="#">未审核</a>
			</li>
			<li>
				<a data-index="1" href="#">审核通过</a>
			</li>
			<li>
				<a data-index="2" href="#">维修中</a>
			</li>
			<li>
				<a data-index="3" href="#">已完成</a>
			</li>
			<li>
				<a data-index="4" href="#">被驳回</a>
			</li>
		</ul>
        <div id="tab_content" class="tabs-content-placeholder">
			<section class="tab-content-active">	<!-- 未审核 -->
				<table	id="unaudited"
					data-toggle="table"
					data-show-columns="true"
					data-search="true"
					data-show-refresh="true"
					data-show-toggle="true"
					data-detail-formatter ="detailFormatter"
					data-checkbox ="true"
					data-id-field ="id"
					data-pagination ="true"
					data-sort-stable ="true"
					data-pagination ="true"
					data-page-size ="8"
					data-height="450"
					data-select-item-name ="checkbox"
					data-checkbox-header ="true"
					data-url ="../control/unaudited.php">
					<thead>
						<tr>
							<th data-field="nid" data-sortable="true" data-width="120px">维修单编号</th>
							<th data-field="uid" data-width="120px">学工号</th>
							<th data-field="regman" data-width="100px">报修人</th>
							<th data-field="tel" data-width="180px">联系方式</th>
							<th data-field="compus" data-sortable="true" data-width="100px">校区</th>
							<th data-field="building" data-sortable="true" data-width="130px">楼栋</th>
							<th data-field="room" data-sortable="true" data-width="100px">房间号</th>
							<th data-field="equipment" data-width="120px">报修设备</th>
							<th data-field="othertext" class="othertext" data-width="150px">报修情况补充</th>
							<th data-field="regtime" data-sortable="true" data-width="180px">登记时间</th>
							<th data-field="time" class="othertext" data-width="150px">预约时间</th>
							<th data-field="operate" data-formatter="operateFormatter" 	data-events="operateEvents" data-width="150px">操作</th>
						</tr>
					</thead>
				</table>
			</section>

			<section>		<!-- 审核通过 -->
				<table	id="pass"
					data-toggle="table"
					data-show-columns="true"
					data-search="true"
					data-show-refresh="true"
					data-show-toggle="true"
					data-detail-formatter ="detailFormatter"
					data-checkbox ="true"
					data-id-field ="id"
					data-pagination ="true"
					data-sort-stable ="true"
					data-pagination ="true"
					data-page-size ="8"
					data-height="380"
					data-select-item-name ="checkbox"
					data-checkbox-header ="true"
					data-url ="../control/pass.php">
					<thead>
						<tr>
							<th data-field="nid" data-sortable="true" data-width="120px">维修单编号</th>
							<th data-field="uid" data-width="120px">学工号</th>
							<th data-field="regman" data-width="100px">报修人</th>
							<th data-field="tel" data-width="180px">联系方式</th>
							<th data-field="compus" data-sortable="true" data-width="100px">校区</th>
							<th data-field="building" data-sortable="true" data-width="130px">楼栋</th>
							<th data-field="room" data-sortable="true" data-width="100px">房间号</th>
							<th data-field="equipment" data-width="120px">报修设备</th>
							<th data-field="othertext" class="othertext" data-width="150px">报修情况补充</th>
							<th data-field="time" class="othertext" data-width="150px">预约时间</th>
							<th data-field="regtime" data-sortable="true" data-width="180px">登记时间</th>
							<th data-field="updateTime" data-sortable="true" data-width="180px">审核时间</th>
							<th data-field="currentStatus" data-sortable="true" data-width="180px">审核结果</th>
							<th data-field="operate" data-formatter="operateFormatter" 	data-events="operateEvents" data-width="150px">操作</th>
						</tr>
					</thead>
				</table>
			</section>
			
			<section>		<!-- 进行中 -->
				<table	id="repairing"
					data-toggle="table"
					data-show-columns="true"
					data-search="true"
					data-show-refresh="true"
					data-show-toggle="true"
					data-detail-formatter ="detailFormatter"
					data-checkbox ="true"
					data-id-field ="id"
					data-pagination ="true"
					data-sort-stable ="true"
					data-pagination ="true"
					data-page-size ="8"
					data-height="380"
					data-select-item-name ="checkbox"
					data-checkbox-header ="true"
					data-url ="../control/repairing.php">
					<thead>
						<tr>
							<th data-field="nid" data-sortable="true" data-width="120px">维修单编号</th>
							<th data-field="uid" data-width="120px">学工号</th>
							<th data-field="regman" data-width="100px">报修人</th>
							<th data-field="tel" data-width="180px">联系方式</th>
							<th data-field="compus" data-sortable="true" data-width="100px">校区</th>
							<th data-field="building" data-sortable="true" data-width="130px">楼栋</th>
							<th data-field="room" data-sortable="true" data-width="100px">房间号</th>
							<th data-field="equipment" data-width="120px">报修设备</th>
							<th data-field="othertext" class="othertext" data-width="150px">报修情况补充</th>
							<th data-field="time" class="othertext" data-width="150px">预约时间</th>
							<th data-field="regtime" data-sortable="true" data-width="180px">登记时间</th>
							<th data-field="updateTime" data-sortable="true" data-width="180px">分配时间</th>
							<th data-field="repairman" data-sortable="true" data-width="180px">维修员</th>
							<th data-field="operate" data-formatter="operateFormatterMore" 	data-events="operateEvents" data-width="180px">操作</th>
						</tr>
					</thead>
				</table>
			</section>

			<section>		<!-- 已完成 -->
				<table	id="repaired"
					data-toggle="table"
					data-show-columns="true"
					data-search="true"
					data-show-refresh="true"
					data-show-toggle="true"
					data-detail-formatter ="detailFormatter"
					data-checkbox ="true"
					data-id-field ="id"
					data-pagination ="true"
					data-sort-stable ="true"
					data-pagination ="true"
					data-page-size ="8"
					data-height="380"
					data-select-item-name ="checkbox"
					data-checkbox-header ="true"
					data-url ="../control/complete.php">
					<thead>
						<tr>
							<th data-field="nid" data-sortable="true" data-width="120px">维修单编号</th>
							<th data-field="uid" data-width="120px">学工号</th>
							<th data-field="regman" data-width="100px">报修人</th>
							<th data-field="tel" data-width="180px">联系方式</th>
							<th data-field="compus" data-sortable="true" data-width="100px">校区</th>
							<th data-field="building" data-sortable="true" data-width="130px">楼栋</th>
							<th data-field="room" data-sortable="true" data-width="100px">房间号</th>
							<th data-field="equipment" data-width="120px">报修设备</th>
							<th data-field="othertext" class="othertext" data-width="150px">报修情况补充</th>
							<th data-field="time" class="othertext" data-width="150px">预约时间</th>
							<th data-field="regtime" data-sortable="true" data-width="180px">登记时间</th>
							<th data-field="updateTime" data-sortable="true" data-width="180px">完成时间</th>
							<th data-field="repairman" data-sortable="true" data-width="180px">维修员</th>
							<th data-field="operate" data-formatter="operateFormattereval" 	data-events="operateEvents" data-width="150px">操作</th>
						</tr>
					</thead>
				</table>
			</section>

			<section>		<!-- 被驳回 -->
				<table	id="revoke"
					data-toggle="table"
					data-show-columns="true"
					data-search="true"
					data-show-refresh="true"
					data-show-toggle="true"
					data-detail-formatter ="detailFormatter"
					data-checkbox ="true"
					data-id-field ="id"
					data-pagination ="true"
					data-sort-stable ="true"
					data-pagination ="true"
					data-page-size ="8"
					data-height="380"
					data-select-item-name ="checkbox"
					data-checkbox-header ="true"
					data-url ="../control/revoke.php">
					<thead>
						<tr>
							<th data-field="nid" data-sortable="true" data-width="120px">维修单编号</th>
							<th data-field="currentStatus" data-width="100px">当前状态</th>
							<th data-field="uid" data-width="120px">学工号</th>
							<th data-field="regman" data-width="100px">报修人</th>
							<th data-field="tel" data-width="180px">联系方式</th>
							<th data-field="compus" data-sortable="true" data-width="100px">校区</th>
							<th data-field="building" data-sortable="true" data-width="130px">楼栋</th>
							<th data-field="room" data-sortable="true" data-width="100px">房间号</th>
							<th data-field="equipment" data-width="120px">报修设备</th>
							<th data-field="othertext" class="othertext" data-width="150px">报修情况补充</th>
							<th data-field="time" class="othertext" data-width="150px">预约时间</th>
							<th data-field="regtime" data-sortable="true" data-width="180px">登记时间</th>
							<th data-field="updateTime" data-sortable="true" data-width="180px">驳回时间</th>
							<th data-field="repairman" data-sortable="true" data-width="180px">驳回理由</th>
							<th data-field="operate" data-formatter="appeal" data-events="operateEvents" data-width="150px">操作</th>
						</tr>
					</thead>
				</table>
			</section>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('[data-menu]').menu();	//个人中心下拉菜单
</script>

</body>
</html>