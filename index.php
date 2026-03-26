<?php
$showResult = isset($_POST['din']) && is_numeric($_POST['din']) && $_POST['din'] > 0;
$real = $showResult ? floatval($_POST['din']) : 0;
$dolar = 0;
$cotacao = 0;
if ($showResult) {
  $inicio = date("m-d-Y", strtotime("-7 days"));
  $fim = date("m-d-Y");
  $url = 'https://olinda.bcb.gov.br/olinda/servico/PTAX/versao/v1/odata/CotacaoDolarPeriodo(dataInicial=@dataInicial,dataFinalCotacao=@dataFinalCotacao)?@dataInicial=\''.$inicio.'\'&@dataFinalCotacao=\''.$fim.'\'&$top=1&$orderby=dataHoraCotacao%20desc&$format=json&$select=cotacaoCompra,dataHoraCotacao';
  $dados = json_decode(file_get_contents($url), true);
  $cotacao = $dados["value"][0]["cotacaoCompra"];
  $dolar = $real / $cotacao;
}
$padrao = numfmt_create("pt_BR", NumberFormatter::CURRENCY);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo $showResult ? 'Resultado — ' : ''; ?>Conversor de Moedas</title>
  <link rel="stylesheet" href="style.css">
  <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
</head>
<body>
  <main>
    <div class="card">
      <div class="header">
        <span class="flag">🇧🇷</span>
        <div class="arrow">→</div>
        <span class="flag">🇺🇸</span>
      </div>
      <h1>Conversor de Moedas</h1>
      <p class="subtitle">Real Brasileiro → Dólar Americano</p>
      <form method="POST" action="">
        <label for="din">Quanto R$ você tem?</label>
        <div class="input-wrap">
          <span class="prefix">R$</span>
          <input type="number" name="din" id="din" placeholder="0,00" step="0.01" min="0" required autocomplete="off" value="<?php echo htmlspecialchars($_POST['din'] ?? ''); ?>">
        </div>
        <button type="submit">Converter agora</button>
        <?php if ($showResult): ?>
          <div class="resultado">
            <div class="linha">
              <span class="label">Você tem</span>
              <span class="valor brl"><?php echo numfmt_format_currency($padrao, $real, "BRL"); ?></span>
            </div>
            <div class="divisor">equivale a</div>
            <div class="linha destaque">
              <span class="label">Em dólar</span>
              <span class="valor usd"><?php echo numfmt_format_currency($padrao, $dolar, "USD"); ?></span>
            </div>
            <p class="cotacao-info">Cotação usada: R$ <?php echo number_format($cotacao, 4, ',', '.'); ?> por US$1,00</p>
          </div>
          <button type="reset">Limpar resultado</button>
        <?php endif; ?>
      </form>
    </div>
  </main>
</body>
</html>
