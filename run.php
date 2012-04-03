<?php
require 'setup.php';

echo "Initializing database schema, and dummy data\n";
initFixtures();

echo "With DQL join\n";
$companies = getAllCompanies();
foreach ($companies as $company) {
    $totalValue = 0;
    $orders = $company->getOrders();
    foreach ($orders as $order) {
        $totalValue += (float) $order->getValue();
    }
    echo "Company {$company->getName()} made us ". $totalValue ." euro already.\n";
}

echo "\nWith DQL join, but letting the DB take care of the sum\n";
$results = getAllCompaniesWithOrdersSummed();
foreach ($results as $result) {
    list($company, $sum) = $result;

    echo "Company {$company->getName()} made us ". $sum ." euro already.\n";
}

echo "\nRaw SQL\n";
var_dump(getRawData());
