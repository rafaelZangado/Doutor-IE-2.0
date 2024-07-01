<?php

namespace App\Jobs;

use App\Services\IndicesServices;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ImportarIndicesXMLJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $livroId;
    protected $xmlData;

    /**
     * Create a new job instance.
     *
     * @param int $livroId
     * @param string $xmlData
     * @return void
     */
    public function __construct(int $livroId, string $xmlData)
    {
        $this->livroId = $livroId;
        $this->xmlData = $xmlData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $indicesService = resolve(IndicesServices::class);
        $indicesService->importarIndices($this->livroId, $this->xmlData);
    }
}
