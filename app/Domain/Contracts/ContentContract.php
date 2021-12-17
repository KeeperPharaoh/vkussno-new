<?php

namespace App\Domain\Contracts;

interface ContentContract
{
    public const SLIDER_TABLE = 'sliders';

    public const SLIDER_TITLE     = 'title';
    public const SLIDER_SUBTITLE  = 'subtitle';
    public const SLIDER_PRICE     = 'price';
    public const SLIDER_OLD_PRICE = 'old_price';

    public const BENEFITS_TABLE = 'benefits';

    public const BENEFITS_IMAGE       = 'image';
    public const BENEFITS_DESCRIPTION = 'description';

    public const ABOUT_COMPANIES = 'about_companies';

    public const ABOUT_TITLE        = 'title';
    public const ABOUT_DESCRIPTION  = 'description';

    public const FAQ = 'faqs';

    public const FAQ_TITLE        = 'title';
    public const FAQ_DESCRIPTION  = 'description';
}
