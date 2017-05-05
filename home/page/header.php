<header class="header">
	<div class="logo"><img src="../img/logo.jpg" height="48px"></div>
	<span class="welcome"><a href="index.php">欢迎使用在线宿舍报修系统!</a></span>
	
	<?php
        if(isset($_SESSION['user'])){
        echo "<span class='user'>您好,
				<a href='javascript:;' class='toggle' id='menu-toggle'> ".
					$_SESSION['user'] ." <i class='glyphicon glyphicon-list'></i>
				</a>
			</span>
			<ul
			    class='menu'
			    data-menu
			    data-menu-toggle='#menu-toggle'>
			    <li>
			    	<a href='personCenter.php' target='_blank'>个人中心</a>
			    </li>
			    <li class='menu-separator'></li>
			    <li>
			    	<a href='record.php' target='_blank'>报修记录</a>
			    </li>
			    
			    <li class='menu-separator'></li>
			    <li>
			    	<a href='../control/outHandle.php'>退出登录</a>
			    </li>
			</ul>
			";
        }else{
            echo "<span class='login'>如需报修，请<a href='login.html'>登录</a></span>";
        }
    ?>        
</header>