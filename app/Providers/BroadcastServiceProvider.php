<?php

namespace App\Providers;

use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Đăng ký route xác thực broadcasting (bắt buộc)
        Broadcast::routes(['middleware' => ['auth:api']]);

        // Load file định nghĩa các channel
        require base_path('routes/channels.php');
    }
}
