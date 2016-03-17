<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>挂机岛</title>
<style>
	header{
		font-size:38px;
		font-family:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", serif;
		font-weight:bold;
		color:#F72528;
	}
	.bg{
		position:absolute;
		left:15%;
		width:70%;
		height:500px;
		top:20%;
	}
	.dl{
		font-size:26px;
		color: red;
	}
</style>
</head>

<body><?php session_start();?>
	<header align="center">~~欢迎来到挂机岛~~</header>
    <table align="center" border="0" cellpadding="0" cellspacing="0" >
    	<tr>
        	<td><img src="bg_image/xiaodao.png" alt="你可以想象下这里有一张图片，上面有岛，还有水"></td>
        </tr>
    	<tr>
        	<td>
            	<div class="dl">归来的岛民，亮出你的身份信息，我就让你上岛！</div>
            </td>
        </tr>
        <tr>
        	<td><table border="0" cellpadding="0" cellspacing="0" align="center"><form action="" name="form1" method="post">
            	<tr>
            		<td>岛民号：</td>
            		<td><input type="text" name="username" id="username"></td>
            	</tr>
            	<tr>
            		<td>岛民口令：</td>
            		<td><input type="password" name="password" id="password"></td>
            	</tr>
            	<tr>
            		<td><input type="submit" value="上岛" id="submit" name="submit"></td>
            		<td><input type="button" value="忘记口令" id="wjkl" name="wjkl" onClick=""></td>
            	</td></form></tr>
            </table>
        </tr>
    	<tr>
        	<td>
            	<div class="dl">想入驻这座岛屿？来我这里<a href="register.php">登记</a>报道吧！</div>
            </td>
        </tr>
    </table>
    <?php
    	if(isset($_POST['submit']))
		{
			include("conmysql.php");
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$sql = "select * from tb_gjd_user where username ='$username'";
			$query = $connID->query($sql);
			$num = $query->num_rows;
			
			if($num != 0)
			{
				$_SESSION["username"] = $username;
				echo "<script>alert('通过验证，成功入岛');</script>";
				echo "<script>document.location='first.php';</script>";
				$connID->close();
			}
			else
			{
				echo "<script>alert('口令/ID出错！');</script>";
			}
			
		}
	?>
    <!--<div class="bg" align="center" id="bgpic"><img src="bg_image/xiaodao.png" alt=""></div>
    <div align="center" style="position:absolute; top:10%;"><span class="dl">归来的岛民，亮出你的身份信息，我就让你上岛！</span></div>
    <div>想入驻这座岛屿？来我这里登记报道吧！</div>-->
</body>
</html>