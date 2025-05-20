# CI4_SPA

A starter template for building admin dashboards with CodeIgniter 4 (backend) and Vue.js 3 (frontend).

## Overview

This project provides a template for quickly setting up a single page application (SPA) with:

- **Backend**: CodeIgniter 4 with RESTful API
- **Frontend**: Vue.js 3 with Vuetify and Tailwind CSS
- **Authentication**: CodeIgniter Shield
- **Development Environment**: Docker Compose

## Directory Structure

```
/
├── backend/           # CodeIgniter 4 backend
├── frontend/          # Vue 3 + Vite frontend
├── docker/            # Docker configuration files
├── .env.example       # Example environment variables
├── docker-compose.yml # Docker Compose configuration
└── README.md          # Project documentation
```

## Prerequisites

- Docker and Docker Compose
- Git

## Quick Start

1. Clone the repository
   ```bash
   git clone https://github.com/your-username/CI4_SPA.git
   cd CI4_SPA
   ```

2. Copy the example environment file
   ```bash
   cp .env.example .env
   ```

3. Start the Docker environment
   ```bash
   docker-compose up -d
   ```

4. Access the application
   - Frontend: http://localhost:5173
   - Backend API: http://localhost:8080/api
   - phpMyAdmin: http://localhost:8081 (user: root, password: root)

## Backend (CodeIgniter 4)

The backend provides a RESTful API for the frontend to consume. It uses:

- CodeIgniter 4 (PHP 8.x)
- MySQL database
- CodeIgniter Shield for authentication
- PSR-4 compliant structure
- RESTful API endpoints

### API Endpoints

- `GET /api` - API information
- `POST /api/login` - User authentication
- Add more endpoints as needed

### Development

To customize the backend:

1. Edit files in the `backend/app` directory
2. Access the backend container shell for commands:
   ```bash
   docker exec -it ci4spa_backend bash
   ```

## Frontend (Vue.js 3)

The frontend is a single page application built with:

- Vue.js 3
- Vite for development
- Vuetify for UI components
- Tailwind CSS for styling
- Pinia for state management
- TypeScript for type safety
- Vue Router for routing
- Axios for API communication
- Storybook for component development

### Development

To customize the frontend:

1. Edit files in the `frontend/src` directory
2. Access the frontend container shell for commands:
   ```bash
   docker exec -it ci4spa_frontend sh
   ```

3. Build for production:
   ```bash
   docker exec -it ci4spa_frontend sh -c "cd /app && pnpm build"
   ```

## Testing

### Backend Testing

Run PHPUnit tests:
```bash
docker exec -it ci4spa_backend php ./vendor/bin/phpunit
```

### Frontend Testing

Run Jest tests:
```bash
docker exec -it ci4spa_frontend sh -c "cd /app && pnpm test"
```

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
