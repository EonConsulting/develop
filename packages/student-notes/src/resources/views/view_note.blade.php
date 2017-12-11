<div style="text-align: left;">
@forelse($notes as $note)
    <div>
        <div>
            <span><strong>{{ $note->created_at }}</strong></span>
            <span class="pull-right"><a href="{{ route('student-notes.destroy', $note->id) }}" class="delete-student-note">Delete</a></span>
        </div>
        <br>
        <div>{{ $note->body }}</div>
    </div>
    <hr/>
@empty
    <div>
        No notes found!
    </div>
@endforelse
</div>