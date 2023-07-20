<?php
namespace App\Helper;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Exception;
class JWTToken{

    public static function CreateToken($userEmail):string{

        $key=env("JWT_KET");
        $payload=[
            'iss'=>"laravel-jwt",
            'iat'=>time(),
            'exp'=>time()+60*60,
            'userEmail'=>$userEmail
        ];
        return JWT::encode($payload,$key,'HS256');
    } 

    public static function CreateTokenSetPassword($userEmail):string{

        $key=env("JWT_KET");
        $payload=[
            'iss'=>"laravel-jwt",
            'iat'=>time(),
            'exp'=>time()+60*5,
            'userEmail'=>$userEmail
        ];
        return JWT::encode($payload,$key,'HS256');
    } 

    public static function VerifyToken($token):string{

        try{
            if($token == null){//logout korle kno token thakbe na tai token null hobe r tokn unauthorized hobe
                return "unauthorized";
            }else{
                $key=env('JWT_KET');
                $decode=JWT::decode($token,new Key($key,'HS256'));
                return $decode->userEmail;
            }
            
        }
        catch(Exception $e){
            return "unauthorized";
        }

    }
}