<?php

namespace Tests\Feature;

use App\Models\MenuItem;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MenuControllerTest extends TestCase
{
  
    use RefreshDatabase;
    
 
    public function test_index_method_displays_menu_items_by_category()
    {
        
        $starter = MenuItem::factory()->create([
            'name' => 'Test Starter',
            'price' => 9.99,
            'description' => 'A starter item',
            'category' => 'starters'
        ]);
        
        $main = MenuItem::factory()->create([
            'name' => 'Test Main',
            'price' => 19.99,
            'description' => 'A main course',
            'category' => 'mains'
        ]);
        
        $drink = MenuItem::factory()->create([
            'name' => 'Test Drink',
            'price' => 4.99,
            'description' => 'A drink item',
            'category' => 'drinks'
        ]);
        
     
        $response = $this->get(route('admin.menu.index'));
        
      
        $response->assertStatus(200);
        
     
        $response->assertViewHas('starters');
        $response->assertViewHas('mains');
        $response->assertViewHas('drinks');
        
      
        $response->assertSee('Test Starter');
        $response->assertSee('Test Main');
        $response->assertSee('Test Drink');
    }
    
   
    public function test_toggle_availability_changes_item_status()
    {
      
        $this->withoutMiddleware();
        
        
        $menuItem = MenuItem::factory()->create([
            'name' => 'Test Menu Item',
            'price' => 12.99,
            'description' => 'A test item',
            'category' => 'mains',
            'is_available' => true
        ]);
        
  
        $response = $this->patch(route('admin.menu.toggle', $menuItem->id));
        

        $response->assertRedirect(route('admin.menu.index'));
        
      
        $response->assertSessionHas('success', 'Availability updated');
        
      
        $menuItem->refresh();
        $this->assertFalse($menuItem->is_available);
        
 
        $this->patch(route('admin.menu.toggle', $menuItem->id));

        $menuItem->refresh();
        $this->assertTrue($menuItem->is_available);
    }
}