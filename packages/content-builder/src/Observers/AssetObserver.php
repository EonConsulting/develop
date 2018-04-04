<?php

namespace EONConsulting\ContentBuilder\Observers;

use EONConsulting\ContentBuilder\Models\Asset;
use Illuminate\Support\Facades\Log;
use EONConsulting\Core\Services\Elastic\Elastic;
use Exception;

class AssetObserver
{

    /**
     * Elastic Client
     *
     * @var \EONConsulting\Core\Services\Elastic\Elastic
     */
    protected $elastic;

    /*
     * Asset Observer
     *
     * @param \EONConsulting\Core\Services\Elastic\Elastic $elastic
     */
    public function __construct(Elastic $elastic)
    {
        $this->elastic = $elastic;
    }

    /*
     * Fire when saving na Asset
     *
     * @param \EONConsulting\ContentBuilder\Models\Asset $asset
     * @return bool
     */
    public function saved(Asset $asset)
    {
        if($asset->wasRecentlyCreated == true)
        {
            return true;
        }

        $categories = $asset->categories()->pluck('name')->implode(",");

        $entry = [
            "id" => $asset->id,
            "title" => $asset->title,
            "content" => $asset->content,
            "description" => $asset->description,
            "tags" => $asset->tags,
            "categories" => $categories
        ];

        try {

            $response = $this->elastic->type("external")
                ->index("assets")
                ->id($asset->id)
                ->update($entry);

        } catch(Exception $e)
        {
            return $this->logDebug($e, 'Unable to Update Entry in Elastic');
        }
    }

    /*
     * Fire when deleting na Asset
     *
     * @param \EONConsulting\ContentBuilder\Models\Asset $asset
     * @return bool
     */
    public function deleted(Asset $asset)
    {
        try {

            $response = $this->elastic->type("external")
                ->index("assets")
                ->id($asset->id)
                ->delete();

        } catch(Exception $e)
        {
            return $this->logDebug($e, 'Unable to Delete Entry in Elastic');
        }
    }

    /**
     * Helper Function to log a error and return true so the modal action will continue
     *
     * @param \Exception $exception
     * @param string $message
     * @return bool
     */
    protected function logDebug(Exception $exception, $message = '')
    {
        if($message)
        {
            Log::debug('AssetObserver: ' . $message);
        }

        Log::debug($e->getMessage());

        return true;
    }
}