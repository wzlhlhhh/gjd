<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>无标题文档</title>
<style>
	html,body{
overflow:hidden;
height:100%;
}
</style>
<script>
	function ajax()
	{
		window.parent.ajax();
	}
</script>
</head>

<body><?php session_start();?>
<?php
    	include("./conmysql.php");
		error_reporting(0);
		//获取uuid
		$sql = "select uuid from tb_gjd_user where username='".$_SESSION['username']."'";
		$query = $connID->query($sql);
		$result = $query->fetch_array();
		$uuid = (int)$result[0];
		?>
	<div style="height:600px; width:700px;">
    	<table style="position:absolute; top:200px; left:140px;" width="400" height="300" align="center" border="2" cellpadding="0" cellspacing="0"><form action="" method="post" name="formzz">
    		<tr>
    			<td align="center" height="50" colspan="4">在V1.0.0版本入驻的玩家可以抽奖来提高属性！<br>奖品列表：</td>
    		</tr>
    		<tr>
    			<td width="100px" height="50">等级提升3级！</td>
    			<td width="100px">金钱获得99！</td>
    			<td width="100px">攻击力+10！</td>
    			<td width="100px">防御力+2！</td>
                
    		</tr>
            <tr>
            	<td align="center" colspan="2">屠龙宝刀！！(1/100000)</td>
            	<td align="center" colspan="2">VIP等级！！(1/100000)</td>
            </tr>
    		<tr>
    			<td colspan="4" align="center" ><input type="submit" value="抽奖" name="cj" style="font-size:100px;" onClick="ajax()"></td>
    		</tr>
    	</form></table>
    </div>
    <?php
    	if($_POST['cj'])
		{	//每个机会均等
			$a = rand(1,4);
			$b = rand(1,100000);
			switch($a)
			{
				case '1':echo "<script>alert('恭喜你抽得--等级提升3级!');</script>";
				$sql_level = "update tb_gjd_jbxx set user_level = user_level + 3 where uuid = '$uuid'";
				$query_level = $connID->query($sql_level);
				if(!$query_level)
				{
					echo "<script>alert('写入level等级失败！！！！');</script>";
				}
				//写属性，HP+300，MP+300
				$sql_insert_hp = "update tb_gjd_zdxx set hp = hp + 300 where uuid = '$uuid'";
				$query_insert_hp = $connID->query($sql_insert_hp);
				if(!$query_level)
				{
					echo "<script>alert('写入insert_hp等级失败！！！！');</script>";
				}
				
				 break;
				case '2':echo "<script>alert('恭喜你获得--金钱99！');</script>"; 
				$sql_money = "update tb_gjd_jbxx set money = money + 99 where uuid = '$uuid'";
				$query_money = $connID->query($sql_money);
				if(!$query_money)
				{
					echo "<script>alert('写入money失败！！！！');</script>";
				}	
				break;
				case '3':echo "<script>alert('恭喜你获得--攻击力+10！');</script>";
				 $sql_gj = "update tb_gjd_zdxx set attck = attck + 10 where uuid = '$uuid'";
				$query_gj = $connID->query($sql_gj);
				if(!$query_gj)
				{
					echo "<script>alert('写入攻击失败！！！！');</script>";
				}
				 break;
				case '4':echo "<script>alert('恭喜你获得--防御+2！');</script>"; 
				$sql_gj = "update tb_gjd_zdxx set fy = tb_gjd_zdxx.fy+ 2 where uuid = '$uuid'";
				$query_gj = $connID->query($sql_gj);
				if(!$query_gj)
				{
					echo "<script>alert('写入防御失败！！！！');</script>";
				}
				break;
			}
			if($b == 123456)
			{
				echo "<script>alert('恭喜你抽得--屠龙宝刀！！');</script>";
				$sql_select = "select * from tb_gjd_zb where uuid='$uuid' and zb_name='屠龙宝刀'";
				$query_select = $connID->query($sql_select);
				$num = $query_select->num_rows;
				if($num == 0)
				{
					$sql_tlbd = "insert into tb_gjd_zb(uuid, zb_name, zb_pic, zb_dis, zb_count) values('$uuid', '屠龙宝刀', 'thing_image/tlbd.jpg', '传说中的屠龙宝刀，自带VIP1，攻击+1000，防御+100', 1)";
					
				$query_tlbd = $connID->query($sql_tlbd);
				if(!$query_tlbd)
				{
					echo "<script>alert('获取屠龙宝刀失败！！！！');</script>";
				}
				$sql_update_gj = "update tb_gjd_zdxx set attck=attck+1000 where uuid='$uuid'";
				$sql_update_fy = "update tb_gjd_zdxx set fy=fy+100 where uuid='$uuid'";
				$query_update = $connID->query($sql_update_gj);
				if(!$query_update)
				{
					echo "<script>alert('获取屠龙宝刀攻击失败！！！！');</script>";
				}
				$query_update = $connID->query($sql_update_fy);
				if(!$query_update)
				{
					echo "<script>alert('获取屠龙宝刀防御失败！！！！');</script>";
				}
				
				$sql_vip = "update tb_gjd_jbxx set vip = vip + 1 where uuid = '$uuid'";
				$query_vip = $connID->query($sql_vip);
				if(!$query_vip)
				{
					echo "<script>alert('写入VIP等级失败！！！！');</script>";
				}
				}
				else
				{
					$sql_tlbd =  "update tb_gjd_zb set zb_count = zb_count + 1 where uuid='$uuid' and zb_name = '屠龙宝刀'";
				$query_tlbd = $connID->query($sql_tlbd);
				if(!$query_tlbd)
				{
					echo "<script>alert('更新屠龙宝刀失败！！！！');</script>";
				}
				$sql_update_gj = "update tb_gjd_zdxx set attck=attck+1000 where uuid='$uuid'";
				$sql_update_fy = "update tb_gjd_zdxx set fy=fy+100 where uuid='$uuid'";
				$query_update = $connID->query($sql_update_gj);
				if(!$query_update)
				{
					echo "<script>alert('获取屠龙宝刀攻击失败！！！！');</script>";
				}
				$query_update = $connID->query($sql_update_fy);
				if(!$query_update)
				{
					echo "<script>alert('获取屠龙宝刀防御失败！！！！');</script>";
				}
				
				$sql_vip = "update tb_gjd_jbxx set vip = vip + 1 where uuid = '$uuid'";
				$query_vip = $connID->query($sql_vip);
				if(!$query_vip)
				{
					echo "<script>alert('写入VIP等级失败！！！！');</script>";
				}
				}
			}
			if($b == 234567)
			{
				echo "<script>alert('恭喜你抽得--VIP等级+1！！');</script>";
				$sql_vip = "update tb_gjd_jbxx set vip = vip + 1 where uuid = '$uuid'";
				$query_vip = $connID->query($sql_vip);
				if(!$query_vip)
				{
					echo "<script>alert('写入VIP等级失败！！！！');</script>";
				}
			}
		}
	?>
</body>
</html>