<?php
session_start();
include '../config/flasher.php';
include '../database/database.php';

if (!$_SESSION['login']) {
    setFlasher('Danger', 'dilarang masuk', 'error');
    header('Location: index.php');
}

$data = mysqli_fetch_assoc(mysqli_query($db, "SELECT nama_user, status, username, no_user FROM user WHERE id_user = '" . $_SESSION['id'] . "'"));

function visible($role, $user) {
    $role = explode('|', $role);
    foreach ($role as $r) {
        if ($r == $user) {
            return true;
        }
    }
    return false;
}

function thisPage() {
    return end(explode('/', $_SERVER['PHP_SELF']));
}

function activeLink($page, $data = null, $request = null)
{
    $page = explode('?', $page);
    $page = explode('/', $page[0]);
    if ($data != null && $request != null) {
        foreach ($page as $p) {
            if (thisPage() == $p && $data == $request) {
                echo 'active';
            }
        }
    } else {
        foreach ($page as $p) {
            if (thisPage() == $p) {
                echo 'active';
            }
        }
    }
}
?>