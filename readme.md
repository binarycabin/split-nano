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

`compose install`

`php artisan key:generate`

`php artisan migrate`

... TODO

## Testing

You can run all unit / feature tests via running `phpunit` from the root directory

## TODO
- Create accounts should only be permissible by admin. (.env ADMIN_USER role?)
- Create accounts for system to use (vue component?)
- Manage Account Groups
- Display History on Account Groups Page
- Schedule To Process 
- Balance Splitter and Queue to NodeTransaction
- Save hash to NodeTransaction when complete