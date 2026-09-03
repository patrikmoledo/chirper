<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Notes from the course

```shell
php --version
composer --version
node --version
npm --version

composer global require laravel/installer

laravel new chirper
cd chirper

composer run dev
```

main folders:

* app/Models
* app/Http/Controllers (Controllers)
* resources/views (Views)
* routes
* database

### Adding first route, making a layout
```php
Route::get('/', function () {
    return view('home');
});
```

```php
// views/components/layout.blade.php
<nav>
    <p>just an example</p>
</nav>

<main>
    {{ $slot }}
</main>

<footer>Footer</footer>
```

```html
<!-- views/home.blade.php -->
<x-layout>
    <x-slot:title>My page</x-slot:title>
    <p>The content here will be pasted in the layout {{ $slot }}. In x-slot:title we are passing an argument to $title. </p>
</x-layout>
```

### Deploying the app

```shell
git init
git add .
git commit -m "initial setup, first route, layout and home page"
gh repo create
gh browse
```
Use Laravel Cloud to create an App and select the laravel app that should be on Github.

Put Hibernation settings to sleep after 5 minutes to save up money with prototype apps.

"Add Resource" can be used to create a database. "Create and connect a database" → "Create new database cluster".

Save and Deploy after setting up everything.

When we push new changes to the Github Repository, Laravel Cloud automatically deploy the latest version

```php
// views/home.blade.php
<p class="mt-2 text-sm text-gray-600">Now this is live on the internet! 🎉</p>
```

```shell
git status
git add .
git commit -m "auto deployment test"
git push origin main
```

### MVC and First Controller example

```shell
php artisan make:controller
php artisan make:controller ChirpsController
php artisan make:controller ChirpsController --resources
```

```php
<?php
// adding a basic index function to app/Http/Controllers/ChirpsController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChirpsController extends Controller
{
    public function index()
    {
        return view('home');
    }
}
```

```php
<?php

use App\Http\Controllers\ChirpsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ChirpsController::class, 'index']);
```

```php
// updating the index function with sample data
public function index()
{
    $chirps = [
        [
            'author' => 'Jane Doe',
            'message' => 'Just deployed my first Laravel app! 🚀',
            'time' => '5 minutes ago'
        ],
        [
            'author' => 'John Smith',
            'message' => 'Laravel makes web development fun again!',
            'time' => '1 hour ago'
        ],
        [
            'author' => 'Alice Johnson',
            'message' => 'Working on something cool with Chirper...',
            'time' => '3 hours ago'
        ]
    ];

    return view('home', ['chirps' => $chirps]);
}
```

```html
<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        @foreach ($chirps as $chirp)
            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">
                    <div>
                        <div class="font-semibold">{{ $chirp['author'] }}</div>
                        <div class="mt-1">{{ $chirp['message'] }}</div>
                        <div class="text-sm text-gray-500 mt-2">{{ $chirp['time'] }}</div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout>
```

### Working with Databases

```shell
php artisan make:migration
php artisan make:migration create_chirps_table
```

```php
// ...
// added 2 columns: the foreignId("user_id) and string("message", 255)
public function up(): void
{
    Schema::create('chirps', function (Blueprint $table) {
        $table->id();
        $table->foreignId("user_id")->nullable()->constrained()->cascadeOnDelete();
        $table->string("message", 255);
        $table->timestamps();
    });
}
// ...
```

```shell
php artisan migrate

php artisan tinker
\DB::select('SELECT * from chirps');

\DB::table('chirps')->insert([
    'user_id' => null,  // Because we don't have a user, we can just leave it off
    'message' => 'My first chirp in the database!',
    'created_at' => now(),  // Laravel doesn't give these by default when using DB
    'updated_at' => now()
]);

\DB::table('chirps')->get();
exit
```

```shell
php artisan migrate:rollback # rolled back the chirps table creation and also its data
php artisan migrate
php artisan migrate:fresh # drops all tables and re-runs migrations (CAREFUL IN PROD)
```

### Our First Model

```shell
php artisan make:model
php artisan make:model Chirp
php artisan make:model Chirp -mrc
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chirp extends Model
{
    // adding this $fillable variable to protect against mass assignment
    protected $fillable = [
        'message',
    ];
}
```

```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    protected $fillable = [
        'message',
    ];

    // adding this association
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
```

```php
// app/Models/User.php

// ...
use Illuminate\Database\Eloquent\Relations\HasMany;

// adding association
public function chirps(): HasMany
{
    return $this->hasMany(Chirp::class);
}
// ...
```

```shell
php artisan tinker

$user = \App\Models\User::create(['name' => 'Patrik', 'email' => 'patrik@gmail.com', 'password' => bcrypt('password')]);  
$chirp = $user->chirps()->create(['message' => 'Eloquent makes working with database easy']);

echo $chirp->user->name; // "Eloquent Expert"
\App\Models\Chirp::all();
\App\Models\Chirp::latest()->get();
```

```php
//app/Http/Controllers/ChirpsController.php

// import the Chirp model
use app\Models\Chirp.php

class ChirpsController extends Controller
{
    public function index()
    {
        // remove the sample data and fetch from the db
        $chirps = Chirp::with('user') // prevents N+1 queries
            ->latest()
            ->take(50)
            ->get();

        return view('home', ['chirps' => $chirps]);
    }
    // ...
}
```

```html
<!-- updating the view: forelse/empty/endforelse, accessing the $chirp variable's data -->
<x-layout>
    <x-slot:title>
        Welcome
    </x-slot:title>
    <div class="max-w-2xl mx-auto">
        @forelse ($chirps as $chirp)
            <div class="card bg-base-100 shadow mt-8">
                <div class="card-body">
                    <div>
                        <div class="font-semibold"> {{ $chirp->user ? $chirp->user->name : 'Anonymous' }}</div>
                        <div class="mt-1">{{ $chirp->message }}</div>
                        <div class="text-sm text-gray-500 mt-2">
                            {{ $chirp->created_at->diffForHumans() }}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-gray-500">No chirps yet. Be the first to chirp!</p>
        @endforelse
    </div>
</x-layout>
```

```shell
# useful commands

Chirp::all();
Chirp::find(1);
Chirp::where('message', 'like', '%laravel&')->first();
Chirp::count();

$user->chirps;
$user->chirps()->create(['message' => 'Hello']);
$chirp->update(['message' => 'Updated message']);
$chirp->delete();

```

### Showing the feed

```html
<!-- resources/views/components/chirp.blade.php -->
@props(['chirp'])

<div class="card bg-base-100 shadow">
    <div class="card-body">
        <div class="flex space-x-3">
            @if($chirp->user)
                <div class="avatar">
                    <div class="size-10 rounded-full">
                    <img src="https://avatars.laravel.cloud/{{ ['62f9c343-20bc-4c10-9f6e-ded48a850b5c', '7cb0dfa8-246f-441c-95a8-f0e0e3b2d4d6?vibe=sunset', 'facae553-65ba-4fa9-975d-55ef659bc569?vibe=daybreak'][rand(0, 2)] }}" 
                         alt="{{ $chirp->user->name }}'s avatar"
                         class="rounded-full" />>

                    </div>
                </div>
            @else
                <div class="avatar placeholder">
                    <div class="size-10 rounded-full">
                        <img src="<https://avatars.laravel.cloud/f61123d5-0b27-434c-a4ae-c653c7fc9ed6?vibe=stealth>"
                        alt="Anonymous User"
                        class="rounded-full" />
                    </div>
                </div>
            @endif

            <div class="min-w-0">
                <div class="flex items-center gap-1">
                    <span class="text-sm font-semibold">{{ $chirp->user ? $chirp->user->name : 'Anonymous' }}</span>
                    <span class="text-base-content/60">·</span>
                    <span class="text-sm text-base-content/60">{{ $chirp->created_at->diffForHumans() }}</span>
                </div>

                <p class="mt-1">
                    {{ $chirp->message }}
                </p>
            </div>
        </div>
    </div>
</div>
```

```html
<!-- home.blade.php -->

 <x-layout>
    <x-slot:title>
        Home Feed
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>

        <div class="space-y-4 mt-8">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp" />
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            <p class="mt-4 text-base-content/60">No chirps yet. Be the first to chirp!</p>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
</x-layout>
```

```shell
php artisan make:seeder
php artisan make:seeder ChirpSeeder
```

```php
// database/seeders/ChirpSeeder.php

// ...
use App\Models\User;
use App\Models\Chirp;
// ...

// ...
public function run(): void
{
    $users = User::count() < 3
                ? collect([
                    User::create([
                        'name' => 'Patrik Moledo',
                        'email' => 'patrik@gmail.com',
                        'password' => bcrypt('password'),
                    ]),
                    User::create([
                        'name' => 'Bob Builder',
                        'email' => 'bob@gmail.com',
                        'password' => bcrypt('password'),
                    ]),
                    User::create([
                        'name' => 'Charlie Coder',
                        'email' => 'charlie@gmail.com',
                        'password' => bcrypt('password'),
                    ]),
                ])
                : User::take(3)->get();
    
    $chirps = [
        'Just discovered Laravel - where has this been all my life? 🚀',
        'Building something cool with Chirper today!',
        'Laravel\'s Eloquent ORM is pure magic ✨',
        'Deployed my first app with Laravel Cloud. So smooth!',
        'Who else is loving Blade components?',
        'Friday deploys with Laravel? No problem! 😎',
    ];

    foreach ($chirps as $message) {
        $users->random()->chirps()->create([
            'message' => $message,
            'created_at' => now()->subMinutes(rand(5, 1440)),
        ]);
    }

}

// ...
```

```shell
php artisan db:seed # didn't work
php artisan db:seed --class=ChirpSeeder
```