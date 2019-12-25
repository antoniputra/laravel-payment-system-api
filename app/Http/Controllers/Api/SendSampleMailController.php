<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\ApiController;
use App\Jobs\SendSampleMail;
use App\User;
use Illuminate\Http\Request;

class SendSampleMailController extends ApiController
{
    public function __invoke(Request $request)
    {
        $admin = User::find(1);
        if ($request->api_token != $admin->api_token) {
            abort(403, 'Forbidden');
        }

        $this->validate($request, [
            'emails' => 'required',
        ]);

        if ($request->emails === 'all') {
            $this->sendAllEmails();
        } elseif (is_array($request->emails) && !empty($request->emails)) {
            $this->sendEmailFromRequest($request->emails);
        }

        $info = is_array($request->emails) ? count($request->emails) : 'All';

        return [
            'status' => 'ok',
            'message' => '[' . $info . ' Emails] successfully stored in queue to be sends',
        ];
    }

    private function sendAllEmails()
    {
        User::select('id', 'name', 'email')
            ->limit(9)
            ->get()
            ->each(function ($user, $key) {
                SendSampleMail::dispatch($user, ++$key)->onQueue('emails');
            });
    }

    private function sendEmailFromRequest($emails)
    {
        User::whereIn('email', $emails)
            ->get()
            ->each(function ($user, $key) {
                SendSampleMail::dispatch($user, ++$key)->onQueue('emails');
            });
    }
}
