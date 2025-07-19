<?php 
namespace App\Core;

class Validator extends Singleton {
    private static array $error = [];
    private static array $rules = [];
    
    function __construct() {
        self::$error = [];
        self::$rules = [
            'required' => function($key, $value, $message = "le champs est obligatoire") {
                if(empty($value)) {                        
                    self::addError($key, $message);
                }
            },
            'minlengh' => function($key, $value, $message, $min) {
                if(strlen($value) < $min) {
                    self::addError($key, $message);
                }
            },
            "isMail" => function ($key, $value, $message = "Email invalide") {
                if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
                    self::addError($key, $message);
                }
            },
            "isCNI" => function ($key, $value, $message = "Numéro de CNI invalide") {
                $value = preg_replace('/\D/', '', $value);
                if (!preg_match('/^1\d{12}$/', $value)) {
                    self::addError($key, $message);
                }
            },
            "isPhone" => function ($key, $value, $message = "Numéro de téléphone invalide") {
                $value = preg_replace('/\D/', '', $value);
                if (strlen($value) < 9) {
                    self::addError($key, $message);
                }
            }
        ];
    }

    public static function getInscriptionRules()
    {
        return [
            "nom" => ['required', ['minlengh', 'Le nom doit contenir au moins 2 caractères', 2]],
            "prenom" => ['required', ['minlengh', 'Le prénom doit contenir au moins 2 caractères', 2]],
            "adresse" => ['required'],
            "telephone" => ['required', ['isPhone', 'Le numéro de téléphone doit contenir au moins 9 chiffres']],
            "numerocni" => ['required', ['isCNI', 'Numéro de CNI invalide']],
            "password" => ['required', ['minlengh', 'Le mot de passe doit contenir au moins 6 caractères', 6]]
        ];
    }

    public static function getLoginRules()
    {
        return [
            "login" => ['required', ['minlengh', 'Le login doit contenir au moins 4 caractères', 4]],
            "password" => ['required', ['minlengh', 'Le mot de passe doit contenir au moins 4 caractères', 4]]
        ];
    }
        
    public static function addError($key, $message) {
        self::$error[$key] = $message;
    }
    
    public static function getError() {
        return self::$error;
    }
    
    public static function validate(array $data, array $rules): bool {
        // Réinitialiser les erreurs à chaque validation
        self::$error = [];
        
        foreach ($rules as $field => $fieldRules) {
            $value = $data[$field] ?? null;
            
            foreach ($fieldRules as $rule) {
                if(isset(self::$error[$field])) {
                    break;
                }
                if (is_string($rule)) {
                    $callback = self::$rules[$rule] ?? null;
                    if ($callback) {
                        $callback($field, $value);
                    }
                }
                elseif (is_array($rule)) {
                    $ruleName = $rule[0];
                    $params = array_slice($rule, 1);
                    $callback = self::$rules[$ruleName] ?? null;
                    
                    if ($callback) {
                        $callback($field, $value, ...$params);
                    }
                }
            }
        }
        
        return empty(self::$error); // Correction: self::$error au lieu de self::$errors
    }
}