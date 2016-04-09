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

**Folder Structure (from master branch)**
- ROOT:
	- Code
		- back_end: all back end associated code
		- css: all css files required for front end
		- front_end: all front end associated code
		- images: all images required for front end
		- temp: irrelevant directory
		- test_suite: tests code for implemented code
	- Documentation:
		- Class Modules: description of important code implementation
		- Final Report: documentation associated with final project report
		- Installations: description of how to run the code - copy of what is explained here
		- life_cycle_motivation: the reasoning behind selecting SCRUM
		- SRS: SRS description of product

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

**Recommendation**

It is recommended that the user run the file `back_end.php` in `Code/test_suite` to check if the database is configured correctly

**Running the back-end code**

Copy the .txt files located in `Code/back_end/` into the root folder of postgresql, the default for this on Ubuntu is `/var/lib/postgresql/9.3/main`
> `sudo cp -f *.txt /var/lib/postgresql/9.3/main`

Create the database tables - from within the /Code/back_end/ folder run:
> `php setup_database.php`

**NOTE:** The following step is a temporary implementation until properly integrated with the front-end

Create the possible permutations for the shopping list saved on the database, run:
> `php database_permutations.php`

**Running the front-end code**

Copy the contents of the /Code/front_end/ as well as the `/css/` and `/images/` folders into the root folder of the apache2 server, the default location for this in Ubuntu is: `/var/www/html/`
- **NOTE:** The css and images must remain as folders in the `/var/www/html` folder
> `cp -r css/. /var/www/html` and the same for images

Open your web-browser and access `localhost/login.php`
- All other web pages will be accessible from this page
- The default login details are:
	- username: `admin@srrec.com`
	- password: `admin123`
- Alternatively the user may navigate to the Create Account page using the navigation menu of the left hand side and create their own login details
- Clicking login will take you to the `index.php` page which allows the user to add and remove items from the shopping list stored on the database
- Selecting generate route defaults to generating the cheapest route and you will be redirected to a map which displays this route and correponding directions

**NOTE:** In order to see a meaningful output on the map it is recommended that the user leave the shopping list items as `SHIRT, TV, MILK`, this is due to the small databases created for prototying purposes.