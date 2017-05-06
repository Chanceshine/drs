<?php
	session_start();
	if(!isset($_SESSION['user'])){
    	echo "<script>window.location.href='../page/login.html';</script>";
    }
    require_once("../control/checkSchedule.php");
?>
<!DOCTYPE html>
<html lang="zh">
<head>
	<meta charset="UTF-8">
	<title>报修进度</title>
	<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../css/menu.min.css">	
	<link rel="stylesheet" type="text/css" href="../css/jquery.eeyellow.Timeline.css">
    <link rel="stylesheet" type="text/css" href="../css/zeroModal.css">
	<link rel="stylesheet" type="text/css" href="../css/header.css">
    <link rel="stylesheet" type="text/css" href="../css/schedule.css">
	<script type="text/javascript" src="../js/jquery.min.js"></script>
	<script type="text/javascript" src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery.eeyellow.Timeline.js"></script>
    <script type="text/javascript" src="../js/zeroModal.min.js"></script>
	<script type="text/javascript" src="../js/menu.js"></script>
</head>
<body>
<!--头部-->
<?php include "header.php";?>
<?php if ($rows[0]["id"]): ?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="VivaTimeline">
                <dl>
                    <dt>报修进度</dt>

    <dd class="pos-left clearfix">
            <div class="circ"></div>
            <div class="time"><? echo $rows[0]["regtime"];?></div>
            <div class="events">
                <div class="events-header">未审核</div>
                <div class="events-body">                         
                    <div class="row">
                        <div class ="events-desc">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td>报修单编号</td>
                                        <td><? echo $rows[0]["nid"];?></td>
                                    </tr>
                                    <tr>
                                        <td>报修设备</td>
                                        <td><? echo $rows[0]["equipment"];?></td>
                                    </tr>
                                    <tr>
                                        <td>登记时间</td>
                                        <td><? echo $rows[0]["regtime"];?></td>
                                    </tr>
                                    <tr>
                                        <td>预约时间</td>
                                        <td><? echo $rows[0]["time"];?></td>
                                    </tr>
                                    <tr>
                                        <td>当前状态</td>
                                        <td>等待审核</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <a target="_blank" href="readMore.php?nid=<? echo $rows[0]["nid"];?>">查看报修单详细信息</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </dd>
    <!--?php else: ?-->
    <?php endif ?>
    <?php if ($rows[1][1]["state"]==1): ?>      
    <dd class="pos-right clearfix">
        <div class="circ"></div>
        <div class="time"><? echo $rows[1][1]["statetime"];?></div>
        <div class="events">
            <div class="events-header">审核通过</div>
            <div class="events-body">                      
                <div class="row">
                    <div class="events-desc">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>报修单编号</td>
                                    <td><? echo $rows[0]["nid"];?></td>
                                </tr>
                                <tr>
                                    <td>报修设备</td>
                                    <td><? echo $rows[0]["equipment"];?></td>
                                </tr>
                                <tr>
                                    <td>审核时间</td>
                                    <td><? echo $rows[1][1]["statetime"];?></td>
                                </tr>
                                <tr>
                                    <td>审核人</td>
                                    <td><? echo $rows[1][1]["operator"];?></td>
                                </tr>
                                <tr>
                                    <td>当前状态</td>
                                    <td>审核通过，等待分配维修员</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </dd>
    <?php endif ?>
    <?php if ($rows[1][1]["state"]==4): ?>
    <dd class="pos-right clearfix">
        <div class="circ"></div>
        <div class="time"><? echo $rows[1][1]["statetime"];?></div>
        <div class="events">
            <div class="events-header">报修单被驳回</div>
            <div class="events-body">                      
                <div class="row">
                    <div class="events-desc">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>报修单编号</td>
                                    <td><? echo $rows[0]["nid"];?></td>
                                </tr>
                                <tr>
                                    <td>报修设备</td>
                                    <td><? echo $rows[0]["equipment"];?></td>
                                </tr>
                                <tr>
                                    <td>审核时间</td>
                                    <td><? echo $rows[1][1]["statetime"];?></td>
                                </tr>
                                <tr>
                                    <td>审核人</td>
                                    <td><? echo $rows[1][1]["operator"];?></td>
                                </tr>
                                <tr>
                                    <td>当前状态</td>
                                    <td class="danger">报修单被驳回！</td>
                                </tr>
                                <tr>
                                    <td>驳回理由</td>
                                    <td><? echo $rows[1][1]["reason"];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </dd>
    <?php endif ?>
    <?php if ($rows[1][2]["state"]==5): ?>
    <dd class="pos-left clearfix">
        <div class="circ"></div>
        <div class="time"><? echo $rows[1][2]["statetime"];?></div>
        <div class="events">
            <div class="events-header">报修单申诉中</div>
            <div class="events-body">                      
                <div class="row">
                    <div class="events-desc">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>报修单编号</td>
                                    <td><? echo $rows[0]["nid"];?></td>
                                </tr>
                                <tr>
                                    <td>报修设备</td>
                                    <td><? echo $rows[0]["equipment"];?></td>
                                </tr>
                                <tr>
                                    <td>审核时间</td>
                                    <td><? echo $rows[1][2]["statetime"];?></td>
                                </tr>
                                <tr>
                                    <td>当前状态</td>
                                    <td>报修单已提交申诉</td>
                                </tr>
                                <tr>
                                    <td>申诉理由</td>
                                    <td><? echo $rows[1][2]["reason"];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </dd>
    <?php endif ?>
    <?php if ($rows[1][3]["state"]==6): ?>
    <dd class="pos-right clearfix">
        <div class="circ"></div>
        <div class="time"><? echo $rows[1][3]["statetime"];?></div>
        <div class="events">
            <div class="events-header">报修单被最终驳回</div>
            <div class="events-body">                      
                <div class="row">
                    <div class="events-desc">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>报修单编号</td>
                                    <td><? echo $rows[0]["nid"];?></td>
                                </tr>
                                <tr>
                                    <td>报修设备</td>
                                    <td><? echo $rows[0]["equipment"];?></td>
                                </tr>
                                <tr>
                                    <td>审核时间</td>
                                    <td><? echo $rows[1][3]["statetime"];?></td>
                                </tr>
                                <tr>
                                    <td>审核人</td>
                                    <td><? echo $rows[1][3]["operator"];?></td>
                                </tr>
                                <tr>
                                    <td>当前状态</td>
                                    <td class="danger">报修单被最终驳回</td>
                                </tr>
                                <tr>
                                    <td>驳回理由</td>
                                    <td><? echo $rows[1][3]["reason"];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </dd>
    <?php endif ?>

    <?php if ($rows[1][2]["state"]==2): ?>
    <dd class="pos-left clearfix">
        <div class="circ"></div>
        <div class="time"><? echo $rows[1][2]["statetime"];?></div>
        <div class="events">
            <div class="events-header">进行中</div>
            <div class="events-body">
                <div class="row">
                    <div class="events-desc">
                        <table class="table table-striped table-bordered">
                            <tbody>
                                <tr>
                                    <td>报修单编号</td>
                                    <td><? echo $rows[0]["nid"];?></td>
                                </tr>
                                <tr>
                                    <td>报修设备</td>
                                    <td><? echo $rows[0]["equipment"];?></td>
                                </tr>
                                <tr>
                                    <td>当前状态</td>
                                    <td>已分配维修员，等待上门</td>
                                </tr>
                                <tr>
                                    <td>分配时间</td>
                                    <td><? echo $rows[1][2]["statetime"];?></td>
                                </tr>
                                <tr>
                                    <td>分配人</td>
                                    <td><? echo $rows[1][2]["operator"];?></td>
                                </tr>
                                <?php if ($rows[1][3]["state"]==null): ?>
                                <tr>
                                    <td>确认任务状态</td>
                                    <td><button id="sure" data-index="<? echo $rows[0]["nid"];?>" class="btn btn-success">确认完成</button></td>
                                </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <!-- <div class="col-md-6 pull-left">
                        <img class="events-object img-responsive img-rounded" src="img/cat02.jpeg" />
                    </div> -->
                    <div class="events-desc">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th colspan="2">维修员信息</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>维修员编号</td>
                                    <td><? echo $rows[0]["repairman"];?></td>
                                </tr>
                                <tr>
                                    <td>维修员姓名</td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>维修员评分</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="events-footer">
            </div>
        </div>
    </dd>
    <?php endif ?>

    <?php if ($rows[1][3]["state"]==3): ?>
        <dd class="pos-right clearfix">
            <div class="circ"></div>
            <div class="time"><? echo $rows[1][3]["statetime"];?></div>
            <div class="events">
                <div class="events-header">维修完成</div>
                <div class="events-body">                      
                    <div class="row">
                        <div class="events-desc">
                            <table class="table table-striped table-bordered">
                                <tbody>
                                    <tr>
                                        <td>报修单编号</td>
                                        <td><? echo $rows[0]["nid"];?></td>
                                    </tr>
                                    <tr>
                                        <td>报修设备</td>
                                        <td><? echo $rows[0]["equipment"];?></td>
                                    </tr>
                                    <tr>
                                        <td>完成时间</td>
                                        <td><? echo $rows[1][3]["statetime"];?></td>
                                    </tr>
                                    <tr>
                                        <td>确认人</td>
                                        <td><? echo $rows[1][3]["operator"];?></td>
                                    </tr>
                                    <tr>
                                        <td>当前状态</td>
                                        <td>维修已完成</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <strong>
                                                <a href="evaluate.php?nid=<? echo $rows[0]["nid"];?>">去评价维修服务>></a>
                                            </strong>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </dd>
    <?php endif ?>
    <?php if ($rows[0]["id"]): ?>
                    <dt>最新进度到底啦！</dt>
                </dl>
            </div>
        </div>
    </div>
    <div class="row seeMore">查看更多 <strong><a href="record.php" target="_blank">我的报修记录</a></strong></div>
    <?php endif ?>
<?php
    if ($rows[0]['id'] ==null) {
        echo "
    <div class='remind center-block'>
        <div class='row'>
            <img src='../img/text.jpg' width='100px'>
            您暂时没有进行中的报修单哦，查看 <strong><a href='record.php'>我的报修记录</a></strong>
        </div>
    </div>";
    }?>
</div>
<script type="text/javascript" src="../js/schedule.js"></script>
</body>
</html>