# Use Cases - ksf_Leave

## UC-LV-001: Submit Leave Request
**Actor**: Employee

**Preconditions**: Employee has active employment status

**Flow**:
1. Navigate to Leave > Request Leave
2. Select leave type:
   - Vacation (V01)
   - Sick (S01)
   - Personal (P01)
   - Bereavement (B01)
   - Other (admin-defined)
3. Enter:
   - Start date
   - End date (or duration)
   - Notes/reason (optional)
   - Half-day options
4. System checks:
   - Leave balance sufficient
   - No conflicts with existing leave
   - Blackout dates (if any)
5. If checks pass → Submit request
6. System:
   - Creates pending request
   - Notifies manager (ksf_Workflow)
   - Shows in employee's leave calendar

**Alternate Flow - Insufficient Balance**:
- System shows error
- Employee can adjust dates or request advance leave

---

## UC-LV-002: Manager Leave Approval
**Actor**: Manager

**Trigger**: Leave request submitted by direct report

**Flow**:
1. Manager receives notification (ksf_Workflow)
2. Views request details:
   - Employee, dates, type
   - Current leave balance
   - Team calendar (conflict check)
3. Decision options:
   - Approve: Request approved
   - Reject: Enter reason
   - Request more info: Send back to employee
4. On approval:
   - Request status → 'Approved'
   - Leave balance deducted (ksf_HRM)
   - Calendar event created (ksf_Calendar)
   - Employee notified
5. On rejection:
   - Request status → 'Rejected'
   - Employee notified with reason
   - No balance deducted

---

## UC-LV-003: Leave Balance Inquiry
**Actor**: Employee, Manager, HR

**Flow**:
1. Navigate to Leave > My Balance (or Employee > Leave)
2. View balance summary:
   - Vacation: X days available / Y earned this year
   - Sick: X days available / Y earned this year
   - Personal: X days available / Y earned this year
   - Pending: Z days in pending requests
3. View history:
   - All leave taken this year
   - Approval status of each
4. Manager sees team balances
5. HR sees all employee balances

---

## UC-LV-004: Leave Accrual Processing
**Actor**: System (monthly cron job)

**Trigger**: End of month

**Flow**:
1. System runs monthly accrual job
2. For each active employee:
   - Calculate accrual based on:
     - Employment type (full-time, part-time)
     - Tenure (more tenure = more vacation)
     - Leave policy
3. Add accrued days to balance:
   - Example: 1.67 days/month for vacation
   - Example: 0.5 days/month for sick
4. Update ksf_HRM leave balance
5. Generate accrual report for HR
6. Send notification to employee (optional)

**Annual Carryover**:
1. At year-end:
   - Calculate carryover allowed (e.g., max 5 days)
   - Lapse excess days
   - Carryover days added to new year balance
2. Generate year-end leave report

---

## UC-LV-005: Leave Escalation
**Actor**: System

**Trigger**: Leave request pending > 48 hours

**Flow**:
1. System checks pending requests daily
2. If request pending > timeout:
   - System emits `leave.escalation` event (ksf_Workflow)
   - Escalate to manager's manager
   - Original manager receives reminder
   - Escalation logged in audit trail
3. Escalated approver can:
   - Approve/reject on behalf
   - Send back to original manager

---

## UC-LV-006: Cancel Leave Request
**Actor**: Employee, HR

**Flow**:
1. Employee navigates to My Leave
2. Selects pending or approved request
3. Clicks Cancel
4. System checks:
   - If pending: simply cancel
   - If approved: check if within cancellation window
5. If within window:
   - Cancel request
   - Restore leave balance
   - Remove calendar event
   - Notify manager
6. If outside window:
   - Show policy warning
   - Require HR approval

---

## UC-LV-007: HR Leave Override
**Actor**: HR Manager

**Flow**:
1. HR identifies leave issue:
   - Overlimit approval needed
   - Correction required
   - Policy exception
2. HR navigates to employee leave
3. Options:
   - Adjust balance manually
   - Approve over-limit request
   - Transfer leave between types
   - Add one-time accrual
4. HR enters reason/justification
5. System logs override with HR signature
6. Audit report available

---

## UC-LV-008: Leave Calendar Sync
**Actor**: System

**Trigger**: Leave approved, cancelled, or modified

**Flow**:
1. When leave status changes:
   - If approved → Create/update calendar event (ksf_Calendar)
     - Event type: 'Out of Office'
     - Block employee's day
     - Show on team calendar
   - If rejected → Remove tentative calendar entry
   - If modified → Update calendar event
2. Calendar event includes:
   - Employee name
   - Leave type
   - Duration
   - Manager name (optional)

---

## UC-LV-009: Sick Leave Documentation
**Actor**: Employee, HR

**Trigger**: Sick leave > 3 consecutive days

**Flow**:
1. Employee submits sick leave
2. If duration > 3 days:
   - System requires documentation flag
   - Email to HR
3. Employee uploads medical certificate
4. HR reviews certificate
5. If approved:
   - Leave marked as 'Documented'
   - Balance deducted
6. If rejected:
   - Leave reclassified or cancelled
   - HR contacts employee

---

## UC-LV-010: Leave Report Generation
**Actor**: HR Manager, Management

**Flow**:
1. Navigate to Reports > Leave
2. Select report type:
   - Leave utilization by department
   - Leave balance summary
   - Sick leave tracking
   - Leave trending
3. Set filters:
   - Date range
   - Department
   - Employee
   - Leave type
4. Generate report
5. Export options: PDF, Excel, CSV
6. Schedule recurring reports

---

## UC-LV-011: Holiday Calendar Setup
**Actor**: HR Administrator

**Flow**:
1. Navigate to Leave > Holidays
2. Add holidays for year:
   - Holiday name
   - Date
   - Optional: recurring annually
3. Holidays auto-excluded from leave requests
4. Calendar shows holidays (ksf_Calendar)
5. Different holiday calendars per region/location

---

## UC-LV-012: Leave Request via Email
**Actor**: Employee (via email bot)

**Trigger**: Employee sends email to leave request address

**Flow**:
1. Employee sends email:
   - To: leave@company.com
   - Subject: Vacation [date range]
   - Body: Optional notes
2. System parses email:
   - Extract dates from subject/body
   - Identify employee from sender email
3. Creates leave request automatically
4. Sends confirmation email back
5. Normal approval workflow follows

*Document Version: 1.0.0*
*Last Updated: 2026-05-11*