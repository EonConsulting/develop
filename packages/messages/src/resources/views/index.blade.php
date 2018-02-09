<style>
    #messages tr { font-size: 12px; }
    #messages tr.unread { font-weight:bold; }
    #messages tr.read { }
</style>

<table id="messages" class="table table-condensed table-hover">
    <thead>
    <tr>
        <th>Subject</th>
        <th width="10%">Status</th>
        <th width="20%">Sent At</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @forelse($messages as $message)
    <tr class="{{ ! $message->read() ? 'unread' : 'read' }}">
        <td>
            <a href="{{ route('messages.show', $message->id) }}" class="messages-view">{{ array_get($message->data, 'subject') }}</a>
        </td>
        <td>
            {{ ! $message->read() ? 'Unread' : 'Read' }}
        </td>
        <td>
            {{ $message->created_at->diffForHumans() }}
        </td>
        <td>
            <a href="{{ route('messages.destroy', $message->id) }}" class="messages-delete">
                <i class="fa fa-trash fa-lg"></i>
            </a>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="4">No messages</td>
    </tr>
    @endforelse
    </tbody>
</table>

{{ $messages->links('messages::pagination') }}