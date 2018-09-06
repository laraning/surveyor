<?php

namespace Laraning\Surveyor\Commands;

use Illuminate\Console\Command;

class MakeNovaLinkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'surveyor:nova-link';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a symlink between Surveyor and Nova to add the Resources.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('');
        $this->info('');
        $this->info('*** SURVEYOR - Create symlink to add Surveyor Resources. ***');
        $this->info('');

        $this->laravel->make('files')->link(
            base_path(path_separators('vendor/laraning/surveyor/app/Nova/Surveyor')),
            app_path('Nova/Surveyor')
        );

        $this->info('Symlink created.');
        $this->info('All done!');
    }
}
