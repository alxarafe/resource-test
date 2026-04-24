#!/bin/bash
# Description: Runs the PHPUnit test suite inside the Docker container.

echo "🚀 Running PHPUnit Tests..."

# Check if container is running
if ! docker ps | grep -q alxarafe-test; then
    echo "❌ Error: The container 'alxarafe-test' is not running."
    echo "Please run 'docker compose up -d' first."
    exit 1
fi

# Check if phpunit exists
if ! docker exec alxarafe-test [ -f ./vendor/bin/phpunit ]; then
    echo "❌ Error: PHPUnit not found in vendor/bin/."
    echo "Please run './bin/install.sh' first to install dependencies."
    exit 1
fi

docker exec alxarafe-test ./vendor/bin/phpunit
