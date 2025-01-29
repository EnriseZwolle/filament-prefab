<?php

declare(strict_types=1);

namespace App\Livewire;

use App\Models\Label;
use App\Models\Page;
use App\Models\Story;
use App\Models\StoryCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Builder;

use Livewire\Component;
use Livewire\WithPagination;

class StoryOverview extends Component
{
    use WithPagination;

    public const AMOUNT_PER_PAGE = 6;

    public Page|Model $storyOverviewPage;

    public array $categories = [];

    public Collection $storyCategoryFilters;

    protected $queryString = [
        'categories' => [
            'as' => 'categorieen',
        ]
    ];

    public function mount()
    {
        $this->storyOverviewPage = Label::getModel('story-overview');

        $this->storyCategoryFilters = StoryCategory::query()
            ->whereHas('stories', fn($builder) => $builder->visible()->published())
            ->get();
    }

    public function updatedCategories(): void
    {
        $this->categories = collect($this->categories)
            ->filter(fn(bool $category) => $category === true)
            ->toArray();

        $this->resetPage();
    }

    protected function getStories(): LengthAwarePaginator
    {
        $storyCategories = array_keys($this->categories);

        return Story::query()
            ->visible()
            ->published()
            ->when(count($storyCategories), fn(Builder $builder) => $builder->whereIn('story_category_id', $storyCategories))
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE);
    }

    public function render(): View
    {
        return view('livewire.story-overview', [
            'stories' => $this->getStories()
        ]);
    }

    public function hasStoryCategory(int $storyCategoryId): bool
    {
        return array_key_exists($storyCategoryId, $this->categories);
    }
}
