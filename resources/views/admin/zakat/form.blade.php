<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            <div class="row">

                <div class="col-md-6">
                    {!! Form::mySelect('category_id', 'Kategori', $category) !!}
                </div>
                <div class="col-md-6">
                    {!! Form::myInput('text', 'title', 'Nama Program') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="">Deskripsi</label>

                @isset($item)
                <textarea id="editor" type="text" name="description">{{ $item->description }}</textarea>
                @endisset

                @empty($item)
                    <textarea id="editor" type="text" name="description"></textarea>
                @endempty
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="bgc-white p-20 bd">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::myInput('number', 'fund_target', 'Target Donasi') !!}

                    {!! Form::myInput('date', 'closed_at', 'Tanggal Berakhir') !!}
                    <div class="col-md-12 m-5">
                        <img style="width: 100%" src="{{ (isset($item)) ? asset($item->image) : ''}}" alt="">
                    </div>
                    {!! Form::myInput('file', 'image', 'Thumbnail Image') !!}

                    @if(!\App\Models\Program::isMainProgramExists())
                    <div class="form-group">
                        <div class="checkbox checkbox-circle checkbox-info peers ai-c mB-15">
                            <input type="checkbox" id="inputCall1" value=1 name="is_main_program" class="peer">
                            <label for="inputCall1" class="peers peer-greed js-sb ai-c">
                                <span class="peer peer-greed">Program Utama</span>
                            </label>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>