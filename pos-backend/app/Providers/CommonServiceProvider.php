<?php
namespace App\Providers;
use Illuminate\Support\Facades\{Auth, Cache, DB, Redis};
use Illuminate\Support\ServiceProvider;

class CommonServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Register services.
     *
     * @return void
     */

    public function register()
    {
        /*-----Test Data-----*/
        $this->app->singleton('divisionList', function ($app) {
            return Cache::store('redis')->rememberForever('division', function () {
                return DB::table('divisions')
                    ->select('id as value','name as text',
                        'code', 'status')
                    ->orderBy('name', 'asc')
                    ->get();
            });
        });
    }
     /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    { }
}
