<div class="row">
    <div class="col-lg-12">
        <div class="col-md-12">
            <div class="card">
                @if(isset($banner->imagem)!="")
                    <img class="card-img-top" src="{{ asset($banner->imagem) }}"  alt="Card image cap">
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Banner</h4>
                        <p class="card-text">{!! Form::file('imagem1', ['class' => 'form-control-file'])!!}</p>
                    </div>
                @else
                    <img class="card-img-top" src="{{ asset('public/images/1900x1080.png') }}"  alt="Card image cap">
                    <div class="card-body">
                        <hr>
                        <h4 class="card-title mb-3">Banner</h4>
                        <p class="card-text">{!! Form::file('imagem', ['class' => 'form-control-file', 'required' => 'required'])!!}</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        {!! Form::label('titulo', 'Titulo*', ['class' => 'control-label']) !!}
        {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-6">
        {!! Form::label('statu_id', 'Status*', ['class' => 'control-label']) !!}
        {!! Form::select('statu_id', $status, null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-6">
        {!! Form::label('link', 'Link', ['class' => 'control-label']) !!}
        {!! Form::text('link', null, ['class' => 'form-control']) !!}
    </div>
    <div class="col-lg-12">
        {!! Form::label('descricao', 'Descrição*', ['class' => 'control-label']) !!}
        {!! Form::textarea('descricao', null,['class' => 'form-control my-editor', 'rows'=>2]) !!}
    </div>
</div>


