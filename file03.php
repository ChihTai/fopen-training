
<style>
ul{
  list-style-type:none;
  width:1030px;
  display:flex;
}
li{
  border:1px solid #ccc;
  width:200px;
  padding:5px;
  word-wrap:break-word;
}
</style>
<!--建立表單來選擇不同年份的資料---->
<form action="?" method="post">
  <select name="year">
    <option value="102年">102年</option>
    <option value="103年">103年</option>
    <option value="104年">104年</option>
    <option value="105年">105年</option>

</select>
<input type="submit" value="送出">

</form>
<?php

//根據POST的值來決定要撈取的資料年份
if(!empty($_POST['year'])){
  $year=$_POST['year'];
}else{
  $year="105年";
}


$dsn="mysql:host=localhost;charset=utf8;dbname=shop";
$pdo=new PDO($dsn,"root","");

$sql="select * from labor where years='$year'";
$rows=$pdo->query($sql)->fetchAll();

$file=fopen("labor".$year.".csv","w");
$str=chr(0xEF).chr(0xBB).chr(0xBF);

foreach($rows as $r){
  echo "<ul>";
  echo "<li>".$r['years']."</li>";
  echo "<li>".$r['name']."</li>";
  echo "<li>".$r['description']."</li>";
  echo "<li>".$r['duration']."</li>";
  echo "<li>".$r['url']."</li>";
  echo "</ul>";
  $str=$str . $r['years'] .",".$r['name'].",".$r['description'].",".$r['duration'].",".$r['url']."\r\n";
}

//echo $str;
fwrite($file,$str);
fclose($file);

?>

<a href="labor<?=$year;?>.csv" download>下載<?=$year;?>度勞工調查資料</a>