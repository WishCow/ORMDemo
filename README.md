ORMDemo
=======

A small demo, to complement [one of my blog posts](http://ihaveabackup.net/2012/04/03/re-bad-orm-is-infinitely-worse-than-bad-sql/), which is a reply to [Bad ORM is infinitely worse than bad SQL](http://mattiasgeniar.be/2012/03/30/bad-orm-is-infinitely-worse-than-bad-sql/) by Mattias Geniar. It will simply run a few DQL queries, outputting the generated SQL queries, and then iterate over the result sets. Obviously this is not my usual coding style, I throw way more globals around :)

Install
-------

- Clone the repo somewhere, cd into the directory
- Get composer from [Packagist](http://packagist.org/) (easiest way: "curl -s http://getcomposer.org/installer | php")
- Get the dependencies by running "php composer.phar install"
- Give your db details in the setup.php file, line 2-3 (doesn't have to be root)
- Create an empty database named "ormdemo"
- Run php doctrine.php orm:schema-tool:create (This will create the database tables)
- Run the app with php run.php
