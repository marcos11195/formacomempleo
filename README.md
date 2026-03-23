# Portal de Empleo (Laravel + Jetstream)

Plataforma para la gestión de ofertas de trabajo con un sistema de tres niveles de acceso: **Administrador**, **Empresa** y **Candidato**. El proyecto se centra en el control de flujos de usuario y la integridad de datos en procesos de inscripción.

## 🚀 Funcionalidades
- **Sistema Multi-rol:** Dashboard segmentado para Admin, Empresa y Candidato mediante Enums (`UserRole`).
- **Onboarding de Usuario:** Lógica de registro que obliga a completar el perfil antes de habilitar las funciones del dashboard.
- **Gestión de Ofertas:** CRUD completo para empresas con seguimiento de candidatos inscritos en tiempo real.
- **Panel de Candidato:** Buscador de vacantes, gestión de inscripciones y perfil profesional editable.
- **Administración Global:** Auditoría de usuarios, validación de empresas y control de inscripciones del sistema.
- **Seguridad:** Protección de rutas mediante el stack de Jetstream y Middlewares personalizados.

## 🛠️ Stack
- **Framework:** Laravel 11 / PHP 8.2+
- **Autenticación:** Laravel Jetstream (Sanctum)
- **Base de Datos:** MySQL (Eloquent ORM)
- **Frontend:** Blade + Tailwind CSS

## ⚙️ Notas Técnicas
- **Redirección Dinámica:** Controlador de tráfico en la ruta `/dashboard` que deriva al usuario según su rol y estado de perfil (`empresa_id` / `candidato_id`).
- **Optimización Eloquent:** Uso de *Eager Loading* (`with(['empresa', 'sector'])`) para evitar el problema de consultas N+1 en el listado de ofertas.
- **Integridad y Persistencia:** Implementación de `SoftDeletes` en el modelo de Empresa y manejo de relaciones `belongsTo` / `hasMany` para vinculación de candidatos.
- **Arquitectura de Controladores:** Organización por Namespaces (`Admin/`, `Dashboard/`) para separar la lógica de gestión global de la lógica de usuario final.
- **Validación:** Uso de Form Requests para desacoplar la validación de datos de la lógica de los controladores.
