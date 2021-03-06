<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache">
	<meta http-equiv="Expires" content="0">
	<title>全部报修单</title>
	<!-- <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"> -->
	<link rel="stylesheet" type="text/css" href="../css/bootstrap-table.css">
	<link rel="stylesheet" type="text/css" href="../css/zeroModal.css">
	<link rel="stylesheet" type="text/css" href="../css/regsTable.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-table.js"></script>
	<script type="text/javascript" src="../js/bootstrap-table-zh-CN.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-table-export.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap-table-toolbar.min.js"></script>
	<script type="text/javascript" src="../js/tableExport.js"></script>
	<script type="text/javascript" src="../js/zeroModal.min.js"></script>
</head>
<body>
	<section id="regs">
		<div id="toolbar">
			<button id="details" class="btn btn-default" disabled>
	            <i class="glyphicon glyphicon-eye-open"></i>  查看详情
	        </button>            
        </div>
        <div id="out">
        	<select class="form-control">
                <option value="">导出当前表</option>
                <option value="all">导出全部记录</option>
                <option value="selected">导出被选项</option>
            </select>
        </div>
		<table	id="table"
	            data-toolbar="#toolbar"
	            data-toggle="table"
	            data-show-columns="true"
	            data-search="true"
	            data-advanced-search="true"
		        data-id-table="advancedTable"
	            data-show-refresh="true"
	            data-show-toggle="true"
	            data-show-export="true"
	            data-detail-formatter="detailFormatter"
	            data-radio="true"
	            data-id-field="id"
	            data-undefined-text="暂无数据"
	            data-pagination="true"
	            data-height="500"
	            data-sort-stable="true"
	            data-pagination="true"
	            data-page-size="8"
	            data-select-item-name="radio"
	            data-checkbox-header="true"
	            data-url="../control/allRegs.php">
			<thead>
				<tr>
					<th data-field="state" data-radio="true"></th>
					<th data-field="id" data-sortable="true" data-width="50px">ID</th>
					<th data-field="nid" data-sortable="true" data-width="120px">维修单编号</th>
					<th data-field="uid" data-sortable="true" data-width="120px">用户ID</th>
					<th data-field="regman" data-width="100px">报修人</th>
					<th data-field="tel" data-width="180px">联系方式</th>
					<th data-field="compus" data-sortable="true" data-width="100px">校区</th>
					<th data-field="building" data-sortable="true" data-width="130px">楼栋</th>
					<th data-field="room" data-sortable="true" data-width="100px">房间号</th>
					<th data-field="equipment" data-width="120px">报修设备</th>
					<th data-field="othertext" class="othertext" data-width="150px">报修情况补充</th>
					<th data-field="time" class="othertext" data-sortable="true" data-width="150px">预约时间</th>
					<th data-field="regtime" data-sortable="true" data-width="180px">登记时间</th>
					<th data-field="currentStatus" data-sortable="true" data-width="150px">当前状态</th>
					<th data-field="updateTime" data-sortable="true" data-width="180px">更新时间</th>
					<th data-field="repairman" data-sortable="true" data-width="100px">维修员</th>
				</tr>
			</thead>
		</table>
	</section>
	<script type="text/javascript" src="../js/regs.js"></script>
</body>
</html>