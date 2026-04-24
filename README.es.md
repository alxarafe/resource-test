# alxarafe/resource-test

![PHP Version](https://img.shields.io/badge/PHP-8.2+-blueviolet?style=flat-square)
![Tests](https://github.com/alxarafe/resource-test/actions/workflows/tests.yml/badge.svg)
![License](https://img.shields.io/badge/license-GPL--3.0--or--later-blue?style=flat-square)

![Alxarafe Showcase UI](assets/showcase.png)

Este es un proyecto de demostración y pruebas (Showcase) para el ecosistema **Alxarafe Resource Controller**.

El propósito de este repositorio es ilustrar la potencia de la UI Declarativa de Alxarafe. Demuestra cómo, utilizando una arquitectura agnóstica sin Laravel ni Vue.js, se pueden construir formularios complejos y paneles anidados en muy pocas líneas de código.

## Características

- 🏗️ **UI Declarativa**: Toda la estructura de pestañas, paneles y campos se define en PHP puro mediante metadatos (Array/Objetos).
- ⚡ **HTML Nativo**: Utiliza `DefaultRenderer` incrustado en `resource-controller` para generar HTML sin motores de plantillas pesados.
- 💾 **Native PDO**: Integra `alxarafe/resource-pdo` para demostrar cómo un `RepositoryContract` puede funcionar con una base de datos SQLite en memoria, sin Eloquent.
- 🚀 **Cero Dependencias Framework**: Sin Laravel, sin Symfony, sin dependencias externas innecesarias.

## Ejecución Local

### Opción 1: Usando Docker (Recomendado)

Si tienes Docker y Docker Compose instalados, puedes levantar el entorno rápidamente sin instalar dependencias en tu máquina:

```bash
docker compose up -d
./bin/install.sh
```

### Ejecutar Tests y Verificación

Para asegurar que todo funciona correctamente, puedes usar los scripts de la carpeta `bin/`:

- **Instalar dependencias**: `./bin/install.sh`
- **Ejecutar tests**: `./bin/run_tests.sh`
- **Chequeo completo**: `./bin/ci_local.sh`


Luego abre en tu navegador: http://localhost:8000

### Opción 2: Usando PHP local

1. Clona el repositorio e instala dependencias:
   ```bash
   composer install
   ```

2. Arranca el servidor web integrado de PHP:
   ```bash
   php -S localhost:8000 -t public
   ```

3. Abre en tu navegador: http://localhost:8000

Verás la vista compleja generada dinámicamente a través de un único array de configuración devuelto por `DemoController`.

## Ecosistema Alxarafe

| Paquete | Propósito | Estado |
|---|---|---|
| **[resource-controller](https://github.com/alxarafe/resource-controller)** | Motor CRUD central + componentes UI | ✅ Estable |
| **[resource-pdo](https://github.com/alxarafe/resource-pdo)** | Adaptador nativo PDO | ✅ Estable |
| **[resource-eloquent](https://github.com/alxarafe/resource-eloquent)** | Adaptador ORM Eloquent | ✅ Estable |
