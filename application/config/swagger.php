<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Swagger Configuration
|--------------------------------------------------------------------------
|
| Configuration for OpenAPI/Swagger documentation
|
*/

$config['swagger'] = array(
    'title' => 'Napito Salon Management API',
    'description' => 'API documentation for Napito Salon Management System',
    'version' => '1.0.0',
    'contact' => array(
        'name' => 'API Support',
        'email' => 'support@napito.com'
    ),
    'license' => array(
        'name' => 'MIT',
        'url' => 'https://opensource.org/licenses/MIT'
    ),
    'servers' => array(
        array(
            'url' => 'http://127.0.0.1/saloon/napito/api/v1',
            'description' => 'Development server'
        ),
        array(
            'url' => 'https://api.napito.com/v1',
            'description' => 'Production server'
        )
    ),
    'security' => array(
        'bearerAuth' => array(
            'type' => 'http',
            'scheme' => 'bearer',
            'bearerFormat' => 'JWT'
        )
    ),
    'paths' => array(
        'base_path' => APPPATH . 'controllers/api/',
        'exclude_paths' => array(
            'index.html',
            'vssver2.scc'
        )
    )
); 