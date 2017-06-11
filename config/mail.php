<?php
return array(
 
    'driver' => 'smtp',
 
    'host' => 'smtp.gmail.com',
 
    'port' => 587,
 
    'from' => array('address' => 'info.phim1p@gmail.com', 'name' => 'phim1p.com'),
 
    'encryption' => 'tls',
 
    'username' => 'info.phim1p@gmail.com',
 
    'password' => 'anhphanngoc@123',

    'name' => 'Admin phim1p.com',
 
    'sendmail' => '/usr/sbin/sendmail -bs',
 
    'pretend' => false,
 
);