# Changelog

## [Unreleased]
### Planned
- CMS Modules Implementation
  - Services Module for managing service offerings
  - Products Module for future product teasers
  - Settings Module for contact information
  - Testimonials Module for client feedback
  - Common features: validation, pagination, filtering, and documentation

## [0.5.0] - 2024-02-26
### Added
- Settings Module Implementation
  - Created Setting model with fields for key, value, group, type, label, description, and options
  - Implemented CRUD endpoints with validation for different setting types
  - Added group-based settings management
  - Added public/private setting visibility control
  - Created default settings seeder with company, contact, and social media settings
  - Added bulk update functionality for efficient settings management
  - Updated API documentation and Postman collection

## [0.4.0] - 2024-02-26
### Added
- Products Module Implementation
  - Created Product model with fields for name, slug, description, image, features, status, launch_date, and teaser_content
  - Implemented CRUD endpoints with validation and file cleanup
  - Added status management (draft, coming_soon, published)
  - Added launch date scheduling and teaser content for upcoming products
  - Added order management and visibility control
  - Updated API documentation and Postman collection

## [0.3.0] - 2024-02-26
### Added
- Authentication System Implementation
  - Integrated Laravel Sanctum for token-based authentication
  - Added admin login endpoint with device-based token generation
  - Implemented password reset functionality with email notifications
  - Set up queued email processing using Mailtrap for testing
  - Added authentication middleware to protect admin and project routes
- Admin Management
  - Created Admin model with fields for name, email, password, and status
  - Implemented CRUD endpoints for admin management
  - Added validation and security measures
  - Set up activity logging for authentication events

## [0.2.0] - 2024-02-02
### Added
- Projects API Implementation
  - Created Project model with fields for name, overview, key_features, challenge, solution, results, and image links
  - Implemented CRUD endpoints for projects management
  - Added project visibility control
  - Implemented pagination for projects listing
- Database Structure
  - Created projects table with necessary fields
  - Added visibility control to projects

## [0.1.0] - Initial Version
- Created PRD document outlining AxeTech Innovations Website requirements, including Overview, Purpose, Objectives, Scope, and more.
- Established project foundation and documentation for future updates. 