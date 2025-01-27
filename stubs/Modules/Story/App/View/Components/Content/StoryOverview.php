<?php

declare(strict_types=1);

namespace App\View\Components\Content;

use App\Models\Story;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class StoryOverview extends Component
{
    public const AMOUNT_PER_PAGE = 6;

    public ?LengthAwarePaginator $stories;

    public function __construct()
    {
        $this->stories = Story::visible()
            ->published()
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE);
    }

    public function render(): View
    {
        return view('components.content.story-overview');
    }
}
