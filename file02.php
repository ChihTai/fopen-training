<?php

/************************************************** 
1.enctype=multipart/form-data
2.input type="file"
3.檔案以二進位方式傳輸到暫存目錄中
4.以$_FILES來存取相關的屬性
  ->$_FILES["file"]["name"] 上傳檔案的原始名稱
  ->$_FILES["file"]["type"] 上傳檔案的檔案類型
    =>"image/gif"
    =>"image/jpeg"
    =>"image/jpg"
    =>"image/png"
  ->$_FILES["file"]["size"] 上傳檔案的原始大小
  ->$_FILES["file"]["tmp_name"] 上傳檔案的暫存位置
  ->$_FILES["file"]["error"] 錯誤代碼
5.move_uploaded_file(source,destination) 移動檔案
6.copy(source,destination) 複製檔案
7.unlink(source) 刪除檔案
***************************************************/

//練習 上傳檔案後提供下載，檔案路徑存在資料表中
$dsn="mysql:host=localhost;charset=utf8;dbname=shop";
$pdo=new PDO($dsn,"root","");

//利用暫存路徑來判斷是否有上傳檔案
if(!empty($_FILES["pic"]["tmp_name"]) && $_FILES["pic"]["type"]=='image/png'){
  
/*   echo $_FILES['pic']['name'];
  echo $_FILES["pic"]["tmp_name"]; */

  $name=$_FILES['pic']['name'];
  $path=$_FILES["pic"]["tmp_name"];

  //移動檔案到指定目錄下,並改命為$name
  move_uploaded_file($path,"./img/" . $name);


  $sql="insert into img (`name`,`path`) values('$name','./img/$name')";
  $pdo->query($sql);
  
}



?>
<style>
table{
  border-collapse:collapse;
}
td{
  text-align:center;
  padding:5px;
  border:1px solid #ccc;
}
</style>
<form action="?" method="post" enctype="multipart/form-data">
  <input type="file" name="pic">
  
  <input type="submit" value="上傳">
</form>
<table>
  <tr>
    <td>縮圖</td>
    <td>檔名</td>
    <td>路徑</td>
  </tr>
<?php
$sql="select * from img";
$rows=$pdo->query($sql)->fetchAll();
foreach($rows as $r){
?>  
  <tr>
    <td><img src='<?=$r['path'];?>' style="width:100px;height:100px;"></td>
    <td><?=$r['name'];?></td>
    <td><?=$r['path'];?></td>
  </tr>
<?php
}
?>
</table>