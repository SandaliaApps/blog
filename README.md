## Blog Application

### To install run the following commands
1. `git clone https://github.com/delower186/blog.git`
2. `cd blog`
3. `composer install`
4. `npm install`
5. `npm run build`
6. `php artisan key:generate`
> rename .env.example file to .env
> Configure database details in the .env file
7. `php artisan migrate`
8. `php artisan serve`

### Api endpoints
> all request should contain `Authorization:"Bearer {token}"` including `logout` endpoints
* `/api/v1/login`
> form-data [email,password]
* `/api/v1/register`
> form-data [name,email,password]
* `/api/v1/logout`
* `api/v1/blogs` method=get
* `api/v1/blogs` method=post
> form-data [name,body,tags,user_id]
* `api/v1/blogs/{blog_id}` method=patch
> form-data [name,body,tags,user_id,updated_by]
* `api/v1/blogs/{blog_id}` method=delete
* `api/v1/blogs/{blog_id}` method=get