# Networking Basics and LAMP Stack Setup

## 1. IP Address
An **IP Address** (Internet Protocol Address) is a unique identifier assigned to devices on a network.  
- **Purpose:** It allows devices to locate and communicate with each other over a network.

---

## 2. MAC Address
A **MAC Address** (Media Access Control Address) is a hardware-based identifier associated with a network interface card (NIC).  
- **Purpose:** It uniquely identifies a device at the hardware level within a LAN.  
- **Format:** 6 pairs of hexadecimal digits, e.g., `00:1A:2B:3C:4D:5E`.

**Difference between MAC Address and IP Address:**
- **MAC Address**: Fixed and hardware-based, used for local communication.  
- **IP Address**: Dynamic and software-based, used for global communication.

---

## 3. Switches, Routers, and Routing Protocols
- **Switch**: Connects multiple devices within a local area network (LAN) and forwards data efficiently.  
- **Router**: Connects different networks and determines the best path for forwarding data between networks.  
- **Routing Protocols**: Used by routers to decide the best route for data to travel. Examples include:
  - **RIP** (Routing Information Protocol)
  - **OSPF** (Open Shortest Path First)
  - **BGP** (Border Gateway Protocol)

---

## 4. Remote Connection to Cloud Instance
Steps to connect to a cloud-based Linux instance (AWS EC2) remotely using SSH:

1. Open a terminal or SSH client.
2. Ensure the private key file (.pem) is available and set correct permissions.

Step-by-Step Setup Instructions
## 1. Launch an EC2 Instance on AWS.

## 2. Install LAMP Stack:
sudo yum update -y
sudo yum install -y httpd mariadb-server php php-mysqli
sudo systemctl start httpd
sudo systemctl enable httpd
sudo systemctl start mariadb
sudo mysql_secure_installation


## 3. Configure the Database:
CREATE DATABASE web_db;
CREATE USER 'web_user'@'localhost' IDENTIFIED BY 'StrongPassword123';
GRANT ALL PRIVILEGES ON web_db.* TO 'web_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;


## 4. Deploy PHP Code:
sudo nano /var/www/html/index.php

# Add the following content:
### PHP Code Example
Below is the PHP code to establish a database connection:

```php
<?php
$servername = "localhost";
$username = "web_user"; // Database username
$password = "StrongPassword123"; // Database password
$dbname = "web_db"; // Database name

// Create connection to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Update the visit counter
$conn->query("UPDATE visits_counter SET visits_count = visits_count + 1 WHERE id = 1");

// Retrieve the current visit count
$result = $conn->query("SELECT visits_count FROM visits_counter WHERE id = 1");
$row = $result->fetch_assoc();
$visits = $row['visits_count'];

// Display the results on the page
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
?>
```

## 5. Make Website Accessible Externally:
Update the Security Group to allow traffic on ports 80 (HTTP) and 22 (SSH).

## 6. Push Code to GitHub:
- git init
- git add .
- git commit -m "Initial commit: LAMP stack setup with database connection"
- git remote add origin https://github.com/aiibd3/Web-Server-on-Linux-Machine.git
- git push -u origin master


# GitHub Repository
- https://github.com/aiibd3/Web-Server-on-Linux-Machine

# Public URL
## The website is accessible at: 
- http://54.157.30.130


