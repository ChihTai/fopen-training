<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  AA
</body>
</html>

AAAA<?php

/****************************************************
1.fopen(file,mode,path,context)
  ->r 唯讀
  ->r+ 讀寫，由檔案開頭開始
  ->w 寫入，由檔案開頭開始並將檔案清空，無檔案則建立檔案
  ->w+ 讀寫，由檔案開頭開始並將檔案清空，無檔案則建立檔案
　->a 寫入，由檔案尾端開始並將檔案清空，無檔案則建立檔案
　->a+ 寫入，由檔案尾端開始並將檔案清空，無檔案則建立檔案
  ->wb 寫入，轉換換行格式為\r\n
  ->file_exists() 判斷檔案是否存在
2.建立要寫入檔案的內容 str
3.fwrite(file,str) 寫入檔案中
4.fclose() 關閉檔案
*****************************************************/
//練習:建立一個檔案並寫入一些內容
$file=fopen("test.txt","w");
$str="hello world";
fwrite($file,$str);
fclose($file);

//練習:利用程式流程結構寫入一堆內容



//練習:讀出資料表的內容後以CSV格式寫入檔案



/****************************************************
1.fgets(file,length) 一次讀取一行的資料出來
2.fgetc(file) 一次讀出一個字元來
3.fgetcsv(file,length,separator,enclosure) 一次一行，並解析字串為陣列
4.feof() 檢查是否己經到了檔案的最尾端
******************************************************/
//練習:讀取一個檔案，並把內容印出來


//練習:讀取一個檔案內容，把內容加上html標籤後呈現在網頁上


//練習:讀入一個CSV檔案，把內容寫入資料表中





?>