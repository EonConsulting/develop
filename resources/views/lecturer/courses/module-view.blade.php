
                        @foreach($courses as $index => $course)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->title }}</td>
                            <td>{{ $course->creator->name }}</td>
                            <td>
                                <a href="{{ route('storyline2.lecturer.edit', $course->id) }}" class="btn btn-info btn-sm">Storyline</a>
                                <a href="{{ route('storyline2.preview', $course->id) }}" class="btn btn-success btn-sm">Preview</a>
                                <div class="btn-group">
                                    <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-caret-down"></i>
                                    </button>
                                    <div class="dropdown-menu">

                                        <a href="#" class="moduleId dropdown-link" type="button" id="{{$course->id}}"><i class="fa fa-pencil-square-o"></i> Edit Module</a>
                                        <a href="#" class="notifyId dropdown-link" type="button" data-id="{{$course->id}}" data-toggle="modal" data-target="#notificationModal"><i class="fa fa-envelope"></i> Notify</a>
                                        <a href="#" class="moduleId dropdown-link" type="button" id="{{$course->id}}"><i class="fa fa-pencil-square-o"></i> Module</a>
                                        <a href="{{ route('metadata.list', $course->id) }}" class="metadataId dropdown-link" id="{{$course->id}}"><i class="fa fa-tags"></i> Metadata</a>
                                        <a href="#" class="marksId dropdown-link" id="{{$course->id}}"><i class="fa fa-file-excel-o"></i> Export Marks</a>
                                    </div>
                                </div> 
                            </td>
                        </tr>
                        @endforeach
                   