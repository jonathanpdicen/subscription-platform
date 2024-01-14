# Subscription Platform

Jonathan Dicen - Laravel Tech Assessment

### Setup
1. cp .env.example .env
2. composer install
3. php artisan key:generate
4. php artisan migrate
5. php artisan db:seed (will insert 10 records of dummy websites)
6. Once the project is running, you can test the endpoints below using a tool like Postman. I have also included an exported Postman file.

### Endpoints
- GET /api/v1/websites to include posts you can use /api/v1/websites?include=posts
- GET /api/v1/websites/{website} to include reviews you can use /api/v1/websites/{website}?include=posts
- POST /api/v1/websites
- PUT /api/v1/websites/{website}
- DELETE /api/v1/websites/{website}

- POST /api/v1/websites/{website}/posts
- PUT /api/v1/posts/{post}/publish

- POST /api/v1/websites/{website}/subscribe
