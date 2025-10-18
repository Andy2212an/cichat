# 📋 Sistema de Gestión de Averías con WebSocket

Aplicación en tiempo real para gestionar averías usando CodeIgniter 4 y WebSockets.

---

## ⚙️ CONFIGURACIÓN INICIAL

### 1️⃣ Configurar archivo de entorno

**IMPORTANTE:** Renombrar el archivo `env` a `.env`

```bash
# En Windows
ren env .env

# En Linux/Mac
mv env .env
```

Editar el archivo `.env` y configurar la base de datos:

```env
database.default.hostname = localhost
database.default.database = WOWDB
database.default.username = root
database.default.password = 
database.default.DBDriver = MySQLi
```

### 2️⃣ Crear Base de Datos

Ejecutar en MySQL/PhpMyAdmin:

```sql
CREATE DATABASE WOWDB;
```

### 3️⃣ Instalar dependencias

```bash
composer install
```

---

## 🗄️ MIGRACIÓN Y DATOS DE PRUEBA

### Crear migración (si no existe)

```bash
php spark make:migration averiasMigrate
```

### Ejecutar migración

Construye la estructura de la tabla `averias`:

```bash
php spark migrate
```

### Crear seeder (si no existe)

```bash
php spark make:seeder AveriasSeeder   
```

Construye los datos de prueba dentro del arreglo **$data = []**

### Ejecutar semilla

Inserta datos de prueba en la tabla:

```bash
php spark db:seed AveriasSeeder 
```

---

## 🚀 INICIAR APLICACIÓN

### 1️⃣ Iniciar servidor WebSocket

En una terminal, ejecutar:

```bash
php server.php
```

**Verificar en consola:** "Servidor websocket iniciado en puerto 8080"

### 2️⃣ Iniciar servidor web (opcional)

Si usas XAMPP, asegúrate de que Apache esté corriendo.

O usa el servidor integrado de PHP:

```bash
php spark serve
```

---

## 🌐 RUTAS DISPONIBLES

Accede a las siguientes URLs en tu navegador:

### 📌 Gestión de Averías

| Ruta | Descripción | URL |
|------|-------------|-----|
| **Listar Pendientes** | Ver averías por atender | `http://cichat.test/averias` |
| **Registrar Avería** | Crear nueva avería | `http://cichat.test/averias/registrar` |
| **Averías Solucionadas** | Ver historial de averías completadas | `http://cichat.test/averias/solucionado` |

### 🔌 WebSocket

| Ruta | Descripción | URL |
|------|-------------|-----|
| **Chat WebSocket** | Interfaz de chat en tiempo real | `http://cichat.test/websocket` |

---

## ✅ VERIFICACIÓN

1. Abre la consola del navegador (F12)
2. Verifica el mensaje: **"Conexión establecida"**
3. Las vistas se actualizan automáticamente vía WebSocket

---
