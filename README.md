# Documentación
## END POINTS
`End point:` _http://127.0.0.1:8000/api/posts/_
`Method:` **GET**
`Description:` Get all post
`Payload:` **NA**

`End point:` _http://127.0.0.1:8000/api/posts/_
`Method:` **POST**
`Description:` Create a post
`Payload:` 
```json
{
    "userId": number,
    "id": number,
    "title": string,
    "body": string
}
```

`End point:` _http://127.0.0.1:8000/api/posts/{id}_
`Method:` **PUT**
`Description:` Edit a post
`Payload:` 
```json
{
    "userId": number,
    "id": number,
    "title": string,
    "body": string
}
```

`End point:` _http://127.0.0.1:8000/api/posts/{id}_
`Method:` **DELETE**
`Description:` Delete a post
`Payload`: NA


## Correr el proyecto
- Ingresar a la carpeta del proyecto y correr ```composer install```
- correr ```composer require laravel/ui```
- correr ```php artisan ui vue```
- Correr ```npm install```
- Correr ```php artisan key:generate```
- Correr ```npm run watch```
- Correr ```php artisan serve```
- Navegar a ```http://127.0.0.1:8000/```



