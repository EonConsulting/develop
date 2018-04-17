<?php

namespace EONConsulting\ContentBuilder\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use EONConsulting\ContentBuilder\Models\Content;
use EONConsulting\Core\Services\Elastic\Elastic;

class ContentSearchController extends Controller
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
    public function index(Request $request)
    {
        $content_items = Content::all();
        $is_content_builder = $request->get('is_content_builder');

        $content = $this->buildView($content_items, $is_content_builder);

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
            $content_items = Content::all();

            $content = $this->buildView($content_items);

            return response()->json(['content' => $content], 200);
        }

        $searchterm = "*" . $request->get('searchterm') . "*" ?? '*';

        $elastic_response = $this->elastic->index('content')->body([
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

        $content_items = Content::whereIn('id', $items->pluck('_id'))
            ->orderBy(\DB::raw('FIELD(`id`, '. $items->pluck('_id')->implode(',') .')'))
            ->get();

        $is_content_builder = $request->get('is_content_builder');

        $content = $this->buildView($content_items, $is_content_builder);

        return response()->json(['content' => $content], 200);
    }

    /*
     * Build a view and return it
     */
    protected function buildView($content_items = [], $is_content_builder = 'false')
    {
        if(count($content_items) > 0)
        {
            return view('eon.content-builder::ajax-search.partials.content-items', compact('content_items', 'is_content_builder'))->render();
        }

        return view('eon.content-builder::ajax-search.partials.no-results')->render();
    }
}