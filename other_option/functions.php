<?php
function cart_count(){
  $c = 0; foreach($_SESSION['cart'] as $q){ $c += $q; } return $c;
}
function add_to_cart($id, $qty=1){
  $id = (int)$id; $qty = max(1,(int)$qty);
  $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + $qty;
}
function remove_from_cart($id){
  $id = (int)$id; unset($_SESSION['cart'][$id]);
}
