<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Leave\Entity;

use Ksfraser\Leave\Entity\LeaveBalance;
use PHPUnit\Framework\TestCase;

class LeaveBalanceTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $balance = new LeaveBalance();

        $this->assertNull($balance->getId());
        $this->assertSame(0, $balance->getEmployeeId());
        $this->assertSame(0, $balance->getLeaveTypeId());
        $this->assertSame(0.0, $balance->getAnnualAllocation());
        $this->assertSame(0.0, $balance->getUsed());
        $this->assertSame(0.0, $balance->getPending());
        $this->assertSame(0.0, $balance->getAccrued());
        $this->assertSame('', $balance->getYearStart());
        $this->assertSame('', $balance->getYearEnd());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveBalance::setEmployeeId
     * @covers Ksfraser\Leave\Entity\LeaveBalance::getEmployeeId
     */
    public function testSetEmployeeId(): void
    {
        $balance = new LeaveBalance();
        $result = $balance->setEmployeeId(123);

        $this->assertInstanceOf(LeaveBalance::class, $result);
        $this->assertSame(123, $balance->getEmployeeId());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveBalance::setAnnualAllocation
     * @covers Ksfraser\Leave\Entity\LeaveBalance::getAnnualAllocation
     */
    public function testSetAnnualAllocation(): void
    {
        $balance = new LeaveBalance();
        $result = $balance->setAnnualAllocation(25.0);

        $this->assertInstanceOf(LeaveBalance::class, $result);
        $this->assertSame(25.0, $balance->getAnnualAllocation());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveBalance::getAvailable
     */
    public function testGetAvailable(): void
    {
        $balance = new LeaveBalance();
        $balance->setAnnualAllocation(25.0);
        $balance->setUsed(5.0);
        $balance->setPending(2.0);

        $this->assertSame(18.0, $balance->getAvailable());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveBalance::setUsed
     * @covers Ksfraser\Leave\Entity\LeaveBalance::getUsed
     */
    public function testSetUsed(): void
    {
        $balance = new LeaveBalance();
        $result = $balance->setUsed(10.0);

        $this->assertInstanceOf(LeaveBalance::class, $result);
        $this->assertSame(10.0, $balance->getUsed());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveBalance::setPending
     * @covers Ksfraser\Leave\Entity\LeaveBalance::getPending
     */
    public function testSetPending(): void
    {
        $balance = new LeaveBalance();
        $result = $balance->setPending(3.0);

        $this->assertInstanceOf(LeaveBalance::class, $result);
        $this->assertSame(3.0, $balance->getPending());
    }
}