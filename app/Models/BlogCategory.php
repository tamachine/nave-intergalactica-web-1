<?php

namespace App\Models;

use App\Interfaces\BlogCategoryRepositoryInterface;
use App\Traits\Nave\HasResponses;
use Illuminate\Support\Collection;

class BlogCategory {

    use HasResponses {
        processSingleResponse as public traitProcessSingleResponse;
    }

    public $hashid;
    public $name;
    public $slug;
    public $url;

    protected $blogCategoryRepository;
    
    public function __construct() {
        $this->blogCategoryRepository = app(BlogCategoryRepositoryInterface::class);                    
    }

    public function postsPublished(): Collection {
        return collect($this->blogCategoryRepository->posts($this->hashid));
    }

    public function setUrl($value) {
        $this->url = $value;
    }

    public function toJson() {
        return json_encode($this);
    }
    
    public static function processSingleResponse(array $instanceData): object { 
        $blogCategory = self::traitProcessSingleResponse($instanceData); 

        $blogCategory->setUrl(route('blog.search.category', ['blog_category_slug' => $blogCategory->slug]));
      
        return $blogCategory;    
    }
}