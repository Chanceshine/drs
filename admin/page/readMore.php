<?php
session_start();
require_once("../control/readMore.php");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>报修单详情</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/readMore.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">	
	<div class="table-responsive">
		<table class="table table-bordered">
			<caption><h2>在线宿舍报修系统--报修详单</h2></caption>
			<tr>
				<td class="bg">报修单</td>
				<td><?php echo $rows[0]['nid'];?></td>
				<td class="bg">学工号</td>
				<td><?php echo $rows[0]['uid'];?></td>
				<td class="bg">姓名</td>
				<td><?php echo $rows[0]['regman'];?></td>
			</tr>
			<tr>
				<td class="bg">报修校区</td>
				<td><?php echo $rows[0]['compus'];?></td>
				<td class="bg">详细地址</td>
				<td><?php echo $rows[0]['building'].$rows[0]['room'];?></td>
				<td class="bg">联系方式</td>
				<td><?php echo $rows[0]['tel'];?></td>
			</tr>
			<tr>
				<td class="bg">报修设备</td>
				<td colspan="5"><?php echo $rows[0]['equipment'];?></td>
			</tr>
			<tr>
				<td class="bg">故障描述</td>
				<td colspan="5"><?php echo $rows[0]['othertext'];?></td>
			</tr>
			<tr>
				<td class="bg">报修时间</td>
				<td><?php echo $rows[0]['regtime'];?></td>
				<td class="bg">预约时间</td>
				<td><?php echo $rows[0]['time'];?></td>
				<td class="bg">当前状态</td>
				<td><?php echo $rows[0]['currentStatus'];?></td>
			</tr>
			<?php if ($rows[0]['currentStatus']!='被驳回'): ?>
			<tr>
				<td class="bg">审核时间</td>
				<td><?php
				if ($rows[1][1]['statetime']) {
					echo $rows[1][1]['statetime'];
				}else{
					echo "暂无";
				}
				?></td>
				<td class="bg">审核人</td>
				<td colspan="3"><?php
				if ($rows[1][1]['operator']) {
					echo $rows[1][1]['operator'];
				}else{
					echo "暂无";
				}
				?></td>
			</tr>
			<tr>
				<td class="bg">派员时间</td>
				<td><?php
				if ($rows[1][2]['statetime']) {
					echo $rows[1][2]['statetime'];
				}else{
					echo "暂无";
				}
				?></td>
				<td class="bg">派员人</td>
				<td><?php
				if ($rows[1][2]['operator']) {
					echo $rows[1][2]['operator'];
				}else{
					echo "暂无";
				}
				?></td>
				<td class="bg">维修员</td>
				<td><?php echo $rows[0]['repairman'];?></td>
			</tr>
			<tr>
				<td class="bg">完成时间</td>
				<td><?php
				if ($rows[1][3]['statetime']) {
					echo $rows[1][3]['statetime'];
				}else{
					echo "暂无";
				}
				?></td>
				<td class="bg">用户评价</td>
				<td>
					<?php if ($rows[2]['complain'] != null && $rows[1][3]['statetime'] != null): ?>
						<a href="mycomplain.php" target="_blank">已投诉</a>
					<?php elseif ($rows[2]['revaluate'] == null && $rows[2]['sevaluate'] == null && $rows[1][3]['statetime'] != null): ?>
						暂无

					<?php elseif (($rows[2]['revaluate'] != null || $rows[2]['sevaluate'] != null) && $rows[1][3]['statetime'] != null): ?>
						已评价
					<?php else: ?>
						暂无
					<?php endif ?>
				</td>
				<td class="bg">评价时间</td>
				<td>
					<?php if ($rows[2]['posttime']): ?>
						<? echo $rows[2]['posttime'];?>
					<?php else: ?>
						暂无
					<?php endif ?>
				</td>
			</tr>
			<?php else: ?>
			<tr>
				<td class="bg">驳回时间</td>
				<td><?php
				if ($rows[1][1]['statetime']) {
					echo $rows[1][1]['statetime'];
				}else{
					echo "暂无";
				}
				?></td>
				<td class="bg">驳回人</td>
				<td><?php
				if ($rows[1][1]['operator']) {
					echo $rows[1][1]['operator'];
				}else{
					echo "暂无";
				}
				?></td>
				<td class="bg">驳回理由</td>
				<td><?php
				if ($rows[1][1]['reason']) {
					echo $rows[1][1]['reason'];
				}else{
					echo "暂无";
				}
				?></td>
			</tr>
			<?php endif ?>
		</table>
	</div>
</div>
</body>
</html>