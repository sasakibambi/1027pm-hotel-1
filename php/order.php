<?php
//フォームに入力した値を受け取る
$number = $_POST['number'];
$room_id = $_POST['room_id']; 

//部屋１を15000円／人、部屋2を20000円／人として、合計金額を計算する
if($room_id == 1){
$total = $number * 15000;
echo number_format($total);
} else{
$total = $number * 20000;
echo number_format($total);
}