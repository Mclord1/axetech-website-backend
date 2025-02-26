# Changelog

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