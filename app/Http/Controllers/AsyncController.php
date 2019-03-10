<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Spatie\Async\Pool;

class AsyncController extends Controller
{
    /*
     * ne radi na windows-u
     */
    public function spatie($things)
    {
        $pool = Pool::create();

        foreach ($things as $thing) {
            $pool->add(function () use ($thing) {
                echo $thing;
            })->then(function ($output){
                $this->guzzle(); //probno
            })->catch(function (\Throwable $exception) {
                //handle exception
            }) ;
        }
    }

    public function guzzle()
    {
        $client = new Client();
        $request = new \GuzzleHttp\Psr7\Request('GET', 'https://reqres.in/api/users?page=2');

        $promise = $client->sendAsync($request)->then(function ($response){
           echo 'I completed:' . $response->getBody();
        });
        echo 'have not yet completed <br>';
        echo 'have not yet completed <br>';
        sleep(2);
        $promise->wait();
    }
}
