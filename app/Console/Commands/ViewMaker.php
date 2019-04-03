<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ViewMaker extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:view {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a view';

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
        $name = str_replace('.', '/', $this->argument('name'));
        $name =  __DIR__.'/../../../resources/views/'.$name.'.blade.php';
        if(!is_dir(dirname($name)))
        {
            mkdir(dirname($name));
        }
        file_put_contents($name, "@extends('layouts.web')\n@section('content')\n\n@endSection");
    }
}
