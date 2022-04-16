# Laravel Package Dropzone

Dropzone is a package that allows you to upload files associated with resources such as users, posts and whatever else
you want.

### 🔧 Installing in a Laravel project

See instructions at: [packages.ewvl.net/laravel-package-dropzone](https://packages.ewvl.net/laravel-package-dropzone)

```
composer require ewvlnet/dropzone
```

Add the FileTrait in the Models you want to work with dropzone, for example in a Model Post.

```
use Ewvlnet\Dropzone\Models\Traits\FileTrait;

class Post extends Model
{
    use HasFactory, FileTrait;

    /* ... Rest of the code... */
```

Create the migration file below in your project 2022_01_01_000008_create_files_table

This migration file must be run after migrations it references foreign, so in the example below where we use as foreign
of 'post_id' and 'user_id', we must be sure that these migrations have already been executed before, otherwise we will
get an error, when you run your migrations. Set the date in the filename so it always runs last.

```
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
         Schema::create('files', function (Blueprint $table) {
             $table->id();

             $table->unsignedBigInteger('user_id')->nullable();
             $table->unsignedBigInteger('post_id')->nullable();

             $table->string('name')->nullable();
             $table->string('type')->nullable();
             $table->string('url')->nullable();

             $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

             $table->timestamps();
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
         Schema::dropIfExists('files');
    }
}
```

Run the migration

```
php artisan migrate
```

In the dropzone-uploader.blade.php and dropzone-gallery.blade.php files, push('css') and push('js') are used, remember
to include this in your master layout to load the necessary scripts.

```
@stack('css')
@stack('js')
```

Now, you can include the blade component below in an edit.blade.php file for example.

```
<x-drozone-uploader mtype="post" ftype="image" :model="$post"/>
```

If you haven't already done so, run the command to publish the "symbolic link", to be able to see the images of the
storage folder.

```
php artisan storage:link
```

To display the gallery ( usually where you retrieve the model, such as a post.show.blade.php ).

```
<x-dropzone-gallery :model="$post"/>
```

If you want to associate other models to work with dropzone-uploader, just edit the migration file of the package,
adding more models in the table, as in the example below:

```
/**
* Adding Tags and Categories
*/

$table->unsignedBigInteger('tag_id')->nullable();
$table->unsignedBigInteger('category_id')->nullable();

$table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

```

Publish components and assets in your application and customize as you wish.

```
php artisan vendor:publish --provider="Ewvlnet\Dropzone\DropzoneServiceProvider
```

## 📄 License

[MIT](./LICENSE.md)

## Follow [ewvl.net](https://ewvl.net) ✌️ 👺 ✌️

