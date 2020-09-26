<?php

namespace App\Jobs;

use App\Repositories\EloquentLink;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddStatistic implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    /**
     * @var EloquentLink
     */
    private $linkRepository;
    private $request;
    private $link;

    /**
     * Create a new job instance.
     *
     * @param EloquentLink $linkRepository
     * @param $link
     * @param $request
     */
    public function __construct(EloquentLink $linkRepository, $link, $request)
    {
        $this->link = $link;
        $this->request = $request;
        $this->linkRepository = $linkRepository;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->linkRepository->addStatistic($this->link, $this->request);
    }
}
