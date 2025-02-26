 # AxeTech Website Backend - Technical Documentation

## Overview

The AxeTech Website Backend is a Laravel-based API that powers the AxeTech Innovations website. It provides a robust backend infrastructure for managing content through a CMS, handling authentication, and serving data to the frontend applications.

## System Requirements

- PHP 8.1 or higher
- MySQL 8.0 or higher
- Composer 2.x
- Laravel 10.x

## Project Structure

The project follows the standard Laravel directory structure with additional organization for better maintainability:

```
axetech-website-backend/
├── app/
│   ├── Constants/         # Application constants
│   ├── Http/
│   │   ├── Controllers/   # API controllers
│   │   ├── Requests/      # Form request validation classes
│   │   └── Middleware/    # Custom middleware
│   ├── Models/           # Eloquent models
│   └── Traits/          # Shared traits (e.g., ApiResponse)
├── database/
│   ├── migrations/      # Database migrations
│   └── seeders/        # Database seeders
├── routes/
│   └── api.php         # API route definitions
├── postman/            # Postman collection for API testing
└── documents/          # Project documentation
```

## Authentication System

### Implementation Details
- Uses Laravel Sanctum for token-based authentication
- Device-based token generation for better security
- Password reset functionality with email notifications
- Queued email processing using Mailtrap for testing

### Authentication Endpoints
- `POST /api/auth/login` - Admin login
- `POST /api/auth/logout` - Admin logout
- `GET /api/auth/profile` - Get admin profile
- `PUT /api/auth/profile` - Update admin profile
- `POST /api/auth/forgot-password` - Request password reset
- `POST /api/auth/reset-password` - Reset password

## API Modules

### 1. Projects Module

#### Model Structure
- Fields: name, overview, key_features, challenge, solution, results, main_image_links
- Uses soft deletes for data recovery
- Includes visibility control

#### Endpoints
- `GET /api/projects` - List projects with pagination
- `POST /api/projects` - Create project
- `GET /api/projects/{project}` - Get project details
- `PUT /api/projects/{project}` - Update project
- `DELETE /api/projects/{project}` - Delete project

### 2. Services Module

#### Model Structure
- Fields: name, slug, description, icon, image, features, order, visibility
- Automatic slug generation
- Order management for display priority

#### Endpoints
- `GET /api/services` - List services with pagination
- `POST /api/services` - Create service
- `GET /api/services/{service}` - Get service details
- `PUT /api/services/{service}` - Update service
- `DELETE /api/services/{service}` - Delete service
- `PUT /api/services/order/update` - Update service order

### 3. Products Module

#### Model Structure
- Fields: name, slug, description, image, features, status, launch_date, teaser_content
- Status management (draft, coming_soon, published)
- Launch date scheduling
- Order management

#### Endpoints
- `GET /api/products` - List products with pagination and filters
- `POST /api/products` - Create product
- `GET /api/products/{product}` - Get product details
- `PUT /api/products/{product}` - Update product
- `DELETE /api/products/{product}` - Delete product
- `PUT /api/products/order/update` - Update product order

### 4. Settings Module

#### Model Structure
- Fields: key, value, group, type, label, description, options, visibility
- Supports multiple value types (text, textarea, number, boolean, select, email, url, tel, date)
- Group-based organization
- Public/private visibility control

#### Endpoints
- `GET /api/settings` - List settings with pagination
- `POST /api/settings` - Create setting
- `GET /api/settings/{setting}` - Get setting details
- `PUT /api/settings/{setting}` - Update setting
- `DELETE /api/settings/{setting}` - Delete setting
- `GET /api/settings/group/{group}` - Get settings by group
- `GET /api/settings/public/all` - Get public settings
- `PUT /api/settings/bulk/update` - Bulk update settings

#### Default Settings Groups
1. Company Information
   - company_name
   - company_tagline

2. Contact Information
   - contact_email
   - contact_phone
   - contact_address
   - business_hours

3. Social Media Links
   - social_linkedin
   - social_twitter
   - social_github

4. Contact Form Configuration
   - contact_form_recipients
   - contact_form_subjects

## Common Features Across Modules

### Validation
- Form request validation classes for all operations
- Custom validation rules for specific data types
- Consistent error response format

### Response Format
All API responses follow a standard format using the ApiResponse trait:
```json
{
    "success": true,
    "message": "Operation successful message",
    "data": {
        // Response data
    }
}
```

### Error Handling
- Consistent error response format
- Proper HTTP status codes
- Validation error messages
- Custom exception handling

### File Management
- Automatic file cleanup on deletion
- Secure file storage configuration
- Support for multiple file types

## Database Structure

### Migrations
All tables include:
- `id` - Primary key
- `created_at` - Creation timestamp
- `updated_at` - Last update timestamp
- `deleted_at` - Soft delete timestamp (where applicable)

### Indexes
- Appropriate indexes for frequently queried columns
- Foreign key constraints where needed
- Unique constraints for slugs and identifiers

## Security Features

1. Authentication & Authorization
   - Token-based authentication
   - Role-based access control
   - Secure password hashing
   - CSRF protection

2. Data Protection
   - Input validation
   - SQL injection prevention
   - XSS protection
   - Rate limiting

## Testing

### API Testing
- Comprehensive Postman collection included
- Environment variables for configuration
- Test cases for all endpoints
- Authentication token management

### Environment Setup
1. Copy `.env.example` to `.env`
2. Configure database settings
3. Set up Mailtrap for email testing
4. Run migrations and seeders

## Deployment

### Requirements
- PHP 8.1+
- MySQL 8.0+
- Composer
- Web server (Nginx/Apache)

### Steps
1. Clone repository
2. Install dependencies: `composer install`
3. Set up environment: `cp .env.example .env`
4. Generate key: `php artisan key:generate`
5. Run migrations: `php artisan migrate`
6. Run seeders: `php artisan db:seed`

## API Documentation

Complete API documentation is available in the Postman collection at `postman/axetech-website-api.json`. The collection includes:
- Request/response examples
- Environment variables
- Authentication setup
- Test scripts

## Future Implementations

1. Testimonials Module (Planned)
   - Client testimonials management
   - Rating system
   - Image handling
   - Display order management

2. Common Features Enhancement
   - Advanced error handling
   - Caching implementation
   - API rate limiting
   - Enhanced security measures