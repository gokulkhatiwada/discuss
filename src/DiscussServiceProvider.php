<?php

namespace Aankhijhyaal\Discuss;

use Aankhijhyaal\Discuss\Models\Category;
use Illuminate\Support\ServiceProvider;

class DiscussServiceProvider extends ServiceProvider
{
  public function boot()
  {

    $this->mergeConfigFrom(__DIR__.'/../config/discuss.php', 'discuss');

    $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    $this->loadViewsFrom(__DIR__.'/../resources/views', 'discuss');

    if($this->app->runningInConsole()){

      $this->publishes([

          __DIR__.'/../config/discuss.php'=>config_path('discuss.php')
      ],'discuss-config');

      $this->publishes([
          __DIR__.'/../database/migrations/' => database_path('migrations'),
      ], 'discuss-migrations');

      $this->publishes([__DIR__ . '/../resources/views/'=>resource_path('views/vendor/discuss')
      ],'discuss-views');

    }



  }

  public function register()
  {

  }
}
