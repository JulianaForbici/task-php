# ☕ TaskManager (Laravel)

Um **Task Manager** simples e elegante para **criar, acompanhar e concluir tarefas**, com autenticação (cadastro/login) e tarefas vinculadas por usuário.

---

## 🖼️ Telas (Preview)

### Home (Dashboard)
![TaskManager - Home](https://github.com/user-attachments/assets/2d673bcb-56dd-493f-ad61-3c17e904b435)

### Login
![TaskManager - Login](https://github.com/user-attachments/assets/1ed4f68e-35a8-4177-89af-14f04178dbd3)

### Cadastro
![TaskManager - Cadastro](https://github.com/user-attachments/assets/edca572b-d15b-4ccd-afe6-3ca13ab3c01e)

### Editar tarefa
![TaskManager - Editar tarefa](https://github.com/user-attachments/assets/25d5ff72-d713-4261-bf30-062a1993e91e)

---

## ✅ Funcionalidades

### Autenticação
- Cadastro de usuário
- Login / Logout
- Rotas protegidas por `auth`

### Tarefas
- Criar tarefa com:
  - **Título** (obrigatório)
  - **Descrição** (opcional)
  - **Status**: `todo`, `doing`, `done`
  - **Prazo (due_date)** opcional (não permite datas no passado)
- Listagem das tarefas do usuário (ordenadas por mais recentes)
- Editar tarefa
- Excluir tarefa
- Resumo na Home com contagem por status (**To do / Doing / Done**)

### Segurança (autorização)
- Policy para garantir que **apenas o dono da tarefa** possa editar/excluir

---

## 🧱 Stack / Tecnologias

- **PHP + Laravel**
- **Blade** (views)
- **Eloquent ORM**
- **SQLite/MySQL** (via configuração do `.env`)
- **Vite**
- **Tailwind CSS**
- **daisyUI (tema lofi)**

---

## 🚀 Como rodar o projeto

### 1) Clonar e instalar dependências
```bash
git clone https://github.com/JulianaForbici/task-php.git
cd task-php

composer install
npm install
```

### 2) Configurar ambiente
Crie seu `.env` a partir do exemplo:

```bash
cp .env.example .env
php artisan key:generate
```

Configure o banco no `.env`.

Exemplo com SQLite:
```env
DB_CONNECTION=sqlite
```

E crie o arquivo do banco (se necessário):
```bash
touch database/database.sqlite
```

### 3) Rodar migrations
```bash
php artisan migrate
```

### 4) Rodar o projeto
Em um terminal:
```bash
php artisan serve
```

Em outro terminal:
```bash
npm run dev
```

Acesse:
- `http://127.0.0.1:8000`

---

## 🔐 Rotas principais

### Públicas
- `GET /register` → tela de cadastro  
- `POST /register` → cria conta  
- `GET /login` → tela de login  
- `POST /login` → autentica usuário  

### Protegidas (auth)
- `GET /` → Home com listagem + formulário de nova tarefa  
- `POST /tasks` → criar tarefa  
- `GET /tasks/{task}/edit` → editar tarefa  
- `PUT /tasks/{task}` → atualizar tarefa  
- `DELETE /tasks/{task}` → excluir tarefa  
- `POST /logout` → sair  

---

## 🗂️ Estrutura (onde está cada coisa)

- Controller: `app/Http/Controllers/TaskController.php`
- Model: `app/Models/Task.php`
- Migration: `database/migrations/2026_03_18_012459_create_tasks_table.php`
- Home: `resources/views/home.blade.php`
- Edit task: `resources/views/tasks/edit.blade.php`
- Auth views: `resources/views/auth/login.blade.php` e `resources/views/auth/register.blade.php`
- Layout (navbar/toasts): `resources/views/components/layout.blade.php`

---

## 📌 Regras de validação (tarefas)

- `title`: obrigatório, string, 3–120 chars  
- `description`: opcional  
- `status`: obrigatório (`todo|doing|done`)  
- `due_date`: opcional, data **>= hoje**  

---

## 📄 Licença

Projeto para fins de estudo/portfolio.
