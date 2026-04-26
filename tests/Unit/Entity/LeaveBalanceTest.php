<?php

declare(strict_types=1);

namespace Ksfraser\Leave\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\Leave\Entity\LeaveBalance;

class LeaveBalanceTest extends TestCase
{
    public function testCanCreateLeaveBalance(): void
    {
        $balance = new LeaveBalance();
        $this->assertInstanceOf(LeaveBalance::class, $balance);
    }

    public function testCanSetAndGetValues(): void
    {
        $balance = new LeaveBalance();
        $balance->setEmployeeId(1);
        $balance->setLeaveTypeId(5);
        $balance->setYear(2024);
        $balance->setOpeningBalance(10);
        $balance->setAccrued(2);
        $balance->setUsed(3);
        
        $this->assertEquals(1, $balance->getEmployeeId());
        $this->assertEquals(5, $balance->getLeaveTypeId());
        $this->assertEquals(2024, $balance->getYear());
    }

    public function testCanCalculateAvailable(): void
    {
        $balance = new LeaveBalance();
        $balance->setOpeningBalance(10);
        $balance->setAccrued(2);
        $balance->setUsed(3);
        
        $this->assertEquals(9, $balance->getAvailable());
    }

    public function testCanCheckInsufficientFunds(): void
    {
        $balance = new LeaveBalance();
        $balance->setOpeningBalance(5);
        $balance->setAccrued(0);
        $balance->setUsed(3);
        
        // Available = 5 + 0 - 3 = 2
        $this->assertFalse($balance->hasInsufficientFunds(2)); // exact available
        $this->assertTrue($balance->hasInsufficientFunds(3)); // more than available
    }
}