<?php

declare(strict_types=1);

namespace Rehor\Myblog\controllers\DBController;

use Rehor\Myblog\controllers\DBController\interfaces\DBControllerInterface;

class DBController implements DBControllerInterface
{
    protected const DB_NAME = "myblog";
    
    protected const DB_TABLE_NAME = "posts";

    protected static function db()
    {
        \Flight::register("db", "mysqli", array("localhost:5600", "root", "root", self::DB_NAME));
        
        return \Flight::db();
    }
    
    public static function select(?string $id = null): object
    {
        $sql = is_null($id) ? "select * from ".self::DB_TABLE_NAME : "select * from ".self::DB_TABLE_NAME." where uid = $id";
        
        return self::db()->query($sql);
    }

    public static function insert(object $data): void
    {
       [
        "title" => $title,
        "author" => $author,
        "text" => $text
        ] = $data;
        
        self::db()->query("insert into ".self::DB_TABLE_NAME." (title, author, text) values ('$title', '$author', '$text')");
    }
    
    public static function update(string $id, object $data): object
    {
        [
        "title" => $title,
        "author" => $author,
        "text" => $text
        ] = $data;

        self::db()->query("update ".self::DB_TABLE_NAME." set title = '$title', author = '$author', text = '$text' where uid = $id");
        
        return self::select($id);
    }
    
    public static function delete(string $id): void
    {
        self::db()->query("delete from ".self::DB_TABLE_NAME." where uid = $id");
    }
}