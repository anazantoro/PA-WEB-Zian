<?php
error_reporting(0);

function setFlasher($title, $action, $type = 'success'){
    $_SESSION['flash']=[
        'title' => $title,
        'msg' => $action,
        'type' => $type
    ];
}

function Flash(){
    if (isset($_SESSION['flash'])) {
        $title = $_SESSION['flash']['title'];
        $msg = $_SESSION['flash']['msg'];
        $type = $_SESSION['flash']['type'];
        echo "
            iziToast.$type({
                position: 'topCenter',
                layout: 2,
                title: '$title',
                message: '$msg',
            });
        ";
        unset($_SESSION['flash']);
    }
}
