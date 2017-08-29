<ul>
    @foreach($children as $child)
        <li>
          <a href="{{ route('lti.courses.single.lectures.item', [$course->id, $child->id]) }}" id="{{$child->id}}" storyline="{{$child->storyline_id}}" course="{{$course->id}}">{{$child->name}}</a>
          @if(count($child->children))
              @include('student.courses.lecture-nav',['children' => $child->children])
          @endif
        </li>
    @endforeach
</ul>
