<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $messages = Message::whereIn('id', function ($query) {
                        $query->selectRaw('MAX(id)')
                              ->from('messages')
                              ->whereColumn('messages.sender_id', 'm.sender_id') // Ensures it's the latest for each sender
                              ->whereColumn('messages.receiver_id', 'm.receiver_id');
                    })
                    ->from('messages as m')
                    ->where('m.receiver_id', Auth::id())
                    ->where('m.status', 0)
                    ->with('sender') // Load sender details
                    ->orderBy('m.created_at', 'desc')
                    ->get();

                $view->with('headerMessages', $messages);
            }
        });
    }
}
