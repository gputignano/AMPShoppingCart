<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MigrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tables_migration_terminates_successfully()
    {
        $response = $this->artisan('migrate:fresh');

        $response->assertExitCode(0);
    }

    /** @test */
    public function tables_seeding_terminates_successfully()
    {
        $response = $this->artisan('db:seed');

        $response->expectsOutput('Database seeding completed successfully.');
    }
}
