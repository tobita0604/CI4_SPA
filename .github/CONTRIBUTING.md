# Contributing to CI4_SPA

Thank you for considering contributing to the CI4_SPA project. This document provides guidelines and information to help you contribute effectively.

## Table of Contents

- [Project Overview](#project-overview)
  - [Architecture](#architecture)
  - [Project Structure](#project-structure)
- [Development Environment Setup](#development-environment-setup)
  - [Prerequisites](#prerequisites)
  - [Setup Instructions](#setup-instructions)
- [Coding Standards](#coding-standards)
  - [General Guidelines](#general-guidelines)
  - [Backend (PHP/CodeIgniter 4)](#backend-phpcodeigniter-4)
  - [Frontend (Vue.js 3/TypeScript)](#frontend-vuejs-3typescript)
- [Git Workflow](#git-workflow)
  - [Branch Naming](#branch-naming)
  - [Commit Message Format](#commit-message-format)
  - [Pull Request Process](#pull-request-process)
- [Testing Guidelines](#testing-guidelines)
  - [Backend Testing](#backend-testing)
  - [Frontend Testing](#frontend-testing)
- [CI/CD Process](#cicd-process)
- [AI Implementation Guidelines](#ai-implementation-guidelines)
  - [General AI Usage](#general-ai-usage)
  - [Prompting Best Practices](#prompting-best-practices)
  - [Specific Guidelines for CI4_SPA](#specific-guidelines-for-ci4_spa)
  - [Code Review for AI-Generated Code](#code-review-for-ai-generated-code)
- [Additional Resources](#additional-resources)
- [Questions and Support](#questions-and-support)

## Project Overview

CI4_SPA is a modern web application using CodeIgniter 4 for the backend API and Vue.js 3 for the frontend SPA, all containerized with Docker. The project follows a clear separation of concerns with dedicated backend and frontend components.

### Architecture

The project follows a typical modern web application architecture:
- **Backend**: CodeIgniter 4 PHP framework providing RESTful APIs
- **Frontend**: Vue.js 3 SPA with TypeScript, Vuetify and Tailwind CSS
- **Database**: MySQL 8.0
- **Containerization**: Docker for development environment consistency

### Project Structure

```
CI4_SPA/
├── backend/                # CodeIgniter 4 application
│   ├── app/               # Application code
│   │   ├── Config/        # Configuration files
│   │   ├── Controllers/   # API controllers
│   │   ├── Models/        # Data models
│   │   ├── Filters/       # Request filters
│   ├── public/            # Public assets and entry point
│   ├── tests/             # Test files
│
├── frontend/              # Vue.js 3 application
│   ├── src/               # Source files
│   │   ├── assets/        # Static assets
│   │   ├── components/    # Vue components
│   │   ├── router/        # Vue router configuration
│   │   ├── stores/        # Pinia stores
│   │   ├── views/         # Vue views
│   ├── public/            # Public assets
│
├── docker/                # Docker configuration files
│   ├── mysql/             # MySQL configuration
│   ├── node/              # Node.js configuration
│   ├── php/               # PHP configuration
│
├── docker-compose.yml     # Docker Compose configuration
```

## Development Environment Setup

### Prerequisites

- [Docker](https://www.docker.com/get-started) and Docker Compose
- [Git](https://git-scm.com/downloads)

### Setup Instructions

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

## Coding Standards

### General Guidelines

- Use UTF-8 encoding for all files
- Use LF (Unix-style) line endings
- Keep lines within a reasonable length (120 characters maximum)
- Write clear, descriptive comments
- Follow the principle of "clean code" - self-documenting, simple, and DRY (Don't Repeat Yourself)

### Backend (PHP/CodeIgniter 4)

#### PHP Coding Style

- Follow [PSR-12](https://www.php-fig.org/psr/psr-12/) coding style
- Use type hints for parameters and return types when possible
- Use strict_types declaration in PHP files

#### CodeIgniter Specific Guidelines

- Follow the [CodeIgniter 4 Style Guide](https://codeigniter.com/user_guide/contributing/styleguide.html)
- Use CodeIgniter's built-in validation and security features
- Use the appropriate Models, Services, and Entities pattern
- Keep controllers thin and delegate business logic to models or services

#### Naming Conventions

- **Controllers**: PascalCase with `Controller` suffix (e.g., `UserController`)
- **Models**: PascalCase with `Model` suffix (e.g., `UserModel`)
- **Methods**:
  - Controller methods: camelCase (e.g., `getUsers()`)
  - Model methods: camelCase (e.g., `findByEmail()`)
- **Variables**: camelCase (e.g., `$userName`)
- **Database tables**: snake_case plural (e.g., `users`, `blog_posts`)
- **Database columns**: snake_case (e.g., `first_name`, `created_at`)

#### Documentation

- Add PHPDoc blocks to classes and methods
- Document parameters, return types, and exceptions
- Explain complex logic with inline comments

### Frontend (Vue.js 3/TypeScript)

#### Vue/TypeScript Style Guide

- Follow the [Vue Style Guide](https://vuejs.org/style-guide/) with priority A and B rules as requirements
- Use TypeScript for type safety
- Prefer the Composition API with `<script setup>` for new components
- Use ES6+ features appropriately

#### Component Structure

- Use Single File Components (.vue files)
- Follow this order in components:
  1. `<template>`
  2. `<script>`
  3. `<style>`
- Use kebab-case for component filenames (e.g., `user-profile.vue`)
- Use PascalCase for component registration and JSX (e.g., `<UserProfile>`)

#### Vuetify and Tailwind CSS Guidelines

- Use Vuetify components for complex UI elements
- Use Tailwind CSS for custom styling
- Avoid inline styles when possible
- Use CSS utility classes from Tailwind rather than custom CSS when appropriate

#### Naming Conventions

- **Components**: PascalCase (e.g., `UserProfile.vue`)
- **Files**: kebab-case (e.g., `user-profile.vue`)
- **Methods**: camelCase (e.g., `fetchUsers()`)
- **Properties**: camelCase (e.g., `userName`)
- **Store files**: kebab-case with `.store.ts` suffix (e.g., `user.store.ts`)

#### State Management

- Use Pinia for state management
- Structure Pinia stores with clear actions, getters, and state
- Avoid accessing the store outside of components when possible

## Git Workflow

### Branch Naming

- Use prefixes to identify the type of work:
  - `feature/` for new features
  - `fix/` for bug fixes
  - `docs/` for documentation updates
  - `refactor/` for code refactoring
  - `test/` for adding or updating tests

Examples:
- `feature/user-authentication`
- `fix/login-validation`
- `docs/api-documentation`

### Commit Message Format

Follow the [Conventional Commits](https://www.conventionalcommits.org/) specification:

```
<type>(<scope>): <description>

[optional body]

[optional footer]
```

Types:
- `feat`: A new feature
- `fix`: A bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, missing semicolons, etc.)
- `refactor`: Code refactoring
- `test`: Adding or updating tests
- `chore`: Other changes that don't modify src or test files

Examples:
- `feat(auth): add user registration endpoint`
- `fix(login): resolve validation error on login form`
- `docs(api): update API documentation`

### Pull Request Process

1. Create a branch from `main` using the naming convention above
2. Make your changes, following the coding standards
3. Test your changes thoroughly
4. Push your branch and create a pull request
5. Fill in the pull request template with relevant information
6. Request a review from a maintainer
7. Address any feedback and update your pull request as needed

## Testing Guidelines

### Backend Testing

- Use PHPUnit for unit and integration tests
- Follow the CodeIgniter 4 testing methodology
- Write tests for controllers, models, and services
- Aim for high code coverage, especially for critical functionality

To run backend tests:
```
docker exec -it ci4spa_backend php spark test
```

### Frontend Testing

- Use Jest for unit tests
- Test components with Vue Test Utils
- Write tests for complex components and Pinia stores

To run frontend tests:
```
docker exec -it ci4spa_frontend npm run test
```

## CI/CD Process

- GitHub Actions are used for continuous integration
- Tests are run automatically on pull requests
- Code style and quality checks are performed automatically

## Additional Resources

- [CodeIgniter 4 Documentation](https://codeigniter.com/user_guide/)
- [Vue.js 3 Documentation](https://vuejs.org/guide/introduction.html)
- [Vuetify Documentation](https://vuetifyjs.com/en/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [Pinia Documentation](https://pinia.vuejs.org/)
- [TypeScript Documentation](https://www.typescriptlang.org/docs/)

## AI Implementation Guidelines

When using AI tools (like GitHub Copilot, ChatGPT, or Claude) for development tasks in this project, please follow these guidelines:

### General AI Usage

- Use AI as a coding assistant, not as a replacement for understanding the codebase
- Always review and test AI-generated code before committing
- Do not paste sensitive information (API keys, credentials, etc.) into AI prompts

### Prompting Best Practices

- Provide context about the project structure and architecture
- Include references to this CONTRIBUTING.md file in your prompts
- Specify the coding standards and naming conventions to follow
- Ask for explanations of complex logic to ensure understanding

### Specific Guidelines for CI4_SPA

- Direct AI to follow the established patterns in the codebase
- For backend (CodeIgniter 4):
  - Request code that follows PSR-12 and CodeIgniter's conventions
  - Ask for proper use of Models, Controllers, and Services
  - Ensure proper validation and security practices are followed
- For frontend (Vue.js 3):
  - Direct AI to use the Composition API with TypeScript
  - Request proper Vuetify component implementation
  - Ensure state management follows Pinia patterns

### Code Review for AI-Generated Code

- Check for inconsistencies with existing code style
- Verify that security best practices are followed
- Test thoroughly for edge cases
- Remove any unnecessary code or comments
- Ensure proper error handling is implemented

## Questions and Support

If you have any questions or need support, please create an issue in the GitHub repository.

Thank you for contributing to CI4_SPA!