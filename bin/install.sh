#!/bin/bash
# Description: Installs dependencies and prepares the environment.

echo "📦 Updating composer dependencies..."

# Check if container is running
if ! docker ps | grep -q alxarafe-test; then
    echo "❌ Error: The container 'alxarafe-test' is not running."
    echo "Please run 'docker compose up -d' first."
    exit 1
fi

docker exec alxarafe-test composer update

echo "✅ Environment ready!"
