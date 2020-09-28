<?php
    function setSession() {
        if(!isset($_SESSION)) { 
            session_start(); 
        }
    }

    function dropSession() {
        if(isset($_SESSION)) {
            session_unset();
        }
    }