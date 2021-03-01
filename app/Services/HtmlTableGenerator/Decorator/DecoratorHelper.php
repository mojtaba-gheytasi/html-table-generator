<?php

declare(strict_types=1);

namespace App\Services\HtmlTableGenerator\Decorator;

use Carbon\Carbon;
use Illuminate\Support\HtmlString;

trait DecoratorHelper
{
    protected function toHtml(string $html): HtmlString
    {
        return new HtmlString($html);
    }

    protected function changeDateTimeFormat(string $dateTime, string $format) : string
    {
        return Carbon::make($dateTime)->format($format);
    }

    protected function getHtmlStatus(int $status) : HtmlString
    {
        if ($status == 1) {
            return $this->toHtml('<span class="badge badge-rounded badge-success">Active</span>');
        }

        return $this->toHtml('<span class="badge badge-rounded badge-danger">Inactive</span>');
    }

    protected function toEmail($email) : HtmlString
    {
        return $this->toHtml("<a href='mailto:{$email}'>" . $email . "</a>");
    }
}
