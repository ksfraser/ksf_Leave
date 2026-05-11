# UAT Plan - ksf_Leave

## Document Information
- **Module**: ksf_Leave
- **Version**: 1.0.0
- **Date**: 2026-05-11

## 1. UAT Overview

### 1.1 Purpose
Validate Leave functionality: request submission, approval, balance tracking.

### 1.2 Modules Integrated
- ksf_HRM
- ksf_Workflow
- ksf_Calendar
- ksf_Timesheets

## 2. UAT Scenarios

### UAT-LV-001: Submit Leave Request
**Scenario**: Employee submits vacation request

**Steps**:
1. Navigate to Leave > Request Leave
2. Select leave type: Vacation (V01)
3. Enter dates: next Monday-Wednesday
4. Add notes
5. Submit request
6. Verify:
   - Request created
   - Balance checked
   - Manager notified

**Expected Results**:
- [ ] Request pending
- [ ] Balance deducted from available (pending)
- [ ] Manager notified via workflow
- [ ] Calendar shows tentative event

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

### UAT-LV-002: Manager Approves Leave
**Scenario**: Manager approves employee's request

**Steps**:
1. Manager receives notification
2. View request details
3. Check team calendar for conflicts
4. Click Approve
5. Add comments
6. Submit

**Expected Results**:
- [ ] Request approved
- [ ] Balance finalized
- [ ] Employee notified
- [ ] Calendar event confirmed

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

### UAT-LV-003: Leave Balance Inquiry
**Scenario**: Employee checks leave balance

**Steps**:
1. Navigate to Leave > My Balance
2. View balance summary:
   - Vacation: 12 days available / 15 earned
   - Sick: 8 days available / 10 earned
3. View pending requests
4. View history

**Expected Results**:
- [ ] Accurate available balance
- [ ] Pending requests shown
- [ ] History displayed

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

### UAT-LV-004: Cancel Leave Request
**Scenario**: Employee cancels approved leave

**Steps**:
1. Navigate to My Leave
2. Select approved request
3. Click Cancel
4. Confirm cancellation
5. Verify balance restored
6. Verify calendar event removed

**Expected Results**:
- [ ] Request cancelled
- [ ] Balance restored
- [ ] Calendar updated
- [ ] Manager notified

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

### UAT-LV-005: Sick Leave with Documentation
**Scenario**: Sick leave > 3 days requires certificate

**Steps**:
1. Submit sick leave for 5 days
2. System flags documentation required
3. Upload medical certificate
4. HR reviews and approves

**Expected Results**:
- [ ] Documentation flag set
- [ ] Certificate linked
- [ ] HR can approve/reject

**Status**: ☐ Pass  ☐ Fail  ☐ N/A

---

## 3. Sign-Off

| Role | Name | Signature | Date |
|------|------|-----------|------|
| Business Owner | | | |
| UAT Lead | | | |
| Technical Lead | | | |

---

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*