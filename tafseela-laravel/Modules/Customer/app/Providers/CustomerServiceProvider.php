<?php

namespace Modules\Customer\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Nwidart\Modules\Traits\PathNamespace;

class CustomerServiceProvider extends ServiceProvider
{
    use PathNamespace;

    protected string $name = 'Customer';
    protected string $nameLower = 'customer';

    public function register(): void
    {
        $this->app->register(RouteServiceProvider::class);
    }

    public function boot(): void
    {
        $this->registerViews();
        $this->loadMigrationsFrom(module_path($this->name, 'database/migrations'));

        $this->registerViewComposers();
    }

    protected function registerViewComposers(): void
    {
        view()->composer(['customer::components.header', 'customer::components.footer'], function ($view) {
            $productManager = new \Modules\Product\Services\ProductManager();
            $categories = $productManager->getAllCategoriesWithDetails(0, \Modules\Product\Enums\ItemStatus::SHOW)->map(function($cat) {
                return (object) [
                    'title' => $cat->category,
                    'slug'  => strtolower(\Modules\Product\Enums\ProductSlugs::tryFrom($cat->category)?->name ?? \Illuminate\Support\Str::slug($cat->category)),
                ];
            });

            $contacts = \Modules\Core\Models\SiteSetting::where('key', 'contacts')->first()?->value ?? [];

            $view->with([
                'navCategories' => $categories,
                'siteContacts'  => (object) $contacts,
            ]);
        });
    }

    public function registerViews(): void
    {
        $viewPath = resource_path('views/modules/'.$this->nameLower);
        $sourcePath = module_path($this->name, 'resources/views');

        $this->publishes([$sourcePath => $viewPath], ['views', $this->nameLower.'-module-views']);

        $this->loadViewsFrom([$viewPath, $sourcePath], $this->nameLower);

        Blade::component('customer::components.category-card', 'category-card');
        Blade::component('customer::components.collection-section', 'collection-section');
        Blade::component('customer::components.home-product-card', 'home-product-card');
        Blade::component('customer::components.header', 'header');
        Blade::component('customer::components.footer', 'footer');
        Blade::component('customer::layouts.client', 'layout.client');
    }
}
