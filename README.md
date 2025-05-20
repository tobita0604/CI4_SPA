# CI4_SPA Project

A modern web application using CodeIgniter 4 for the backend API and Vue.js 3 for the frontend SPA, all containerized with Docker.

## Project Structure

- `backend/` - CodeIgniter 4 application
- `frontend/` - Vue.js 3 application
- `docker/` - Docker configuration files
- `docker-compose.yml` - Docker Compose configuration

## Quick Start

1. Clone the repository:
   ```
   git clone https://github.com/tobita0604/CI4_SPA.git
   cd CI4_SPA
   ```

2. Copy environment file:
   ```
   cp .env.example backend/.env
   ```

3. Start the Docker containers:
   ```
   docker-compose up -d
   ```

4. Run database migrations:
   ```
   docker exec -it ci4spa_backend php spark migrate
   ```

5. Run database seeder:
   ```
   docker exec -it ci4spa_backend php spark db:seed UserSeeder
   ```

6. Access the application:
   - Frontend: http://localhost:5173
   - Backend API: http://localhost:8080/api
   - phpMyAdmin: http://localhost:8081 (username: root, password: root)

## Features

### Backend (CodeIgniter 4)
- RESTful API structure
- User authentication with filters
- MySQL database integration
- CORS support for frontend-backend communication

### Frontend (Vue.js 3)
- TypeScript support
- Vuetify as UI component library
- Tailwind CSS for custom styling
- Pinia for state management
- Vue Router for navigation
- Axios for API communication

## Development

### Backend Commands
Run these commands inside the backend container:

```
# Access the container
docker exec -it ci4spa_backend bash

# Run migrations
php spark migrate

# Create a new migration
php spark make:migration CreateTableName

# Create a new controller
php spark make:controller ControllerName

# Create a new model
php spark make:model ModelName
```

### Frontend Commands
Run these commands inside the frontend container:

```
# Access the container
docker exec -it ci4spa_frontend sh

# Install dependencies
npm install

# Run development server
npm run dev

# Build for production
npm run build
```

## License

MIT
