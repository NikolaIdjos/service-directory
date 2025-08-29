# Service Directory

## Prerequisites

Before running this project, make sure you have the following installed on your system:

- **Docker** and **Docker Compose** (required for Laravel Sail)
- **Git** (for cloning the repository)
- **Composer**

Optional tools you might want for development:

- **PHP** >= 8.2

## Project setup

1. **Clone the repository**
```bash
git clone https://github.com/NikolaIdjos/service-directory.git
cd service-directory
```
2. **Copy .env.example to .env**
```bash
cp .env.example .env
```
3. **Start Sail**
```bash
composer install
./vendor/bin/sail up -d
```
4. **PHP commands**
```bash
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate --seed
```
5. **npm commands**
```bash
./vendor/bin/sail npm install
./vendor/bin/sail npm run dev
```
6. **run tests**
```bash
./vendor/bin/sail artisan test
```

## Notes on Trade-offs / Timeboxing

During development, certain decisions and trade-offs were made due to time constraints and prioritization:

- **Frontend structure**: I avoided splitting components into too many small parts and only extracted those that would make future development easier.
- **Resources**: Implemented because I believe they improve code structure and readability.
- **Feature tests**: Tried to cover as many edge cases as possible.
- **Inertia**: Used instead of Vue Router since there was no need for a full SPA routing setup in this project.
- **Interceptors**: Added interceptors to avoid using try/catch everywhere.
- **Filter validation**: Added validation for filters.

## Optimization
`Frontend:`
- Use vite-plugin-compression for JS/CSS compression
- Run npm run build for production (minified, bundled assets)
- Eager-load above-the-fold / LCP images; lazy-load others
- Preload critical fonts and images
- Split code & use dynamic imports for large components

`Backend:`
- Cache frequent API responses (ProviderController@index / index) - just for simulation
- Cache arrays instead of objects for performance
- Index frequently filtered database columns
- Eager load relationships to avoid N+1 queries
- Return only required fields via Resources
- Monitor performance using Laravel Telescope
- Queue heavy tasks

