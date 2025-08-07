<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Swagger Helper Library
 * 
 * Generates OpenAPI/Swagger documentation for CodeIgniter controllers
 */
class Swagger_helper {
    
    private $CI;
    private $config;
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->config->load('swagger', TRUE);
        $this->config = $this->CI->config->item('swagger');
    }
    
    /**
     * Generate OpenAPI specification
     */
    public function generate_spec() {
        $spec = array(
            'openapi' => '3.0.0',
            'info' => array(
                'title' => $this->config['title'],
                'description' => $this->config['description'],
                'version' => $this->config['version'],
                'contact' => $this->config['contact'],
                'license' => $this->config['license']
            ),
            'servers' => $this->config['servers'],
            'security' => array(
                array('bearerAuth' => array())
            ),
            'paths' => $this->scan_controllers(),
            'components' => array(
                'schemas' => $this->get_schemas(),
                'securitySchemes' => array(
                    'bearerAuth' => $this->config['security']['bearerAuth']
                )
            )
        );
        
        return $spec;
    }
    
    /**
     * Scan API controllers for endpoints
     */
    private function scan_controllers() {
        $paths = array();
        $controllers_path = $this->config['paths']['base_path'];
        
        if (!is_dir($controllers_path)) {
            return $paths;
        }
        
        $files = scandir($controllers_path);
        
        foreach ($files as $file) {
            if (in_array($file, $this->config['paths']['exclude_paths'])) {
                continue;
            }
            
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $controller_paths = $this->parse_controller($controllers_path . $file);
                $paths = array_merge($paths, $controller_paths);
            }
        }
        
        return $paths;
    }
    
    /**
     * Parse individual controller file
     */
    private function parse_controller($file_path) {
        $paths = array();
        $content = file_get_contents($file_path);
        
        // Extract class name
        preg_match('/class\s+(\w+)\s+extends/', $content, $matches);
        $class_name = isset($matches[1]) ? $matches[1] : '';
        
        // Extract methods
        preg_match_all('/public\s+function\s+(\w+)\s*\(/', $content, $matches);
        $methods = isset($matches[1]) ? $matches[1] : array();
        
        foreach ($methods as $method) {
            if (strpos($method, '_') === 0) {
                continue; // Skip private methods
            }
            
            $path_info = $this->get_path_info($class_name, $method, $content);
            if ($path_info) {
                $paths[$path_info['path']] = $path_info['operations'];
            }
        }
        
        return $paths;
    }
    
    /**
     * Get path information for a method
     */
    private function get_path_info($class_name, $method_name, $content) {
        // Extract method content
        $pattern = '/public\s+function\s+' . $method_name . '\s*\([^)]*\)\s*\{[^}]*\}/s';
        preg_match($pattern, $content, $matches);
        
        if (empty($matches)) {
            return null;
        }
        
        $method_content = $matches[0];
        
        // Determine HTTP method and path based on method name and content
        $http_method = $this->determine_http_method($method_name, $method_content);
        $path = $this->determine_path($class_name, $method_name);
        
        if (!$http_method || !$path) {
            return null;
        }
        
        return array(
            'path' => $path,
            'operations' => array(
                $http_method => array(
                    'tags' => array($this->get_tag_from_class($class_name)),
                    'summary' => $this->generate_summary($method_name),
                    'description' => $this->generate_description($method_name),
                    'parameters' => $this->get_parameters($method_content),
                    'responses' => $this->get_responses($method_name),
                    'security' => array(
                        array('bearerAuth' => array())
                    )
                )
            )
        );
    }
    
    /**
     * Determine HTTP method from method name and content
     */
    private function determine_http_method($method_name, $content) {
        $method_name_lower = strtolower($method_name);
        
        if (strpos($method_name_lower, 'get') === 0) {
            return 'get';
        } elseif (strpos($method_name_lower, 'post') === 0 || strpos($method_name_lower, 'create') === 0) {
            return 'post';
        } elseif (strpos($method_name_lower, 'put') === 0 || strpos($method_name_lower, 'update') === 0) {
            return 'put';
        } elseif (strpos($method_name_lower, 'delete') === 0) {
            return 'delete';
        }
        
        // Default to POST for API methods
        return 'post';
    }
    
    /**
     * Determine API path from class and method name
     */
    private function determine_path($class_name, $method_name) {
        $class_name_lower = strtolower(str_replace('_controller', '', $class_name));
        $method_name_lower = strtolower($method_name);
        
        // Remove common prefixes
        $method_name_clean = preg_replace('/^(get_|post_|put_|delete_|api_)/', '', $method_name_lower);
        
        return '/api/v1/' . $class_name_lower . '/' . $method_name_clean;
    }
    
    /**
     * Get tag from class name
     */
    private function get_tag_from_class($class_name) {
        $tag = str_replace('_controller', '', $class_name);
        return ucwords(str_replace('_', ' ', $tag));
    }
    
    /**
     * Generate summary for method
     */
    private function generate_summary($method_name) {
        $method_name_clean = preg_replace('/^(get_|post_|put_|delete_|api_)/', '', $method_name);
        $method_name_clean = str_replace('_', ' ', $method_name_clean);
        return ucwords($method_name_clean);
    }
    
    /**
     * Generate description for method
     */
    private function generate_description($method_name) {
        $method_name_clean = preg_replace('/^(get_|post_|put_|delete_|api_)/', '', $method_name);
        $method_name_clean = str_replace('_', ' ', $method_name_clean);
        return 'API endpoint for ' . strtolower($method_name_clean);
    }
    
    /**
     * Get parameters for method
     */
    private function get_parameters($method_content) {
        $parameters = array();
        
        // Check for common parameters
        if (strpos($method_content, '$this->input->post') !== false) {
            $parameters[] = array(
                'name' => 'body',
                'in' => 'body',
                'required' => true,
                'schema' => array(
                    '$ref' => '#/components/schemas/RequestBody'
                )
            );
        }
        
        return $parameters;
    }
    
    /**
     * Get responses for method
     */
    private function get_responses($method_name) {
        return array(
            '200' => array(
                'description' => 'Successful operation',
                'content' => array(
                    'application/json' => array(
                        'schema' => array(
                            '$ref' => '#/components/schemas/ApiResponse'
                        )
                    )
                )
            ),
            '400' => array(
                'description' => 'Bad request',
                'content' => array(
                    'application/json' => array(
                        'schema' => array(
                            '$ref' => '#/components/schemas/ErrorResponse'
                        )
                    )
                )
            ),
            '401' => array(
                'description' => 'Unauthorized'
            ),
            '500' => array(
                'description' => 'Internal server error'
            )
        );
    }
    
    /**
     * Get schema definitions
     */
    private function get_schemas() {
        return array(
            'ApiResponse' => array(
                'type' => 'object',
                'properties' => array(
                    'success' => array(
                        'type' => 'boolean',
                        'description' => 'Operation success status'
                    ),
                    'data' => array(
                        'type' => 'object',
                        'description' => 'Response data'
                    ),
                    'message' => array(
                        'type' => 'string',
                        'description' => 'Response message'
                    )
                )
            ),
            'ErrorResponse' => array(
                'type' => 'object',
                'properties' => array(
                    'success' => array(
                        'type' => 'boolean',
                        'example' => false
                    ),
                    'message' => array(
                        'type' => 'string',
                        'description' => 'Error message'
                    ),
                    'errors' => array(
                        'type' => 'array',
                        'items' => array(
                            'type' => 'string'
                        )
                    )
                )
            ),
            'RequestBody' => array(
                'type' => 'object',
                'properties' => array(
                    'example' => array(
                        'type' => 'object',
                        'description' => 'Request body example'
                    )
                )
            )
        );
    }
} 