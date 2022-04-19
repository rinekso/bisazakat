@extends('admin.default')

@section('page-header')
    Detail Data Program
@endsection

@section('content')
    <div class="row mb-5">
        <div class="col-md-12">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.programs.show', $program->program_id) }}">Overview</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Perkembangan Program</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                @foreach($progressUpdates as $progress)
                <div class="col-md-12 mb-3">
                    <h4 class="mb-4">Update {{ $loop->iteration	 }}</h4>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $progress->title }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ date('j F Y', strtotime($progress->created_at)) }}</h6>
                            <div class="card-text mb-5">{!! str_limit($progress->description, 200, ' ...') !!}</div>
                            <a href="{{ route('admin.progress.edit', [$program->program_id, $progress->program_progress_update_id]) }}" class="card-link ">Update</a>
                            <a href="#" class="card-link">Lihat Selengkapnya</a>
                            {!! Form::open([
                                      'class'=>'delete card-link pull-right',
                                      'url'  => route(ADMIN . '.progress.destroy', [$program->program_id, $progress->program_progress_update_id]),
                                      'method' => 'DELETE',
                                      ])
                                  !!}

                            <button class="btn btn-danger btn-sm" title="{{ trans('app.delete_title') }}">Delete</button>

                            {!! Form::close() !!}
                        </div>
                    </div>
                    <hr>
                </div>

                    @if ($loop->last)
                        <div class="col-md-12">
                            <h4 class="mb-4">Update {{ $loop->count + 1 }}</h4>
                            <div class="card">
                                <div class="card-body mx-auto">
                                    <a href="{{ route('admin.progress.create', 1) }}" class="btn btn-success">Tulis
                                        Perkembangan</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="col-md-3">
            <h4 class="mb-4">Tulis Perkembangan</h4>
            <a href="{{ route('admin.progress.create', 1) }}" class="btn btn-success form-control">Tulis Perkembangan Terbaru</a>
        </div>
    </div>
@endsection