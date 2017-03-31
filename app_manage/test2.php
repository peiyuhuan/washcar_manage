<?php
require("mysql_class.php");


//mysql
/*$conf = array(
	'host' => '127.0.0.1:3306',
    // 'port' => 3306,
	'root' => 'root',
	'password' => 'root',
	'database' => 'near',
    // 'charset' => 'utf8',
    // 'persistent' => false
	);*/
$db=new Mysql("localhost","root","root","near");

//向表中插入数据
$insert=$db->insert("user_info","(id,name,pic_url,sex,personal_note)","(359836040135902,'hhh','http://www.eoeandroid.com/uc_server/data/avatar/000/58/59/95_avatar_small.jpg',0,'hllop')");
$db->dbClose();


//修改表中数据
/*$update = $db->update("user","nikename = #beyondwebcn#","where id = #2#");//请把#号替换为单引号
$db->dbClose();*/


// 查询表中数据并输出

//删除表中数据
/* $delete = $db->delete("user","where nikename = #beyondweb#");//请把#号替换为单引号
$db->dbClose();*/





?>