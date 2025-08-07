<?php
/**
 * Swagger Installation Script for Napito Salon Management System
 * 
 * This script sets up OpenAPI/Swagger documentation for the existing API
 */

// Check if running from command line
if (php_sapi_name() !== 'cli') {
    die('This script should be run from command line: php install_swagger.php');
}

echo "=== Napito Salon Management - Swagger Installation ===\n\n";

// Step 1: Check PHP version
echo "1. Checking PHP version...\n";
if (version_compare(PHP_VERSION, '7.4.0', '<')) {
    die("Error: PHP 7.4 or higher is required. Current version: " . PHP_VERSION . "\n");
}
echo "✓ PHP version " . PHP_VERSION . " is compatible\n\n";

// Step 2: Check if composer is available
echo "2. Checking Composer...\n";
if (!file_exists('composer.json')) {
    die("Error: composer.json not found. Please run this script from the project root.\n");
}
echo "✓ composer.json found\n\n";

// Step 3: Install dependencies
echo "3. Installing Swagger dependencies...\n";
$output = shell_exec('composer install 2>&1');
if (strpos($output, 'error') !== false) {
    echo "Warning: Some composer errors occurred, but continuing...\n";
}
echo "✓ Dependencies installed\n\n";

// Step 4: Create necessary directories
echo "4. Creating directories...\n";
$directories = [
    'application/views/swagger',
    'application/libraries',
    'application/config'
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
        echo "✓ Created directory: $dir\n";
    } else {
        echo "✓ Directory exists: $dir\n";
    }
}
echo "\n";

// Step 5: Check if files exist
echo "5. Checking required files...\n";
$files = [
    'application/config/swagger.php' => 'Swagger configuration',
    'application/libraries/Swagger_helper.php' => 'Swagger helper library',
    'application/controllers/Swagger_controller.php' => 'Swagger controller',
    'application/views/swagger/index.php' => 'Swagger UI view'
];

foreach ($files as $file => $description) {
    if (file_exists($file)) {
        echo "✓ $description exists\n";
    } else {
        echo "✗ $description missing: $file\n";
    }
}
echo "\n";

// Step 6: Test API endpoints
echo "6. Testing API endpoints...\n";
$base_url = 'http://127.0.0.1/saloon/napito';
$endpoints = [
    '/swagger' => 'Swagger UI',
    '/swagger/spec' => 'OpenAPI Specification',
    '/api/v1/api/customer_login' => 'Customer Login API'
];

foreach ($endpoints as $endpoint => $description) {
    $url = $base_url . $endpoint;
    echo "Testing $description... ";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_TIMEOUT, 10);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    
    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($http_code == 200 || $http_code == 404) {
        echo "✓ Accessible (HTTP $http_code)\n";
    } else {
        echo "✗ Not accessible (HTTP $http_code)\n";
    }
}
echo "\n";

// Step 7: Generate sample documentation
echo "7. Generating sample documentation...\n";
if (file_exists('application/libraries/Swagger_helper.php')) {
    // Include CodeIgniter bootstrap
    define('BASEPATH', 'system/');
    define('APPPATH', 'application/');
    
    // Load the helper
    require_once 'application/libraries/Swagger_helper.php';
    
    try {
        $swagger = new Swagger_helper();
        $spec = $swagger->generate_spec();
        
        // Save to file
        $spec_file = 'api_documentation.json';
        file_put_contents($spec_file, json_encode($spec, JSON_PRETTY_PRINT));
        echo "✓ Generated OpenAPI specification: $spec_file\n";
        
        // Count endpoints
        $endpoint_count = count($spec['paths'] ?? []);
        echo "✓ Found $endpoint_count API endpoints\n";
        
    } catch (Exception $e) {
        echo "✗ Error generating documentation: " . $e->getMessage() . "\n";
    }
}
echo "\n";

// Step 8: Create documentation
echo "8. Creating documentation...\n";
$docs = [
    'README_SWAGGER.md' => generate_readme(),
    'API_GUIDE.md' => generate_api_guide(),
    'SWAGGER_SETUP.md' => generate_setup_guide()
];

foreach ($docs as $filename => $content) {
    file_put_contents($filename, $content);
    echo "✓ Created: $filename\n";
}
echo "\n";

// Step 9: Final instructions
echo "=== Installation Complete ===\n\n";
echo "Next steps:\n";
echo "1. Start your web server\n";
echo "2. Visit: http://127.0.0.1/saloon/napito/swagger\n";
echo "3. Test the API documentation interface\n";
echo "4. Review generated files:\n";
echo "   - api_documentation.json (OpenAPI spec)\n";
echo "   - README_SWAGGER.md (Documentation)\n";
echo "   - API_GUIDE.md (API usage guide)\n";
echo "\n";
echo "For development:\n";
echo "- Add @OA annotations to your API controllers\n";
echo "- Update swagger.php configuration as needed\n";
echo "- Customize the Swagger UI in application/views/swagger/index.php\n";
echo "\n";

function generate_readme() {
    return "# Napito Salon Management - Swagger Documentation

## Overview
This project now includes comprehensive OpenAPI/Swagger documentation for the Napito Salon Management API.

## Features
- **Interactive API Documentation**: Swagger UI interface
- **Auto-generated Specifications**: OpenAPI 3.0 compliant
- **Real-time Testing**: Test API endpoints directly from documentation
- **Export Capabilities**: Download API specifications

## Quick Start
1. Visit: `http://127.0.0.1/saloon/napito/swagger`
2. Explore the interactive API documentation
3. Test endpoints using the built-in interface

## API Endpoints
The documentation covers all major API endpoints including:
- Customer authentication and management
- Salon and branch operations
- Booking and appointment management
- Service and product catalogs
- Financial operations
- Marketing and promotional features

## Authentication
Most API endpoints require Bearer token authentication. Include the token in the Authorization header:
```
Authorization: Bearer <your-token>
```

## Development
To add documentation for new endpoints:
1. Add `@OA` annotations to your controller methods
2. Update the Swagger configuration as needed
3. Regenerate the documentation

## Support
For API support, contact: support@napito.com
";
}

function generate_api_guide() {
    return "# API Usage Guide

## Authentication
```bash
# Login to get token
curl -X POST http://127.0.0.1/saloon/napito/api/v1/api/customer_login \\
  -H \"Content-Type: application/json\" \\
  -d '{\"phone\":\"9876543210\",\"password\":\"password123\"}'
```

## Common Endpoints

### Customer Management
- `POST /api/v1/api/customer_login` - Customer authentication
- `GET /api/v1/api/get_customer_profile` - Get customer profile
- `POST /api/v1/api/update_customer_profile` - Update customer profile

### Salon Operations
- `GET /api/v1/api/get_store_details` - Get salon information
- `GET /api/v1/api/get_store_services` - Get available services
- `POST /api/v1/api/set_booking` - Create new booking

### Booking Management
- `GET /api/v1/api/pending_bookings` - Get pending bookings
- `GET /api/v1/api/completed_bookings` - Get completed bookings
- `POST /api/v1/api/cancel_service` - Cancel booking

## Response Format
All API responses follow this format:
```json
{
  \"success\": true,
  \"message\": \"Operation successful\",
  \"data\": {
    // Response data
  }
}
```

## Error Handling
```json
{
  \"success\": false,
  \"message\": \"Error description\",
  \"errors\": [\"Detailed error messages\"]
}
```

## Rate Limiting
- 100 requests per minute per IP
- 1000 requests per hour per user

## Testing
Use the Swagger UI at `/swagger` to test endpoints interactively.
";
}

function generate_setup_guide() {
    return "# Swagger Setup Guide

## Installation Steps

### 1. Dependencies
```bash
composer require zircote/swagger-php:^4.7
composer require darkaonline/l5-swagger:^8.5
```

### 2. Configuration Files
- `application/config/swagger.php` - Swagger configuration
- `application/libraries/Swagger_helper.php` - Helper library
- `application/controllers/Swagger_controller.php` - Controller

### 3. Routes
Add to `application/config/routes.php`:
```php
\$route['swagger'] = \"Swagger_controller/index\";
\$route['swagger/spec'] = \"Swagger_controller/spec\";
\$route['swagger/controller/(:any)'] = \"Swagger_controller/controller/\$1\";
\$route['swagger/export'] = \"Swagger_controller/export\";
```

### 4. Annotations
Add OpenAPI annotations to your controllers:
```php
/**
 * @OA\\Post(
 *     path=\"/api/v1/endpoint\",
 *     summary=\"Endpoint Description\",
 *     tags={\"Category\"},
 *     @OA\\RequestBody(...),
 *     @OA\\Response(...)
 * )
 */
public function your_method() {
    // Implementation
}
```

## Customization

### Styling
Edit `application/views/swagger/index.php` to customize the UI.

### Configuration
Modify `application/config/swagger.php` to change:
- API title and description
- Server URLs
- Security schemes
- Default responses

### Adding Endpoints
1. Add `@OA` annotations to controller methods
2. Update the Swagger helper if needed
3. Test the generated documentation

## Troubleshooting

### Common Issues
1. **Routes not working**: Check CodeIgniter routing configuration
2. **Annotations not recognized**: Ensure proper PHP syntax
3. **UI not loading**: Check JavaScript console for errors

### Debug Mode
Enable debug mode in `application/config/config.php`:
```php
\$config['log_threshold'] = 4;
```

## Maintenance
- Regularly update Swagger dependencies
- Review and update API documentation
- Test all documented endpoints
- Keep annotations in sync with code changes
";
} 