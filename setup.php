<?php
define('DB_USER', '');
define('DB_PW', '');

require 'vendor/.composer/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use ORMDemo\Company;
use ORMDemo\Order;

// Initialize the Doctrine2 EntityManager 
$dbParams = array(
    'driver' => 'pdo_mysql',
    'user' => DB_USER,
    'password' => DB_PW,
    'dbname' => 'ormdemo'
);

$path = array(__DIR__ . '/ORMDemo/Mapping/');
$config = Setup::createYAMLMetadataConfiguration($path, true);
$em = EntityManager::create($dbParams, $config);

// Set up our own namespace
$classLoader = new \Doctrine\Common\ClassLoader('ORMDemo', './');
$classLoader->register();

// Functions to perform the various queries
function getAllCompanies() {
    global $em;

    $dql = "SELECT c, o
            FROM   ORMDemo\\Company c
            JOIN   c.orders o";
    $query = $em->createQuery($dql);

    echo $query->getSQL()."\n";
    return $query->getResult();
}

function getAllCompaniesWithOrdersSummed() {
    global $em;

    $dql = "SELECT   c, SUM(o.value)
            FROM     ORMDemo\\Company c
            JOIN     c.orders o
            GROUP BY c.id, c.name";
    $query = $em->createQuery($dql);

    echo $query->getSQL()."\n";
    return $query->getResult();
}

function getRawData() {
    global $em;

    $sql = "SELECT SUM(o.VALUE) AS TotalValue, c.name AS CompanyName 
            FROM companies AS c 
            LEFT JOIN orders AS o ON o.company_id = c.id
            GROUP BY o.company_id";
    $dbal = $em->getConnection();
    return $dbal->fetchAll($sql);
}

function initFixtures() {
    global $em;

    if (!trim(DB_PW) || !trim(DB_USER)) {
        die("Error: Please set your database password in setup.php, line 2, and create an empty database, named ormdemo\n");
    }
    $dbal = $em->getConnection();
    $sm = $dbal->getSchemaManager()->createSchema();
    $companyLimit = 5;
    $orderLimit = 5;

    if (!$sm->hasTable('companies') || !$sm->hasTable('orders')) {
        die("Error: Cannot find the database tables. Did you run 'php doctrine.php orm:schema-tool:create?\n");
    }

    $em->createQuery('DELETE FROM ORMDemo\\Order')->getResult();
    $em->createQuery('DELETE FROM ORMDemo\\Company')->getResult();

    for ($i = 1; $i <= $companyLimit; $i++) {
        $company = new Company();
        $company->setName("Company $i");

        for ($j = 1; $j <= $orderLimit; $j++) {
            $order = new Order();
            $order->setValue($j);
            $order->setCompany($company);
            $em->persist($order);
        }

        $em->persist($company);
    }

    $em->flush();
    $em->clear();
}
