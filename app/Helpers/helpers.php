<?php
   
function rupiah($angka){
    $hasil_rupiah = "IDR " . number_format($angka,2,',','.');
	return $hasil_rupiah;    
}

function date_beautify($date){
    return date('d M Y', strtotime($date));
}

function totalprice_order($order){
    
    $price=0;
    $dicount = $order->discount_amount;
    foreach ($order->detail as $key => $detail) {
        $price = $price + $detail->total_price;
    }
    $price = $price - $dicount;
    return $price;
}