@extends('layouts.sufeelogin')

@section('content')
<div class="container">
    <div class="login-content">
        <div class="login-logo">
            <img class="align-content" src="{{ asset('public/images/cropped-oloyfit-logo.png') }}" alt="">
        </div>
        <div class="login-form">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="form-group">
                    <label>Nome</label>
                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus placeholder="Nome">
                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required placeholder="Email">
                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Senha</label>
                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Senha">
                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group">
                    <label>Confirme a Senha</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirmar Senha">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" required> Aceito os termos de compromissos (<a href="" data-toggle="modal" data-target="#scrollmodal">Visualizar</a>)
                    </label>
                </div>
                <div class="social-login-content">
                    <div class="social-button">
                        <button type="submit" class="btn btn-primary btn-flat m-b-30 m-t-30">Registrar</button>
                    </div>
                </div>
                <div class="register-link m-t-15 text-center">
                    <p>Já possui registro? <a href="{{ route('login') }}"> Faça o login aqui</a></p>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="scrollmodal" tabindex="-1" role="dialog" aria-labelledby="scrollmodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="scrollmodalLabel"><img class="align-content" src="{{ asset('public/images/cropped-oloyfit-logo.png') }}" alt=""></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-justify">
                <div class="text-center"><p><strong>PARA VOCÊ</strong></p></div>
                <p>A OloyFit é um portal que conecta, profissionais, empresas, eventos e produtos digitais do  segmento fitness na internet. A responsabilidade das informações inseridas pelo usuário ou parceiro em nosso banco de dados será exclusivamente da pessoa física ou jurídica que realizou o cadastro. O portal OloyFit orienta que, qualquer dúvida, suporte ou contato sobre os produtos, serviços e eventos divulgados no portal devem ser direcionados diretamente à pessoa, empresa, profissional ou prestador de serviço, responsável pelo conteúdo da veiculação publicitária.
                Durante a navegação no site OloyFit, os dados que o usuário ou parceiro inserirem serão coletados e salvos em nosso sistema através de cookies e ferramentas de coleta de dados, que nos informarão, suas preferências por produtos e serviços, preservando sempre a segurança dessas informações. Lembrando sempre que essa coleta poderá ser desabilitada todas as vezes que o usuário utilizar o site, através do seu navegador de internet. </p>
                <p>Todas as suas informações pessoais recolhidas, serão usadas exclusivamente para o ajudar a tornar a sua visita ao nosso site mais produtiva e agradável. Essas informações recolhidas podem incluir o seu nome, e-mail, número de telefone, preferências e/ou outros.
                O usuário do site OloyFit é o único responsável por todas as ações decorrentes da utilização de sua conta no sistema (login /senha), onde deverá ser utilizado sempre, senhas seguras e ao detectar qualquer vulnerabilidade ou anormalidade do sistema, o portal poderá ser informado pelo e-mail suporte@oloyfit.com para que o problema seja resolvido.</p>    
                <p>A garantia para os Infoprodutos (produtos digitais) divulgadas no Site oloyfit.com é estabelecida pelos próprios produtores e pode variar de acordo com o produto. Sendo assim, o portal OloyFit apenas divulga esses produtos e não garante ou se compromete com qualquer tipo promessa ou expectativa de resultado oferecido pelos Infoprodutores.</p>    
                <p>O Site oloyfit.com possui ligações para outros sites, os quais, a nosso ver, podem conter informações / ferramentas úteis para os nossos visitantes. A nossa política de privacidade NÂO é aplicada a sites de terceiros, por isso, caso visite outro site a partir do nosso, você deverá ler a política de uso e privacidade do mesmo. Não nos responsabilizamos pela política de uso e privacidade ou conteúdo presente nesses mesmos sites de terceiros.
                A equipe do site OloyFit ( oloyfit.com ) reserva-se ao direito de alterar este acordo sem aviso prévio. Deste modo, recomendamos que consulte a nossa política de privacidade com regularidade para que fique sempre atualizado.</p>
                <p>O usuário dos nossos serviços pode a qualquer momento se “descadastrar” do nosso site automaticamente, excluindo sua conta(perfil) do sistema ou deixar de receber comunicações do nosso site ou sistema. Para tanto basta enviar um e-mail para contato@oloyfit.com indicando o seu desejo de não mais receber essas comunicações.</p>
                <p>O uso do Site oloyfit.com pressupõe a aceitação livre e espontânea deste Acordo de Uso e Privacidade descrito neste termo.
                Este documento é regido e deve ser interpretado de acordo com as leis da República Federativa do Brasil.  Fica eleito o Foro da Comarca de São Luis, Maranhão, como o competente para dirimir quaisquer questões porventura oriundas do presente documento, com expressa renúncia a qualquer outro, por mais privilegiado que seja.</p>
                <hr>
                <div class="text-center"><p><strong>PARA PARCEIROS</strong></p></div>
                <p>O parceiro, por meio do aceite tácito deste termo, autoriza o portal OloyFit a divulgar o seu nome/marca, logomarca, contatos e eventos profissionais, conteúdos integrais ou parciais, imagens de produtos, serviços e pessoas veiculados na internet, gratuitamente pelo período de 6 meses, prorrogável tacitamente enquanto da vontade espontânea das partes envolvidas.</p>
                <p>O portal OloyFit é quem define o local, espaço, tamanho e o tipo de veiculação que será feito dentro do site, de forma gratuita. A eventual intenção do rompimento da parceria ou da retirada, retificação de qualquer veiculação publicitária e de conteúdo na forma citada acima, é livre e irrestrita, tanto para o parceiro quanto para o portal OloyFit, e poderá ser feita a qualquer momento; porém, quando pela vontade do parceiro, esse deverá comunicar por escrito o portal OloyFit (contato@oloyfit.com) para que o site atenda a solicitação.</p>
                <p>O cadastro de qualquer Profissional, Empresa, Evento ou Infoproduto poderá ser editado ou excluído a qualquer momento, somente pelo usuário cadastrado com login e senha no sistema que inseriu a referida informação, dado ou ainda pela própria administração do Site. </p>
                <p>Prezando pela qualidade das informações oferecidas ao usuário e de acordo com os critérios estabelecidos internamente, a publicidade de produtos, profissionais, serviços ou eventos na plataforma NÃO se dará de forma automática após o cadastro online,  cabendo ao portal OloyFit, a moderação das informações, podendo de forma unilateral, decidir pela não aprovação do cadastro ou pela retirada da divulgação de qualquer profissional, empresa, evento ou produto digital, em situações que a empresa OloyFit julgue inadequadas aos objetivos do portal. </p>
                <p>O uso do Site oloyfit.com pressupõe a aceitação livre e espontânea deste Acordo de Parceria descrito nesse termo acima.</p>
                </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
@endsection