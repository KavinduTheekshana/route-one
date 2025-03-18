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
                $query = Message::whereIn('id', function ($query) {
                        $query->selectRaw('MAX(id)')
                              ->from('messages')
                              ->whereColumn('messages.sender_id', 'm.sender_id')
                              ->whereColumn('messages.receiver_id', 'm.receiver_id');
                    })
                    ->from('messages as m')
                    ->where('m.status', 0) // Unread messages
                    ->with('sender') // Load sender details
                    ->orderBy('m.created_at', 'desc');

                // Check if the user is not a super admin
                if (Auth::user()->user_type !== 'superadmin') {
                    $query->where('m.receiver_id', Auth::id());
                }

                $messages = $query->get();
                $view->with('headerMessages', $messages);
            }

        });
    }
}
