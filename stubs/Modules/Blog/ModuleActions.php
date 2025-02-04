<?php

declare(strict_types=1);

namespace EnriseZwolle\FilamentPrefabStubs\Modules\Blog;

use EnriseZwolle\FilamentPrefab\Console\PrefabCommand;

class ModuleActions
{
    public function execute(): void
    {
        $this->registerRoutes();
    }

    protected function registerRoutes(): void
    {
        $prefabCommand = app(PrefabCommand::class);

        $after = <<< 'AFTER'
            // RouteDefinitions
AFTER;

        $new = <<< 'NEW'
                Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/{blog:slug}', [BlogController::class, 'show'])->name('blog.show');
NEW;

        $prefabCommand->addToExistingFile(base_path('routes/web.php'), $new, $after);
    }
}
