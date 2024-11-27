### **CRUD de Pokémon en PHP Traditional-App**

---

## **Descripción del Proyecto**
Este proyecto es un sistema de gestión básico de Pokémon, implementado en PHP con una base de datos MySQL. Este CRUD (Crear, Leer, Actualizar y Eliminar) nos permite realizar las siguientes acciones:
- Listar todos los Pokémon existentes.
- Agregar nuevos Pokémon.
- Editar información de un Pokémon existente.
- Eliminar un Pokémon con confirmación.

Este proyecto se ha diseñado para aprender y practicar los fundamentos de PHP así como el manejo de bases de datos.

---

## **Funcionalidades**
1. **Listar Pokémon:**
   - Muestra todos los Pokémon registrados en una tabla.
   - Incluye acciones de editar y eliminar.

2. **Agregar Pokémon:**
   - Formulario para agregar un nuevo Pokémon con campos:
     - Nombre
     - Tipo
     - Nivel

3. **Editar Pokémon:**
   - Permite actualizar los datos de un Pokémon.
   - Carga un formulario pre-rellenado con los datos actuales.

4. **Eliminar Pokémon:**
   - Elimina un Pokémon de la base de datos.
   - Incluye una ventana de confirmación para evitar eliminaciones accidentales.

5. **Mensajes de Éxito:**
     - Muestra notificaciones después de realizar una acción, como:
     - Pokémon eliminado.

---

## **Requisitos** 
Para desarrollar este proyecto utilice:
- **XAMPP** (ya que es un servidor local con soporte para PHP y MySQL).
	Para ello realice las siguientes acciones:

1. **Instalar XAMPP:**
  
2. **Iniciar Servicios:**
 **Apache** y **MySQL**.
imagen

3. **Configurar la Carpeta del Proyecto:**
   - Colocamos el proyecto en `C:/xampp/htdocs/crud-pokemon/`.

4. **Configurar la Base de Datos:**
   - Abrimos **phpMyAdmin** desde XAMPP (`http://localhost/phpmyadmin/`).
   - Creamos una nueva base de datos llamada `pokemon_db`.
   - Importamos el siguiente esquema SQL:

```sql
CREATE DATABASE IF NOT EXISTS pokemon_db;

USE pokemon_db;

CREATE TABLE IF NOT EXISTS pokemons (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    level INT NOT NULL
);
```
---

## **Configuración del Proyecto**
1. **Conexión a la Base de Datos:**
   - Editamos el archivo `db.php` para configurar la conexión a tu base de datos:

```php
<?php
$host = 'localhost';
$dbname = 'pokemon_db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error de conexión: " . $e->getMessage());
}
?>
```
   -Debemos verificar que los valores de `username` y `password` coincidan con nuestra configuración local (en XAMPP, el usuario por defecto es `root` sin contraseña).

2. **La estructura de nuestro Proyecto es la siguiente:**

   - `index.php`: Página principal para listar Pokémon.
   - `create.php`: Formulario para agregar nuevos Pokémon.
   - `update.php`: Formulario para editar Pokémon.
   - `delete.php`: Script para eliminar Pokémon.
   - `db.php`: Archivo de conexión a la base de datos.
   - `styles.css`: Archivo de estilos para mejorar la apariencia.

3. **Para iniciar el Proyecto:**
   - Abrimos `http://localhost/crud-pokemon/` en nuestro navegador.

---
- **Errores Comunes:**
  - `404 Not Found`: Debemos asegurarnos que los archivos del proyecto están en `htdocs` y que accedemos a la URL correcta.
