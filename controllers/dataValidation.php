<?php

class DataValidation {
    public static function validateNewUser($userData) {
        $errors = [];

        if($userData["name"] === "") {
            $errors[] = "El nombre esta vació";
        }

        if(false == filter_var($userData["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email no valído";
        }

        if(strlen($userData["pass"]) < 8 ) {
            $errors[] = "La contraseña es demasiado corta";
        }

        if($userData["pass"] !== $userData["vpass"]) {
            $errors[] = "Las contraseñas no coinciden";
        }

        if (!empty($errors)) {
            return $errors;
        } else {
            return true; // No hay errores
        }
        
    }

    public static function validateLogin($userData) {
        $errors = [];

        if(false == filter_var($userData["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Email no valído";
        }

        if(strlen($userData["pass"]) < 8 ) {
            $errors[] = "La contraseña es demasiado corta";
        }

        if(!empty($errors)) {
            return $errors;
        } else {
            return true;
        }
    }
}