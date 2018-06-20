@foreach($courses as $index => $course)
<tr @if($course->isLocked()) style="background-color: #ffebee;" @endif>
    <td>{{ $index + 1 }}</td>
    <td>
        @if($course->isLocked())
            <i class="fa fa-lock" style="font-size: 20px; color:Tomato; vertical-align: 0%"></i>
        @endif {{ $course->title }}
    </td>
    <td>{{ $course->title }}</td>
    <td>{{ $course->creator->name }}</td>
    <td>

        <div class="row">
            <div class="col-sm-6">

                <div class="btn-group">
                    @if($course->isEditable())
                        <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-caret-down"></i>
                        </button>
                        <div class="dropdown-menu">
                            <a href="#" class="moduleId dropdown-link" type="button" id="{{$course->id}}"><i class="fa fa-pencil-square-o"></i> Edit Module</a>
                            @if($course->canBeLocked())
                                @if($course->isLocked())
                                    <a href="{{ route('storyline2.course.destroy', $course) }}" class="dropdown-link" type="button"><i class="fa fa-unlock"></i> Unlock Module</a>
                                @else
                                    <a href="{{ route('storyline2.course.store', $course) }}" class="dropdown-link" type="button"><i class="fa fa-lock"></i> Lock Module</a>
                                @endif
                            @endif
                            <a href="#" class="notifyId dropdown-link" type="button" data-id="{{$course->id}}" data-toggle="modal" data-target="#notificationModal"><i class="fa fa-envelope"></i> Notify</a>
                            <a href="{{ route('metadata.list', $course->id) }}" class="metadataId dropdown-link" id="{{$course->id}}"><i class="fa fa-tags"></i> Metadata</a>
                            <a href="#" class="marksId dropdown-link" id="{{$course->id}}"><i class="fa fa-file-excel-o"></i> Export Marks</a>
                            <a href="#" class="course-exports dropdown-link" data-id="{{$course->id}}"  data-toggle="modal" data-target="#course-exports"><i class="fa fa-file-pdf-o"></i> Export Course</a>
                        </div>
                    @endif
                </div>

                @if($course->isEditable())
                    <a href="{{ route('storyline2.lecturer.edit', $course->id) }}" class="btn btn-info btn-sm">Storyline</a>
                @endif

            </div>
            <div class="col-sm-6">
                <a href="{{ route('storyline2.preview', $course->id) }}" class="btn btn-success btn-sm">Preview</a>
            </div>
        </div>

    </td>
</tr>
@endforeach

               