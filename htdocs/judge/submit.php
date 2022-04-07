<?php


$code = $_POST["code"];// 获取 代码
$cakeid = $_POST["cakeid"];

$file = fopen("judge.cpp","w+") or exit("Unable to Open CPP."); //将 代码 写入 judge.cpp
fwrite($file,$code);
fclose($file);

$input = fopen("../cakes/$cakeid/data.in", "r") or exit("Not correct cake id.");

$fin = fopen("data.in","w+") or exit("Unable to Open Input"); //将 输入 写入 data.in
while (!feof($input)) {
  fwrite($fin,fgets($input));
}
fclose($fin);

$output = fopen("../cakes/$cakeid/data.out", "r") or exit("Not correct cake id.");

$fans = fopen("data.ans","w+") or exit("Unable to Open Output"); 
while (!feof($output)) {
  fwrite($fans,fgets($output));
}
fclose($fans);

exec("g++ ./judge.cpp -O2 -o ./judge.exe", $message1);
// print_r($message1);
exec("judge.exe < data.in > data.out", $message2);
// print_r($message2);

$fout = fopen("data.out","r") or exit("Unable to Open File."); // 输出 data.out
while (!feof($fout)){
  echo fgets($fout);
}
fclose($fout);
// echo "finish\n";
?>