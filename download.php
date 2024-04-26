<?php

session_start();

//ファイル名
$filename = 'user.csv';


//書き込みモードでファイルを開く
if (!$fp = fopen($filename, 'w')) {
    echo "Cannot open file ($filename)";
    exit;
}

//文字コード変換
$head = 'id,nickname,gender,birthdate,prefecture,marital_status, children, indate';
 
// head書き込み
fwrite($fp, mb_convert_encoding($head . "\n", "SJIS"));



include("funcs.php");


//DB接続し、書き込み
try{
    $pdo = db_conn();
 
    $sql = 'SELECT * FROM user_signup';
    $sql = $pdo->prepare($sql);
    $sql->execute();
 
    while($data = $sql->fetch()){
 
        // 出力用
        $output_text  = '"';
        $output_text .= $data['id'];
        $output_text .= '","' . $data['nickname'];
        $output_text .= '","' . $data['gender'];
        $output_text .= '","' . $data['birthdate'];
        $output_text .= '","' . $data['prefecture'];
        $output_text .= '","' . $data['marital_status'];
        $output_text .= '","' . $data['children'];
        $output_text .= '","' . $data['indate'];
        $output_text .= '"';
        $output_text .= "\n";
 
        if (fwrite($fp, mb_convert_encoding($output_text, "SJIS")) === FALSE) {
            break;
        }
    }
 
 
    // close mysql
    $pdo = null;
 
} catch (PDOException $e) {
 
    print "[ERROR] {{$e->getMessage()}}\n";
    die();
 
}
 

//ファイルクローズ
fclose($fp);


//ファイルダウンロード
  /* download_file関数実行 */
  download_file($filename);
 
  function download_file($path_file)
  {
      /* ファイルの存在確認 */
      if (!file_exists($path_file)) {
          die("Error: File(".$path_file.") does not exist");
      }
   
      /* オープンできるか確認 */
      if (!($fp = fopen($path_file, "r"))) {
          die("Error: Cannot open the file(".$path_file.")");
      }
      fclose($fp);
   
      /* ファイルサイズの確認 */
      if (($content_length = filesize($path_file)) == 0) {
          die("Error: File size is 0.(".$path_file.")");
      }
   
      /* ダウンロード用のHTTPヘッダー送信 */
      header("Cache-Control: private");
      header("Pragma: private");
      header('Content-Description: File Transfer');
      header("Content-Disposition: inline; filename=\"".basename($path_file)."\"");
      header("Content-Length: ".$content_length);
      header("Content-Type: application/octet-stream");
      header('Content-Transfer-Encoding: binary');
   
      /* ファイルを読んで出力 */
      if (!readfile($path_file)) {
          die("Cannot read the file(".$path_file.")");
      }
  }



?>