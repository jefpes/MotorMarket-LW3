<div class="indent-2 container m-3 space-y-3">
    <h1 class="text-xl text-center font-bold">
      CONTRATO DE COMPRA E VENDA DE MOTOCICLETA
    </h1>

    <div class="space-y-3">
      <h2 class="font-semibold">DAS PARTES</h2>
      <p >
        <span class="font-semibold">LOJA {{ $company->name }}</span>, sediada na {{ $company->address }} @if ($company->ceo && $company->cpf && $company->ceo_address)<span>, representada por seu
        , neste ato representado por seu titular ANTONIO, brasileiro, solteiro, residente e
        domiciliado na Rua: Antonio Moreira, 263, Bairro: Acampamento, CEP 62.640-000, Cidade de Pentecoste, Estado do Ceará,
        CPF:000.000.000-98 , denominado VENDEDOR</span>@endif.
      </p>
      <p>
        Do outro lado, {{ $sale->client->name }}, {{ $sale->client->marital_status }}, residente no(a)
        {{ $sale->client->logradouro_type . ' '. $sale->client->logradouro . ', '. $sale->client->number . ' - '. $sale->client->bairro }} - {{ $sale->client->city->name . ' - ' . $sale->client->state . ' - ' . $sale->client->cep }}
        , RG: {{ $sale->client->rg }} , CPF: {{ $sale->client->cpf }}, denominado <span class="font-semibold">COMPRADOR</span>, têm entre si como justos e contratado o que segue, que se obrigam a cumprir por si, seus herdeiros e sucessores.
      </p>
      <p>
        As partes acima identificadas acordam com o presente Contrato de Compra e Venda com Reserva de Domínio, que se regerá
        pelas cláusulas seguintes:
      </p>
    </div>

    <div class="space-y-3">
      <h2 class="font-semibold pb-3">DO OBJETO DO CONTRATO</h2>
      <p><span class="font-semibold">Cláusulas 1ª:</span> Um veículo de:</p>

      <table class="w-full text-left rtl:text-right">
        <tbody>
            <tr class="border">
              <th scope="row" class="px-6 py-4 font-medium whitespace-nowrap border border-gray-600">
                {{ $infos[0] }}
              </th>
              <td class="px-6 py-4 border border-gray-600">
                {{ $sale->vehicle->model->brand->name }}
              </td>
            </tr>
        </tbody>
      </table>
    </div>

    <div class="space-y-3">
      <h2 class="font-semibold pb-3">DA RESERVA DE DOMÍNIO</h2>

      <p>
        <span class="font-semibold"> Cláusula 2ª </span> - Fica reservado ao VENDEDOR, conforme o disposto neste contrato,
        a propriedade do bem objeto deste instrumento, até serem pagas todas as parcelas pelo COMPRADOR.
      </p>

      <p>
        <span class="font-semibold"> Parágrafo primeiro: </span> Fica impedido o COMPRADOR de vender ou ceder bem a terceiros, sem o conhecimento e autorização do
        VENDEDOR, nem constituir, direta ou indiretamente, ônus, penhor, caução ou qualquer outro gravame sobre mesmo, até que
        sejam quitadas todas as parcelas previstas neste contrato, o descumprimento no exposto acima poderá caracterizar crime,
        com pena prevista no art. 171§2º, I, do Código Penal. (Incluído pela Lei 10.931, de 2004): Obter, para si ou para
        outrem, vantagem ilícita, em prejuízo alheio, induzindo ou mantendo alguém em erro, mediante artifício, ardil, ou
        qualquer outro meio fraudulento, Pena - reclusão, de um a cinco anos, e multa.
      </p>

      <p>
        <span class="font-semibold">Parágrafo segundo: </span> O COMPRADOR não terá, antes do pagamento integral do preço e da transferência de posse, direito sobre
        hipótese alguma de alugar o bem e nem tampouco em ceder a quem quer que seja o seu uso, e se o fizer terá o VENDEDOR o
        direito de exigir a restituição do bem.·.
      </p>
    </div>

    <div class="space-y-3">
      <h2 class="font-semibold pb-3">DO PREÇO E DO PAGAMENTO</h2>

      <p>
        <p>
          <span class="font-semibold"> Cláusula 3ª </span> - O COMPRADOR PAGOU 9.000 (NOVE MIL REAIS ) EM FORMA DE ENTRADA. ASSUMINDO O COMPROMISSO DE PAGAR 15 PARCELAS DE R$ 350,00 REAIS, DURANTE O PERÍODO DE 05/08/24 Á 05/10/25.
        </p>
        <p>Incorrerá reajuste do valor da parcela se o índice de inflação (IPCA) acumulado dos últimos 12(doze) meses ultrapassar 10% (dez por cento), ultrapassando esse limite, a parcela será reajustada com o IPCA do último mês.</p>
      </p>

      <p>
        <span class="font-semibold">Parágrafo primeiro:</span> Após o vencimento de qualquer uma das prestações, caso o COMPRADOR (A) não cumpra com o pagamento,
        fica o COMPRADOR sujeito a mora de 0,33% por dia de atraso, e multa de impontualidade de 1% sobre o valor da prestação,
        sendo que o devedor não efetuando o pagamento no prazo de 30 dias fica ciente que após esse período ficará sujeito a
        custas de cartório, honorários de advogado e outras despesas.
      </p>

      <p>
        <span class="font-semibold">Parágrafo segundo:</span> O vendedor poderá vender, ceder ou descontar os créditos acima exposto, em todo ou em parte a
        qualquer instituição financeira e ESC (empresa simples de crédito).
      </p>
    </div>

    <div class="space-y-3">
      <h2 class="font-semibold pb-3">DA CONSERVAÇÃO, DO USO DO BEM E DA GARANTIA</h2>
      <p>
        <span class="font-semibold">Cláusula 4ª</span> - O COMPRADOR declara haver recebido o bem em perfeito estado de conservação e funcionamento, ficando o mesmo
        obrigado em conservar o bem, objeto deste contrato, até o pagamento de todas as parcelas, ficando à suas custas a
        perfeita manutenção e integridade, zelando pelo seu bom funcionamento, sendo defesa a sua alteração de estrutura ou
        funções nem aparência.
      </p>
      <p>
        <span class="font-semibold">Parágrafo Primeiro:</span> O Comprador se comprometerá a fazer revisões periodicamente do veículo, bem com trocas regulares de
        óleo do motor de acordo com as especificações do fabricante. GARANTIA DE 3 MESES DA PARTE DE FORÇA DO MOTOR POR 3 MESES, A PARTIR DA DATA DE HOJE.
      </p>
    </div>

    <div class="space-y-3">
      <h2 class="font-semibold pb-3">DAS DEMAIS RESPONSABILIDADES</h2>
      <p>
        <span class="font-semibold">Cláusula 5ª</span> - Fica o COMPRADOR, a partir da assinatura do contrato responsável tanto na esfera civil e criminal pelo
        veículo objeto do contrato, O COMPRADOR se responsabiliza por quaisquer desastres ou acidentes que o bem venha a sofrer
        e responde pelos prejuízos que forem causados a si e a terceiros. O VENDEDOR não poderá ser responsabilizado, de forma
        alguma pelos atos do COMPRADOR nem tampouco, pelos acidentes causados por atos ou negociações do COMPRADOR, assumindo
        este, toda e qualquer responsabilidade, decorrente de acidente, danos e perdas causados pelo bem.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Primeiro:</span> As responsabilidades no que se dispõem os órgãos de regulamentação de trânsito, em face ao objeto do
        contrato, serão atribuídas diretamente ao COMPRADOR, excetuando o VENDEDOR, ficando o COMPRADOR responsável com o
        pagamento de procuração e demais despesas documentadas para a retirada do bem, em possíveis apreensões.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Segundo:</span> Na esfera criminal o COMPRADOR responderá todos e quaisquer atos incidentes ao objeto do contrato,
        resguardando o VENDEDOR após assinatura deste.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Terceiro:</span> Enquanto não forem pagas todas as prestações referidas, obriga-se o COMPRADOR:
        <ul class="pl-4">
          <li>a) A protegê-lo contra qualquer turbação de terceiros, reservando o vendedor iguais direitos para se;</li>
          <li>b) A sujeitá-los a inspeção do VENDEDOR quando este, bem o entender.</li>
        </ul>
      </p>

      <p>
        <span class="font-semibold">Parágrafo Quarto:</span> Responderá o COMPRADOR (A) ainda pelas despesas que forem feitas pelo vendedor no interesse da defesa
        dos direitos decorrentes deste contrato.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Quinto:</span> Todas as despesas deste contrato correrão por conta do COMPRADOR.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Sexto:</span> Todos os impostos, contribuições fiscais, multas, prêmios de seguro, etc., que pesem sobre o bem, já
        existentes ou que venham a ser exigidos, correrão por conta do COMPRADOR.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Sétimo:</span> O COMPRADOR incorrerá na multa de 2% sobre o valor total do debito no caso de ser o vendedor obrigado
        a recorrer aos meios judiciais, para assegurar os direitos decorrentes deste contrato sem prejuízo da integral execução
        deste.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Oitavo:</span> Enquanto não tiver pago a última prestação o COMPRADOR não pode de modo algum dispor dos bem seus
        pertences e acessórios, nem transferir a outrem os direitos e obrigações decorrentes do contrato de compra e venda. O
        COMPRADOR declara que a reserva de domínio prevista neste contrato abrange todos e quaisquer melhoramentos, que possa
        fazer ao bem comprado.
      </p>
    </div>

    <div class="space-y-3">
      <h2 class="font-semibold pb-3">DO ATRASO E DA RESCISÃO</h2>

      <p>
        <span class="font-semibold">Cláusula 6ª</span> - Em consequência disposto na clausula segunda, e caso falte ao pontual pagamento de uma ou mais prestações
        mencionadas ou em algum evento relacionado a esta clausula parágrafo terceiro ficará o COMPRADOR, desde logo constituído
        em mora e o VENDEDOR com o direito de protestar os títulos vencidos e não pagos, ou requerer a imediata reintegração de
        posse do Bem, (Reintegração que se fará amigavelmente ou de acordo com o Art. 1.210, 1º do novo Código Civil), ou
        executar contra o COMPRADOR todos os títulos referentes ao debito supramencionado.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Primeiro:</span> Em caso de rescisão de contrato por falta de pagamento das parcelas e/ou por desistência do
        comprador fica acordado entre as partes a devolução de 50% (cinquenta por cento) do valor da entrada ao COMPRADOR. A
        devolução que se trata nesse parágrafo fica condicionada a entrega do bem pelo COMPRADOR ao VENDEDOR no prazo máximo da
        terceira parcela consecutiva atrasada.
      </p>

      <p>
        <span class="font-semibold">Parágrafo segundo:</span> O contrato será automaticamente rescindido se: Ocorrer apreensão do veículo por qualquer órgão de
        trânsito sem a imediata comunicação ao VENDEDOR; Inadimplência com os órgãos de fiscalização do Trânsito; Inclusão da
        empresa no cadastro da dívida ativa da União, Estado e ou Município, decorrentes de taxas e impostos incidentes desse
        veículo, a falta de indicação do condutor quando solicitado pelo VENDEDOR, no caso de multas; deixar de informar ao
        VENDEDOR tendo sido pego em infração grave e ou gravíssima junto a qualquer órgão de trânsito; deixar de atualizar
        telefone e ou endereço no caso de mudança; fixar-se com o bem fora deste Estado, por tempo superior a trinta dias
        Por falta de pagamento das parcelas ou por desistência do comprador; deixar de atender o exposto na clausula quinta
        parágrafo segundo alínea b.
      </p>

      <p>
        <span class="font-semibold">Parágrafo Terceiro:</span> Verificada a rescisão da DECLARAÇ O E CONTRATO DE COMPRA E VENDA efetivado diretamente com o
        vendedor por culpa do COMPRADOR ficará este responsável pelo pagamento das despesas a que o vendedor foi obrigado na
        defesa de seus direitos sendo que o deposito a que proceder ao vendedor com o preliminar da ação de reintegração de
        posse e referida na clausula anterior, não poderá ser levantado pelo COMPRADOR antes que ele pague à custa a que for
        condenado.
      </p>
    </div>

    <div class="space-y-3">
      <h2 class="font-semibold pb-3">DA TRANSFERÊNCIA DA PROPRIEDADE</h2>

      <p>
        <span class="font-semibold">Cláusula 7 ª</span> O COMPRADOR terá o prazo máximo de trinta dias após o pagamento da última parcela, quando as mesmas
        estiverem devidamente quitadas, para receber junto à compradora o documento de transferência, após esse prazo a
        VENDEDORA se ausenta de qualquer ônus que venha acontecer com o referido processo de transferência (Certificado de
        Registro de Veículo) que só será entregue devidamente preenchida e assinada com os dados do COMPRADOR.
      </p>

      <p>
        <span class="font-semibold">Parágrafo primeiro:</span> O preço referido na clausula terceira, não inclui os custos inerentes à formalização da transmissão
        da propriedade.
      </p>
    </div>

    <div class="space-y-3">
      <h2 class="font-semibold pb-3">DAS DISPOSIÇÕES FINAIS</h2>

      <p>
        <span class="font-semibold">Cláusula 8ª</span> – O presente termo será registrado no Cartório de Registros Títulos e Documentos do domicilio do COMPRADOR
        (Art. 522 do novo código civil).
      </p>

      <p>
        <span class="font-semibold">Parágrafo Primeiro:</span> O presente contrato passa a vigorar entre as partes a partir da assinatura do mesmo, as quais elegem
        o foro da cidade de Pentecoste, para dirimirem quaisquer dúvidas provenientes da execução e cumprimento do mesmo. Os
        herdeiros ou sucessores das partes contratantes se obrigam desde já ao inteiro teor deste contrato.
      </p>

      <p>
        E por estarem de pleno acordo, as partes assinam o presente CONTRATO DE COMPRA E VENDA DE RESERVA DE Domínio 2(duas)
        vias de igual teor, juntamente com 1 (uma) testemunha.
      </p>
    </div>

    <div class="py-10">
      <p class="font-semibold">PENTECOSTE, 25 de junho de 2024.</p>
    </div>

    <div class="grid grid-cols-2 gap-4 gap-y-20 py-20">
      <div>
        <div class="w-full border-b border-gray-700"></div>
        <p class="text-center">VENDEDOR</p>
      </div>

      <div>
        <div class="w-full border-b border-gray-700"></div>
        <p class="text-center">COMPRADOR</p>
      </div>

      <div>
        <div class="w-full border-b border-gray-700"></div>
        <p>TESTEMUNHA:</p>
        <p>CPF:</p>
      </div>
    </div>
  </div>
