<?php
function enCrypt_Pass($user){
    $user = md5($user);
    $user = sha1($user);
    $user = crypt($user,'tk');

    return $user;
}
// echo enCrypt_Pass('admin1234');

echo substr('admin1234',0,2);

?>