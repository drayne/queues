<?php

namespace App\Console\Commands;

use App\Http\Controllers\RabbitController;
use Illuminate\Console\Command;

class RabbitConsume extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:rabbitConsume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        //iako ne bi trebalo da pozivas kontroler
        $consumer = new RabbitController();
        $consumer->consume();
    }
}
