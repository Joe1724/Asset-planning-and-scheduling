# OpsCore - Maintenance Management System

OpsCore is a comprehensive maintenance management system built with Laravel, designed to streamline asset tracking, maintenance requests, and work order management for educational institutions and organizations.

## Features

### Asset Management
- Track equipment and assets with detailed information including location, category, manufacturer, model, and serial numbers
- Monitor asset status, installation dates, and inspection schedules
- Organize assets by location and category

### Maintenance Requests
- Submit maintenance requests for assets or general issues
- Track request status and history
- User-friendly interface for different roles

### Work Order Management
- Generate work orders from maintenance requests or scheduled tasks
- Assign work orders to technicians
- Track priority, status, and completion
- Schedule maintenance activities

### User Roles & Permissions
- **Admin**: Full system access and configuration
- **Manager**: Oversee maintenance operations and generate reports
- **Teacher**: Submit maintenance requests and view related work orders
- **Technician**: Execute work orders and update progress

### Component Tracking
- Track components used in maintenance activities
- Associate components with work orders
- Inventory management for maintenance parts

## Tech Stack

- **Framework**: Laravel 11.31
- **Database**: SQLite (configurable)
- **Frontend**: Blade templates with Tailwind CSS
- **Authentication**: Laravel Sanctum
- **Real-time**: Laravel Broadcasting (optional)
- **Testing**: PHPUnit
- **Development Tools**: Laravel Sail, Pail, Pint

## Installation

### Prerequisites
- PHP 8.2 or higher
- Composer
- Node.js and npm
- SQLite or your preferred database

### Setup Steps

1. **Clone the repository**
   ```bash
   git clone https://github.com/Joe1724/Asset-planning-and-scheduling
   cd Asset-planning-and-scheduling
   ```

2. **Install PHP dependencies**
   ```bash
   composer install
   ```

3. **Install Node.js dependencies**
   ```bash
   npm install
   ```

4. **Environment configuration**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Database setup**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

6. **Build assets**
   ```bash
   npm run build
   ```

7. **Start the application**
   ```bash
   php artisan serve
   ```

   For development with hot reloading:
   ```bash
   composer run dev
   ```

## Usage

### Accessing the Application
- Visit `http://localhost:8000` (or your configured host/port)
- Register a new account or login with seeded data

### Key Workflows

1. **Asset Registration**: Add new equipment/assets to the system
2. **Maintenance Requests**: Teachers and staff can submit requests for repairs
3. **Work Order Creation**: Managers generate work orders from requests
4. **Assignment & Execution**: Technicians are assigned and complete work orders
5. **Reporting**: Track maintenance history and generate reports

## Database Schema

### Core Tables
- `users` - System users with roles
- `locations` - Physical locations/facilities
- `assets` - Equipment and assets
- `maintenance_requests` - Submitted maintenance requests
- `work_orders` - Generated work orders
- `maintenance_tasks` - Scheduled maintenance tasks
- `components` - Parts and components
- `work_order_components` - Component usage tracking

## API

OpsCore includes RESTful API endpoints for integration with external systems. Authentication is handled via Laravel Sanctum tokens.

## Testing

Run the test suite:
```bash
php artisan test
```

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## Security

If you discover any security vulnerabilities, please email the development team immediately.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support

For support and questions, please contact the development team or create an issue in the repository.
