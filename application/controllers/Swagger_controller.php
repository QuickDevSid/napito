<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Swagger Controller
 * 
 * Handles API documentation generation and serving
 */
class Swagger_controller extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->library('swagger_helper');
    }
    
    /**
     * Display Swagger UI
     */
    public function index() {
        $data['title'] = 'API Documentation';
        $data['swagger_url'] = base_url('swagger/spec');
        
        $this->load->view('swagger/index', $data);
    }
    
    /**
     * Generate and serve OpenAPI specification
     */
    public function spec() {
        $spec = $this->swagger_helper->generate_spec();
        
        header('Content-Type: application/json');
        echo json_encode($spec, JSON_PRETTY_PRINT);
    }
    
    /**
     * Generate documentation for specific controller
     */
    public function controller($controller_name = '') {
        if (empty($controller_name)) {
            $this->output->set_status_header(400);
            echo json_encode(array(
                'success' => false,
                'message' => 'Controller name is required'
            ));
            return;
        }
        
        $controller_file = APPPATH . 'controllers/api/' . $controller_name . '.php';
        
        if (!file_exists($controller_file)) {
            $this->output->set_status_header(404);
            echo json_encode(array(
                'success' => false,
                'message' => 'Controller not found'
            ));
            return;
        }
        
        // Parse specific controller
        $content = file_get_contents($controller_file);
        $endpoints = $this->parse_controller_endpoints($content, $controller_name);
        
        header('Content-Type: application/json');
        echo json_encode($endpoints, JSON_PRETTY_PRINT);
    }
    
    /**
     * Parse controller endpoints manually
     */
    private function parse_controller_endpoints($content, $controller_name) {
        $endpoints = array();
        
        // Extract class name
        preg_match('/class\s+(\w+)\s+extends/', $content, $matches);
        $class_name = isset($matches[1]) ? $matches[1] : $controller_name;
        
        // Extract public methods
        preg_match_all('/public\s+function\s+(\w+)\s*\(/', $content, $matches);
        $methods = isset($matches[1]) ? $matches[1] : array();
        
        foreach ($methods as $method) {
            if (strpos($method, '_') === 0) {
                continue; // Skip private methods
            }
            
            $endpoint = $this->create_endpoint_info($class_name, $method, $content);
            if ($endpoint) {
                $endpoints[] = $endpoint;
            }
        }
        
        return array(
            'controller' => $class_name,
            'endpoints' => $endpoints
        );
    }
    
    /**
     * Create endpoint information
     */
    private function create_endpoint_info($class_name, $method_name, $content) {
        $method_name_lower = strtolower($method_name);
        
        // Skip constructor and private methods
        if (in_array($method_name, array('__construct', 'index'))) {
            return null;
        }
        
        // Determine HTTP method
        $http_method = 'POST'; // Default for API methods
        if (strpos($method_name_lower, 'get') === 0) {
            $http_method = 'GET';
        } elseif (strpos($method_name_lower, 'post') === 0) {
            $http_method = 'POST';
        } elseif (strpos($method_name_lower, 'put') === 0) {
            $http_method = 'PUT';
        } elseif (strpos($method_name_lower, 'delete') === 0) {
            $http_method = 'DELETE';
        }
        
        // Create path
        $path = '/api/v1/' . strtolower(str_replace('_controller', '', $class_name)) . '/' . $method_name;
        
        return array(
            'method' => $http_method,
            'path' => $path,
            'summary' => ucwords(str_replace('_', ' ', $method_name)),
            'description' => 'API endpoint for ' . strtolower(str_replace('_', ' ', $method_name)),
            'tags' => array(ucwords(str_replace('_', ' ', str_replace('_controller', '', $class_name))))
        );
    }
    
    /**
     * Export documentation to file
     */
    public function export() {
        $spec = $this->swagger_helper->generate_spec();
        
        $filename = 'api_documentation_' . date('Y-m-d_H-i-s') . '.json';
        
        header('Content-Type: application/json');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        echo json_encode($spec, JSON_PRETTY_PRINT);
    }
} 