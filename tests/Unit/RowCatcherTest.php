<?php

namespace Aabadawy\RowCatcher\Test\Unit;

use Aabadawy\RowCatcher\Facade\RowCatcher;
use Aabadawy\RowCatcher\Test\TestCase;
use Illuminate\Support\Collection;

class RowCatcherTest extends TestCase
{

    /**
     * @return void
     * @test
     */
    public function it_start_init_rows()
    {
        $items = [1,2,3,4,5,6,7,8,9,10];

        RowCatcher::startCatching($items);

        $rows = RowCatcher::getRegisteredRows();

        $this->assertEquals(10,count($rows));
    }

    /**
     * @return void
     * @test
     */
    public function it_init_successes_collection()
    {
        $items = [1,2,3,4,5,6,7,8,9,10];

        RowCatcher::startCatching($items);

        $successes = RowCatcher::getSuccesses();

        $this->assertCount(0, $successes);

        $this->assertTrue($successes instanceof Collection);
    }

    /**
     * @return void
     * @test
     */
    public function it_init_failures_collection()
    {
        $items = [1,2,3,4,5,6,7,8,9,10];

        RowCatcher::startCatching($items);

        $failures  = RowCatcher::getFailures();

        $this->assertCount(0, $failures);

        $this->assertTrue($failures instanceof Collection);
    }

    /**
     * @return void
     * @test
     */
    public function it_doesnt_register_failures_rows_when_no_exception()
    {
        $items = [1,2,3,4,5,6,7,8,9,10];

        RowCatcher::startCatching($items)
        ->each(function ($item){
            $item = $item * $item;
        });

        $failures  = RowCatcher::getFailures();

        $successes = RowCatcher::getSuccesses();

        $this->assertCount(0,$failures);

        $this->assertCount(10,$successes);

        $this->assertTrue(RowCatcher::allSuccess());

        $this->assertFalse(RowCatcher::allFailed());
    }

    /**
     * @return void
     * @test
     */
    public function it_doesnt_register_successes_rows_when_no_exception()
    {
        $items = [1,2,3,4,5,6,7,8,9,10];

        RowCatcher::startCatching($items)
        ->each(function ($item){
            throw new \Exception('some error happen!');
        });

        $failures  = RowCatcher::getFailures();

        $successes = RowCatcher::getSuccesses();

        $this->assertCount(10,$failures);

        $this->assertCount(0,$successes);

        $this->assertTrue(RowCatcher::allFailed());

        $this->assertFalse(RowCatcher::allSuccess());
    }

    /**
     * @return void
     * @test
     */
    public function it_reInit_success_and_failure_rows_when_end_catching()
    {
        $items = [1,2,3,4,5,6,7,8,9,10];

        RowCatcher::startCatching($items);
        foreach ($items as $item) {
            try {
                if($item % 2 == 0)
                    $result = $item * $item;
                else
                    throw new \Exception('some error here');
                RowCatcher::catchSuccess($item);
            } catch (\Throwable $exception) {
                RowCatcher::catchFailure($exception);
            }
        }

        $failures_before_end = RowCatcher::getFailures();

        $successes_before_end = RowCatcher::getSuccesses();

        RowCatcher::endCatching();

        $failures_after_end = RowCatcher::getFailures();

        $successes_after_end = RowCatcher::getSuccesses();

        $this->assertNotEmpty($failures_before_end);

        $this->assertNotEmpty($successes_before_end);

        $this->assertEmpty($successes_after_end);

        $this->assertEmpty($failures_after_end);
    }
}