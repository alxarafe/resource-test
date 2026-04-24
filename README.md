# alxarafe/resource-test

![PHP Version](https://img.shields.io/badge/PHP-8.2+-blueviolet?style=flat-square)
![Tests](https://github.com/alxarafe/resource-test/actions/workflows/tests.yml/badge.svg)
![License](https://img.shields.io/badge/license-GPL--3.0--or--later-blue?style=flat-square)

[Leer en español 🇪🇸](README.es.md)

![Alxarafe Showcase UI](assets/showcase.png)

This is a **Showcase and Testing** project for the **Alxarafe Resource Controller** ecosystem.

The purpose of this repository is to illustrate the power of Alxarafe's Declarative UI. It demonstrates how, using an agnostic architecture without Laravel or Vue.js, you can build complex forms and nested panels in just a few lines of code.

## Features

- 🏗️ **Declarative UI**: The entire structure of tabs, panels, and fields is defined in pure PHP using metadata (Arrays/Objects).
- ⚡ **Built-in HTML**: Uses the consolidated `DefaultRenderer` from `resource-controller` to generate the UI without heavy template engines.
- 💾 **Native PDO**: Integrates `alxarafe/resource-pdo` to demonstrate how a `RepositoryContract` can work with any database (e.g., SQLite in-memory) without an ORM.
- 🚀 **Zero Framework Dependencies**: No Laravel, no Symfony, no unnecessary external weight.

## Local Execution

### Option 1: Using Docker (Recommended)

If you have Docker and Docker Compose installed, you can spin up the environment quickly:

```bash
docker compose up -d
./bin/install.sh
```

### Running Tests and Verification

To ensure everything is working correctly, you can use the scripts in the `bin/` directory:

- **Install dependencies**: `./bin/install.sh`
- **Run tests**: `./bin/run_tests.sh`
- **Full CI check**: `./bin/ci_local.sh`


Then open in your browser: http://localhost:8000

### Option 2: Using Local PHP

1. Clone the repository and install dependencies:
   ```bash
   composer install
   ```

2. Start the built-in PHP web server:
   ```bash
   php -S localhost:8000 -t public
   ```

3. Open in your browser: http://localhost:8000

You will see the complex view dynamically generated through a single configuration array returned by `DemoController`.

## Alxarafe Ecosystem

| Package | Purpose | Status |
|---|---|---|
| **[resource-controller](https://github.com/alxarafe/resource-controller)** | Central CRUD engine + UI components | ✅ Stable |
| **[resource-pdo](https://github.com/alxarafe/resource-pdo)** | Native PDO adapter | ✅ Stable |
| **[resource-eloquent](https://github.com/alxarafe/resource-eloquent)** | Eloquent ORM adapter | ✅ Stable |
