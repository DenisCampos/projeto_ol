@extends('layouts.site')

@section('content')

<div class="container">
    <!-- Content Row -->
    <div class="row mt-4">
        <div class="col-lg-8 mb-4">
            <h5>PARA TODOS OS USUÁRIOS DO SITE (Público Geral):</h5>
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
            <h5>PARA CADASTROS DE PARCEIROS (Profissionais/Empresas/Eventos/Infoprodutos):</h5>
            <p>O parceiro, por meio do aceite tácito deste termo, autoriza o portal OloyFit a divulgar o seu nome/marca, logomarca, contatos e eventos profissionais, conteúdos integrais ou parciais, imagens de produtos, serviços e pessoas veiculados na internet, gratuitamente pelo período de 6 meses, prorrogável tacitamente enquanto da vontade espontânea das partes envolvidas.</p>
            <p>O portal OloyFit é quem define o local, espaço, tamanho e o tipo de veiculação que será feito dentro do site, de forma gratuita. A eventual intenção do rompimento da parceria ou da retirada, retificação de qualquer veiculação publicitária e de conteúdo na forma citada acima, é livre e irrestrita, tanto para o parceiro quanto para o portal OloyFit, e poderá ser feita a qualquer momento; porém, quando pela vontade do parceiro, esse deverá comunicar por escrito o portal OloyFit (contato@oloyfit.com) para que o site atenda a solicitação.</p>
            <p>O cadastro de qualquer Profissional, Empresa, Evento ou Infoproduto poderá ser editado ou excluído a qualquer momento, somente pelo usuário cadastrado com login e senha no sistema que inseriu a referida informação, dado ou ainda pela própria administração do Site. </p>
            <p>Prezando pela qualidade das informações oferecidas ao usuário e de acordo com os critérios estabelecidos internamente, a publicidade de produtos, profissionais, serviços ou eventos na plataforma NÃO se dará de forma automática após o cadastro online,  cabendo ao portal OloyFit, a moderação das informações, podendo de forma unilateral, decidir pela não aprovação do cadastro ou pela retirada da divulgação de qualquer profissional, empresa, evento ou produto digital, em situações que a empresa OloyFit julgue inadequadas aos objetivos do portal. </p>
            <p>O uso do Site oloyfit.com pressupõe a aceitação livre e espontânea deste Acordo de Parceria descrito nesse termo acima.</p>
        </div>
        <!-- Contact Details Column -->
        <div class="col-lg-4">
            <div class="col-lg-12 text-custom-titulo" style="padding-left: 0px">
                    <h5>Top Produtos 
                        <button type="buttom" onclick="window.open('{{route('cursos.posts',['categoria'=>0])}}','_self')" class="btn btn-sm btn-custom pull-right">Todos</button>
                    </h5>
                    <hr>
                </div>
                @foreach($cursos as $curso)
                <div class="row align-items-center">
                    <div class="col-md-4 mb-3">
                        <a href="{{route('cursos.post',['post'=>$curso->id])}}">
                        <img class="img-fluid rounded mb-3 mb-md-0" src="{{asset($curso->imagem1)}}" alt="">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h5 class="text-custom-titulo">{{$curso->titulo}}</h5>
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->
@endsection