# Split Nano

A dashboard for creating accounts that automatically forward to multiple addresses.

If you'd like to try out and use this system you can setup an account at [splitnano.com](https://splitnano.com) or you can setup your own local application using the details below

## Server Requirements

This application is built using the Laravel web framework. Server requirements can be found at: [laravel.com/docs](https://laravel.com/docs/6.x#server-requirements)

## Installation

`cp .env.example .env`

Update `.env` to include your:
- Database information
- User email address which should gain administrative rights
- Mail SMTP settings (or mailtrap settings)
- A new, unused Nano Seed (obtain from a fresh NanoVault instance or some other wallet). DO NOT USE A SEED YOU ALREADY KEEP YOUR FUNDS ON!
- The URI to your Nano Node and Representative you would like to use

`compose install`

`php artisan key:generate`

`php artisan migrate`

- Next, register an account using the admin email address you've assigned in .env and click on "Generate Accounts" to begin creating the accounts your system will use. Each Address Group a user creates will be assigned it's own address group, so it's important to know how many accounts you may need to create.

- Finally, setup a cron job to run the applications scheduled tasks:

```
* * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1
```

## Testing

You can run all unit / feature tests via running `phpunit` from the root directory

## TODO
- Manage Account Groups
- Display History on Account Groups Page
- Schedule To Process 
- Balance Splitter and Queue to NodeTransaction
- Save hash to NodeTransaction when complete