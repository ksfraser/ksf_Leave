<?php

declare(strict_types=1);

namespace Ksfraser\Leave\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use Ksfraser\Leave\Entity\LeaveType;

class LeaveTypeTest extends TestCase
{
    public function testCanCreateLeaveType(): void
    {
        $type = new LeaveType();
        $this->assertInstanceOf(LeaveType::class, $type);
    }

    public function testCanSetAndGetId(): void
    {
        $type = new LeaveType();
        $type->setId(1);
        $this->assertEquals(1, $type->getId());
    }

    public function testCanSetAndGetName(): void
    {
        $type = new LeaveType();
        $type->setName('Vacation');
        $this->assertEquals('Vacation', $type->getName());
    }

    public function testCanSetAndGetCode(): void
    {
        $type = new LeaveType();
        $type->setCode('VAC');
        $this->assertEquals('VAC', $type->getCode());
    }

    public function testCanSetAnnualAllowance(): void
    {
        $type = new LeaveType();
        $type->setAnnualAllowance(15);
        $this->assertEquals(15, $type->getAnnualAllowance());
    }

    public function testCanCheckIfAccrues(): void
    {
        $type = new LeaveType();
        $type->setAccrues(true);
        $this->assertTrue($type->accrues());
    }

    public function testCanCheckIfRequiresApproval(): void
    {
        $type = new LeaveType();
        $type->setRequiresApproval(true);
        $this->assertTrue($type->requiresApproval());
    }

    public function testCanSetAndGetAccrualRate(): void
    {
        $type = new LeaveType();
        $type->setAccrualRate(1.25);
        $this->assertEquals(1.25, $type->getAccrualRate());
    }

    public function testCanCheckIsActive(): void
    {
        $type = new LeaveType();
        $type->setActive(true);
        $this->assertTrue($type->isActive());
        
        $type->setActive(false);
        $this->assertFalse($type->isActive());
    }
}