<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Asset;
use EONConsulting\Core\Services\Elastic\Elastic;

class AssetSearchController extends Controller
{
    /**
     * Elastic Client
     *
     * @var \EONConsulting\Core\Services\Elastic\Elastic
     */
    protected $elastic;

    public function __construct(Elastic $elastic)
    {
        $this->elastic = $elastic;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $assets = Asset::all();

        $content = $this->buildView($assets);

        return response()->json(['content' => $content], 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if($request->get('searchterm') == '')
        {
            $assets = Asset::all();

            $content = $this->buildView($assets);

            return response()->json(['content' => $content], 200);
        }

        $searchterm = "*" . $request->get('searchterm') . "*" ?? '*';

        $elastic_response = $this->elastic->index('assets')->body([
            'query' => [
                'query_string' => [
                    'query' => $searchterm
                ]
            ]
        ])->take(10)->get();

        if($elastic_response->total < 1)
        {
            $content = $this->buildView();

            return response()->json(['content' => $content], 200);
        }

        $items = collect($elastic_response->all());

        $assets = Asset::whereIn('id', $items->pluck('_id'))
            ->orderBy(\DB::raw('FIELD(`id`, '. $items->pluck('_id')->implode(',') .')'))
            ->get();

        $content = $this->buildView($assets);

        return response()->json(['content' => $content], 200);
    }

    /*
     * Build a view and return it
     */
    protected function buildView($assets = [])
    {
        if(count($assets) > 0)
        {
            return view('eon.content-builder::ajax-search.partials.assets', compact('assets'))->render();
        }

        return view('eon.content-builder::ajax-search.partials.no-results')->render();
    }
}