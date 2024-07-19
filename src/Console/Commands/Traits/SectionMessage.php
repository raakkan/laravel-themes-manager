<?php

declare(strict_types=1);

namespace Raakkan\ThemesManager\Console\Commands\Traits;

trait SectionMessage
{
    public function sectionMessage($title, $message, $style = 'info'): void
    {
        $formattedLine = $this->getHelperSet()->get('formatter')->formatSection(
            $title,
            $message,
            $style
        );

        $this->line($formattedLine);
    }
}
