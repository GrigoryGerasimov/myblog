<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\FileController\interfaces;

interface FileControllerInterface
{
    public static function getUploadedFileName(string $fileInputName);

    public static function getUploadedFileTmpName(string $fileInputName);

    public static function getUploadedFileError(string $fileInputName): int;

    public static function uploadFile(string $fileInputName): string;

    public static function removeFiles($filepath): void;
}