@extends('components.layout')

@section('template_title')
    Add Project
@endsection

@section('content')
    <div class="container my-4">
        <div>
            <h1>Add Project</h1>
        </div>
        <div class="w-50">
            <form action="{{ route('projects.store') }}" method="POST">
                @csrf
                <div class="my-3">
                    <label class="form-label" for="projectname">Project Name:</label>
                    <input class="form-control" type="text" id="projectname" name="projectname"
                        value="{{ old('projectname') }}">
                </div>
                <div id="err-projectname" class="text-danger">
                    @error('projectname')
                        {{ $message }}
                    @enderror
                </div>
    
                <div class="my-3">
                    <label class="form-label" for="startdate">Start Date:</label>
                    <input class="form-control" type="date" id="startdate" name="startdate" value="{{ old('startdate') }}">
                </div>
                <div id="err-startdate" class="text-danger">
                    @error('startdate')
                        {{ $message }}
                    @enderror
                </div>
    
                <div class="my-3">
                    <label class="form-label" for="">Project Type:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="projecttypeInternal" name="projecttype"
                            vlaue="Internal">
                        <label class="form-check-label" for="projecttypeInternal">Internal</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="projecttypeExternal" name="projecttype"
                            value="External">
                        <label class="form-check-label" for="projecttypeExternal">External</label>
                    </div>
                </div>
                <div id="err-projecttype" class="text-danger">
                    @error('projecttype')
                        {{ $message }}
                    @enderror
                </div>
    
                <div class="my-3">
                    <label class="form-label" for="budget">Budget:</label>
                    <input class="form-control" type="number" id="budget" name="budget" value="{{ old('budget') }}">
                </div>
                <div id="err-budget" class="text-danger">
                    @error('budget')
                        {{ $message }}
                    @enderror
                </div>
    
                <div class="my-3">
                    <label class="form-label" for="">Active Status:</label>
                    <div>
                        <input class="form-check-input" type="checkbox" id="activestatus" name="activestatus" value="1"
                            checked>
                        <label class="form-check-label" for="activestatus">Active</label>
                    </div>
                </div>
    
                <div class="my-3">
                    <label class="form-label" for="manager">Project Manager:</label>
                    <input class="form-control" type="text" id="manager" name="manager" value="{{ old('manager') }}">
                </div>
                <div id="err-manager" class="text-danger">
                    @error('manager')
                        {{ $message }}
                    @enderror
                </div>
    
                <div class="my-3">
                    <label class="form-label" for="projectlogo">Project Logo:</label>
                    <input class="form-control" type="file" id="projectlogo" name="projectlogo">
                </div>
                <div id="err-projectlogo" class="text-danger">
                    @error('projectlogo')
                        {{ $message }}
                    @enderror
                </div>
    
                <button class='btn btn-outline-success' id="submit-project">ADD</button>
                {{-- <button class='btn btn-outline-warning' id="update-project">EDIT</button> --}}
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/project-validation.js') }}"></script>
    {{-- @vite('resources/js/login-validation.js') --}}
@endpush

