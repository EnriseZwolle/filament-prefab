# Prefab

Use this template to scaffold a new website

## Installation

1. Create a new project `laravel new project-name`
2. clone this repository
3. update the `composer.json` of your new project and change minimum stability to dev: `"minimum-stability": "dev",`
4. `composer require enrisezwolle/filament-prefab`
5. Install all modules:
- `php artisan prefab:filament --module=base --force`
  - be patient with the shell script, force is required to overwrite the user model
- `php artisan prefab:filament --module=blog`
- `php artisan prefab:filament --module=news`
- `php artisan prefab:filament --module=story`
- `php artisan prefab:filament --module=employee`
- `php artisan prefab:filament --module=form-builder`
- `php artisan prefab:filament --module=service`
- `php artisan prefab:filament --module=location`
- `php artisan prefab:filament --module=vacancy`
- `php artisan prefab:filament --module=job-alert`
- `php artisan prefab:filament --module=socials`
- NOTE: When updating modules after their initial rollout add `--force` to override local files. Additionally `--no-shell` can be added to prevent shell commands from being executed to speed up rolling out updates.
6. `composer dump`
7. `php artisan migrate`
8. Create a user `php artisan make:filament-user` and follow the prompts
9. `php artisan db:seed`
10. open `docker-compose.yml` and replace the container_name with a name of this project
11. `docker compose up -d`
12. `npm install && npm run dev`

### How to use search
1. Add the `IsSearchable` interface to the model
2. Implement the required methods. Your IDE will inform you when adding the interface.
3. Add the `use Searchable` trait to the model
4. Add the config to `searchable.php` config by adding it to the `models` array where the key is the model and the value is an array with the searchable columns
5. Modules can also be specified in the `modules` section in `searchable.php`. Here the key is the relation name and the value an array of searchable fields. To search a module on a model add the name of the resource to the model array like you would add a column
6. In the example below the page searches in the columns `name` and `content`, as well as the module `heroImage`, for which the columns `title` and `content` are searchable
```php
'models' => [
    Page::class => [
        'name',
        'content',
        'heroImage',
    ],
],

'modules' => [
    'heroImage' => [
        'title',
        'content',
    ],
],
```

### Elasticsearch

The search module makes use of elasticsearch, please make sure `SCOUT_DRIVER` is set to `elastic` in your `.env`

To sync models to elastic run `php artisan search:sync`.

This project also contains a docker file which can be executed using laravel sail. The default port for elastic in this docker file is 9298. To allow your local project to communicate with this docker file add `ELASTIC_HOST=localhost:9298` to your `.env`


### How to use Hero Images
1. add the `use Heroable` trait to the model
2. add `static::$model::heroableFields(),` to the form fields in the resource

### How to use Employees
1. add the `use Employeeable` trait to the model
2. add `static::$model::employeeableFields(),` to the form fields in the resource

### How to use Seoable en Ogable
1. add the `use Seoable`trait to the model
2. add `static::$model::seoFields(),` to the form fields in the resource

### How to use Labels
1. add the `use Labelable` trait to the model
2. add `static::$model::labelableFields(),` to the form fields in the resource

### How to use menus
1. Implement `App/Contracts/Menuable` on models that should be able to be linked in menus.
2. Implement required methods
3. Available resources will be auto detected by the menu item resource

### How to use icon picker
1. create a folder in  `/resources/images/svg` (if this folder is empty it will not be committed, so add atleast 1 icon)
2. Place all the SVGs voor de icons you want in this folder (make sure the name of the file is prefixed with `icon-`)
3. add the IconPicker to a resource (with preload):
```php
IconPicker::make('icon')
    ->preload()
```
4. in the blade use `<x-icon :name="$model->icon" />` to get the icon

### How to use titles and slugs
1. For titles and slugs we use a forked and self-hosted project [filament-title-with-slug](https://github.com/MotivoZwolle/filament-title-with-slug)
2. On forms use the `TitleWithSlugInput` form component. This will handle both the title and the slug. Both fields are required and the slug field validates if it is unique.
3. For more documentation checkout [the motivo repository](https://github.com/MotivoZwolle/filament-title-with-slug)

### How to use blocks module
1. Simple add `BlockModule::make('content')` to any resource, where the param is the name of the column which stores the data.
2. Add `'content' => 'array'` to the casts of the model
3. New blocks can be created by making a new class in the `App/Filament/Plugins/Blocks` directory and extending the `BaseBlock` model
4. New blocks can be registered in the `active` array in the `blocks.php` config file
5. There is also a toggle content field, which can have nested fields. These are registed in the `toggle_content` array in the `blocks.php` config
6. You can also create your own set of blocks.
   1. First create a new array in the `blocks.php` config file. The key of this array is not restricted.
   2. When adding the block module to the resource you can specify a second parameter, which is the key of the array from the previous step, for example `BlockModule::make('content', 'form-builder')`

### How to use form module
1. The form module is build on top of the blocks module
2. Adding a new form can be done by creating a new form block, extending the `FormBlock` class
3. Blocks can be registered in the `form` array in the `blocks.php` config file.

### How to use input components
1. Input components can be used to simply add a styled input to the front-end
2. These components have some required fields that need to be sent alongside the component:
   1. name (the name of the input)
   2. title (the title that the label will use)
   3. errors (just the $errors from the parent can be sent here)
3. Some components require other information like options. These options are expected to be formatted as [label => value]
4. Below is a list of all components:
   1. checkbox
   2. radio
   3. select
   4. submit
   5. text
   6. textarea

### Front-end
1. visit `/blog` for a blog overview
2. visit `/blog/{blog:slug}` for the show page of a blog

### Settings
1. For settings we use the [spatie plugin](https://filamentphp.com/plugins/filament-spatie-settings).
2. Optional: add the filament page to the correct navigation group `protected static ?string $navigationGroup = 'settings';`
3. Add the settings to view composer in `AppServiceProvider` to access variables in blade

### Generating a sitemap
1. When wanting to generate a sitemap, you need to add de model to the sitemap config file under key "models"
2. The model must have a getRoute() function where the route is defined
3. When all models are added, run the "app:generate-sitemap" command in the terminal

### Biggest Todos:
- [x] Update naar Laravel 11
- [x] slugs
- [x] redo SEO as field instead of trait (?)
- [x] Cookie consent `Base module`
- [x] Something formbuilder-like (alternative methods?) (https://filamentphp.com/plugins/lara-zeus-bolt)? `Contact module`
- [x] Blocks module (WIP) `Blocks module`
- [ ] Email sending (?) `Job Alert`
- [x] Search functionalities `Search Module`
- [ ] Donation module
- [x] Redirects en dead-link tracker
- [x] Add route for home
- [x] Translations

### "Copypaste" Todos:
- [x] Employee
- [x] Location
- [x] News
- [x] Service
- [x] Story
- [x] Vacancy
- [x] Settings
- [ ] Toptasks


## dependencies:
- `filamentphp/filament`
- `awcodes/filament-curator` (media manager)
- `solution-forest/filament-tree` (menu builder)
- `spatie/laravel-sitemap` (sitemap generation)
