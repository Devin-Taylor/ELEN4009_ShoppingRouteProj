# Shopping Route Recommender
## ELEN 4009 Software Engineering Project 2016
### The projects primary focus is on documenting the process of designing a software product
#
**Product Summary**

The Shopping Route Recommender is a web application that aims to improve the general publics day-to-day life. The product proposes to do this by reducing the associated stresses of shopping. In specific that application aims to:

- Allow users to add items to a shopping list on an adhoc basis
- Generate a route that optimises based on either of the following user inputs:
	- Fastest possible route to obtaining all the products
	- Shortest possible route to obtaining all the products
	- Cheapest possible route to obtaining all the products

**Prerequisits**

- Install [apache2 server and PHP5](http://www.howtogeek.com/howto/ubuntu/installing-php5-and-apache-on-ubuntu/)
- Install and setup postgresql
	- `sudo apt-get install postgresql-9.3`
	- `sudo apt-get install php5-pgsql`

**Setup**


**NOTE:** If the user has already installed postgresql they may need to edit the .php files and change the password

- Create a postgresql database called `srrec`
	- `sudo -i -u postgres`
	- `createuser --interactive`
		- username: `srrec`
	- `psql postgres`
	- `\password postgres`
		- password: `srrec`
	- `ctrl + d`
	- `createdb srrec`
	- `psql srrec`
	- `\password srrec`
		- password: `srrec`

**Running the back-end code**

Copy the .txt files located in `Code/back_end/` into the root folder of postgresql, the default for this on Linux is `/var/lib/postgresql/9.3/main`
> `sudo cp -f *.txt /var/lib/postgresql/9.3/main`

**NOTE:** The following steps are temporary implementations until properly integrated with the front-end

Create the database tables - from within the /Code/back_end/ folder run:
> `php setup_database.php`

Create the possible permutations for the shopping list saved on the database, run:
> `php database_permutations.php`

Create 2D array containing all locations for different routes (each route is a row and each column in a row is a waypoint), run:
> `php get_route_information.php`

**Running the front-end code**

Copy the contents of the /Code/front_end/ into the root folder of the apache2 server, the default location for this in Ubuntu is: `/var/www/html/`

Open your web-browser and access `localhost/index.php`
- All other web pages will be accessible from this page
