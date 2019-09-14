<?php
namespace App\Note\Test\Unit;
use Illuminate\Foundation\Testing\WithFaker;

use Tests\TestCase;
use Illuminate\Foundation\Testing\ RefreshDatabase;
use App\User\Model\User;
use App\Note\Model\Note;
class NoteTest extends TestCase {
 use WithFaker;
/***
A Index test Note.*
*
@return void 
 */
 public function testIndexNote() {

 $response = $this->get('/Note');
 $response->assertOk();
}
/***
A Show test Note.*
*
@return void 
 */
 public function testShowNote() {
 $record = Note::inRandomOrder()->first(); 

 $response = $this->get('/Note/'+$record->id+'');
 $response->assertOk();
}
/***
A Store test Note.*
*
@return void 
 */
 public function testStoreNote() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('POST','/Note', [ 
undefined,
'isDone' => $faker->boolean(50)
 ]); 
 $response->assertOk(); 
}
/***
A Destroy test Note.*
*
@return void 
 */
 public function testDestroyNote() {

 $user = User::inRandomOrder()->first(); 
 $record = Note::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('delete','/Note/'+$record->id+''); 
$response->assertOk();  
}
/***
A Update test Note.*
*
@return void 
 */
 public function testUpdateNote() {
 $user = User::inRandomOrder()->first(); 
 $response = $this->actingAs($user, 'api')->json('PUT','/Note/'+$record->id+'', [ 
undefined,
'isDone' => $faker->boolean(50)
 ]); 
 $response->assertOk(); 
}
/***
A Create test Note.*
*
@return void 
 */
 public function testCreateNote() {
 $record = Note::inRandomOrder()->first(); 

 $response = $this->get('/Note/create');
 $response->assertOk();
}
/***
A Edit test Note.*
*
@return void 
 */
 public function testEditNote() {
 $record = Note::inRandomOrder()->first(); 

 $response = $this->get('/Note/'+$record->id+'/edit');
 $response->assertOk();
}

}
