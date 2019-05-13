<?php

/************************************************** 
1.enctype=multipart/form-data
2.input type="file"
3.檔案以二進位方式傳輸到暫存目錄中
4.以$_FILES來存取相關的屬性
  ->$_FILES["file"]["name"] 上傳檔案的原始名稱
  ->$_FILES["file"]["type"] 上傳檔案的檔案類型
  ->$_FILES["file"]["size"] 上傳檔案的原始大小
  ->$_FILES["file"]["tmp_name"] 上傳檔案的暫存位置
  ->$_FILES["file"]["error"] 錯誤代碼
5.move_uploaded_file(source,destination) 移動檔案
6.copy(source,destination) 複製檔案
7.unlink(source) 刪除檔案
***************************************************/

//練習 上傳檔案後提供下載，檔案路徑存在資料表中




?>