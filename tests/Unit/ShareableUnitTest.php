<?php
namespace App\Shareable\Test\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User\Model\User;
use App\Shareable\Model\Shareable;
class ShareableTest extends TestCase {
 use WithFaker;
/***
A Index test Shareable.*
*
@return void 
 */
 public function testIndexShareable() {

 $response = $this->get('/Shareable');
 $response->assertOk();
}
/***
A Show test Shareable.*
*
@return void 
 */
 public function testShowShareable() {
 $record = Shareable::inRandomOrder()->first(); 

 $response = $this->get('/Shareable/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test Shareable.*
*
@return void 
 */
 public function testStoreShareable() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/Shareable', [ 
undefined,
undefined,
'shareable_user_id' => function () {
return App\Shareable\Model\Shareable::inRandomOrder()->first()->id;

}
 ]); 
 $response->assertOk(); 
}
/***
A Destroy test Shareable.*
*
@return void 
 */
 public function testDestroyShareable() {

 $user = User::inRandomOrder()->first(); 
 $record = Shareable::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/Shareable/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test Shareable.*
*
@return void 
 */
 public function testUpdateShareable() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/Shareable/'+$record->id+'', [ 
undefined,
undefined,
'shareable_user_id' => function () {
return App\Shareable\Model\Shareable::inRandomOrder()->first()->id;

}
 ]); 
 $response->assertOk(); 
}
/***
A Create test Shareable.*
*
@return void 
 */
 public function testCreateShareable() {
 $record = Shareable::inRandomOrder()->first(); 

 $response = $this->get('/Shareable/create');
 $response->assertOk();
}
/***
A Edit test Shareable.*
*
@return void 
 */
 public function testEditShareable() {
 $record = Shareable::inRandomOrder()->first(); 

 $response = $this->get('/Shareable/'+$record->id+'/edit');
 $response->assertOk();
}

}
