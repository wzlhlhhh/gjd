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
</head>

<body><?php session_start();//获取包裹信息?>
	<?php
    	include("conmysql.php");
		//获取uuid
		$sql = "select uuid from tb_gjd_user where username='".$_SESSION['username']."'";
		$query = $connID->query($sql);
		$result = $query->fetch_array();
		$uuid = $result[0];
		
		$sql = "select * from tb_gjd_bg where uuid='$uuid'";
		$query = $connID->query($sql);
		
		//使用函数，定义这个物品是否有使用按钮
		function check_sy($bg_name)
		{
			if(($bg_name == '1级的鱼') || ($bg_name == '5级的鱼') || ($bg_name == '10级的鱼') || ($bg_name == '1级植物') || ($bg_name == '5级植物') || ($bg_name == '10级植物') || ($bg_name == '1级骨头') || ($bg_name == '5级骨头') || ($bg_name == '10级骨头'))
				return false;
			else
				return true;
		}
	?>
	<div style="height:600px; width:700px; background-image: url(thing_image/baobao.jpg); background-repeat:round;">
    	<table border="1" cellspacing="0" cellpadding="0" width="600px">
        	<tr align="center">
				<td height="25px">物品图像</td>
				<td>物品名称</td>
				<td>物品数量</td>
				<td>物品描述</td>
                <!--使用，出售-->
                <td colspan="2">互动</td>
			</tr>
			<?php
				/*//每页显示8条物品信息
				$i=0;
				if(!isset($_GET['bg_page']))//取得页码
				{
					$page = 1;
				}
				else
				{
					$page = $_GET['bg_page'];
				}
				*/
            	while($result = $query->fetch_array())//显示背包信息
				{	
					/*if($i <= ($page*4 - 4))//如果当前这条信息比$offset小，表示取过了
					{
						$i++;
						continue;
					}
					
					if($i % 4==0 && $i != 0)//8条记录跳页
					{
						$page++;
						break;
					}*/
					
					if($result['bg_count']==0)
					{
						continue;
					}
					?>
					<tr align="center">
						<td height="50px" align="center"><img src="<?php echo (string)$result['bg_pic'];?>" alt="" height="50" width="50"></td>
						<td><?php echo $result['bg_name'];?></td>
						<td><?php echo $result['bg_count'];?></td>
						<td><?php echo $result['bg_dis'];?></td>
                        <td align="center"><?php if(check_sy($result['bg_name'])){?><input type="button" value="使用"><?php }?>
                        <input type="button" value="卖出"></td>
					</tr>
					<?php
					/*$i++;/**/
				}
				
				//下一页，上一页
				/*if($i % 4 == 0)
				{
					if($page != 1)
					{
						?>
                        <tr align="center">
                        	<td><a href="bg.php?page=<?php echo $page;?>">下一页</a><td>
                        </tr>
                        <?php
					}
				}
				else
				{
					if($page != 1)
					{?>
					<tr align="center">
                       <td><a href="bg.php?page=<?php echo $page-1;?>">上一页</a><td>
                    </tr>
					<?php
					}
				}*/
			?>
        </table>
    </div>
</body>
</html>