# 📖 MedNet User Guide

> **Complete step-by-step guide for customers and administrators**

---

## 📑 Table of Contents

- [Customer Guide](#-customer-guide)
  - [Getting Started](#1-getting-started)
  - [Browsing Products](#2-browsing-products)
  - [Shopping Cart](#3-shopping-cart)
  - [Checkout Process](#4-checkout-process)
  - [Order Management](#5-order-management)
  - [Profile Management](#6-profile-management)
  - [Quick Buy Feature](#7-quick-buy-feature)
  - [Support & Help](#8-support--help)
- [Admin Guide](#-admin-guide)
  - [Admin Access](#1-admin-access)
  - [Dashboard Overview](#2-dashboard-overview)
  - [Product Management](#3-product-management)
  - [Order Processing](#4-order-processing)
  - [User Management](#5-user-management)
  - [Promotional Management](#6-promotional-management)
  - [Prescription Approval](#7-prescription-approval)
  - [Support Management](#8-support-management)
  - [Analytics & Reports](#9-analytics--reports)

---

# 👤 Customer Guide

## 1. Getting Started

### 1.1 Registration

**Step-by-step process:**

1. **Visit the homepage** at `http://127.0.0.1:8000`
2. **Click "Register"** button in the top-right corner of the navigation bar
3. **Fill in the registration form:**
   - **Name**: Enter your full name
   - **Email**: Provide a valid email address
   - **Password**: Choose a secure password (minimum 8 characters)
   - **Confirm Password**: Re-enter your password
4. **Click "Register"** button to create your account
5. **Success!** You'll be automatically logged in and redirected to the dashboard

**Note**: Email verification is optional but recommended for account security.

---

### 1.2 Login

**For existing users:**

1. **Click "Login"** in the top-right corner
2. **Enter credentials:**
   - Email address
   - Password
3. **Check "Remember Me"** (optional) to stay logged in
4. **Click "Login"** to access your account
5. You'll be redirected to your personalized dashboard

**Forgot Password?**
- Click "Forgot Password?" link
- Enter your email address
- Follow the password reset link sent to your email

---

## 2. Browsing Products

### 2.1 Dashboard/Homepage

Once logged in, you'll see:

- **🎨 Promotional Slider**: Featured products and special offers (swipe through 6 promotional banners)
- **💰 Discounted Products**: Top 20 products with active discounts
- **📊 Quick Stats**: Your cart count and recent activity
- **🔍 Search Bar**: Quick access to search functionality
- **📂 Category Menu**: Navigate to different product sections

---

### 2.2 Product Categories

**Three main categories to explore:**

#### 💊 Medicines
1. **Click "Medicine"** in the navigation menu
2. **Browse products**: 
   - View product cards with name, price, and image
   - See discount badges on sale items
   - Check stock status (In Stock/Low Stock/Out of Stock)
3. **Filter & Sort**:
   - By price range
   - By manufacturer
   - By prescription requirement
   - By stock availability

#### 🌿 Supplements
1. **Click "Supplements"** in the navigation menu
2. **View supplements catalog**:
   - Vitamins, minerals, and dietary supplements
   - Herbal and natural products
   - Nutritional support items
3. **Same filtering options** as medicines

#### 🏥 First Aid
1. **Click "First Aid"** in the navigation menu
2. **Browse first aid supplies**:
   - Bandages and dressings
   - Antiseptics and disinfectants
   - Medical instruments
   - Emergency supplies

---

### 2.3 Product Search

**Advanced search functionality:**

1. **Click the search icon** or search bar in the navigation
2. **Type your query**:
   - Product name (e.g., "Paracetamol")
   - Generic name (e.g., "Acetaminophen")
   - Partial matches work
3. **Real-time results** appear as you type
4. **Filter results** by category, price, or availability
5. **Click any product** to view full details

---

### 2.4 Product Details

**When you click on a product:**

1. **Product Information Displayed:**
   - Large product image
   - Product name and generic name
   - Detailed description
   - Price (with discount if applicable)
   - Dosage information
   - Manufacturer details
   - Expiry date
   - Stock status and quantity available
   - Side effects (if any)
   - Prescription requirement indicator

2. **Available Actions:**
   - **Add to Cart**: Specify quantity and add to shopping cart
   - **Quick Buy**: Add to quick buy list for faster future orders
   - **View Similar**: See related products

---

## 3. Shopping Cart

### 3.1 Adding Items to Cart

**Two ways to add products:**

#### Option 1: From Product Listing
1. **Find product** in category or search
2. **Click "Add to Cart"** button on product card
3. **Select quantity** (default is 1)
4. **Confirm** - Item added notification appears
5. **Cart count updates** in navigation bar

#### Option 2: From Product Details
1. **Open product details** page
2. **Adjust quantity** using +/- buttons or number input
3. **Click "Add to Cart"** button
4. **Success message** confirms addition
5. **Option to continue shopping** or **Go to Cart**

---

### 3.2 Viewing Your Cart

**Access your cart:**

1. **Click cart icon** in navigation (shows item count)
2. **Or go to** `/cart` URL

**Cart Page Shows:**
- ✅ All items in your cart
- ✅ Product images and names
- ✅ Individual prices
- ✅ Quantity selectors
- ✅ Subtotals per item
- ✅ Total cart value
- ✅ Prescription upload section (for required items)

---

### 3.3 Managing Cart Items

**Quantity Adjustment:**
1. **Use +/- buttons** to increase or decrease quantity
2. **Or type directly** in quantity input
3. **Auto-save** - Changes are saved automatically
4. **Price updates** in real-time

**Removing Items:**
1. **Click "Remove"** or trash icon next to item
2. **Confirm deletion** (if prompted)
3. **Item removed** from cart immediately
4. **Total recalculated** automatically

**Prescription Upload (for prescription medicines):**
1. **Identify items** marked "Prescription Required"
2. **Click "Upload Prescription"** button
3. **Select prescription image** (JPEG, PNG, PDF accepted)
4. **Upload** - Prescription attached to cart item
5. **Green checkmark** indicates successful upload

---

### 3.4 Cart Validation

**Before checkout, system checks:**
- ✅ All prescription medicines have prescriptions uploaded
- ✅ All items are in stock
- ✅ Quantities don't exceed available stock
- ⚠️ **Warning messages** appear if issues found
- 🚫 **Checkout blocked** until issues resolved

---

## 4. Checkout Process

### 4.1 Initiating Checkout

1. **Review your cart** to ensure everything is correct
2. **Click "Proceed to Checkout"** button
3. **Redirected to checkout page** (`/checkout`)

---

### 4.2 Delivery Address

**First-time checkout:**

1. **Address Form Displayed:**
   - **Address Alias**: Give this address a nickname (e.g., "Home", "Office")
   - **Full Address**: Enter complete delivery address with landmarks
   - **Phone Number**: Contact number for delivery
   - **Location**: Select "Inside Dhaka" or "Outside Dhaka" (affects shipping)
   - **Set as Default**: Check to make this your default address

2. **Click "Save Address"** button

3. **Address saved** and displayed in checkout

**Returning customers:**

1. **Select from saved addresses**: Radio button list shows all your addresses
2. **Or add new address**: Click "Add New Address" button
3. **Edit existing**: Click edit icon next to address
4. **Delete address**: Click delete icon (except default address)

---

### 4.3 Order Summary

**Review your order:**

- **Order Items List:**
  - Product names and images
  - Quantities ordered
  - Individual prices
  - Subtotals

- **Prescription Status:**
  - ✅ Green check: Prescription uploaded
  - ⚠️ Yellow warning: Pending approval
  - 📋 Preview option: View uploaded prescription

- **Price Breakdown:**
  - Subtotal: Sum of all items
  - Delivery Charge: Based on Dhaka inside/outside
  - **Total Amount**: Final price to pay

---

### 4.4 Payment

**Current payment method:**

1. **Cash on Delivery (COD)** is selected by default
2. **Review total amount** to be paid on delivery
3. **Delivery note** (optional): Add special instructions

**Future updates may include:**
- Online payment gateways
- Credit/debit card payment
- Mobile banking (bKash, Nagad)

---

### 4.5 Place Order

1. **Review everything** one last time:
   - ✅ Delivery address is correct
   - ✅ All items are in cart
   - ✅ Prescriptions uploaded (if required)
   - ✅ Total amount is acceptable

2. **Click "Place Order"** button

3. **Order Processing:**
   - System validates stock availability
   - Inventory is reserved
   - Order number generated
   - Cart is cleared

4. **Confirmation Page:**
   - ✅ Order success message
   - 🎫 Order number displayed
   - 📧 Email confirmation sent
   - 📦 Estimated delivery time
   - 🔗 Link to track order

---

## 5. Order Management

### 5.1 Viewing Orders

**Access your orders:**

1. **Click profile icon** in navigation
2. **Select "My Orders"** from dropdown
3. **Or visit** `/profile/orders`

**Orders Page Shows:**
- List of all your orders (newest first)
- Order number and date
- Order status badge
- Total amount
- Number of items
- Action buttons

---

### 5.2 Order Status Tracking

**Order statuses explained:**

- 🟡 **Pending**: Order received, awaiting admin confirmation
- 🔵 **Processing**: Order confirmed, being prepared
- 📦 **Shipped**: Order dispatched, in transit
- ✅ **Delivered**: Order successfully delivered
- ❌ **Cancelled**: Order cancelled (by you or admin)

**Track your order:**
1. **Find your order** in orders list
2. **Click "View Details"** button
3. **Order tracking page shows:**
   - Current status
   - Status timeline
   - Expected delivery date
   - Tracking information (if available)

---

### 5.3 Order Details

**Detailed order information:**

1. **Click "View Details"** on any order
2. **Information displayed:**
   - Order number and date
   - Current status
   - Delivery address used
   - Itemized product list
   - Quantities and prices
   - Payment method
   - Total amount paid/to pay
   - Prescription status
   - Order notes

3. **Available Actions:**
   - **Download Invoice**: PDF invoice for your records
   - **Reorder**: Add all items back to cart
   - **Contact Support**: For order issues
   - **Cancel Order**: (only if status is "Pending")

---

### 5.4 Cancelling Orders

**Cancel order before processing:**

1. **Go to order details** page
2. **Click "Cancel Order"** button (only visible for pending orders)
3. **Confirm cancellation** when prompted
4. **Order status changes** to "Cancelled"
5. **Stock restored** to inventory
6. **Notification sent** to admin

⚠️ **Note**: You can only cancel orders with "Pending" status. Contact support for other statuses.

---

## 6. Profile Management

### 6.1 Profile Information

**Update your details:**

1. **Click profile icon** in navigation
2. **Select "Profile"** or visit `/profile`

**Editable information:**
- Name
- Email address
- Password (change password option)

**To update:**
1. **Click "Edit Profile"** button
2. **Modify information** in form fields
3. **Click "Save Changes"** button
4. **Success message** confirms update

---

### 6.2 Password Management

**Change your password:**

1. **Go to profile page**
2. **Click "Change Password"** section
3. **Fill in form:**
   - Current password
   - New password
   - Confirm new password
4. **Click "Update Password"** button
5. **Password updated** - You may need to log in again

---

### 6.3 Address Management

**Manage delivery addresses:**

1. **Go to** `/profile/addresses` or click "My Addresses" in profile menu

2. **View all addresses:**
   - Default address highlighted
   - Address alias and full address
   - Phone number
   - Location (Dhaka inside/outside)

3. **Add new address:**
   - Click "Add New Address" button
   - Fill in address form
   - Save

4. **Edit address:**
   - Click edit icon
   - Update information
   - Save changes

5. **Delete address:**
   - Click delete icon
   - Confirm deletion
   - Cannot delete default address (change default first)

6. **Set default address:**
   - Click "Set as Default" button
   - This address will be pre-selected at checkout

---

## 7. Quick Buy Feature

### 7.1 What is Quick Buy?

**Quick Buy** allows you to save frequently purchased items for one-click reordering.

**Benefits:**
- ⚡ Faster checkout
- 📝 Remember regular medications
- 🔄 Easy reordering
- 🎯 Personalized shopping list

---

### 7.2 Adding to Quick Buy

**Two ways to add items:**

#### From Product Page:
1. **View product details**
2. **Click "Add to Quick Buy"** button
3. **Item saved** to your quick buy list
4. **Confirmation message** appears

#### From Cart:
1. **Items in cart** show "Save to Quick Buy" option
2. **Click button** to save
3. **Item added** to quick buy list

---

### 7.3 Managing Quick Buy List

**Access your list:**

1. **Click "Quick Buy"** in navigation
2. **Or visit** `/quick-buy/manage`

**List shows:**
- All saved items with images
- Product names and prices
- Current stock status
- Quantity selectors

**Available actions:**

1. **Adjust quantity:**
   - Use +/- buttons
   - Set your regular order amount

2. **Add to cart:**
   - Click "Add to Cart" for individual items
   - Or "Add All to Cart" for bulk add

3. **Remove items:**
   - Click remove icon
   - Item deleted from quick buy list

4. **Update items:**
   - If product price changes, you'll see updated price
   - Out of stock items are marked

---

### 7.4 Quick Buy Checkout

**Fast ordering process:**

1. **Go to Quick Buy page**
2. **Review items and quantities**
3. **Click "Add Selected to Cart"**
4. **Items added to cart instantly**
5. **Proceed to checkout** normally
6. **Complete order** in seconds!

---

## 8. Support & Help

### 8.1 Contact Support

**Submit a support request:**

1. **Find "Contact Support"** or "Help" in footer
2. **Fill in support form:**
   - **Name**: Your full name
   - **Email**: Contact email
   - **Subject**: Brief description
   - **Category**: Select type (Bug Report, Feature Request, General Inquiry)
   - **Message**: Detailed description of issue/question

3. **Click "Submit"** button
4. **Confirmation message**: "Your feedback has been submitted"
5. **Email confirmation** sent to your address
6. **Support team** will respond within 24-48 hours

---

### 8.2 Tracking Support Tickets

**Check ticket status:**

1. **Email notifications** sent on status updates
2. **Status categories:**
   - 🟡 Pending: Ticket received
   - 🔵 In Progress: Being reviewed
   - ✅ Resolved: Issue fixed
   - ⏹️ Closed: Ticket completed

---

### 8.3 FAQ & Help Resources

**Common questions answered:**

- Product information
- Prescription requirements
- Delivery times and charges
- Payment methods
- Return policies
- Account management

**Access help:**
- Check footer links
- Product pages have info icons
- Tooltip help throughout site

---

# 🎛️ Admin Guide

## 1. Admin Access

### 1.1 Admin Login

**Separate admin portal:**

1. **Navigate to** `/admin/login` (not the regular login page)
2. **Enter admin credentials:**
   - Email: `admin@admin.com`
   - Password: `adminadmin`
3. **Click "Login"** button
4. **Redirected to admin dashboard**

⚠️ **Important**: Admin accounts are specially flagged. Regular users cannot access admin portal.

---

### 1.2 Admin Dashboard

**Dashboard overview shows:**

- 📊 **Key Metrics Cards:**
  - Total revenue (all-time)
  - Total orders count
  - Total products in catalog
  - Total registered users
  - Pending orders count
  - Low stock alerts

- 📈 **Charts & Graphs:**
  - Daily/weekly/monthly sales trends
  - Revenue by product category
  - Order status distribution
  - User registration trends

- ⚡ **Quick Actions:**
  - Add new product
  - Process pending orders
  - View prescription approvals
  - Manage promotions

- 📋 **Recent Activity:**
  - Latest orders
  - Recent user registrations
  - Low stock products
  - Support tickets

---

## 2. Dashboard Overview

### 2.1 Navigation Menu

**Admin sidebar menu:**

- 🏠 **Dashboard**: Main overview
- 📦 **Products**: Product management
- 📋 **Orders**: Order processing
- 👥 **Users**: User management
- 🎨 **Promotions**: Banner management
- 💊 **Prescriptions**: Prescription approvals
- 💬 **Support**: Customer feedback
- 📊 **Analytics**: Reports and insights
- ⚙️ **Settings**: System configuration

---

### 2.2 Analytics Overview

**Real-time statistics:**

1. **Revenue Tracking:**
   - Today's sales
   - Week's sales
   - Month's sales
   - Year's sales
   - Comparison with previous periods

2. **Order Metrics:**
   - Orders by status
   - Average order value
   - Orders per day/week/month

3. **Product Performance:**
   - Top-selling products
   - Most viewed products
   - Products with low stock
   - Expired/expiring products

4. **User Insights:**
   - New registrations
   - Active users
   - User retention rate

---

## 3. Product Management

### 3.1 Product List

**View all products:**

1. **Click "Products"** in admin menu
2. **Product table displays:**
   - Product ID
   - Product image (thumbnail)
   - Name and generic name
   - Category
   - Price (with discount)
   - Stock quantity
   - Stock status
   - Expiry date
   - Actions (Edit/Delete)

3. **Features:**
   - **Search**: Find products by name/generic name
   - **Filter**: By category, stock status, expiry
   - **Sort**: By name, price, stock, date
   - **Pagination**: 25 products per page

---

### 3.2 Adding New Product

**Create a new product:**

1. **Click "Add Product"** button
2. **Fill in product form:**

   **Basic Information:**
   - Product Name (required)
   - Generic Name (required)
   - Description (rich text editor)
   - Category: Medicine/Supplement/First Aid (required)
   - Tag: For sub-categorization

   **Pricing:**
   - Base Price (required)
   - Discount Percentage (0-100)
   - Updated Price (auto-calculated)

   **Inventory:**
   - Stock Quantity (required)
   - Low Stock Threshold (alert when below this)
   - Stock Status: Normal/Low Stock/Out of Stock (auto-set)
   - Expiry Date (required)

   **Medical Details:**
   - Dosage Information
   - Manufacturer Name (required)
   - Side Effects (optional)
   - Prescription Required (checkbox)

   **Media:**
   - Product Image (JPEG, PNG, max 2MB)
   - Preview before upload

3. **Click "Save Product"** button
4. **Validation checks:**
   - All required fields filled
   - Price is valid number
   - Stock is non-negative
   - Expiry date is future date
   - Image meets requirements

5. **Success!** Product created and added to catalog

---

### 3.3 Editing Products

**Update product information:**

1. **Find product** in product list
2. **Click "Edit"** button
3. **Product edit form** opens (pre-filled with current data)
4. **Modify any fields:**
   - Update prices and discounts
   - Change stock quantities
   - Edit descriptions
   - Upload new image
   - Update expiry date
5. **Click "Update Product"** button
6. **Changes saved** immediately
7. **Customers see** updated information instantly

**Bulk operations:**
- Select multiple products (checkboxes)
- Apply bulk discount
- Update stock status
- Change category

---

### 3.4 Deleting Products

**Remove product from catalog:**

1. **Click "Delete"** button next to product
2. **Confirmation popup** appears
   - "Are you sure you want to delete this product?"
   - Warning about active orders
3. **Confirm deletion**
4. **Product removed** from database
5. **Associated data handled:**
   - Cart items removed
   - Quick buy items removed
   - Order history preserved (product marked as deleted)

⚠️ **Caution**: Deletion is permanent. Consider marking as "Out of Stock" instead.

---

### 3.5 Stock Management

**Monitor and update inventory:**

1. **Stock alerts** on dashboard:
   - Red badge: Out of stock
   - Yellow badge: Low stock
   - Green badge: Normal stock

2. **Bulk stock update:**
   - Import CSV file
   - Update multiple products at once

3. **Stock history:**
   - View stock changes over time
   - Track restock dates
   - Monitor depletion rate

4. **Expiry management:**
   - Filter products by expiry date
   - Alerts for products expiring soon
   - Batch remove expired products

---

## 4. Order Processing

### 4.1 Order List

**View all customer orders:**

1. **Click "Orders"** in admin menu
2. **Orders table shows:**
   - Order number
   - Customer name and email
   - Order date and time
   - Total amount
   - Payment method
   - Current status
   - Action buttons

3. **Filters:**
   - By status (Pending/Processing/Shipped/Delivered/Cancelled)
   - By date range
   - By customer
   - By payment method

4. **Sort options:**
   - Newest first (default)
   - Oldest first
   - Highest amount
   - Lowest amount

---

### 4.2 Order Details

**View complete order information:**

1. **Click "View"** button on any order
2. **Order details page shows:**

   **Customer Information:**
   - Name and email
   - Phone number
   - Delivery address
   - User account status

   **Order Information:**
   - Order number and date
   - Current status
   - Payment method
   - Special instructions/notes

   **Order Items:**
   - Product list with images
   - Quantities ordered
   - Individual prices
   - Subtotals
   - Prescription status

   **Financial Summary:**
   - Items subtotal
   - Delivery charge
   - Total amount

   **Order History:**
   - Status change timeline
   - Admin who made changes
   - Timestamps

---

### 4.3 Processing Orders

**Update order status:**

1. **Open order details**
2. **Current status displayed** with badge
3. **Click "Update Status"** button
4. **Select new status** from dropdown:
   - Pending → Processing (confirm order)
   - Processing → Shipped (dispatch order)
   - Shipped → Delivered (mark as delivered)
   - Any status → Cancelled (cancel order)

5. **Add note** (optional): Reason or tracking info
6. **Click "Update"** button
7. **Status changed**, customer notified by email

**Status workflow:**
```
Pending → Processing → Shipped → Delivered
   ↓
Cancelled (from any stage)
```

---

### 4.4 Order Cancellation

**Cancel problematic orders:**

1. **Open order details**
2. **Click "Cancel Order"** button
3. **Cancellation form:**
   - Reason for cancellation (dropdown)
   - Additional notes (optional)
   - Refund method (if paid online)

4. **Click "Confirm Cancellation"** button
5. **System actions:**
   - Order status changed to "Cancelled"
   - Stock returned to inventory
   - Customer notified
   - Payment refunded (if applicable)

---

### 4.5 Printing & Invoices

**Generate order documents:**

1. **Invoice:**
   - Click "Print Invoice" button
   - Professional invoice PDF generated
   - Includes all order details
   - Print or download

2. **Packing Slip:**
   - Click "Print Packing Slip"
   - Warehouse-friendly format
   - Product list with quantities
   - Barcode for tracking

3. **Shipping Label:**
   - Click "Print Shipping Label"
   - Customer address formatted
   - Order number and barcode
   - Ready for courier

---

## 5. User Management

### 5.1 User List

**View all registered users:**

1. **Click "Users"** in admin menu
2. **Users table displays:**
   - User ID
   - Name and email
   - Registration date
   - Admin status
   - Ban status
   - Total orders
   - Total spent
   - Actions

3. **Search users:**
   - By name
   - By email
   - By user ID

4. **Filters:**
   - All users
   - Admin users only
   - Banned users
   - Active customers
   - Recently registered

---

### 5.2 User Details

**View user profile:**

1. **Click user name** or "View" button
2. **User profile shows:**
   - Personal information
   - Contact details
   - Registration date
   - Account status

3. **Order history:**
   - All user's orders
   - Total spent
   - Average order value
   - Frequent purchases

4. **Activity log:**
   - Login history
   - Recent actions
   - Support tickets

---

### 5.3 Ban/Unban Users

**Manage problematic users:**

**Ban a user:**
1. **Open user details**
2. **Click "Ban User"** button
3. **Reason for ban** (dropdown):
   - Fraudulent activity
   - Multiple payment failures
   - Terms violation
   - Spam/abuse
4. **Add notes** (optional)
5. **Confirm ban**
6. **User banned:**
   - Cannot log in
   - Orders cancelled
   - Cart cleared
   - Notification email sent

**Unban a user:**
1. **Find banned user** in list
2. **Click "Unban"** button
3. **Confirm action**
4. **User restored:**
   - Can log in again
   - Account reactivated
   - Welcome back email sent

---

### 5.4 Email Banning

**Block specific email addresses:**

1. **Go to "Banned Emails"** section
2. **View blacklist:**
   - All banned email addresses
   - Reason for ban
   - Date added

3. **Add email to ban:**
   - Click "Ban Email" button
   - Enter email address
   - Reason for ban
   - Save

4. **Effect:**
   - Email cannot register
   - Existing accounts unaffected
   - Registration blocked with message

5. **Remove from blacklist:**
   - Click "Unban" next to email
   - Email can register again

---

## 6. Promotional Management

### 6.1 Promotion Slider

**Manage homepage banners:**

1. **Click "Promotions"** in admin menu
2. **Current promotions displayed:**
   - Banner preview
   - Title and description
   - Display order
   - Active status
   - Actions

---

### 6.2 Adding Promotions

**Create new promotional banner:**

1. **Click "Add Promotion"** button
2. **Fill in form:**
   - **Title**: Promotion name (optional)
   - **Description**: Brief text (optional)
   - **Alt Text**: For accessibility (required)
   - **Display Order**: 1-6 (position in slider)
   - **Active**: Enable/disable
   - **Image**: Upload banner (required)
     - Recommended size: 1920x600px
     - Format: JPEG, PNG
     - Max size: 5MB

3. **Preview image** before upload
4. **Click "Save Promotion"** button
5. **Promotion appears** on homepage slider

**Best practices:**
- Use high-quality images
- Keep text readable
- Match brand colors
- Optimize file size for fast loading
- Maximum 6 active promotions

---

### 6.3 Editing Promotions

**Update existing banners:**

1. **Find promotion** in list
2. **Click "Edit"** button
3. **Modify:**
   - Change image
   - Update title/description
   - Reorder position
   - Toggle active status
4. **Save changes**
5. **Homepage updates** immediately

---

### 6.4 Managing Display Order

**Control slider sequence:**

1. **Drag and drop** promotions to reorder
2. **Or use number** in Display Order field
3. **Lower numbers** appear first
4. **Order 1** is the first slide
5. **Changes save** automatically

---

### 6.5 Deactivating Promotions

**Temporarily hide banners:**

1. **Toggle "Active"** switch to OFF
2. **Promotion hidden** from homepage
3. **Data preserved** for reactivation
4. **Reactivate anytime** by toggling ON

---

## 7. Prescription Approval

### 7.1 Prescription Queue

**Review uploaded prescriptions:**

1. **Click "Prescriptions"** in admin menu
2. **Dashboard shows:**
   - Pending prescription count
   - Urgent approvals (old orders)
   - Recently approved
   - Rejected prescriptions

3. **Prescription list displays:**
   - Order number
   - Customer name
   - Upload date
   - Product requiring prescription
   - Status (Pending/Approved/Rejected)
   - View button

---

### 7.2 Reviewing Prescriptions

**Approve or reject prescriptions:**

1. **Click "View"** on pending prescription
2. **Review page shows:**
   - High-resolution prescription image
   - Zoom and pan controls
   - Customer information
   - Product details
   - Order information

3. **Check prescription validity:**
   - ✅ Doctor's signature present
   - ✅ Patient name matches customer
   - ✅ Medication matches order
   - ✅ Prescription date is recent
   - ✅ Dosage is appropriate
   - ✅ Doctor's registration number visible

---

### 7.3 Approving Prescriptions

**If prescription is valid:**

1. **Click "Approve"** button
2. **Add notes** (optional): Specific instructions
3. **Confirm approval**
4. **System actions:**
   - Order status updated to "Processing"
   - Customer notified by email
   - Prescription marked as approved
   - Order moves to fulfillment queue

---

### 7.4 Rejecting Prescriptions

**If prescription is invalid:**

1. **Click "Reject"** button
2. **Select rejection reason:**
   - Prescription unclear/unreadable
   - Doctor signature missing
   - Patient name mismatch
   - Prescription expired
   - Wrong medication
   - Other (specify)

3. **Add detailed note** explaining issue
4. **Confirm rejection**
5. **System actions:**
   - Customer notified with reason
   - Order put on hold
   - Customer can re-upload prescription
   - Admin can review again

---

### 7.5 Requesting Re-upload

**For minor issues:**

1. **Click "Request Clarification"**
2. **Specify what's needed:**
   - Better image quality
   - Different angle
   - Additional documents
3. **Send request** to customer
4. **Customer can re-upload**
5. **Review again** when new upload received

---

## 8. Support Management

### 8.1 Support Tickets

**Manage customer inquiries:**

1. **Click "Support"** in admin menu
2. **Tickets list shows:**
   - Ticket ID
   - Customer name and email
   - Subject
   - Category (Bug/Feature/General)
   - Priority (Low/Medium/High)
   - Status (Pending/In Progress/Resolved/Closed)
   - Created date
   - Actions

---

### 8.2 Responding to Tickets

**Handle customer requests:**

1. **Click ticket** to open details
2. **Read full message** and context
3. **Check customer history:**
   - Previous tickets
   - Order history
   - Account status

4. **Compose response:**
   - Click "Reply" button
   - Type response message
   - Professional and helpful tone
   - Provide clear solution

5. **Update status:**
   - Keep as "Pending"
   - Change to "In Progress" (working on it)
   - Mark "Resolved" (issue fixed)
   - Close ticket (completed)

6. **Send response**
7. **Customer receives** email notification

---

### 8.3 Categorizing Tickets

**Organize by type:**

- **Bug Reports**: Technical issues
- **Feature Requests**: Suggestions
- **General Inquiry**: Questions
- **Complaints**: Service issues
- **Order Issues**: Order problems

**Set priority:**
- **High**: Urgent, blocking customer
- **Medium**: Important but not critical
- **Low**: General questions

---

### 8.4 Ticket Resolution

**Close completed tickets:**

1. **Verify issue resolved** with customer
2. **Update status** to "Resolved"
3. **Add resolution note**: How it was fixed
4. **Customer can reopen** if needed
5. **Auto-close** after 7 days if no response
6. **Archive old tickets** for records

---

## 9. Analytics & Reports

### 9.1 Sales Reports

**Generate sales analytics:**

1. **Click "Analytics"** → **"Sales Reports"**
2. **Select date range:**
   - Today
   - This week
   - This month
   - Custom range

3. **Report shows:**
   - Total sales revenue
   - Number of orders
   - Average order value
   - Sales by category
   - Sales by product
   - Payment method breakdown

4. **Export options:**
   - Download as PDF
   - Export to Excel/CSV
   - Print report

---

### 9.2 Inventory Reports

**Stock analysis:**

1. **Navigate to** "Inventory Reports"
2. **View metrics:**
   - Total products
   - In-stock items
   - Low stock alerts
   - Out of stock items
   - Expiring soon products

3. **Detailed lists:**
   - Products below threshold
   - Products expired/expiring
   - Fast-moving items
   - Slow-moving items

4. **Actions:**
   - Generate restock list
   - Export inventory
   - Print stock report

---

### 9.3 Customer Analytics

**User insights:**

1. **Go to** "Customer Analytics"
2. **View data:**
   - Total registered users
   - New users this month
   - Active users
   - Customer lifetime value
   - Repeat customer rate

3. **Segmentation:**
   - By location
   - By purchase frequency
   - By total spend
   - By product preference

4. **Use insights** for marketing campaigns

---

### 9.4 Product Performance

**Best and worst performers:**

1. **Access** "Product Analytics"
2. **Top products by:**
   - Revenue
   - Quantity sold
   - Profit margin
   - Customer ratings

3. **Underperforming products:**
   - Low sales
   - High return rate
   - Negative feedback

4. **Make decisions:**
   - Promote top sellers
   - Discount slow movers
   - Discontinue poor performers

---

### 9.5 Custom Reports

**Create tailored reports:**

1. **Click "Custom Report"**
2. **Select metrics** to include
3. **Choose date range**
4. **Add filters**
5. **Generate report**
6. **Save template** for future use
7. **Schedule automated** reports (daily/weekly/monthly)

---

## 🎯 Quick Reference

### Customer Quick Actions
- **Register**: Top-right → Register
- **Browse Products**: Medicine/Supplements/First Aid menus
- **Search**: Click search icon, type query
- **Add to Cart**: Product page → Add to Cart
- **Checkout**: Cart → Proceed to Checkout
- **Track Order**: Profile → My Orders
- **Quick Buy**: Product → Add to Quick Buy

### Admin Quick Actions
- **Add Product**: Products → Add Product
- **Process Order**: Orders → Select order → Update Status
- **Approve Prescription**: Prescriptions → View → Approve
- **Ban User**: Users → Select user → Ban User
- **Add Promotion**: Promotions → Add Promotion
- **View Analytics**: Dashboard → Analytics section

---

## 💡 Tips & Best Practices

### For Customers
- 📸 Upload clear prescription images
- 📝 Keep delivery addresses updated
- 🔔 Enable email notifications
- ⭐ Save frequently ordered items to Quick Buy
- 📞 Contact support for any issues

### For Admins
- ✅ Process orders promptly
- 📊 Monitor low stock daily
- 💬 Respond to support tickets within 24 hours
- 📈 Review analytics weekly
- 🔍 Verify prescriptions carefully
- 🎨 Keep promotions fresh and relevant

---

## ❓ FAQ

### Common Customer Questions

**Q: How do I upload a prescription?**
A: In your cart, click "Upload Prescription" next to prescription-required items.

**Q: Can I edit my order after placing it?**
A: You can cancel pending orders. Contact support for changes to processing orders.

**Q: How long does delivery take?**
A: Inside Dhaka: 1-2 days. Outside Dhaka: 3-5 days.

**Q: What payment methods are accepted?**
A: Currently Cash on Delivery (COD). Online payment coming soon.

### Common Admin Questions

**Q: How do I set up discounts?**
A: Edit product → Enter discount percentage → Save.

**Q: Can I recover deleted products?**
A: No, deletion is permanent. Mark as "Out of Stock" instead.

**Q: How do I handle prescription rejections?**
A: Reject with clear reason. Customer can re-upload.

**Q: Can I export order data?**
A: Yes, from Analytics → Export as CSV/Excel.

---

## 📞 Support

**Need help?**
- 📧 Email: support@mednet.com
- 📱 Phone: +880-XXXX-XXXXXX
- 💬 Live Chat: Available 9 AM - 6 PM
- 📖 Documentation: This guide!

---

<div align="center">

**Thank you for using MedNet!**

*Last updated: December 25, 2025*

</div>
