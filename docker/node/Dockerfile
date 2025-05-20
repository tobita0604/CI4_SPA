FROM node:18-alpine

# Set working directory
WORKDIR /app

# Install pnpm
RUN npm install -g pnpm

# Expose port 5173 (default Vite port)
EXPOSE 5173

# Start command
CMD ["sh", "-c", "cd /app && pnpm install && pnpm run dev"]