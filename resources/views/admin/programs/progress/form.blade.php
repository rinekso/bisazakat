<div class="row mB-40">
    <div class="col-sm-8">
        <div class="bgc-white p-20 bd">
            <div class="row">
                <div class="col-md-12">
                    {!! Form::myInput('text', 'title', 'Judul') !!}
                </div>
            </div>

            <div class="form-group">
                <label for="">Deskripsi</label>

                <textarea id="editor" type="text" name="description">{{ $programProgress->description }}</textarea>

            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="bgc-white p-20 bd">
            <div class="row">
                <div class="col-md-12">
                    <h6 class="lh-1">Nama Program</h6>
                    <h4>Program</h4>
                    <hr>

                    <h6 class="lh-1">Kategori</h6>
                    <h4>Kategori</h4>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>