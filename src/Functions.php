<?php
session_start();

function dd($args, $die = true){

    echo '<pre>';
    print_r($args);
    echo '</pre>';

    if($die){
        die;
    }
}

function redirect($url){
    echo "<script> window.location.href = '$url'; </script>";
}

function alert($msg){
    echo "<script> alert('$msg'); </script>";
}

function swal($titulo, $msg, $opc){
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo "<script> swal('$titulo', '$msg', '$opc'); </script>";
}