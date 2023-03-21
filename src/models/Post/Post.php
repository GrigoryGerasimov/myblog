<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Post;

use Rehor\Myblog\models\Post\interfaces\PostInterface;
use Rehor\Myblog\controllers\DBController\DBController;

class Post implements PostInterface
{
    private $data;

    public function __construct(object $data = null)
    {
        $this->data = $data;
    }
    
    public function __destruct()
    {
        $this->data = null;
    }
    
    public function add(): void
    {
        DBController::insert($this->data);
    }
    
    public function update(string $uid): object
    {
        DBController::update($uid, $this->data);
    }
    
    public function getOne(string $uid): object
    {
        return DBController::select($uid);
    }
    
    public function getAll(): object
    {
        return DBController::select();
    }
    
    public function delete(string $uid): bool
    {
        try {
            DBController::delete($uid);
            return true;
        } catch(\Exception $e) {
            return false;
            exit(1);
        }
    }
}