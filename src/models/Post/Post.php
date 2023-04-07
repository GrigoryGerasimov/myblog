<?php

declare(strict_types=1);

namespace Rehor\Myblog\models\Post;

use Rehor\Myblog\models\Post\interfaces\PostInterface;
use Rehor\Myblog\controllers\DBController\DBController;

final class Post implements PostInterface
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
    
    public function update(array $params): object
    {
        try {
            
            return DBController::update($params, $this->data);
            
        } catch(\Exception $e) {
            
            throw $e;
            
        }
    }
    
    public function getOne(array $params): object
    {
        return DBController::select($params);
    }
    
    public function getAll(): object
    {
        return DBController::select();
    }
    
    public function delete(array $params): void
    {
        try {
            
            DBController::delete($params);
            
        } catch(\Exception $e) {
            
            throw $e;
            
        }
    }
}