# CorpEasy Form Testing Guide

## Overview
This document outlines how to test all forms on the CorpEasy website to verify that:
1. Form submissions are properly stored in the database
2. Submitted data is correctly displayed on the admin insights page

---

## Forms on the Website

### 1. Home Page Hero Form
**Location:** Homepage > "Tell Us What You Need" sidebar form
**URL:** https://corpeasy.in/
**Fields:**
- Full Name (required)
- Company Name (required)
- Phone Number (required)
- Email ID (required)
- I am looking for... (dropdown)
  - Managed office space (up to 50 seats)
  - Managed office space (50 to 200 seats)
  - Managed office space (200+ seats)
  - Help finding a commercial office for rent
  - A tenant for my commercial property
  - General information

### 2. Managed Offices Page Form
**Location:** Managed Offices page > "Tell Us Your Office Requirement" form
**URL:** https://corpeasy.in/#managed
**Fields:**
- Full Name (required)
- Company Name (required)
- Work Email (required)
- Phone Number (required)
- Team size and preferred location (optional)

### 3. Find a Property Page Form
**Location:** Find a Property page > "Tell Us What You Are Looking For" form
**URL:** https://corpeasy.in/#find
**Fields:**
- Full Name (required)
- Company Name (required)
- Phone Number (required)
- Email ID (required)
- Your requirement (optional)

### 4. Lease Your Property Page Form
**Location:** Lease Your Property page > "Tell Us About Your Property" form
**URL:** https://corpeasy.in/#list
**Fields:**
- Your Name (required)
- Company or Property Owner Name (optional)
- Phone Number (required)
- Email ID (required)
- Property Address or Area (required)
- Approximate Area (Sq Ft) (optional)

### 5. Facility Management Page Form
**Location:** Facility Management page > "Get a Facility Management Quote" form
**URL:** https://corpeasy.in/#facility
**Fields:**
- Your Full Name (required)
- Company Name (required)
- Work Email Address (required)
- +91 Phone Number (required)
- Office Size (dropdown, required)
  - Small Office (Up to 20 seats)
  - Mid-Size Office (20–100 seats)
  - Large Office (100–500 seats)
  - Enterprise Campus (500+ seats)

### 6. Contact Us Page Form
**Location:** Contact page > "Send Us a Message" form
**URL:** https://corpeasy.in/#contact
**Fields:**
- Your Full Name (required)
- Company Name (required)
- Email Address (required)
- Phone Number (required)
- What can we help you with? (dropdown, required)
  - I need a managed office space in Mumbai
  - I need help finding a commercial office for rent
  - I want to list my commercial property
  - I need facility management for my office
  - General enquiry

---

## Testing Procedure

### Step 1: Test Each Form Submission

For each form, follow these steps:

1. **Navigate to the page containing the form**
2. **Fill in the form with TEST data:**
   - Use a test email like: test@example.com
   - Use a test phone like: +91 9876543210
   - Use company name: Test Company CorpEasy
   - Use your name: Test User

3. **Submit the form**
4. **Verify success message appears:**
   - Should see: "Received. We will be in touch within 24 hours."
   - A reference number should be displayed (format: CE-YYYYMMDD-XXXXXX)

5. **Check for email notification:**
   - You should receive an auto-reply email at the test email address
   - The notification email goes to: jaynishar@corpeasy.in

### Step 2: Verify Data in Admin Dashboard

1. **Access the admin dashboard:**
   - URL: https://corpeasy.in/admin_simple.php
   - Login with your admin credentials

2. **Locate your test submission:**
   - Find the row with your test data
   - Fields displayed: ID, Date, Name, Company, Email, Phone, Type

3. **Click "View" to see full details:**
   - Check all submitted fields are captured
   - Verify: Full Name, Company, Email, Phone, Form Type, Requirement, Property Location, Property Area (if applicable), Message, Source Page

### Step 3: Verify Data in Database (Optional)

If you have direct database access:

1. **Connect to MySQL database:**
   ```
   Host: localhost
   Database: u315885808_corpeasy_leads
   User: u315885808_corpeasy
   Password: [your password]
   ```

2. **Run query to check recent submissions:**
   ```sql
   SELECT * FROM leads ORDER BY id DESC LIMIT 10;
   ```

3. **Verify columns:**
   - id (auto-increment)
   - form_type (e.g., "submit_your_requirement", "share_my_requirement")
   - full_name
   - company_name
   - email
   - phone
   - requirement
   - property_location
   - property_area
   - message
   - source_page (e.g., "#home", "#managed")
   - ip_address
   - created_at (timestamp)

---

## Expected Test Results

### Form Submission Success
| Form | Expected Result |
|------|-----------------|
| Home Hero Form | Green success message, reference number shown |
| Managed Offices Form | Green success message, reference number shown |
| Find Property Form | Green success message, reference number shown |
| Lease Property Form | Green success message, reference number shown |
| Facility Management Form | Green success message, reference number shown |
| Contact Form | Green success message, reference number shown |

### Admin Dashboard Display
| Field | Should Display |
|-------|----------------|
| ID | Sequential number (1, 2, 3...) |
| Date | Format: "DD Mon YYYY" |
| Name | Full name as submitted |
| Company | Company name as submitted |
| Email | Valid email address |
| Phone | Phone number with country code |
| Type | Form type based on button text |
| Requirement | Selected option or custom text |
| Property Location | Address/area (for list page form) |
| Property Area | Square feet value (for list page form) |

---

## CSV Export Testing

1. **Navigate to admin dashboard**
2. **Click "Export CSV" button**
3. **Verify downloaded CSV contains:**
   - All leads data
   - Correct headers: ID, Date, Name, Company, Email, Phone, Form Type, Requirement, Property Location, Property Area, Message, Source Page, IP Address
   - All submitted data correctly mapped

---

## Troubleshooting

### Form Not Submitting
- Check browser console for JavaScript errors
- Verify network connectivity
- Check if submit.php is accessible

### Data Not Appearing in Admin
- Verify database connection in submit.php
- Check PHP error logs
- Confirm table structure matches expected schema

### Email Not Received
- Check spam folder
- Verify PHP mail() function works
- Check notification email address in submit.php

---

## Test Data Template

Use this template for testing:

```
Name: John Test
Email: testuser123@example.com
Phone: +91 9876543210
Company: Test Industries Pvt Ltd
Requirement: Managed office space (50 to 200 seats)
Source Page: #home (or respective page)
```

---

## Schedule

- Test all forms after any code changes
- Run weekly verification of admin dashboard
- Monthly audit of data integrity

---

*Last Updated: March 2026*
