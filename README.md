# 🎯 [Laravel Quiz App](https://quiztime.marcpericot.es/)

Una aplicación web de quizzes desarrollada con [Laravel](https://laravel.com/) y MySQL. Permite a los usuarios registrarse, jugar quizzes, ver resultados, y a los administradores gestionar quizzes y categorías. [LIVE APP](https://quiztime.marcpericot.es/)

## 🚀 Características

- Autenticación de usuarios (registro, login, logout)
- Listado y juego de quizzes
- Muestra los resultados por cada intento
- Perfil de usuario con historial
- Panel de administración para gestionar quizzes y categorías

## 🛠️ Tecnologías

- Laravel 12
- MySQL
- Blade (motor de plantillas)
- Tailwind (frontend)

## 📁 Instalación

1. Clona el repositorio:

```bash
git clone https://github.com/MarcpTr/Laravel_quiz.git
cd laravel-quiz-app
````

2. Instala las dependencias:

```bash
composer install
npm install && npm run dev
```

3. Crea el archivo `.env`:

```bash
cp .env.example .env
```

4. Configura tus variables de entorno (DB, APP\_URL, etc.) y genera la clave:

```bash
php artisan key:generate
```

5. Crea la base de datos y ejecuta las migraciones:

```bash
php artisan migrate
```

6. Levanta el servidor:

```bash
php artisan serve
```

## 🔐 Rutas públicas

* `/` → Página principal
* `/quizzes` → Lista de quizzes
* `/categories` → Lista de categorías
* `/quiz/{id}` → Jugar un quiz
* `/quiz/{id}/submit` → Enviar respuestas (POST)
* `/result/{attempt}` → Ver resultado del intento

## 🔒 Rutas protegidas (requieren autenticación)

* `/profile` → Perfil del usuario
* `/admin/quizzes` → Gestión de quizzes (admin)
* `/quizzes/create` → Crear nuevo quiz
* `/quizzes/delete/{id}` → Eliminar quiz (DELETE)
* `/quiz` → Guardar nuevo quiz (POST)
* `/category/create` → Crear categoría
* `/category` → Guardar categoría (POST)

## 👥 Roles

* **Usuarios registrados** pueden jugar quizzes y ver sus resultados.
* **Administradores** pueden crear, editar y eliminar quizzes y categorías.

## 📸 Capturas de Pantalla

![pantalla principal](https://raw.githubusercontent.com/MarcpTr/Laravel_quiz/refs/heads/main/index.JPG)
![pantalla de perfil](https://raw.githubusercontent.com/MarcpTr/Laravel_quiz/refs/heads/main/profile.JPG)

