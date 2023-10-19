<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DateTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        // $knownDate = Carbon::now()->format('Y/m');
        $getYear = date('m');
        echo $getYear; 

    }
}
