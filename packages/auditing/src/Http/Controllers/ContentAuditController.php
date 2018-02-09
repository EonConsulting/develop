<?php

namespace EONConsulting\Auditing\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use EONConsulting\Storyline2\Models\StorylineItem;
use OwenIt\Auditing\Models\Audit;

class ContentAuditController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(StorylineItem $storylineItem)
    {
        $content = $storylineItem->content;

        $audits = $content->audits()->orderBy('updated_at', 'desc')->paginate(5);

        $message = view('auditing::popups.content-index', compact('audits'))->render();

        return response()->json(['message' => $message], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $storylineItem
     * @param  int  $audit_id
     * @return \Illuminate\Http\Response
     */
    public function show(Audit $audit)
    {

        $modifications = [];

        foreach($audit->getModified() as $name => $changes)
        {

            if( ! $this->isAuditable($name))
            {
                continue;
            }

            $diff = $this->get_decorated_diff(
                array_get($changes, 'old', ''),
                array_get($changes, 'new', '')
            );

            $modifications[$name] = $diff;
        }

        //dd($modifications);

        $message = view('auditing::popups.content-show', compact('modifications'))->render();

        return response()->json(['message' => $message], 200);
    }

    protected function isAuditable($name)
    {
        return in_array($name, ['title', 'body']);
    }

    protected function get_decorated_diff($old, $new)
    {
        $from_start = strspn($old ^ $new, "\0");
        $from_end = strspn(strrev($old) ^ strrev($new), "\0");

        $old_end = strlen($old) - $from_end;
        $new_end = strlen($new) - $from_end;

        $start = substr($new, 0, $from_start);
        $end = substr($new, $new_end);
        $new_diff = substr($new, $from_start, $new_end - $from_start);
        $old_diff = substr($old, $from_start, $old_end - $from_start);

        $new = "$start<ins style='background-color:#ccffcc'>$new_diff</ins>$end";
        $old = "$start<del style='background-color:#ffcccc'>$old_diff</del>$end";
        return ["old" => $old, "new" => $new];
    }
}