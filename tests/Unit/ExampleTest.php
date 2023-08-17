<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{

    /** @test **/
    public function the_bike_moves()
    {
        $bike = new Bike;
        //make sure it is stopped
        $this->assertFalse($bike->moving);
        $this->assertEquals(0, $bike->speed);
        
        //ride the bike
        $bike->ride(20);
        $this->assertTrue($bike->moving);
        $this->assertEquals(20, $bike->speed);
    }

    /** @test **/
    public function the_bike_stops()
    {
        $bike = new Bike;
        $bike->ride(20);

        //make sure the bike is moving
        $this->assertTrue($bike->moving);
        $this->assertEquals(20, $bike->speed);

        $bike->stop();

        //make sure it is stopped
        $this->assertFalse($bike->moving);
        $this->assertEquals(0, $bike->speed);
    }

    /** @test **/
    public function the_bike_cannot_go_over_30mkh()
    {
        $bike = new Bike;
        $bike->ride(30);

        //make sure the bike is moving
        $this->assertTrue($bike->moving);
        $this->assertEquals(30, $bike->speed);

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('The bike cannot go over 30km/h.');

        $bike->ride(31);
    }

    /**
     * A basic test example.
     */
    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }
}

class Bike
{
    public $moving = false;
    public $speed = 0;

    public function ride($speed = 5)
    {
        if ($speed > 30) {
            throw new \Exception('The bike cannot go over 30km/h.');
        }
        $this->moving = true;
        $this->speed = $speed;
    }

    public function stop()
    {
        $this->moving = false;
        $this->speed = 0;
    }
}
