<?php

namespace App\Console\Commands;

use App\Http\Controllers\UserController;
use App\Services\UserService;
use Illuminate\Console\Command;
use Illuminate\Http\Request;

class TestCommand extends Command
{

    public Request $request;
    public UserService $service;

    public function __construct(Request $request, UserService $service)
    {
        $this->request = $request;
        $this->service = $service;
        parent::__construct();
    }

    protected $signature = 'test';

    protected $description = 'test route';

    public function handle(): void
    {
        $this->info("Start action test");

        $result = (new UserController($this->service))->lucky($this->request);

        $this->info("The result is: $result");

        $this->info("End action test");
    }
}
