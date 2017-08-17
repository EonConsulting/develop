<ul>
    @foreach($children as $child)
        <li>
          <a href="{{ route('lti.courses.single.lectures.item', [$course->id, $child->id]) }}">{{$child->name}}</a>
          @if(count($child->children))
              @include('student.courses.lecture-nav',['children' => $child->children])
          @endif
        </li>
    @endforeach
</ul>
