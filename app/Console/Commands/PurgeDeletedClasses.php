<?php

namespace App\Console\Commands;

use App\Models\ClassModel;
use Illuminate\Console\Command;
use Carbon\Carbon;

class PurgeDeletedClasses extends Command
{
    protected $signature = 'app:purge-deleted-classes';

    protected $description = 'Permanently delete classes that were soft deleted over 10 days ago';

    public function handle()
    {
        $dateThreshold = Carbon::now()->subDays(10);

        $deletedClasses = ClassModel::onlyTrashed()
            ->where('status', 'deleted')
            ->where('deleted_at', '<', $dateThreshold)
            ->get();

        $count = $deletedClasses->count();

        if ($count === 0) {
            $this->info('No classes to permanently delete.');
            return 0;
        }

        foreach ($deletedClasses as $class) {
            $class->forceDelete();
        }

        $this->info("Successfully permanently deleted $count classes soft deleted more than 10 days ago.");

        return 0;
    }
}
