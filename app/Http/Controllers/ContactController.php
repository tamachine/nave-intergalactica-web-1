<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Interfaces\PageRepositoryInterface;
use App\Interfaces\ExtendsWebLayoutInterface;
use App\Models\SeoConfiguration;
use App\Repositories\Nave\ContactFormRepository;
use App\Traits\Nave\ExtendsWebLayout;
use Illuminate\Support\Facades\Route;

class ContactController extends Controller implements ExtendsWebLayoutInterface
{
    use ExtendsWebLayout;

    protected $contactFormRepository;

    protected $pageRepository;

    public function __construct(ContactFormRepository $contactFormRepository, PageRepositoryInterface $pageRepository) {
        $this->contactFormRepository = $contactFormRepository;
        $this->pageRepository = $pageRepository;
    }

    public function index()
    {            
        return view(
            'contact.index',
             array_merge( $this->webLayoutViewParams(),
                [
                    'breadcrumbs'   => getBreadcrumb(['home', 'contact']),
                ]
            )
        );
    }

    public function getSeoConfiguration(): SeoConfiguration
    {
        return $this->pageRepository->seoConfiguration(Route::currentRouteName());
    }

    public function footerImagePath() : string
    {       
        return asset('/images/footer/contact.png');
    }

    public function footerWebpImagePath() : string
    {       
        return asset('/images/footer/contact.webp');
    }
}
