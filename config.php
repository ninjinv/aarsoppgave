<?php

// this file is usable for any other php file when using sessions
// how to secure ur sessions

ini_set('session.use_only_cookies', 1); // value 1 = true, 0 = false
ini_set('session.use_strict_mode', 1); // mandatory to have when sessions are used.

// parameters

session_set_cookie_params([
    // lifetime, make sure cookies get destroyed after certain time, security
    'lifetime' => 1800, 
    // domain 
    'domain' => '10.2.2.214', // if online: example.com
    'path' => '/',
    'secure' => false,// only run this cookie on a secure webside HTTPS
    'httponly' => true // restrict any sort of script from our client.
]);

session_start(); 

// session_regenerate_id(true); // generate a new id for the session, regenerate vurrent session id 

// checking if we have a session var created using isset for last_generation
// if not it is the first time, first time => create session var
 if(!isset($_SESSION['last_regeneration'])) {

    session_regenerate_id(true);
    // session_create_id(); other example.
    $_SESSION['last_regeneration'] = time();

 } else { // if u have, this wil run.

    $interval = 60 * 30; // 1800s, till we regenerate session id.

    // time minus session, takes current time minus our time with the session var
    // more time = regenerate session id
    if(time() - $_SESSION['last_regeneration'] >= $interval) {

        session_regenerate_id(true);
        $_SESSION['last_regeneration'] = time();
    }
}

