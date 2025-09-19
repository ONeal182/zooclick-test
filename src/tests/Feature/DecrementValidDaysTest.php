<?php

namespace Tests\Feature;

use App\Jobs\DecrementValidDaysJob;
use App\Models\Vaccination;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DecrementValidDaysTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_decrements_valid_days_for_all_vaccinations()
    {
        $vaccination = Vaccination::factory()->create([
            'valid_days' => 10,
        ]);

        (new DecrementValidDaysJob())->handle();

        $this->assertDatabaseHas('vaccinations', [
            'id' => $vaccination->id,
            'valid_days' => 9,
        ]);
    }

    /** @test */
    public function it_does_not_go_below_zero()
    {
        $vaccination = Vaccination::factory()->create([
            'valid_days' => 0,
        ]);

        (new DecrementValidDaysJob())->handle();

        $this->assertDatabaseHas('vaccinations', [
            'id' => $vaccination->id,
            'valid_days' => 0,
        ]);
    }
}
