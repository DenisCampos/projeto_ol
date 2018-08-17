{!! Form::hidden('redirect_to', URL::previous()) !!}
<div class="row">
    <div class="col-md-12">
        <div class="card">
            @if(isset($banner->banner)!="")
                <img class="card-img-top" src="{{ asset($banner->banner) }}"  alt="Card image cap">
                <div class="card-body">
                    <hr>
                    <h4 class="card-title mb-3">Imagem em destaque</h4>
                    <p class="card-text">{!! Form::file('banner', ['class' => 'form-control-file'])!!}</p>
                </div>
            @else
                <img class="card-img-top" src="{{ asset('public/images/400x100.png') }}"  alt="Card image cap">
                <div class="card-body">
                    <hr>
                    <h4 class="card-title mb-3">Imagem em destaque</h4>
                    <p class="card-text">{!! Form::file('banner', ['class' => 'form-control-file', 'required' => 'required'])!!}</p>
                </div>
            @endif
        </div>
    </div>
    <div class="col-lg-12">
        {!! Form::label('site', 'Link de redirecionamento', ['class' => 'control-label']) !!}   
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-laptop"></i></div>
            {!! Form::text('site', null, ['class' => 'form-control']) !!}
        </div>
    </div>
</div>