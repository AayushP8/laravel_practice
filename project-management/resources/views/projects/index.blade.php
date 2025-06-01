{{-- @extends('layouts.app') --}}
{{-- @section('title', 'Index Page') --}}
@extends('components.layout')

@section('template_title')
    Project List Page
@endsection

@section('content')
    <div class="container">
        <div>
            <a href="{{ route('projects.create') }}"  id="add" class='btn btn-outline-dark' >Add Project</a>
        </div>
        <div>
            <h1>Project List</h1>
            <div class="card my-4">
                <div class="card-header">
                    <strong><i class="fa fa-sort"></i> FILTER CUSTOMER</strong>
                </div>
                <div class="card-body">
                    <form action="{{ route('projects.index') }}" method="GET">
                        <div class="row">
                            <div class="col-md-3">
                                <input type="text" class="form-control" id="filter-projectname" name="filter_projectname" 
                                       placeholder="Project Name" value="{{ request('filter_projectname') }}">
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="filter-projecttype" name="filter_projecttype">
                                    <option value="All">All Types</option>
                                    <option value="Internal" {{ request('filter_projecttype') == 'Internal' ? 'selected' : '' }}>Internal</option>
                                    <option value="External" {{ request('filter_projecttype') == 'External' ? 'selected' : '' }}>External</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" id="filter-activestatus" name="filter_activestatus">
                                    <option value="All">All Status</option>
                                    <option value="Active" {{ request('filter_activestatus') == 'Active' ? 'selected' : '' }}>Active</option>
                                    <option value="Inactive" {{ request('filter_activestatus') == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                        </div>
                        {{-- <div>
                            <button type="submit" class="btn btn-outline-success"><i class="fa fa-filter"></i>
                                Apply</button>
                            <a href="{{ route('customers.index') }}" type="submit"
                                class="btn btn-outline-primary"><i class="fa fa-refresh"></i> Reset</a>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
        <div class="my-5 table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Project ID</th>
                        <th>Project Name</th>
                        <th>Start Date</th>
                        <th>Project Type</th>
                        <th>Budget</th>
                        <th>Active Status</th>
                        <th>Project Manager</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @if ($projects->isNotEmpty())
                        @forelse($projects as $project)
                            <tr>
                                <td id="project">{{ $project->id }}</td>
                                <td id="projectname">{{ $project->project_name }}</td>
                                <td id="startdate">{{ $project->start_date->format('d-m-Y') }}</td>
                                <td id="projecttype">{{ $project->project_type }}</td>
                                <td id="budget">₹{{ number_format($project->budget) }}</td>
                                <td id="activestatus">
                                    <span class="badge {{ $project->active_status ? 'bg-success' : 'bg-secondary' }}">
                                        {{ $project->active_status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td id="manager">{{ $project->manager }}</td>
                                <td>
                                    <a href="/edit/{{ $project->id }}" id="edit-{{ $project->id }}" class="btn btn-sm btn-warning">Edit</a>
                                    <button onclick="confirmDelete({{ $project->id }})" id="delete-{{ $project->id }}" class="btn btn-sm btn-danger">Delete</button>
                                </td>
                            </tr>
                            @endforelse
                            <tr>
                                <td colspan="8" class="text-center">No projects found</td>
                            </tr>
                    @endif --}}
                </tbody>
            </table>
        </div>
    </div>
@endsection