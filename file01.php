<?php

/****************************************************
1.fopen(file,mode,path,context)
  ->r 唯讀
  ->r+ 讀寫，由檔案開頭開始
  ->w 寫入，由檔案開頭開始並將檔案清空，無檔案則建立檔案
  ->w+ 讀寫，由檔案開頭開始並將檔案清空，無檔案則建立檔案
　->a 寫入，由檔案尾端開始，無檔案則建立檔案
　->a+ 寫入，由檔案尾端開始，無檔案則建立檔案
  ->wb 寫入，轉換換行格式為\r\n
  ->file_exists() 判斷檔案是否存在
2.建立要寫入檔案的內容 str
  ->斷行 \n or \r\n
3.fwrite(file,str) 寫入檔案中
4.fclose() 關閉檔案
*****************************************************/
//練習:建立一個檔案並寫入一些內容
/* $file=fopen("test.txt","w");
$str="hello world ,\r\ntoday is a good day";
fwrite($file,$str);
fclose($file);
 */

//練習:利用程式流程結構寫入一堆內容
/* $file=fopen("99.txt","w");
$str="";

for($i=1;$i<=9;$i++){
  for($j=1;$j<=9;$j++){
    $str=$str . ($i . " x " . $j . " = " .($i*$j)) ." , ";
  }
  $str = $str."\r\n";
}

fwrite($file,$str);
fclose($file); */


//練習:讀出資料表的內容後以CSV格式寫入檔案
/* $file=fopen("csv.csv","w");
$str=chr(0xEF).chr(0xBB).chr(0xBF);
$str=$str . "金庸,天龍八部,遠流\r\n";
$str=$str . "古龍,楚留香,遠流\r\n";

fwrite($file,$str);
fclose($file);
 */



/****************************************************
1.fgets(file,length) 一次讀取一行的資料出來
2.fgetc(file) 一次讀出一個字元來
3.fgetcsv(file,length,separator,enclosure) 一次一行，並解析字串為陣列
4.feof() 檢查是否己經到了檔案的最尾端
******************************************************/
//練習:讀取一個檔案，並把內容印出來

/* $read=fopen("test2.txt","r");

while(!feof($read)){
  $content=fgetc($read);
  echo $content . "<br>";
}

fseek($read,0);

 while(!feof($read)){
  $content=fgets($read);
  echo $content . "<br>";
} 

fclose($read); */


//練習:讀取一個檔案內容，把內容加上html標籤後呈現在網頁上
/* $read=fopen("test2.txt","r");

while(!feof($read)){
  $font_size=rand(16,32) . "px";
  $content=fgets($read);
  echo "<p style='font-size:$font_size'>";
  echo $content;
  echo "</p>";
}  */

//練習:讀入一個CSV檔案，把內容寫入資料表中
/*
  $dsn="mysql:host=localhost;charset=utf8;dbname=shop";
  $pdo=new PDO($dsn,"root","");
  $sql="insert into labor (`years`,`name`,`description`,`duration`,`url`) 
  values('105年','15-29歲青年勞工就業狀況調查','青年就業現況','每2年','http://statdb.mol.gov.tw/html/svy05/0511menu.htm')";
  $pdo->query($sql);
*/
//首行標題不要
//空行不要

//建立資料表連線
$dsn="mysql:host=localhost;charset=utf8;dbname=shop";
$pdo=new PDO($dsn,"root","");

//開啟檔案
$file=fopen("A17000000J-020064-CEu.csv","r");

$count=0;  //計算處理行數
$insert=0; //計算插入資料表行數

//用迴圈判斷是否到檔尾
while(!feof($file)){

//$line=fgets($file);  //取出一行資料
$line=fgetcsv($file);  //取出一行資料

  if($count>0){   //第一行的資料不要處理

    //$data=explode(',',$line); //用explode函式來拆解字串成為一個陣列

    //if(strlen($line)>2){  //判斷空白行，非空白行才需要寫入
    if(count($line)>1){  //判斷空白行，非空白行才需要寫入

      //建立SQL insert語法 
      //$sql="insert into labor (`years`,`name`,`description`,`duration`,`url`) 
         //values('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."')";
      $sql="insert into labor (`years`,`name`,`description`,`duration`,`url`) 
          values('".$line[0]."','".$line[1]."','".$line[2]."','".$line[3]."','".$line[4]."')";
      //echo  $sql."<br>";
      //寫入資料表
      $pdo->query($sql);
      echo "第".$count."行資料<br>";
      $insert++; //寫入成功的話變數insert加1
    }
  }
  $count++; //迴圈完成一次變數count加1
}

//在網頁上顯示處理狀況
echo "共處理".$count."行資料";
echo "共加入".$insert."筆資料";


?>