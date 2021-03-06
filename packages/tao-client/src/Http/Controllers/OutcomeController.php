<?php

namespace EONConsulting\TaoClient\Http\Controllers;

use App\Http\Controllers\Controller;
use EONConsulting\TaoClient\Models\TaoResult;
use EONConsulting\TaoClient\Services\TaoOutcome;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use EONConsulting\TaoClient\Exceptions\TaoOutcomeException;
use EONConsulting\TaoClient\Jobs\TaoResultJob;
use EONConsulting\Notifications\Notifications\TaoOutcome as NotificationTaoOutcome;
use Auth;
use Log;

class OutcomeController extends Controller
{
    /**
     * OutcomeController constructor.
     */
    public function __construct()
    {
        \Debugbar::disable();
    }

    /**
     * Store Tao outcome results
     */
    public function store()
    {

        try {

            $outcome = TaoOutcome::handle();

        } catch(TaoOutcomeException $e)
        {
            Log::debug($e->getMessage());
            return response()->json(['status' => $e->getMessage()], 422);
        }

        if( ! $source_id = $outcome->getSourcedId())
        {
            Log::debug('TaoOutcome: Failed getting the source id!');
            return response()->json(['status' => 'Failed'], 422);
        }

        try {

            $result = TaoResult::bySourceId($source_id)->byPendingOutcome()->firstOrFail();

        } catch(ModelNotFoundException $e)
        {
            Log::debug('TaoResult: | ' . $e->getMessage());
            return response()->json(['status' => 'TaoResult: | ' . $e->getMessage()], 422);
        }

        $result->status = 1;
        $result->status_message = 'Outcome results captured';
        $result->score = $outcome->getResult();

        $result->save();

        if( $user = $result->user)
        {
            $user->notify(
                new NotificationTaoOutcome($outcome->getResult())
            );
        }

        Log::info('Received outcome for reference ' . $source_id);

        TaoResultJob::dispatch($result);
    }

    /**
     * Return page showing test was completed
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('tao-client::return');
    }


}