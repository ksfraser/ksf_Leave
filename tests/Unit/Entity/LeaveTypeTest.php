<?php

declare(strict_types=1);

namespace Ksfraser\Tests\Unit\Leave\Entity;

use Ksfraser\Leave\Entity\LeaveType;
use PHPUnit\Framework\TestCase;

class LeaveTypeTest extends TestCase
{
    public function testDefaultValues(): void
    {
        $leaveType = new LeaveType();

        $this->assertNull($leaveType->getId());
        $this->assertSame('', $leaveType->getName());
        $this->assertSame('', $leaveType->getCode());
        $this->assertSame('', $leaveType->getDescription());
        $this->assertSame(0.0, $leaveType->getAnnualAllowance());
        $this->assertTrue($leaveType->accrues());
        $this->assertSame(0.0, $leaveType->getAccrualRate());
        $this->assertTrue($leaveType->requiresApproval());
        $this->assertFalse($leaveType->isNegativeAllowed());
        $this->assertSame(0.0, $leaveType->getMaxNegativeBalance());
        $this->assertSame('', $leaveType->getGlCodeExpense());
        $this->assertSame('', $leaveType->getGlCodeAccrual());
        $this->assertTrue($leaveType->isPaid());
        $this->assertTrue($leaveType->isActive());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveType::setId
     * @covers Ksfraser\Leave\Entity\LeaveType::getId
     */
    public function testSetId(): void
    {
        $leaveType = new LeaveType();
        $result = $leaveType->setId(123);

        $this->assertInstanceOf(LeaveType::class, $result);
        $this->assertSame(123, $leaveType->getId());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveType::setName
     * @covers Ksfraser\Leave\Entity\LeaveType::getName
     */
    public function testSetName(): void
    {
        $leaveType = new LeaveType();
        $result = $leaveType->setName('Annual Leave');

        $this->assertInstanceOf(LeaveType::class, $result);
        $this->assertSame('Annual Leave', $leaveType->getName());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveType::setCode
     * @covers Ksfraser\Leave\Entity\LeaveType::getCode
     */
    public function testSetCode(): void
    {
        $leaveType = new LeaveType();
        $result = $leaveType->setCode('AL');

        $this->assertInstanceOf(LeaveType::class, $result);
        $this->assertSame('AL', $leaveType->getCode());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveType::setAnnualAllowance
     * @covers Ksfraser\Leave\Entity\LeaveType::getAnnualAllowance
     */
    public function testSetAnnualAllowance(): void
    {
        $leaveType = new LeaveType();
        $result = $leaveType->setAnnualAllowance(25.0);

        $this->assertInstanceOf(LeaveType::class, $result);
        $this->assertSame(25.0, $leaveType->getAnnualAllowance());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveType::setAccrues
     * @covers Ksfraser\Leave\Entity\LeaveType::accrues
     */
    public function testSetAccrues(): void
    {
        $leaveType = new LeaveType();
        $result = $leaveType->setAccrues(false);

        $this->assertInstanceOf(LeaveType::class, $result);
        $this->assertFalse($leaveType->accrues());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveType::setNegativeAllowed
     * @covers Ksfraser\Leave\Entity\LeaveType::isNegativeAllowed
     */
    public function testSetNegativeAllowed(): void
    {
        $leaveType = new LeaveType();
        $result = $leaveType->setNegativeAllowed(true);

        $this->assertInstanceOf(LeaveType::class, $result);
        $this->assertTrue($leaveType->isNegativeAllowed());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveType::setMaxNegativeBalance
     * @covers Ksfraser\Leave\Entity\LeaveType::getMaxNegativeBalance
     */
    public function testSetMaxNegativeBalance(): void
    {
        $leaveType = new LeaveType();
        $result = $leaveType->setMaxNegativeBalance(5.0);

        $this->assertInstanceOf(LeaveType::class, $result);
        $this->assertSame(5.0, $leaveType->getMaxNegativeBalance());
    }

    /**
     * @covers Ksfraser\Leave\Entity\LeaveType::setIsPaid
     * @covers Ksfraser\Leave\Entity\LeaveType::isPaid
     */
    public function testSetIsPaid(): void
    {
        $leaveType = new LeaveType();
        $result = $leaveType->setIsPaid(false);

        $this->assertInstanceOf(LeaveType::class, $result);
        $this->assertFalse($leaveType->isPaid());
    }
}