<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\FileController;

use Rehor\Myblog\controllers\FileController\interfaces\FileControllerInterface;
use Rehor\Myblog\controllers\FileController\traits\FileControllerTrait;

class FileController implements FileControllerInterface
{
    use FileControllerTrait;

    private static $fileDirectory;

    public static function getUploadedFileName(string $fileInputName)
    {
        return self::getFileProps($fileInputName, "name");
    }

    public static function getUploadedFileTmpName(string $fileInputName)
    {
        return self::getFileProps($fileInputName, "tmp_name");
    }

    public static function getUploadedFileError(string $fileInputName): int
    {
        return self::getFileProps($fileInputName, "error");
    }

    public static function uploadFile(string $fileInputName): string
    {
        $filename = self::getFileName(self::getUploadedFileName($fileInputName));

        self::$fileDirectory = self::getFileDirectory();

        try {
            switch (self::getUploadedFileError($fileInputName)) {
                
                case UPLOAD_ERR_OK: {
                    if (is_uploaded_file(self::getUploadedFileTmpName($fileInputName))) {

                        if (self::checkFileExtension($filename)) {
                            move_uploaded_file(self::getUploadedFileTmpName($fileInputName), self::$fileDirectory.$filename);
                            
                            return self::$fileDirectory.$filename;

                        } else {
                            throw new \Exception("Incorrect file format");
                        }
                    }
                }
                
                case UPLOAD_ERR_FORM_SIZE: {
                    throw new \Exception("File max size exceeded");
                }
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public static function removeFiles($filepath): void
    {
        if (is_dir($filepath)) {

            $dirPath = glob($filepath."*", GLOB_MARK);

            foreach($dirPath as $path) {
                self::removeFiles($path);
            }

            rmdir($filepath);

        } elseif (is_file($filepath)) {

            unlink($filepath);
            
        }
    }
}