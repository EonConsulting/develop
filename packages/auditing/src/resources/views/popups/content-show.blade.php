<table class="table">
    <thead>
    <tr>
        <th width="10%">Field Name</th>
        <th width="45%">Old</th>
        <th width="45%">New</th>
    </tr>
    </thead>
    <tbody>
        @foreach($modifications as $name => $diff)
        <tr>
            <td style="border-right: 1px solid;"><h4>{{ $name }}</h4></td>
            <td style="border-right: 1px solid;">{!! $diff['old'] !!} </td>
            <td>{!! $diff['new'] !!} </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    MathJax.Hub.Queue(["Typeset",MathJax.Hub]);
</script>