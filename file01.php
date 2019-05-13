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
3.fwrite(file,str) 寫入檔案中
4.fclose() 關閉檔案
*****************************************************/
//練習:建立一個檔案並寫入一些內容
/* $file=fopen("test.txt","w");
$str="hello world,\r\ntoday is a good day";
fwrite($file,$str);
fclose ($file);
 */

//練習:利用程式流程結構寫入一堆內容
/* $file=fopen("99.txt","w");
$str="";
for($i=1;$i<=9;$i++){
  for($j=1;$j<=9;$j++){
    //echo $i . "x" . $j . "=".($i*$j);
    $str=$str .($i . "x" . $j . "=".($i*$j)) . ",";
    $str = $str. "\r\n";
  }
}
fwrite($file,$str);
fclose ($file); */


//練習:讀出資料表的內容後以CSV格式寫入檔案
/* $file=fopen("csv.csv","w");
$str=chr(0xEF).chr(0xBB).chr(0xBF);
$str.="金庸,天龍八部,遠流\r\n";
$str.="古龍,楚留香,遠流\r\n";

fwrite($file,$str);
fclose ($file); */

/* .= x.=y =>x=x.y
+= x+=y =>x=x+y
*=
-=
/= */


/****************************************************
1.fgets(file,length) 一次讀取一行的資料出來
2.fgetc(file) 一次讀出一個字元來
3.fgetcsv(file,length,separator,enclosure) 一次一行，並解析字串為陣列
4.feof() 檢查是否己經到了檔案的最尾端
******************************************************/
//練習:讀取一個檔案，並把內容印出來
/* $read=fopen("test2.txt","r");
//$content=fgets($read);
while(!feof($read)){
  $content=fgets($read);
  echo $content . "<br>";
}
//fclose($read);
fseek($read,0);
while(!feof($read)){
  $content=fgetc($read);
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
} */
//練習:讀入一個CSV檔案，把內容寫入資料表中

/*  $dsn="mysql:host=Localhost;charset=utf8;dbname=shop";
$pdo=new PDO($dsn,"root","");
$sql="insert into labor (`years`,`name`,`description`,`duration`,`url` )
values('105年','15-29歲青年勞工就業狀況調查','青年就業現況','每2年','http://statdb.mol.gov.tw/html/svy05/0511menu.htm')" ;
$pdo ->query($sql); */

$dsn="mysql:host=Localhost;charset=utf8;dbname=shop";
$pdo=new PDO($dsn,"root","");

$file=fopen("A17000000J-020064-CEu.csv","r");

 $count=0;
 $insert=0;
 while(!feof($file)){
   $line=fgets($file);
   if($count>0){
     $data=explode(',',$line);
    if(strlen($line)>2){

       $sql="insert into labor (`years`,`name`,`description`,`duration`,`url` )
values('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."','".$data[4]."')" ;
      $pdo ->query($sql); 

      echo $sql. "<br>";
      echo "第".$count . "行資料<br>";
      $insert++;

    }
   }
   $count++;
 }
 echo "共處理".$count. "行資料";
 echo "共寫入".$insert. "行資料";
?>