# ZooClick API

Небольшое API для управления питомцами и вакцинациями.  
Проект написан на **Laravel 10** с использованием **Sanctum** для авторизации и **Swagger (L5-Swagger)** для документации.

---

## 🚀 Установка и запуск

```bash
git clone <repo_url>
cd zooclick-test
cp .env.example .env
```

При необходимости поменяй параметры в `.env` (БД, порты).

Запуск через Docker:

```bash
docker-compose up -d --build
```

Выполнить миграции и сиды:

```bash
docker-compose exec app php artisan migrate:fresh --seed
```

---

## 🔑 Авторизация

Используется **Bearer Token**.  

Получить токен:

```http
POST /api/login
Content-Type: application/json

{
  "email": "admin@example.com",
  "password": "password"
}
```

В ответе будет поле `token`. Его нужно передавать в каждом запросе:

```http
Authorization: Bearer <token>
```

---

## 📌 Эндпоинты

### Питомцы (`/api/pet`)
- `GET /api/pet` — список (с пагинацией и фильтрацией по query)  
- `GET /api/pet/{id}` — один питомец  
- `POST /api/pet` — создать  
- `PUT /api/pet/{id}` — обновить  
- `DELETE /api/pet/{id}` — удалить  

### Вакцинации (`/api/vaccination`)
- `GET /api/vaccination` — список  
- `GET /api/vaccination/{id}` — одна вакцинация  
- `POST /api/vaccination` — создать (подтягивает `country` из внешнего API)  
- `PUT /api/vaccination/{id}` — обновить  
- `DELETE /api/vaccination/{id}` — удалить  

---

## 📄 Документация Swagger

После запуска доступна по адресу:  
👉 [http://localhost:8080/api/documentation](http://localhost:8080/api/documentation)

---

## 🧪 Тестовые данные

Сиды создают:
- пользователя-админа:  
  ```
  admin@example.com / password
  ```
- несколько питомцев и вакцинаций.

---

## 🔍 Примеры запросов (cURL)

### Получить токен
```bash
curl -X POST http://localhost:8080/api/login   -H "Content-Type: application/json"   -d '{"email":"admin@example.com","password":"password"}'
```

### Получить список питомцев
```bash
curl -X GET http://localhost:8080/api/pet   -H "Authorization: Bearer <token>"
```

### Создать питомца
```bash
curl -X POST http://localhost:8080/api/pet   -H "Authorization: Bearer <token>"   -H "Content-Type: application/json"   -d '{"name":"Lucky","type":"dog"}'
```

### Создать вакцинацию
```bash
curl -X POST http://localhost:8080/api/vaccination   -H "Authorization: Bearer <token>"   -H "Content-Type: application/json"   -d '{"pet_id":1,"serial_number":"2BHHHHA8BB","vaccinated_at":"2025-09-19","valid_days":365}'
```
