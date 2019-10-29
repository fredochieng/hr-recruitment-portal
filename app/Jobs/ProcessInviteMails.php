<?php

namespace App\Jobs;

use App\Notifications\PanelistInviteNotification;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;

class ProcessInviteMails implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $title = 'Interview Invite';
        $invites = DB::table('interview_invites')
            ->select(
                DB::raw('interview_invites.*')
            )
            ->where('interview_invites.delivered', '=', '0')
            ->limit(40)
            ->get();

        //dd($invites);

        if ($invites) {
            $now = Carbon::now('Africa/Nairobi');
            Log::info("MAIL SENDING FOR BATCH STARTED AT " . $now);

            foreach ($invites as $key => $value) {
                try {
                    // dd($title);
                    Mail::to($value->panelist_email)->send(new PanelistInviteNotification($value->panelist_name, $title, $value->message));
                } catch (Swift_TransportException $e) {
                    \Log::emergency("File:" . $e->getFile() . "Line:" . $e->getLine() . "Message:" . $e->getMessage());
                }

                $send_mail = array(
                    'delivered' => '1'
                );

                // $send_message = DB::table('interview_invites')->where('id', $value->id)
                //     ->update($send_mail);

                Log::info("Mesaage template id " . $value->id . " sent to " . $value->panelist_email . " at " . $now);
            }
            Log::info("MAIL SENDING FOR BATCH FINISHED AT " . $now);
        }
    }
}