# Workout API 💪

API RESTful para gerenciamento de treinos e exercícios, desenvolvida com **Laravel 12** e autenticação via **Sanctum**.

## 🚀 Tecnologias

- **PHP 8.2+**
- **Laravel 12**
- **SQLite** (desenvolvimento)
- **Laravel Sanctum** (autenticação)
- **Laravel Factories** (dados de teste)

## 📋 Pré-requisitos

- PHP 8.2+
- Composer
- SQLite

## ⚙️ Instalação

**1. Clone o repositório**

```bash
git clone https://github.com/Uzzoper/workout-api.git
cd workout-api
```

**2. Instale as dependências**

```bash
composer install
```

**3. Configure o ambiente**

```bash
cp .env.example .env
php artisan key:generate
```

**4. Execute as migrações**

```bash
php artisan migrate
```

**5. Inicie o servidor**

```bash
php artisan serve
```

A API estará disponível em `http://localhost:8000`

---

## 🔐 Autenticação

A API utiliza **Laravel Sanctum** com tokens Bearer.

### Endpoints Públicos

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `POST` | `/api/v1/register` | Registrar novo usuário |
| `POST` | `/api/v1/login` | Fazer login |

### Endpoints Protegidos (requer token)

Adicione o header em todas as requisições:

```
Authorization: Bearer {seu_token}
```

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `POST` | `/api/v1/logout` | Fazer logout |
| `GET` | `/api/v1/me` | Dados do usuário logado |

---

## 🏋️ Treinos (Workouts)

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/v1/workouts` | Listar todos os treinos |
| `POST` | `/api/v1/workouts` | Criar novo treino |
| `GET` | `/api/v1/workouts/{id}` | Ver detalhes do treino |
| `PUT` | `/api/v1/workouts/{id}` | Atualizar treino |
| `DELETE` | `/api/v1/workouts/{id}` | Deletar treino |

**Exemplo de criação:**

```http
POST /api/v1/workouts
```

```json
{
    "name": "Treino de Peito",
    "description": "Foco em peitoral",
    "scheduled_date": "2026-02-20"
}
```

---

## 🏃 Exercícios (Exercises)

| Método | Endpoint | Descrição |
|--------|----------|-----------|
| `GET` | `/api/v1/workouts/{id}/exercises` | Listar exercícios do treino |
| `POST` | `/api/v1/workouts/{id}/exercises` | Adicionar exercício ao treino |
| `PUT` | `/api/v1/exercises/{id}` | Atualizar exercício |
| `DELETE` | `/api/v1/exercises/{id}` | Deletar exercício |

**Exemplo de criação:**

```http
POST /api/v1/workouts/1/exercises
```

```json
{
    "name": "Supino Reto",
    "sets": 4,
    "reps": 12,
    "weight": 60.5,
    "rest_time": 90,
    "notes": "Manter postura"
}
```

---

## 🧪 Testes com Factories

Crie dados de teste rapidamente:

```bash
php artisan tinker
```

```php
// Criar usuário com 2 treinos e 3 exercícios cada
$user = \App\Models\User::factory()->has(
    \App\Models\Workout::factory()->count(2)->has(
        \App\Models\Exercise::factory()->count(3)
    )
)->create();

// Ver dados criados
$user->email;
$user->workouts;
```

---

## 📁 Estrutura do Projeto

```
workout-api/
├── app/
│   ├── Http/Controllers/
│   │   ├── AuthController.php      # Autenticação
│   │   ├── WorkoutController.php   # CRUD de treinos
│   │   └── ExerciseController.php  # CRUD de exercícios
│   └── Models/
│       ├── User.php
│       ├── Workout.php
│       └── Exercise.php
├── database/
│   ├── factories/                  # Factories para testes
│   └── migrations/                 # Migrações do banco
└── routes/
    └── api.php                     # Rotas da API
```

---

## 🔒 Segurança

- Autenticação via tokens Sanctum
- Usuários só acessam seus próprios dados
- Validação em todos os endpoints
- Proteção contra SQL Injection (Eloquent ORM)

---

## 📝 Status do Projeto

✅ **MVP Backend Completo:**

- Autenticação (Sanctum)
- CRUD de Treinos
- CRUD de Exercícios
- Factories para testes
- Validações e autorizações

---

## 👨‍💻 Autor

**Juan Antonio Peruzzo** — [GitHub](https://github.com/Uzzoper)