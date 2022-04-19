@extends('admin.default')

@section('page-header')
    Site Settings <small>Manage</small>
@stop

@section('content')

    <div class="row mB-40">
        <div class="col-sm-6">
            <div class="bgc-white p-20 bd">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Site Description</label>
                            <textarea class="form-control" name="" id="" cols="30" rows="10"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="bgc-white p-20 bd">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="">Social Media Links</label>
                            <hr>
                            <div class="form-group">
                                <label for="">Instagram</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Youtube</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Twitter</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="">Instagram</label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection