<?php
header('Content-Type: text/plain');

function generateTextQR($url) {
    $width = 40;
    $height = 20;
    $qr = '';
    
    // Generate a simple ASCII art QR code
    for ($i = 0; $i < $height; $i++) {
        for ($j = 0; $j < $width; $j++) {
            $qr .= rand(0, 1) ? '█' : ' ';
        }
        $qr .= "\n";
    }
    
    return $qr . "\nURL: " . $url;
}

$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$url = $_GET['url'] ?? '';

// Check if it's an automated request
$isAutomated = stripos($userAgent, 'curl') !== false || 
               stripos($userAgent, 'wget') !== false || 
               stripos($userAgent, 'python') !== false ||
               stripos($userAgent, 'postman') !== false;

if ($isAutomated) {
    if (empty($url)) {
        echo "Error: URL parameter is required\n";
        echo "Usage: curl -A \"curl\" \"https://your-domain.com/?url=https://example.com\"\n";
        exit(1);
    }
    
    echo generateTextQR($url);
} else {
    // Show HTML page for browsers
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TextQR Generator</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            background: #f5f5f5;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .qr-output {
            font-family: monospace;
            white-space: pre;
            background: #fff;
            padding: 15px;
            border-radius: 4px;
            margin-top: 20px;
        }
        input[type="url"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>TextQR Generator</h1>
        <p>Enter a URL to generate a text-based QR code:</p>
        <form method="GET">
            <input type="url" name="url" placeholder="https://example.com" required>
            <button type="submit">Generate</button>
        </form>
        <?php if (!empty($url)): ?>
        <div class="qr-output">
            <?php echo htmlspecialchars(generateTextQR($url)); ?>
        </div>
        <?php endif; ?>
    </div>
</body>
</html>
    <?php
}
?> 