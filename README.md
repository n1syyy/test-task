# Test Task

Implemented simple 2 page website - Lead Submit page(Home) and Leads Statuses page

Used AJAX to make it seamless so that user doesn't have to witness the reload and also to dynamically update table with filtered Lead Statuses using user-selected dates.

## Tools used

- PHP
- JS / JQuery / AJAX
- [Jquery Validation Plugin](https://jqueryvalidation.org/)
- [International Telephone Input](https://github.com/jackocnr/intl-tel-input)


## Usage

Clone the project to the directory
```bash
git clone https://github.com/n1syyy/test-task.git .
```

Set up your nginx conf and point to the public directory when specifying `root`

```nginx
server {
    ...
    server_name your_local_domain.loc; # update your hosts file
    root /var/www/test-task/public/; # replace with the project path on you got
}

```

Update your `hosts` file and add your local domain (e.g. test.loc)


## Environment Variables

To run this project, you will need to edit the following environment variables values in your `config.example.php` file and rename it to `config.php`

`API_URL`

`API_TOKEN`

`BOX_ID`

`OFFER_ID`

`COUNTRY_CODE`

`LANGUAGE`

`PASSWORD`

