<?php

namespace App\Console\Commands;

use App\Models\Callback;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkExpiredRecords extends Command
{
    protected $signature = 'records:mark-expired';
    protected $description = 'Mark records as expired if they are older than 336 hours (14 days)';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'app:mark-expired-records';

    /**
     * The console command description.
     *
     * @var string
     */
//    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $expirationDate = Carbon::now()->subHours(336);

        Callback::where('created_at', '<=', $expirationDate)
            ->where('is_expired', false)
            ->update(['is_expired' => true]);

        $this->info('Expired records have been marked.');
    }
}
