<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\FileController;

use Rehor\Myblog\controllers\FileController\interfaces\FileControllerInterface;
use Rehor\Myblog\controllers\FileController\traits\FileControllerTrait;

class FileController implements FileControllerInterface
{
    use FileControllerTrait;

    private static $fileDirectory;

    public static function getUploadedFileName(string $fileInputName): string|array
    {
        foreach ($_FILES as $key => $value) {
            if ($fileInputName === $key) {
                return $_FILES[$fileInputName]["name"];
            } else {
                throw new \Exception("No file identified");
                exit(1);
            }
        };
    }

    public static function getUploadedFileTmpName(string $fileInputName): string|array
    {
        foreach ($_FILES as $key => $value) {
            if ($fileInputName === $key) {
                return $_FILES[$fileInputName]["tmp_name"];
            } else {
                throw new \Exception("No file identified");
                exit(1);
            }
        };
    }

    public static function getUploadedFileError(string $fileInputName): int
    {
        foreach ($_FILES as $key => $value) {
            if ($fileInputName === $key) {
                return $_FILES[$fileInputName]["error"];
            } else {
                throw new \Exception("No file identified");
                exit(1);
            }
        }
    }

    public static function uploadFile(string $fileInputName): string
    {
        $filename = self::getFileName(self::getUploadedFileName($fileInputName));

        self::$fileDirectory = self::getFileDirectory();

        if (is_uploaded_file(self::getUploadedFileTmpName($fileInputName)) && self::getUploadedFileError($fileInputName) === UPLOAD_ERR_OK) {

            try {
                if (self::checkFileExtension($filename)) {
                    
                    move_uploaded_file(self::getUploadedFileTmpName($fileInputName), self::$fileDirectory.$filename);
                    
                    return self::$fileDirectory.$filename;
                } else {
                    throw new \Exception("Incorrect file format");
                }
            } catch(\Exception $e) {
                throw $e;
            }
        }
    }

    public static function removeFiles(): void
    {
        if (is_dir(self::$fileDirectory)) {
            $dirPath = glob(self::$fileDirectory."*", GLOB_MARK);

            if ($dirPath) {
                self::removeFiles();
            }

            rmdir(self::$fileDirectory);
        } elseif (is_file(self::$fileDirectory)) {
            unlink(self::$fileDirectory);
        }
    }
}