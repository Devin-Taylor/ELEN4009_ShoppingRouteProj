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

- Install [apache2 and PHP5](http://www.howtogeek.com/howto/ubuntu/installing-php5-and-apache-on-ubuntu/) server
- Install and setup postgresql
	- `sudo apt-get install postgresql-9.3`
	- `sudo apt-get install php5-pgsql`

**Setup**


**NOTE:** If the user has already installed postgresql they will need to edit the .php files and change the password

- Create a postgresql database called `srrec`
	- `sudo -i -u postgres`
	- `psql postgres`
	- `\password srrec`
	- `ctrl + d`
	- `createdb srrec`
	- `psql srrec`
	- `\password srrec`
		- password: `srrec`

**Running the code**

Copy the .txt files located in `Code/back_end/` into the root folder of postgresql, the default for this on Linux is `/var/lib/postgresql/9.3/main`
> `sudo cp -f *.txt /var/lib/postgresql/9.3/main`

Create the database tables - from within the /Code/back_end/ folder run:
> `php setup_database.php`

