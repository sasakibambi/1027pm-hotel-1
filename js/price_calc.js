//合計金額の計算
$(function(){$('.calc').change(function(){
    let $number = $('#number').val();
    let $room_id = $('#room_id').val();
    console.log ('$number' +$number);
    console.log ('$room_id' +$room_id);
    $('#total').load(
        'php/order.php',
        {number:$number, room_id:$room_id},
        function(data,textStatus,XMLHttpRequest){},
    );
    console.log ('$total');
})}
);