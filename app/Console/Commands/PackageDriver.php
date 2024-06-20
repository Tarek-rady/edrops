<?php

namespace App\Console\Commands;

use App\Models\Driver;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class PackageDriver extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:trip';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check Driver Go TO Trip Or NO';

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
     * @return int
     */
    public function handle()
    {
        $drivers = Driver::where('package_id', 2)->get();

        foreach ($drivers as $key => $driver) {
            $trip = $driver->trips()->whereDate('created_at', today())->get();
            
            if ($driver->count_day > 0 & $trip->isNotEmpty()) {
                $driver->update(['count_day' => $driver->count_day - 1]);
            } else {
                $driver->update(['package_id' => null]);
            }

        }
        
    }
}
