<div style="text-align: left;">
    @forelse($audits as $audit)
        <div>
            <div>
                <span class="pull-right"><a href="javascript:void();" class="auditing-view" data-audit-id="{{ $audit->id }}">View Audit</a></span>
            </div>
            <br>
            <div>
                On <b>@datetime(array_get($audit->getMetadata(), 'audit_created_at'))</b>, <br/><br/>{{ array_get($audit->getMetadata(), 'user_name') }} made modifications to Storyline Item.
            </div>
        </div>

        @if ( ! $loop->last) <hr/> @endif
    @empty
        <div>
            No Audits available.
        </div>
    @endforelse
</div>

{{ $audits->links('auditing::pagination') }}