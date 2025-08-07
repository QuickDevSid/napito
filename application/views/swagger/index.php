<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?> - Napito Salon Management</title>
    
    <!-- Swagger UI CSS -->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui.css" />
    
    <style>
        html {
            box-sizing: border-box;
            overflow: -moz-scrollbars-vertical;
            overflow-y: scroll;
        }
        
        *, *:before, *:after {
            box-sizing: inherit;
        }
        
        body {
            margin: 0;
            background: #fafafa;
        }
        
        .swagger-ui .topbar {
            background-color: #2c3e50;
        }
        
        .swagger-ui .topbar .download-url-wrapper .select-label {
            color: #fff;
        }
        
        .swagger-ui .topbar .download-url-wrapper input[type=text] {
            border: 2px solid #34495e;
        }
        
        .swagger-ui .info .title {
            color: #2c3e50;
        }
        
        .swagger-ui .info .description {
            color: #7f8c8d;
        }
        
        .custom-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .custom-header h1 {
            margin: 0;
            font-size: 2.5em;
            font-weight: 300;
        }
        
        .custom-header p {
            margin: 10px 0 0 0;
            font-size: 1.1em;
            opacity: 0.9;
        }
        
        .api-info {
            background: white;
            margin: 20px;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        
        .api-info h2 {
            color: #2c3e50;
            margin-top: 0;
        }
        
        .api-info p {
            color: #7f8c8d;
            line-height: 1.6;
        }
        
        .feature-list {
            list-style: none;
            padding: 0;
        }
        
        .feature-list li {
            padding: 8px 0;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .feature-list li:before {
            content: "✓";
            color: #27ae60;
            font-weight: bold;
            margin-right: 10px;
        }
        
        .feature-list li:last-child {
            border-bottom: none;
        }
    </style>
</head>
<body>
    <div class="custom-header">
        <h1>Napito Salon Management API</h1>
        <p>Comprehensive API documentation for salon management operations</p>
    </div>
    
    <div class="api-info">
        <h2>API Overview</h2>
        <p>The Napito Salon Management API provides comprehensive endpoints for managing salon operations, including:</p>
        
        <ul class="feature-list">
            <li>Customer management and authentication</li>
            <li>Salon and branch management</li>
            <li>Booking and appointment scheduling</li>
            <li>Service and product catalog management</li>
            <li>Employee and staff management</li>
            <li>Financial operations and billing</li>
            <li>Marketing and promotional features</li>
            <li>Real-time notifications and messaging</li>
        </ul>
        
        <p><strong>Base URL:</strong> <code><?php echo base_url(); ?></code></p>
        <!-- <p><strong>Authentication:</strong> Bearer token required for protected endpoints</p> -->
    </div>
    
    <div id="swagger-ui"></div>
    
    <!-- Swagger UI JavaScript -->
    <script src="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui-bundle.js"></script>
    <script src="https://unpkg.com/swagger-ui-dist@4.15.5/swagger-ui-standalone-preset.js"></script>
    
    <script>
        window.onload = function() {
            // Swagger UI configuration
            const ui = SwaggerUIBundle({
                url: '<?php echo $swagger_url; ?>',
                dom_id: '#swagger-ui',
                deepLinking: true,
                presets: [
                    SwaggerUIBundle.presets.apis,
                    SwaggerUIStandalonePreset
                ],
                plugins: [
                    SwaggerUIBundle.plugins.DownloadUrl
                ],
                layout: "StandaloneLayout",
                validatorUrl: null,
                onComplete: function() {
                    console.log('Swagger UI loaded successfully');
                },
                onFailure: function(data) {
                    console.log('Swagger UI failed to load:', data);
                }
            });
            
            // Custom styling and behavior
            window.ui = ui;
        };
        
        // Add custom functionality
        document.addEventListener('DOMContentLoaded', function() {
            // Add download button
            const downloadBtn = document.createElement('button');
            downloadBtn.innerHTML = '📥 Export Documentation';
            downloadBtn.style.cssText = `
                position: fixed;
                top: 20px;
                right: 20px;
                z-index: 9999;
                background: #27ae60;
                color: white;
                border: none;
                padding: 10px 20px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
                box-shadow: 0 2px 4px rgba(0,0,0,0.2);
            `;
            
            downloadBtn.addEventListener('click', function() {
                window.open('<?php echo base_url('swagger/export'); ?>', '_blank');
            });
            
            document.body.appendChild(downloadBtn);
        });
    </script>
</body>
</html> 