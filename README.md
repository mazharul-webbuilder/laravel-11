<h2>What's new in Laravel 11</h2>
<hr/>
<ul>
<li>We can define where our application load view from, run command php artisan
    config:publish type or select view. you will find a view.php file inside
    config folder. In paths array you can specify your views file path. you can add multiple
    paths
</li>
<li>
    In laravel 11 custom service providers
    will auto registered by laravel itself. Just create a service provider using
    artisan command and use it. If you dont create service provider by artisan command 
    you can register it manually to Bootstrap/providers.php
</li>
<li>
    In laravel 11, by default there is no middleware, where in previous version laravel 10 or lesser they
    had 9 default middleware on http/middleware folder. Laravel shift those middleware to 
    foundation level, that means we can't directly modify those middleware. To do so, go to
    App/Providers/AppServiceProvider.php file on boot method 
    <pre>
        TrimStrings::except(['secret']); // for remote white space form all input except
        RedirectIfAuthenticated::redirectUsing(fn($request) => route('dashboard')); 
    </pre>
</li>
<li>
    There is not Http Kernal in new laravel 11, so how we can register custom middleware, to do so
    go to bootstap/app.php file, 
    <pre>
        ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(
            append: [\App\Http\Middleware\LogRequestEndpoint::class],
            prepend: [\App\Http\Middleware\AddMiddlewareToPrependMiddleware::class]
        )
        $middleware->api(
            append: [],
            prepend: []
        );
    })
    </pre>
    appended item with add to beginning of array and prepended item will add at the end of list
</li>
<li>
    In laravel 11 there is no Exception/handler.php file. to register exception
    go to bootstrap/app.php and do like this as earlier version
    <pre>
        // Customize ValidationException response  Custom Request Class
        $exceptions->renderable(function (ValidationException $exception){
            return response()->json([
                'status' => false,
                'message' => 'Validation Error',
                'data' => null,
                'errors' => $exception->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        });
    </pre>
</li>
<li>
    In Laravel 11 all custom command will automatically register and 
    we can Schedule task direct from console.php file lived in routes folder.
</li>
<li>
    Be default there is no api.php file. To work with api run artisan command
    php artisan api:install it will install sanctum as a default api provider
</li>
<li>Default laravel 11 database driver is sqlite. You can change it immediately</li>
<li>Laravel 11 add new feature Dumpable trait. which allow us to add new custom method
    method on it.
</li>

</ul>
