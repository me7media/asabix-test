## Run App

- Clone repository
- Enter app dir `cd` to dir
- Run `composer install`
- To raise mysql run in console `docker-compose up -d`
- Run `cp .env.example .env`
- Run `php artisan migrate:refresh --seed` to create tables
- Run app `php artisan serve`
- Open in browser link from console, example `http://127.0.0.1:8000`

## Routs and Data
>Create (http POST method) or Update (PUT method and uri {id}) Post with languages relations 3 for creating 1-3 for updating:
> 
>.../api/v1/posts/{id}
> 
>`Post data:`
>
> ``` 
> { 
> "data": {
>"UA": {
>"title": "ua_title",
>"description": "ua_description",
>"content": "ua_content"
>},
>"RU": {
>"title": "ru_title",
>"description": "ru_description",
>"content": "ru_content"
> },
>"EN": {
>"title": "en_title",
>"description": "en_description",
>"content": "en_content"
> }
>   }
> }
 >```
> Success status code: 201/202
> 
To receive validation error messages use headers on client:

`Content-Type:application/json`
`Accept:application/json`

> Receive all Posts (GET method) or one by add post {id} to uri
> 
> .../api/v1/posts/{id}
> 
> Get data:
> 
> ``` 
> { 
> "data": {
>"id": 1,
>"post_translations": {
>"UA": {
>"title": "ua_title",
>"description": "ua_description",
>"content": "ua_content"
>},
>"RU": {
>"title": "ru_title",
>"description": "ru_description",
>"content": "ru_content"
> },
>"EN": {
>"title": "en_title",
>"description": "en_description",
>"content": "en_content"
> }
>   }
> }
 >```
> Success status code: 200


> Soft deleting Post by http DELETE method
> .../api/v1/posts/{id}
> Success status code: 204
