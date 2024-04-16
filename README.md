# Travel Idea

## Introduction

This is a travel idea project. It is a web application that allows users to search for travel ideas based on their destination, and date. Users can also post their travel ideas, chat with friends under the idea, and create travel plans with ideas. The application uses Google Maps API to retrieve location information, Open Weather API to retrieve weather information, and AMADEUS API to retrieve information about nearby attractions.

## Getting Started

To get a local copy up and running follow these simple steps.

### Use git clone to clone the repository

```bash
git clone https://github.com/TwT2114/travel-idea.git
```
### Install dependencies

run `npm install` to install dependencies.

```bash
npm install
```



### Setup in env

- Set database address, user, and password.
- Add API key, including Google Map API Key, Open Weather API, and AMADEUS API Key to `.env` file.

```dotenv
GOOGLE_MAP_API=YOUR_GOOGLE_MAP_API

WEATHER_API_KEY=YOUR_WEATHER_API

AMADEUS_CLIENT_ID=YOUR_AMADEUS_CLIENT_ID
AMADEUS_CLIENT_SECRET="YOUR_AMADEUS_CLIENT_SECRET"
```

### Database migration

run `php artisan migrate` to migrate database

```bash
php artisan migrate
```

### Run the project

run `npm run dev` and `php artisan serve` separately in terminal to run the project

```bash
npm run dev

php artisan serve
```
