<?php
function updateFiles($dir) {
    $files = scandir($dir);
    
    foreach ($files as $file) {
        if ($file == '.' || $file == '..') continue;
        $fullPath = $dir . DIRECTORY_SEPARATOR . $file;

        if (is_dir($fullPath)) {
            updateFiles($fullPath); // सब-फोल्डर्स में भी चेक करें
        } elseif (pathinfo($fullPath, PATHINFO_EXTENSION) === 'php') {
            $content = file_get_contents($fullPath);
            $updatedContent = preg_replace('/\$password\s*=\s*""/', '$password = "Rajukumar@21"', $content);
            file_put_contents($fullPath, $updatedContent);
            echo "✅ Updated: " . $fullPath . "<br>";
        }
    }
}

$rootDir = __DIR__; // प्रोजेक्ट का मुख्य फोल्डर
updateFiles($rootDir);
echo "🎉 All PHP files updated successfully!";
?>
