require 'vendor/autoload.php';

use Aws\Ssm\SsmClient;

$ssm = new SsmClient([
    'region' => 'your-region', // Replace with your AWS region, e.g., 'us-east-1'
    'version' => 'latest'
]);

function getParameter($ssm, $name) {
    $result = $ssm->getParameter([
        'Name' => $name,
        'WithDecryption' => true 
    ]);
    return $result['Parameter']['Value'];
}

$servername = getParameter($ssm, '/web_server/db_host'); 
$username = getParameter($ssm, '/web_server/db_username');
$password = getParameter($ssm, '/web_server/db_password'); 
$dbname = getParameter($ssm, '/web_server/db_name'); 

// Establish database connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("UPDATE visits_counter SET visits_count = visits_count + 1 WHERE id = 1");

$result = $conn->query("SELECT visits_count FROM visits_counter WHERE id = 1");
$row = $result->fetch_assoc();
$visits = $row['visits_count'];

echo "<!DOCTYPE html>
<html>
<head>
    <title>Welcome to My Website</title>
</head>
<body>
    <h1>Hello World!</h1>
    <p>Your IP Address: " . $_SERVER['REMOTE_ADDR'] . "</p>
    <p>Current Time: " . date('Y-m-d H:i:s') . "</p>
    <p>Connected to the database successfully!</p>
    <p>Total Visits: " . $visits . "</p>
</body>
</html>";

$conn->close();

