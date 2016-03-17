<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>

</head>

<body>
	<?php session_start();?>
  <div id="xx_dis">
 <div class="jbxx" align="center" id="jbxx_dis" style="line-height:1.5em;">
<?php
		ob_end_flush();//关闭缓存 
	 	$host = '127.0.0.1';
		$username = 'a0909221552';
		$password = '1010100QQ';
		$db_name = 'a0909221552';
		
		$connI =new mysqli($host, $username, $password, $db_name);
		$connI->query("set names utf8");
		$connI->query("reset query cache");

				
		//PHP脚本也是看顺序的。。。在代码前先执行...
		//取出角色uuid信息
		$sql = "select uuid from tb_gjd_user where username='".$_SESSION['username']."'";
		$query = $connI->query($sql);
		$result = $query->fetch_array();
		$uuid = $result[0];
		
		//取出角色基本信息
		$sql_jbxx = "select * from tb_gjd_jbxx where uuid = '$uuid'";
		$query_jbxx = $connI->query($sql_jbxx);
		$result_jbxx = $query_jbxx->fetch_array();
		$user_tx = (string)$result_jbxx['user_tx'];			//头像信息
		$user_name = (string)$result_jbxx['user_name'];		//角色名
		$user_level = $result_jbxx['user_level'];			//角色等级
		$dao_level = $result_jbxx['dao_level'];				//小岛等级
		$money = $result_jbxx['money'];						//当前金钱信息
		$money_h = $result_jbxx['money_h'];					//金钱收益
		$jingyan_h = $result_jbxx['jingyan_h'];				//经验收益
		$vip = $result_jbxx['vip'];

		//取出角色战斗信息
		$sql_zdxx = "select * from tb_gjd_zdxx where uuid = '$uuid'";
		$query_zdxx = $connI->query($sql_zdxx);
		$result_zdxx = $query_zdxx->fetch_array();
		$hp = $result_zdxx['hp'];					//角色血量
		$mp = $result_zdxx['mp'];					//角色蓝量		
		$attck = $result_zdxx['attck'];				//角色攻击
		$fy = $result_zdxx['fy'];					//角色防御
		$jyz = $result_zdxx['jyz'];					//角色当前经验值
		$jyz_level = $result_zdxx['jyz_level']; 		//角色当前等级升级所需经验值
		?>
      角色等级：<?php echo $user_level;?><br>小岛等级：<?php echo $dao_level;?><br>金钱：<?php echo $money;?><br>收益：金钱<?php echo $money_h;?>/h,经验<?php echo $jingyan_h?>/h</div>
                                	<div class="zdxx_none" align="center" id="zdxx_dis">生命值：<?php echo $hp;?><br>法力值：<?php echo $mp;?><br>攻击力：<?php echo $attck;?><br>防御：<?php echo $fy;?><br>经验值：<?php echo $jyz;?>/<?php echo $jyz_level;?></div>
     </div>  
</body>
</html>