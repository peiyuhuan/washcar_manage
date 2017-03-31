<?php

class Mysql{
        private $host;//服务器地址
        private $root;//用户名
        private $password;//密码
        private $database;//数据库名

        //后面所提到的各个方法都放在这个类里
        //...

        function __construct($host,$root,$password,$database){
        	$this->host = $host;
        	$this->root = $root;
        	$this->password = $password;
        	$this->database = $database;
        	$this->connect();
        }

        function connect(){
        	$this->conn = mysql_connect($this->host,$this->root,$this->password) or die("DB Connnection Error !".mysql_error());
        	mysql_select_db($this->database,$this->conn);
        	mysql_query("set names utf8");
        }

        function dbClose(){
        	mysql_close($this->conn);
        }

        function query($sql){
        	return mysql_query($sql);
        }
        
        function myArray($result){
        	return mysql_fetch_array($result);
        }
        
        function rows($result){
        	return mysql_num_rows($result);
        }


//5、自定义查询数据方法
        function select($tableName,$condition){
        	return $this->query("SELECT * FROM $tableName $condition");
        }

// 6、自定义插入数据方法
        function insert($tableName,$fields,$value){
        	$this->query("INSERT INTO $tableName $fields VALUES$value");
        }

// 7、自定义修改数据方法
        function update($tableName,$change,$condition){
        	$this->query("UPDATE $tableName SET $change $condition");
        }

//8、自定义删除数据方法
        function delete($tableName,$condition){
        	$this->query("DELETE FROM $tableName $condition");
        }


//多维数组按指定的字段排序
        function multi_array_sort($multi_array,$sort_key,$sort=SORT_ASC){ 
            if(is_array($multi_array)){ 
                foreach ($multi_array as $row_array){ 
                    if(is_array($row_array)){ 
                        $key_array[] = $row_array[$sort_key]; 
                    }else{ 
                        return false; 
                    } 
                } 
            }else{ 
                return false; 
            } 
            array_multisort($key_array,$sort,$multi_array); 
            return $multi_array; 
        } 

    }

    ?>