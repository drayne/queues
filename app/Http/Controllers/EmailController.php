<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmailJob;
use App\Mail\SendMailable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function index()
    {
        $i = 0;
        while($i < 30){
            $this->sendEmailJob();
            $i++;
        }
        echo 'emails sent';
    }

    public function sendEmail()
    {
//        $emailJob = (new SendEmailJob())->delay(Carbon::now()->addSeconds(3));
//        $this->dispatch($emailJob);
        SendEmailJob::dispatch()->delay(Carbon::now()->addSeconds(30));
    }

    public function sendEmailJob()
    {
        SendEmailJob::dispatch()->onQueue('emails');
    }

}
