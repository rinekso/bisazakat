<div class="row mB-40">
  <div class="col-sm-8">
    <div class="bgc-white p-20 bd">
        {!! Form::myInput('text', 'name', 'Nama Permission') !!}
        @if(!$roles->isEmpty())
          <small>Tambahkan Permission ke Role</small>
          @foreach ($roles as $role)

                <div class="checkbox checkbox-circle checkbox-info peers ai-c mB-15">
                    <input type="checkbox" id="inputCall{{ $role->id }}" value="{{ $role->id }}" name="permissions[]" class="peer">
                    <label for="inputCall{{ $role->id  }}" class="peers peer-greed js-sb ai-c">
                        <span class="peer peer-greed">{{ $role->name }}</span>
                    </label>
                </div>

          @endforeach
        @endif

    </div>
  </div>
</div>