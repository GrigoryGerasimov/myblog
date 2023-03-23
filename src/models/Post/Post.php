<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Post;

use Rehor\Myblog\models\Post\interfaces\PostInterface;
use Rehor\Myblog\controllers\DBController\DBController;

class Post implements PostInterface
{
    private $data;

    public function __construct(?object $data = null)
    {
        $this->data = $data;
    }
    
    public function __destruct()
    {
        $this->data = null;
    }
    
    public function add(): void
    {
        try {
            DBController::insert($this->data);
        } catch(\Exception $e) {
            throw $e;
        }
    }
    
    public function update(string $uid): object
    {
        try {
            return DBController::update($uid, $this->data);
        } catch(\Exception $e) {
            throw $e;
        }
    }
    
    public function getOne(string $uid): object
    {
        return DBController::select($uid);
    }
    
    public function getAll(): object
    {
        return DBController::select();
    }
    
    public function delete(string $uid): void
    {
        try {
            DBController::delete($uid);
        } catch(\Exception $e) {
            throw $e;
        }
    }
}