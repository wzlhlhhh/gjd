<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>挂机岛岛民登记中心</title>
</head>
<style>
	header{
		font-size:38px;
		font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
		font-weight:bold;
		color:#F72528;
	}
	
	.bg{
		background:url(bg_image/xiaodao2.jpg);
	}
	
	td{
		font-family:"Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, sans-serif;
		font-size:25px;
		color:red;
	}
	
	.tdr{
		position:relative;
		right:20px;
	}
	.tdl{
		position:relative;
		left:20px;
	}
</style>
<body><?php session_start();?>
	<header align="center">~~挂机岛岛民登记中心~~</header>
    <div class="bg">
    <table border="0" cellpadding="0" cellspacing="0" align="center" vspace="top" height="400">
    <tr><td>
    	<table border="0" cellpadding="0" cellspacing="0" align="center" height="300" width="600"><form action="" method="post" name="form1">
        	<tr>
        		<td height="60" align="right" class="tdr">岛民登记号：</td>
        		<td class="tdl" align="left"><input type="text" name="username" id="username" placeholder="请输入6位以上的字母/数字"></td>
        	</tr>
        	<tr>
        		<td height="60" class="tdr" align="right">岛民口令：</td>
        		<td class="tdl" align="left"><input type="password" name="pwd" id="pwd" placeholder="请输入6位以上的字母/数字"></td>
        	</tr>
        	<tr>
        		<td height="60" class="tdr" align="right">确认岛民口令：</td>
        		<td class="tdl" align="left"><input type="password" name="chkpwd" id="chkpwd"></td>
        	</tr>
        	<tr>
        		<td height="60" class="tdr" align="right">找回密码的邮箱：</td>
        		<td class="tdl" align="left"><input type="email" name="email" id="email" placeholder="这是你找回口令的唯一凭据"></td>
        	</tr>
        	<tr>
        		<td height="60" class="tdr" align="right"><input type="submit" value="登记" name="dj" id="dj"></td>
        		<td class="tdl" align="left"><input type="reset" value="清空"></td>
        	</tr></form>
        </table>
        </td></tr>
        
        <tr>
        	
        </tr>
        </table>
    </div>
    <?php
		function chkmail($email)
		{
			$str = '/[0-9]*[a-z]*[A-Z]*@[0-9]*[a-z]*[A-Z]*.com/';
			$num = preg_match($str, $email);
			if($num != 0)
				return true;
			else
				return false;
		}
    	if(isset($_POST['dj']))
		{
			$username_zc = $_POST['username'];
			$pwd_zc = $_POST['pwd'];
			$chkpwd_zc = $_POST['chkpwd'];
			$email_zc = $_POST['email'];
			
			//echo $username.$pwd.$chkpwd.$email;
			//echo strlen($username);
			//验证注册信息
			if(!isset($username_zc) || (strlen($username_zc)<6))
			{
				//echo strlen($_POST['username']);
				echo "<script>alert('请输入岛民登记号！');</script>";
				return false;
			}
			else if(!isset($pwd_zc) || (strlen($pwd_zc)<6))
			{
				echo "<script>alert('请输入岛民口令！');</script>";
				return false;
			}
			else if(!isset($chkpwd_zc) || ($pwd_zc != $chkpwd_zc))
			{
				echo "<script>alert('请确认岛民口令！');</script>";
				return false;
			}
			else if(!chkmail($email_zc))
			{
				echo "<script>alert('请输入正确的邮箱！这是您找回密码的唯一依据！');</script>";
				return false;
			}
			//var_dump($_POST);
			
			//验证无误，写入数据库
			include("conmysql.php");
			//检查是否已经有这个用户注册
			$query = $connID->query("select * from tb_gjd_user where username='$username_zc'");
			$querynum = $query->num_rows;
			echo $querynum;
			//随机一个8位uuid
			$uuid = rand(10000000, 99999999);
			$user_name = (string)$uuid;
			//var_dump($user_name);
			//写入user表进行注册
			$sql = "insert into tb_gjd_user(username, password,email, uuid) values('$username_zc', '$pwd_zc', '$email_zc', '$uuid')";
			$queryint = $connID->query($sql);
			//$queryintt = $queryint->num_rows;
			
			if($queryint)
			{
				//初始化jbxx表,uuid是主键，角色名默认uuid号，角色头像默认nv_01，角色等级默认为1，小岛等级默认为1，金钱默认为500，金钱收益0/h,小岛经验10/h
				$sql = "insert into tb_gjd_jbxx(uuid, user_tx, user_name, user_level, dao_level, money, money_h, jingyan_h) values('$uuid', 'tx_image/tx_nv_01.jpg','$user_name', '1', '1', '500', '0', '10')";
				$jbxxresult = $connID->query($sql);
				if(!$jbxxresult)
				{
					echo "<script>alert('发生未知错误！jbxx');</script>";
					return false;
				}
				
				//初始化zdxx表，uuid主键，hp是角色血量，mp是角色蓝量， attck是角色攻击，fy是角色防御，jyz是角色当前经验值，jyz_level是升级经验值
				$sql = "insert into tb_gjd_zdxx(uuid, hp, mp, attck, fy, jyz, jyz_level, zb_wq, zb_zj, zb_kz, zb_xz) values('$uuid', '100', '100', '10', '5', '0', '10', '10级武器', '10级战甲', '10级裤子', '10级鞋子')";
				$zdxxresult = $connID->query($sql);
				if(!$zdxxresult)
				{
					echo "<script>alert('发生未知错误！zdxx');</script>";
					return false;
				}
				
				//初始化hdzt表，uuid主键，dy\zz\dl\gc\jg为活动状态（0/1），XX_level为活动等级，XX_time为活动持续时间
				$sql = "insert into tb_gjd_hdzt(uuid, dy, dl, zz, gc, jg) values('$uuid', 0, 0, 0, 0, 0)";
				$hdztresult = $connID->query($sql);
				if(!$hdztresult)
				{
					echo "<script>alert('发生未知错误！hdzt');</script>";
					return false;
				}
			}
			
			
			
			if($queryint)
			{
				$_SESSION['username'] = $username_zc;
				echo "<script>alert('岛民已登记！接下来将跳转到首页！');</script>";
				echo "<script>window.location.href='first.php'</script>";
				$connID->close();
			}
			elseif($querynum == 1) 
			{		
					echo "haha";
					echo "<script>alert('用户名重复,注册失败！');</script>";
			}
			else
			{
				echo "<script>alert('服务器繁忙，请稍后再试！');</script>";
			}
		}
	?>
</body>
</html>