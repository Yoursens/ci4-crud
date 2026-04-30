# CI4 Student System
### Laboratory Exercise 4 — CRUD with Git Collaboration
**Course:** BSIT | Advanced Web Development

---

## Features
| Feature | Branch | Status |
|---|---|---|
| Basic CRUD | `feature-crud` | ✅ |
| Search | `feature-search` | ✅ |
| Pagination | `feature-pagination` | ✅ |
| Bootstrap 5 UI | `feature-bootstrap` | ✅ |
| Soft Deletes | `feature-crud` | ✅ |
| REST API | `feature-api` | ✅ |

---

## Quick Setup

### 1. Clone & Install
```bash
git clone https://github.com/YOUR_USERNAME/ci4-student-system.git
cd ci4-student-system
composer install
```

### 2. Configure Environment
```bash
cp .env.example .env
# Edit .env — set your DB credentials
```

### 3. Database
Import `database.sql` in phpMyAdmin, **or** run:
```bash
php spark migrate
```

### 4. Run
```bash
php spark serve
# Open http://localhost:8080
```

---

## REST API Endpoints

Base URL: `http://localhost:8080/api/students`

| Method | Endpoint | Description |
|---|---|---|
| GET | `/api/students` | List all students |
| GET | `/api/students/{id}` | Get one student |
| POST | `/api/students` | Create student |
| PUT | `/api/students/{id}` | Update student |
| DELETE | `/api/students/{id}` | Soft-delete student |

### Example POST body (JSON)
```json
{
  "first_name": "Juan",
  "last_name": "dela Cruz",
  "email": "juan@school.edu.ph",
  "course": "BSIT",
  "year_level": 2
}
```

---

## Git Workflow (Lab Requirement)

```bash
# Each member creates their branch
git checkout -b feature-crud

# Work, then commit
git add .
git commit -m "feat: basic CRUD for students"
git push origin feature-crud

# After each PR merge, everyone pulls
git checkout main
git pull origin main
```

---

## Project Structure
```
app/
├── Controllers/
│   ├── Students.php          ← CRUD + Search + Pagination
│   └── Api/
│       └── Students.php      ← REST API (JSON)
├── Models/
│   └── StudentModel.php      ← Model + Soft Deletes
├── Views/
│   ├── layouts/
│   │   └── main.php          ← Bootstrap 5 layout
│   ├── students/
│   │   ├── index.php         ← List + Search + Pagination
│   │   ├── create.php        ← Add form
│   │   └── edit.php          ← Edit form
│   └── Pager/
│       └── bootstrap_pagination.php
├── Config/
│   └── Routes.php
└── Database/
    └── Migrations/
        └── ..._CreateStudentsTable.php
database.sql                  ← Quick DB setup + sample data
.env                          ← DB config (not committed)
.gitignore
```
