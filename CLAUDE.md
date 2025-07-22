# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Development Commands

**Laravel Backend:**
- `php artisan serve` - Start development server
- `php artisan migrate` - Run database migrations
- `php artisan db:seed` - Seed database with test data
- `php artisan queue:work` - Process background jobs
- `php artisan test` - Run PHPUnit tests (uses Pest framework)
- `php artisan tinker` - Laravel REPL for debugging

**Frontend (Vue.js + Laravel Mix):**
- `npm run dev` - Build assets for development
- `npm run watch` - Watch and rebuild assets on changes
- `npm run prod` - Build assets for production
- `yarn install` - Install frontend dependencies

**Testing:**
- `./vendor/bin/pest` - Run tests using Pest framework
- `php artisan test` - Alternative test command

## Architecture Overview

### Core Domain
VIAK is a **course/event booking and management system** for educational training:
- **Courses** define educational content with metadata
- **Events** are specific course instances with dates and booking limits
- **Bookings** track student registrations with rental options
- **Users** have roles: Student, Expert (instructor), or Admin
- **Invoices** handle payment processing and rental billing

### Key Architectural Patterns

**Facade Pattern**: Custom facades encapsulate complex business logic:
- `App\Facades\BookingFacade` - Complete booking lifecycle management
- `App\Facades\InvoiceFacade` - Financial operations
- `App\Facades\DiscountFacade` - Discount code handling
- `App\Facades\MessageFacade` - Communication management

**Store Pattern**: Session-based state management in `app/Stores/`:
- `BasketStore` - Shopping cart persistence
- `CourseFilterStore` - Search filter state
- `PaymentStore` - Payment flow data

**Event-Driven Architecture**: Laravel events fire for business operations:
- Events in `app/Events/` (BookingCompleted, EventConfirmed, etc.)
- Listeners in `app/Listeners/` handle email notifications
- Custom `Job` model manages email queue processing

**State Management**: Uses `spatie/laravel-model-flags` for entity states:
- Events: confirmed, cancelled, closed
- Bookings: completed, cancelled
- Query with scopes in `app/Traits/` for state filtering

### Frontend Architecture

**Vue.js 2 Structure**:
- `resources/js/vue/backend/` - Admin dashboard SPA with routing
- `resources/js/vue/frontend/` - Individual components (booking, checkout, filters)
- Vuex for global state management
- Laravel Mix compiles separate bundles for different app sections

**Multi-language Support**:
- JSON-based translations using `spatie/laravel-translatable`
- Content stored with language-specific keys in model attributes
- `resources/lang/en.json` for interface translations

### Important Conventions

**Database**:
- All entities use UUIDs for public-facing IDs
- Internal auto-increment IDs for database relationships
- Polymorphic relationships for Images, Files, Messages

**Date Logic**:
- Heavy use of date comparisons for event states
- Penalty calculations based on cancellation timing
- Automated state transitions via scheduled tasks

**File Organization**:
- Models use traits for scopes and shared behavior
- Custom helper classes in `app/Helpers/`
- Task-based scheduled commands in `app/Tasks/`

### Key Models & Relationships
- Course → hasMany Events
- Event → hasMany Bookings, belongsToMany Users (experts)
- User → hasMany Bookings
- Booking → belongsTo Event, User, Invoice
- Polymorphic: Images, Files (attached to various models)

## Testing
Uses Pest PHP framework. Test files in `tests/` directory with `CreatesApplication` trait for Laravel integration.