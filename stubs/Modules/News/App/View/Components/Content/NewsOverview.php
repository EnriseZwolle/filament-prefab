<?php

declare(strict_types=1);

namespace App\View\Components\Content;

use App\Models\NewsItem;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\View\Component;
use Illuminate\View\View;

class NewsOverview extends Component
{
    public const AMOUNT_PER_PAGE = 6;

    public ?LengthAwarePaginator $newsItems;

    public function __construct()
    {
        $this->newsItems = NewsItem::visible()
            ->published()
            ->latest()
            ->paginate(self::AMOUNT_PER_PAGE);
    }

    public function render(): View
    {
        return view('components.content.news-overview');
    }
}
