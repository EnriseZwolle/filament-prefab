<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Label;
use App\Models\Page;
use App\Models\Blog;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class BlogOverview extends Component
{
    use WithPagination;

    public const AMOUNT_PER_PAGE = 6;

    public Page|Model $blogOverviewPage;

    public function mount()
    {
        $this->blogOverviewPage = Label::getModel('blog-overview');
    }

    protected function getBlogs(): LengthAwarePaginator
    {
        return Blog::query()
            ->visible()
            ->published()
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE);
    }

    public function render(): View
    {
        return view('livewire.blog-overview', [
            'blogs' => $this->getBlogs()
        ]);
    }
}
