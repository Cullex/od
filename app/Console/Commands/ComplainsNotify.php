<?php

namespace App\Console\Commands;

use App\Complaint;
use App\Notifications\ComplaintNotify;
use App\User;
use Illuminate\Console\Command;

class ComplainsNotify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'complains:notify';

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
        Complaint::query()
            ->where('status' , '=','created')
            ->where('level' , '=' , 1)
            ->get()->each(function ($complaint){
            /** @var Complaint $complaint */
            $complaint->managers()->get()->each(function ($manager) use ($complaint){
                /** @var User $manager */
                $manager->notify( new ComplaintNotify($complaint));
            });
        });
    }
}
