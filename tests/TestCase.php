<?php


namespace Aankhijhyaal\Discuss\Tests;


use Aankhijhyaal\Discuss\DiscussServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
  protected function getPackageProviders($app)
  {
    return [
        DiscussServiceProvider::class
    ];
  }

  protected function getEnvironmentSetUp($app)
  {
    $app['config']->set('database.default','testdb');
    $app['config']->set('database.connections.testdb',[
        'driver'=>'sqlite',
        'database'=>':memory:'
    ]);
  }
}
