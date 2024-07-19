<?php

declare(strict_types=1);

namespace Raakkan\ThemesManager\Console\Commands;

use Raakkan\ThemesManager\Console\Commands\Traits\SectionMessage;
use Raakkan\ThemesManager\Facades\ThemesManager;
use Illuminate\Console\Command;

class ClearCache extends Command
{
    use SectionMessage;

    /**
     * The console command name.
     */
    protected $name = 'theme:cache:clear';

    /**
     * The console command description.
     */
    protected $description = 'Clear themes cache';

    /**
     * Prompt for module's alias name.
     */
    public function handle(): void
    {
        if (ThemesManager::clearCache()) {
            $this->sectionMessage('Themes Manager', 'Themes cache cleared succefully');
        } else {
            $this->error('An error occured while clearing themes cache');
        }
    }
}
