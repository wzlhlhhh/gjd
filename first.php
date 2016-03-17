<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>挂机岛|首页</title>
<script>
	//切换战斗信息/基本信息
	function change(btn)
	{
		//alert(btn);
		if(btn == 'jbxx')
		{
			
			document.getElementById("jbxx_dis").className="jbxx";
			document.getElementById('zdxx_dis').className="zdxx_none";
		}
		else if(btn == 'zdxx')
		{
			//alert('xixi');
			document.getElementById('jbxx_dis').className="jbxx_none";
			document.getElementById('zdxx_dis').className="zdxx";
		}
	}
	//切换活动页面 
	function changeframe(btn)
	{
		switch(btn)
		{
			//alert("haha");
			case 'dy':
				document.getElementById('iframe').src="hd/dy.php"; break;
			case 'gc':
				document.getElementById('iframe').src="hd/gc.php"; break;
			case 'jg':
				document.getElementById('iframe').src="hd/jg.php"; break;
			case 'dl':
				document.getElementById('iframe').src="hd/dl.php"; break;
			case 'zz':
				document.getElementById('iframe').src="hd/zz.php"; break;
			case 'bg':
				document.getElementById('iframe').src="bg.php"; break;
			case 'shop':
				document.getElementById('iframe').src="shop.php"; break;
			case 'zb':
				document.getElementById('iframe').src="zb.php"; break;
			case 'cj':
				document.getElementById('iframe').src="cj.php"; break;
		}
	}
	//改名
	function changegm()
	{
		document.getElementById('gmdiv').className="jmdiv_dis";
	}
	
	//ajax
	var xmlHttp;  //定义HttpRequest对象

function createXmlHttpRequestObject(){   //创建一个ajax实例
	if(window.ActiveXObject){            //如果在IE下
		try{
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");   //IE下的第一种方式
		}catch(e){
			try{
				xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");  //IE下的第二种方式
			}catch(e){
				xmlHttp=false;
			}
		}
	}else if(window.XMLHttpRequest){   //如果在通用浏览器下
		try{
			xmlHttp=new XMLHttpRequest();
		}catch(e){
			xmlHttp=false;
		}
	}
	if(!xmlHttp){      //如果xmlHttp为假，既创建实例失败
		alert("浏览器不兼容！");
	}else{
		return xmlHttp;
	}
}
//刷新
function changeF5(){
		createXmlHttpRequestObject(); //调用createXmlHttpRequestObject()函数，创建一个ajax实例
		xmlHttp.onreadystatechange=Handler;   //实例xmlHttp的onreadystatechange属性
		xmlHttp.open("GET","Afirst.php",true);
		xmlHttp.send(null);
	
}

function Handler(){
	//alert(xmlHttp.status+xmlHttp.readyState);
	if(xmlHttp.readyState==4 && xmlHttp.status==200){
		document.getElementById("xx_dis").innerHTML=xmlHttp.responseText;
		
	}
}
	
	function ajax()
	{
		changeF5();
	}
</script>
<style>
	.jbxx{
		display:block;
	}
	.jbxx_none{
		display:none;
	}
	
	.zdxx{
		display:block;
	}
	.zdxx_none{
		display:none;
	}
	.jmdiv{
		display:none;
	}
	.jmdiv_dis{
		display:block;
	}
	.none{
		display:none;
	}
</style>
</head>

<body><?php session_start(); include("conmysql.php");?>
<?php  

		//PHP脚本也是看顺序的。。。在代码前先执行...
		//取出角色uuid信息
		$sql = "select uuid from tb_gjd_user where username='".$_SESSION['username']."'";
		$query = $connID->query($sql);
		$result = $query->fetch_array();
		$uuid = $result[0];
		
		//取出角色基本信息
		$sql_jbxx = "select * from tb_gjd_jbxx where uuid = '$uuid'";
		$query_jbxx = $connID->query($sql_jbxx);
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
		$query_zdxx = $connID->query($sql_zdxx);
		$result_zdxx = $query_zdxx->fetch_array();
		$hp = $result_zdxx['hp'];					//角色血量
		$mp = $result_zdxx['mp'];					//角色蓝量		
		$attck = $result_zdxx['attck'];				//角色攻击
		$fy = $result_zdxx['fy'];					//角色防御
		$jyz = $result_zdxx['jyz'];					//角色当前经验值
		$jyz_level = $result_zdxx['jyz_level']; 		//角色当前等级升级所需经验值
		
		
		//改名函数
			if(isset($_POST['submit']))
			{
				$new_name = $_POST['gm'];
				$sql = "update tb_gjd_jbxx set user_name='$new_name' where user_name = '$uuid'";
				$query = $connID->query($sql);
				if($query)
				{
					echo "<script>alert('修改成功！');</script>";
					//0sleep(3);
					
					echo "<script>window.locahref='index.php';</script>";
				}
			}
	?>
	<div align="center" style="background:url(bg_image/xiaodao2.jpg)">
    	<iframe style="display:none;" src="" frameborder="0" id="hidediv"></iframe>
    	<table border="10" cellpadding="0" cellspacing="0" height="768" width="1024" style=" border-style:double;" ><!--定义游戏窗口界面 1024*768  因为考虑到边线，所以游戏实际窗口为1000*744-->
		<tr><!--游戏界面一行两列的表，左边的一列表显示基本信息，右边显示交互信息-->
			<td width="250" height="744">
            	<table border="1" cellpadding="0" cellspacing="0" height="744" style="border-style:dashed; margin:0px;"><!--左边一列第一张表，两行，第一行基本信息，第二行商店-->
            		<tr>
            			<td height="500" style=" margin-bottom:10px; border-left-style:none;" width="250">
                        	<table border="1" cellpadding="0" cellspacing="0" height="500" style="border-left-style:none;"><!--基本信息表，包含头像，角色名，基本信息/战斗信息-->
                            <tr><!--第一行，显示角色头像和角色名-->
                            	<td colspan="2" height="120" align="center" width="250"><img height="80" width="80" src="<?php echo $user_tx;?>" alt="你的头像"><br><br><?php echo $user_name;
								//判定，若角色名和uuid号相同，可以改名
								if($user_name == $uuid){
								?>
                                	<input type="submit" value="改名" onClick="changegm();">
                                <div class="jmdiv" align="left" style="position:absolute; top:110px;" id="gmdiv">
                                    <form action="" method="post">
                                        <input type="text" name="gm" id="gm">
                                        &nbsp;&nbsp;<input type="submit" value="提交" name="submit">
                                    </form>
                                </div>
								<?php
								}
								if($vip!=0)
								{
									?>
									&nbsp;&nbsp;<b>VIP <span style=" color:red;"><?php echo $vip;?></span></b>
									<?php
								}
								?></td>
                            </tr>
                            <tr align="center"><!--第二行，可以切换战斗信息和基本信息-->
                            	<td height="50"><input type="button" value="基本信息" id="jbxx" name="jbxx" onClick="change('jbxx');"></td>
                            	<td><input type="button" value="战斗信息" id="zdxx" name="zdxx" onClick="change('zdxx');"></td>
                            </tr>
                            <tr><!--第三行，显示战斗信息/基本信息-->
                            	<td colspan="2" height="230">
                                	<div id="xx_dis"><div class="jbxx" align="center" id="jbxx_dis" style="line-height:1.5em;">角色等级：<?php echo $user_level;?><br>小岛等级：<?php echo $dao_level;?><br>金钱：<?php echo $money;?><br>收益：金钱<?php echo $money_h;?>/h,经验<?php echo $jingyan_h?>/h</div>
                                	<div class="zdxx_none" align="center" id="zdxx_dis">生命值：<?php echo $hp;?><br>法力值：<?php echo $mp;?><br>攻击力：<?php echo $attck;?><br>防御：<?php echo $fy;?><br>经验值：<?php echo $jyz;?>/<?php echo $jyz_level;?></div></div>
                                </td>
                            </tr>
                            <tr><!--第四行，包裹按钮，加入装备页面-->
                            	<td align="center"><input type="button" value="包裹" id="bg" name="bg" style="font-size:18px; height:50px; width:100px;" onClick="changeframe('bg');"></td>
                                <td align="center"><input type="button" value="装备" id="zb" name="zb" style="font-size:18px; height:50px; width:100px;" onClick="changeframe('zb');"></td>
                            </tr>
                            </table>
                        </td>
            		</tr>
            		<tr><!--第二行，商店、v1.0.0大转盘-->
            			<td height="234" width="125" align="center"><input type="button" value="商店" id="shop" name="shop" style="height:100px; width:100px;" onClick="changeframe('shop');">
                        <input type="button" value="v1.1.0抽奖" id="choujiang" name="choujiang" style="height:100px; width:100px;" onClick="changeframe('cj');"></td>
            		</tr>
            	</table>
            </td>
			<td width="750" height="724"><!--右边的一列，有活动栏和内嵌网页-->
            	<table border="1" cellpadding="0" cellspacing="0" width="750" height="744">
            		<tr><!--活动标题栏-->
            			<td colspan="5" height="50px" style="font-size:36px;" align="center">~~活动~~</td>
            		</tr>
            		<tr align="center"><!--具体活动-->
            			<td height="50px"><input type="button" value="钓鱼" name="dy" onClick="changeframe('dy');"></td>
            			<td><input type="button" value="种植" name="zz" onClick="changeframe('zz');"></td>
            			<td><input type="button" value="打猎" name="dl" onClick="changeframe('dl');"></td>
            			<td><input type="button" value="工厂" name="gc" onClick="changeframe('gc');"></td>
            			<td><input type="button" value="加工" name="jg" onClick="changeframe('jg');"></td>
            		</tr>
            		<tr>
            			<td colspan="5" height="644px" align="center"><!--内嵌处理页面-->
                        	<iframe src="hd/dy.php" frameborder="2" height="600" width="700" id="iframe"></iframe>
                        </td>
            		</tr>
            	</table>
            </td>
		</tr>        
        </table>
    </div>
    <?php $connID->close(); ?>
</body>
</html>