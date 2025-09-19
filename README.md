# ZooClick API

Небольшое API для управления питомцами и вакцинациями.  
Проект написан на **Laravel 10** с использованием **Sanctum** для авторизации и **Swagger (L5-Swagger)** для документации.  
Использует **очереди Laravel** на базе **Redis** для фоновых задач.

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

Сгенерировать Swagger-документацию:

```bash
docker-compose exec app php artisan l5-swagger:generate
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

## ⚙️ Очереди и фоновые задачи

В проекте используется **Redis** в качестве драйвера очередей.  

### Джоба `DecrementValidDaysJob`
- Каждый день уменьшает поле `valid_days` у всех вакцинаций (не уходит ниже 0).  
- Запускается по расписанию через планировщик (`app/Console/Kernel.php`).  

### Сервисы в Docker
- **queue** — воркер очередей (`php artisan queue:work redis`)  
- **scheduler** — планировщик, который каждую минуту проверяет задания (`php artisan schedule:run`)  

### Запуск вручную
```bash
docker-compose exec app php artisan queue:work
docker-compose exec app php artisan schedule:run
```

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

---

## 🧪 Тесты

Для запуска тестов (используется `phpunit`):

```bash
docker-compose exec app php artisan test
```

Пример: `DecrementValidDaysTest` проверяет, что количество дней действия вакцинации корректно уменьшается и не уходит ниже нуля.
