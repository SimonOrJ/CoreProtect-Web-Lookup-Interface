<?php require "settings.php";
try {
    $codb=($_sql["onMySQL"])?new PDO("mysql:charset=utf8;host=".$_sql["hostname"].";
    dbname=".$_sql["database"],$_sql["username"],$_sql["password"]):new PDO("sqlite:".$_sql["databasePath"]);
} catch(PDOException $e) {
    $out[0]["status"]=3;$out[0]["reason"]="Database connection failed";$out[1]=$e->getMessage();exit();
}?>