<?php

namespace App\Repositories\Nave;

use App\Interfaces\FaqCategoryRepositoryInterface;
use App\Repositories\Nave\BaseRepository;
use App\Models\FaqCategory;

class FaqCategoryRepository extends BaseRepository implements FaqCategoryRepositoryInterface {
    
    public function all($all = false): array {
        $endpoint = 'faq-categories';

        $params['all'] = $all;
        
        return $this->processArrayToObjects($this->processGet($endpoint, $params, self::CACHED), FaqCategory::class);
    }      
}
