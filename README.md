# PHP_Laravel12_Searchable
```php
- Laravel 12 based project demonstrating Browser-Based Search functionality
  using Spatie Laravel Searchable package with Blade UI.
```
# Step 1: Install Laravel 12 – Create Project
Open Terminal / CMD:
```php
composer create-project laravel/laravel:^12.0 PHP_Laravel12_Searchable
```
Move to project folder:
```php
cd PHP_Laravel12_Searchable
```
Generate application key:
```php
php artisan key:generate
```
# Explanation
```php
- Laravel uses an application key for encryption and security.
- Without APP_KEY, sessions and encrypted data will not function properly.
```
# Step 2: Setup Database (.env File)
Open .env file and configure database credentials:
```php
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel12_searchable
DB_USERNAME=root
DB_PASSWORD=
```
Create database in MySQL:
```php
CREATE DATABASE laravel12_searchable;
```
Run default migrations:
```php
php artisan migrate
```
# Explanation
```php
- This step verifies database connectivity
- Default Laravel tables are created successfully
- Ensures environment setup is correct
```
# Step 3: Install Spatie Laravel Searchable Package
Install the package:
```php
composer require spatie/laravel-searchable
```
# Explanation
```php
- Provides a clean abstraction for search functionality
- Supports searching across multiple models
- Widely used in real-world production Laravel projects
```

# Step 4: Create Searchable Model (Post)
Create model with migration:
```php
php artisan make:model Post -m
```
Migration file
```php
database/migrations/xxxx_xx_xx_create_posts_table.php
```
```php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('posts', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->text('content');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
```
Run migration:
```php
php artisan migrate
```

# Step 5: Make Model Searchable
Path:
```php
app/Models/Post.php
```
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Post extends Model implements Searchable
{
    protected $fillable = ['title', 'content'];

    public function getSearchResult(): SearchResult
    {
        return new SearchResult(
            $this,
            $this->title,
            route('posts.show', $this->id)
        );
    }
}
```
# Step 6: Create Search Controller
Create controller:
```php
php artisan make:controller SearchController
```
```php
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use App\Models\Post;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function create()
{
    return view('search.create');
}

public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'content' => 'required',
    ]);

    \App\Models\Post::create($request->only('title', 'content'));

    return redirect('/')->with('success', 'Post created successfully');
}


    public function search(Request $request)
    {
        $searchResults = (new Search())
            ->registerModel(Post::class, ['title', 'content'])
            ->search($request->search);

        return view('search.index', compact('searchResults'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('search.show', compact('post'));
    }
}
```
# Step 7: Define Web Routes
Path:
```php
routes/web.php
```
```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [SearchController::class, 'index']);
Route::get('/search', [SearchController::class, 'search'])->name('search');
Route::get('/post/{id}', [SearchController::class, 'show'])->name('posts.show');

Route::get('/posts/create', [SearchController::class, 'create']);
Route::post('/posts/store', [SearchController::class, 'store'])->name('posts.store');
```
# Step 8: Blade UI
Folder structure:
```php
resources/views/
 ├─ layouts/
 │   └─ app.blade.php
 ├─ components/
 │   ├─ navbar.blade.php
 │   └─ footer.blade.php
 └─ search/
     ├─ index.blade.php
     ├─ create.blade.php
     └─ show.blade.php
```
# Explanation
```php
- Layout-based architecture
- Reusable UI components
- Clean and scalable for real projects
```
# Step 9: Run Laravel Project
Run development server:
```php
php artisan serve
```
Open browser:

Search page:
```php
http://127.0.0.1:8000/search
```
<img width="1268" height="575" alt="image" src="https://github.com/user-attachments/assets/d58e5bbb-6614-4910-8bf0-1a85e7809f6d" />

Create post page:
```php
http://127.0.0.1:8000/posts/create
```
<img width="1322" height="619" alt="image" src="https://github.com/user-attachments/assets/4715dc5e-8291-450f-903b-3f6dccc3b398" />

# Project Folder Structure
```php
PHP_Laravel12_Searchable
├── app
│   ├── Http
│   │   └── Controllers
│   │       └── SearchController.php
│   └── Models
│       └── Post.php
│
├── database
│   └── migrations
│       └── create_posts_table.php
│
├── resources
│   └── views
│       ├── layouts
│       │   └── app.blade.php
│       ├── components
│       │   ├── navbar.blade.php
│       │   └── footer.blade.php
│       └── search
│           ├── index.blade.php
│           ├── create.blade.php
│           └── show.blade.php
│
├── routes
│   └── web.php
│
├── .env
├── artisan
```

