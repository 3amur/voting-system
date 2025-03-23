@extends('dashboard.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users Overview</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('dashboard.user_overview') }}">Users Overview</a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table class="text-center table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Id</th>                                        
                                        <th>Name</th>
                                        <th>Status</th>
                                        <th>Votes</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($allUsers as $item)
                                        <tr>
                                            <td>{{ $item->id }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                @if ($item->status == 'approved')
                                                    <span class="badge badge-success">{{ $item->status }}</span>
                                                @elseif ($item->status == 'pending')
                                                    <span class="badge badge-danger">{{ $item->status }}</span>
                                                @else
                                                    <span class="badge badge-warning">{{ $item->status }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->hasVotes?->count() }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{ $allUsers->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection