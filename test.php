<?php
/* TEMPORARY DIAGNOSTIC — DELETE after fixing */
echo '<pre style="font-family:monospace;padding:20px;">';
echo 'PHP Version: ' . PHP_VERSION . "\n";
echo 'PDO drivers: ' . implode(', ', PDO::getAvailableDrivers()) . "\n";
echo 'SQLite available: ' . (in_array('sqlite', PDO::getAvailableDrivers()) ? 'YES' : 'NO') . "\n";
echo '__DIR__: ' . __DIR__ . "\n";
echo 'dirname(__DIR__): '  . dirname(__DIR__) . "\n";

$dir = dirname(__DIR__) . '/titus_db';
echo 'DB dir: ' . $dir . "\n";
echo 'DB dir writable: ' . (is_writable(dirname($dir)) ? 'YES' : 'NO') . "\n";

echo "\nExtensions: ";
$ext = ['pdo','pdo_sqlite','sqlite3','json','mbstring'];
foreach ($ext as $e) { echo $e . '=' . (extension_loaded($e)?'YES':'NO') . ' '; }

echo "\n\nconfig/database.php load test:\n";
try {
    require_once __DIR__ . '/config/database.php';
    echo "✓ database.php loaded OK\n";
    $pdo = getDB();
    echo $pdo ? "✓ SQLite connected OK\n" : "✗ getDB() returned null\n";
} catch (Throwable $e) {
    echo "✗ Error: " . $e->getMessage() . " in " . $e->getFile() . ':' . $e->getLine() . "\n";
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
}
echo '</pre>';
