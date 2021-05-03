<?php


namespace Aankhijhyaal\Discuss\Tests\Feature;


use Aankhijhyaal\Discuss\Models\Category;
use Aankhijhyaal\Discuss\Tests\TestCase;
use Illuminate\Foundation\Auth\User;

class InitialTest extends TestCase
{
  public function test_check_test()
  {
    $this->assertTrue(true);
  }

  public function test_config()
  {
    $this->assertEquals('discussions', config('discuss.routes.home'));
  }

//  public function test_routes()
//  {
//    foreach(config('discuss.routes') as $key=>$url){
//     $response = $this->call('GET',$url);
//     $response->assertStatus(200);
//    }
//  }

  public function test_discussion_view_test()
  {
    $this->call('get', '/discussion')->assertViewIs('discuss::discussion');
  }

  public function test_migrations()
  {
    $this->artisan('migrate')->assertExitCode(0);

  }

  public function test_migration_fresh()
  {
    $this->artisan('migrate:refresh')->assertExitCode(0);
  }

  public function test_thread_create_test()
  {
    $user = new User([
        'id'=>1,
      'name'=>'Josh'
    ]);
    $this->be($user);
    $mockedCategory = \Mockery::mock(Category::class)->makePartial();
    $mockedCategory->slug = 'test-category';
    $response = $this->call('POST', '/thread',[
        'title'=>'title',
      'text'=>'text',
      'category'=>$mockedCategory->slug
    ]);

    $response->assertStatus(200);
  }
}
