@extends('layouts.app')

<!-- ============================================================================= -->

@section('page-title')
    Templates
@endsection

<!-- ============================================================================= -->

@section('custom-styles')

@endsection

<!-- ============================================================================= -->

@section('content')

    <div class="container-fluid">
            <div class="dashboard-card shadow">

                <div class="dashboard-card-heading">
                    Templates <a href="{{ url('storyline2/templates/create') }}" class="btn btn-xs btn-info"><i class="fa fa-plus"></i></a>
                </div>
        
                @if(!empty($templates))
        
                <table class="table">
                    <thead>
                        <th>Name</th><th>Actions</th>
                    </thead>
                    
                    <tbody id="category_table">
                        
                        @foreach($templates as $template)
        
                        <tr>
                            <td>{{ $template['name'] }}</td>
                            <td>
                                <a class="btn btn-xs btn-info" href="{{ url('storyline2/templates/'. $template['id'] .'/edit') }}">Edit</a>
                                <a class="btn btn-xs btn-danger" href="#">Delete</a>
                            </td>
                        </tr>
        
                        @endforeach
        
                        
                    </tbody>
        
                </table>
        
                @else
        
                <h3>No Templates</h3>
        
                @endif
            
            </div>


    </div>

@endsection

<!-- ============================================================================= -->

@section('exterior-content')


@endsection

<!-- ============================================================================= -->

@section('custom-scripts')


@endsection