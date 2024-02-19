# Laravel with Sail

## Prerequisites

Before you begin, make sure you have the following installed on your system:

- [Docker Desktop](https://www.docker.com/products/docker-desktop)
- [Composer](https://getcomposer.org/)

## Setting Up Environment Variables

Before running the Laravel application, you need to set up your environment variables, especially for mail
configuration. Follow these steps:

1. Copy the `.env.example` file and rename it to `.env`:

   ```bash
   cp .env.example .env

2. Open the .env file in a text editor.
3. Configure the mail variables under the "Mail Configuration" section. These variables control how your application
   sends emails. Below are the common mail variables to configure:

    ```
       MAIL_MAILER=smtp
       MAIL_HOST=smtp.gmail.com
       MAIL_PORT=465
       MAIL_USERNAME=your_username
       MAIL_PASSWORD=your_password
       MAIL_ENCRYPTION=tls
       MAIL_FROM_ADDRESS=your_email@example.com
       MAIL_FROM_NAME="${APP_NAME}"
    ```

## Running Commands

You can run various artisan commands and Composer commands using Sail. Here are some examples:

- **Install Composer dependencies**:

  ```bash
  ./vendor/bin/sail composer install
  ```

- **Run an Artisan command**:

  ```bash
  ./vendor/bin/sail artisan migrate:fresh --seed
  ```

  Alternative (if Sail is not running):
    ```bash
      docker exec -it  nouvelles-laravel.test-1 php artisan migrate:fresh --seed
    ```

## Start Sail

Follow these steps to set up a Laravel project using Sail:

1. **Navigate into your project directory**:

   ```bash
   cd nouvelles
   ```

2. **Start Sail**:

   ```bash
   ./vendor/bin/sail up
   ```

   This command will start the Docker containers required for your Laravel application.

3. **Access your Laravel application**:

   Open your web browser and navigate to `http://localhost`. You should see the default Laravel welcome page.

## Stopping Sail

To stop Sail and shut down your Docker containers, use the following command:

```bash
./vendor/bin/sail stop
```

## Importing Postman Collection

If you're using [Postman](https://www.postman.com/) for API testing, you can import the provided Postman collection to
quickly set up requests for the Laravel API endpoints.

To import the Postman collection:

1. Open Postman and locate the "Import" button in the top-left corner.
2. Click "Import" and select the downloaded `Thousand.postman_collection.json` file.
3. Postman will import the collection along with its requests and folders.
4. You can now explore and execute the requests defined in the collection to interact with your Laravel application's
   API endpoints.
