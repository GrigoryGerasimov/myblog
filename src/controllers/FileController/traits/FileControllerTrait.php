<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\FileController\traits;

use Rehor\Myblog\controllers\AuthControllers\AuthController\AuthController;
use Rehor\Myblog\repositories\SessionRepository\SessionRepository;

trait FileControllerTrait
{
    public static function getFileName(string $filename): string
    {
        return basename($filename);
    }

    public static function getFileUniqueName(): string
    {
        $random = (string) rand(0, 10000);
        
        return uniqid(bin2hex($random)).time();
    }
    
    public static function getFileDirectory(): string
    {
        if (AuthController::checkSession()) {
            $currentUserId = SessionRepository::getSession()["user_id"];

            $dirnameCompounds = array($currentUserId, date("Y"), date("m"), date("d"), self::getFileUniqueName(), "");

            $filedirname = "assets/uploads/".implode("/", $dirnameCompounds);

            if (!is_dir($filedirname)) {
                mkdir($filedirname, 0777, true);
            }

            return $filedirname;
        
        } else {
            echo "Authorization error!";
            http_response_code(403);
            exit(1);
        }
    }

    public static function getFileProps(string $fileInputName, string $fileProp)
    {
        foreach ($_FILES as $key => $value) {
            if ($fileInputName === $key) {
                return $_FILES[$fileInputName][$fileProp];
            } else {
                throw new \Exception("No file identified");
                exit(1);
            }
        };
    }

    public static function checkFileExtension(string $filename): bool
    {
        $allowed_ext = array("png", "jpeg", "jpg", "svg", "gif");

        $filenameSplitted = explode(".", $filename);

        $fileext = $filenameSplitted[count($filenameSplitted) - 1];

        return in_array($fileext, $allowed_ext);
    }
}