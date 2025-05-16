<?php

namespace Tests\Feature;

use App\Models\Reservation;
use App\Models\Table;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ReservationControllerTest extends TestCase
{
    use RefreshDatabase;


    public function test_index_shows_tables_and_reservations()
    {
        // Disable middleware to avoid auth issues
        $this->withoutMiddleware();


        $table = Table::factory()->create([
            'name' => 'Test Table',
            'capacity' => 4,
            'is_active' => true
        ]);


        $reservation = Reservation::factory()->create([
            'table_id' => $table->id,
            'customer_name' => 'John Doe',
            'customer_phone' => '123-456-7890',
            'reservation_time' => now()->addDays(1),
            'guests' => 2,
            'status' => 'pending'
        ]);


        $response = $this->get(route('admin.reservations.index'));


        $response->assertStatus(200);

        $response->assertViewHas('tables');
        $response->assertViewHas('reservations');

        $response->assertSee('Test Table');
        $response->assertSee('John Doe');
    }


    public function test_update_status_changes_reservation_status()
    {

        $this->withoutMiddleware();

        $table = Table::factory()->create([
            'name' => 'Test Table',
            'capacity' => 4,
            'is_active' => true
        ]);

        $reservation = Reservation::factory()->create([
            'table_id' => $table->id,
            'customer_name' => 'Jane Doe',
            'customer_phone' => '123-456-7890',
            'reservation_time' => now()->addDays(1),
            'guests' => 2,
            'status' => 'pending'
        ]);


        $response = $this->patch(route('admin.reservations.status.update', $reservation->id), [
            'status' => 'confirmed'
        ]);


        $response->assertRedirect(route('admin.reservations.index'));

        $response->assertSessionHas('success', 'Status updated successfully');

        $reservation->refresh();


        $this->assertEquals('confirmed', $reservation->status);
    }
}