<?php
header('Content-Type: text/plain');
echo "SMTP Diagnostic Start\n";
echo "=====================\n\n";

$hosts = [
    'mail.playabacusindia.com' => [587, 465, 25],
    'localhost' => [587, 465, 25]
];

foreach ($hosts as $host => $ports) {
    foreach ($ports as $port) {
        echo "Testing $host:$port... ";
        $connection = @fsockopen($host, $port, $errno, $errstr, 5);
        if (is_resource($connection)) {
            echo "SUCCESS\n";
            fclose($connection);
        } else {
            echo "FAILED ($errno: $errstr)\n";
        }
    }
    echo "\n";
}

echo "PHP Version: " . PHP_VERSION . "\n";
echo "OpenSSL support: " . (extension_loaded('openssl') ? 'YES' : 'NO') . "\n";
?>