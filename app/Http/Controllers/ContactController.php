<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\BlogPostRepositoryInterface;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\ExtendsWebLayoutInterface;
use App\Models\SeoConfiguration;
use App\Traits\Nave\ExtendsWebLayout;
use Illuminate\Support\Facades\Route;

class ContactController extends Controller implements ExtendsWebLayoutInterface
{
    use ExtendsWebLayout;

    protected $blogPostRepository;

    protected $pageRepository;

    public function __construct(BlogPostRepositoryInterface $blogPostRepository, PageRepositoryInterface $pageRepository) {
        $this->blogPostRepository = $blogPostRepository;
        $this->pageRepository     = $pageRepository;
    }

    public function index()
    {            
        echo "contact"; die;
    }

    public function getSeoConfiguration(): SeoConfiguration
    {
        return $this->pageRepository->seoConfiguration(Route::currentRouteName());
    }

    protected function footerImagePath() : string
    {       
        return '/images/footer/home.png';
    }

   
}
