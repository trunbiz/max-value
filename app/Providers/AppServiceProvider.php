<?php

namespace App\Providers;

use App\Models\OrderProduct;
use App\Models\Product;
use App\Repositories\National\NationalRepository;
use App\Repositories\National\NationalRepositoryInterface;
use App\Repositories\Transaction\TransactionInterface;
use App\Repositories\Transaction\TransactionRepository;
use App\Repositories\WebsiteInterface;
use App\Repositories\WebsiteRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Rinvex\Attributes\Models\Attribute;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->singleton(
            TransactionInterface::class,
            TransactionRepository::class
        );
        $this->app->singleton(
            NationalRepositoryInterface::class,
            NationalRepository::class
        );

        $this->app->singleton(WebsiteInterface::class, WebsiteRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Attribute::typeMap([
            'text' => \Rinvex\Attributes\Models\Type\Text::class,
            'boolean' => \Rinvex\Attributes\Models\Type\Boolean::class,
            'integer' => \Rinvex\Attributes\Models\Type\Integer::class,
            'varchar' => \Rinvex\Attributes\Models\Type\Varchar::class,
            'datetime' => \Rinvex\Attributes\Models\Type\Datetime::class,
        ]);

        app('rinvex.attributes.entities')->push(Product::class);
        app('rinvex.attributes.entities')->push(OrderProduct::class);
    }
}
