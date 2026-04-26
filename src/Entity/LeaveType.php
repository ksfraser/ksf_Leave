<?php

declare(strict_types=1);

namespace Ksf\Leave\Entity;

class LeaveType
{
    private ?int $id = null;
    private string $name = '';
    private string $code = '';
    private string $description = '';
    private float $annualAllowance = 0;
    private bool $accrues = true;
    private float $accrualRate = 0;
    private bool $requiresApproval = true;
    private bool $negativeAllowed = false;
    private float $maxNegativeBalance = 0;
    private string $glCodeExpense = '';
    private string $glCodeAccrual = '';
    private bool $isPaid = true;
    private bool $active = true;

    public function getId(): ?int { return $this->id; }
    public function setId(?int $id): self { $this->id = $id; return $this; }
    public function getName(): string { return $this->name; }
    public function setName(string $name): self { $this->name = $name; return $this; }
    public function getCode(): string { return $this->code; }
    public function setCode(string $code): self { $this->code = $code; return $this; }
    public function getDescription(): string { return $this->description; }
    public function setDescription(string $description): self { $this->description = $description; return $this; }
    public function getAnnualAllowance(): float { return $this->annualAllowance; }
    public function setAnnualAllowance(float $annualAllowance): self { $this->annualAllowance = $annualAllowance; return $this; }
    public function accrues(): bool { return $this->accrues; }
    public function setAccrues(bool $accrues): self { $this->accrues = $accrues; return $this; }
    public function getAccrualRate(): float { return $this->accrualRate; }
    public function setAccrualRate(float $accrualRate): self { $this->accrualRate = $accrualRate; return $this; }
    public function requiresApproval(): bool { return $this->requiresApproval; }
    public function setRequiresApproval(bool $requiresApproval): self { $this->requiresApproval = $requiresApproval; return $this; }
    public function isNegativeAllowed(): bool { return $this->negativeAllowed; }
    public function setNegativeAllowed(bool $negativeAllowed): self { $this->negativeAllowed = $negativeAllowed; return $this; }
    public function getMaxNegativeBalance(): float { return $this->maxNegativeBalance; }
    public function setMaxNegativeBalance(float $maxNegativeBalance): self { $this->maxNegativeBalance = $maxNegativeBalance; return $this; }
    public function getGlCodeExpense(): string { return $this->glCodeExpense; }
    public function setGlCodeExpense(string $glCodeExpense): self { $this->glCodeExpense = $glCodeExpense; return $this; }
    public function getGlCodeAccrual(): string { return $this->glCodeAccrual; }
    public function setGlCodeAccrual(string $glCodeAccrual): self { $this->glCodeAccrual = $glCodeAccrual; return $this; }
    public function isPaid(): bool { return $this->isPaid; }
    public function setIsPaid(bool $isPaid): self { $this->isPaid = $isPaid; return $this; }
    public function isActive(): bool { return $this->active; }
    public function setActive(bool $active): self { $this->active = $active; return $this; }
}