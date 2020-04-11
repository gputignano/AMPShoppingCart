<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MigrationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function tables_migration_terminates_successfully()
    {
        $this->artisan('migrate:fresh')
            ->assertExitCode(0);
    }

    /** @test */
    public function tables_seeding_terminates_successfully()
    {
        $this->artisan('db:seed')
            ->expectsOutput('Database seeding completed successfully.');
    }
}
