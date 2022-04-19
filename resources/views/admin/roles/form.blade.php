<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            {!! Form::myInput('text', 'name', 'Nama Role') !!}

            @if (count($permissions) != 0)
                <small>Pilih permission</small>
                <br><br>
                @foreach($permissions as $permission)
                    <div class="checkbox checkbox-circle checkbox-info peers ai-c mB-15">
                        <input type="checkbox" id="inputCall{{ $permission->id }}" value="{{ $permission->id }}" name="permissions[]" class="peer">
                        <label for="inputCall{{ $permission->id  }}" class="peers peer-greed js-sb ai-c">
                            <span class="peer peer-greed">{{ $permission->name }}</span>
                        </label>
                    </div>
                @endforeach
            @else
                <p>Belum ada permission yang dibuat, <a href="{{ route('admin.permissions.create') }}">Buat
                        Permission</a></p>
            @endif
        </div>
    </div>
</div>