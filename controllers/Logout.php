<?php

/**
 * logout class
 */
class Logout
{
    use Controller;

    public function index()
    {
        session_unset();
        session_destroy();
        header('Location: /PetSpot_clinic/public/login');
        exit;
    }
}
