<?php
$fakerTypes = include 'fakerTypes.php';
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Gerador de INSERTs</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <form action="fakerGenerator.php" method="post">
        <h1>Gerador de INSERTs</h1>

        <div class="campo">
            <input type="text" name="tabela" placeholder="Nome da Tabela" required>
        </div>

        <div class="campo">
            <input type="number" name="quantidade" placeholder="Quantidade de registros" required min="1">
        </div>

        <h3>Campos</h3>

        <div id="campos-wrapper" class="campos-scroll">
            <div class="campo">
                <input type="text" name="colunas[]" placeholder="Nome da coluna">
                <select name="tipos[]" onchange="mostrarRange(this)">
                    <option value="">Tipo...</option>
                    <?php foreach ($fakerTypes as $key => $item): ?>
                        <option value="<?= $key ?>"><?= $item['label'] ?></option>
                    <?php endforeach; ?>
                </select>
                <div class="range-wrapper" style="display: none;">
                    <input type="number" name="range_min[]" placeholder="Mín" class="range-input">
                    <input type="number" name="range_max[]" placeholder="Máx" class="range-input">
                </div>
                <span class="btn-remove" onclick="removerCampo(this)">✖</span>
            </div>
        </div>

        <button type="button" class="btn-add" onclick="adicionarCampo()">+ Adicionar campo</button>

        <button type="submit">Gerar arquivo</button>
    </form>

    <script>
        const tipos = `<?php foreach ($fakerTypes as $key => $item) {
            echo "<option value='$key'>$item[label]</option>";
        } ?>`;

        function adicionarCampo() {
            const wrapper = document.getElementById('campos-wrapper');
            const div = document.createElement('div');
            div.className = 'campo';
            div.innerHTML = `
        <input type="text" name="colunas[]" placeholder="Nome da coluna">
        <select name="tipos[]" onchange="mostrarRange(this)">
            <option value="">Tipo...</option>
            ${tipos}
        </select>
        <div class="range-wrapper" style="display: none;">
            <input type="number" name="range_min[]" placeholder="Mín" class="range-input">
            <input type="number" name="range_max[]" placeholder="Máx" class="range-input">
        </div>
        <span class="btn-remove" onclick="removerCampo(this)">✖</span>
    `;
            wrapper.appendChild(div);
        }

        function mostrarRange(selectElement) {
            const rangeWrapper = selectElement.parentElement.querySelector('.range-wrapper');
            if (selectElement.value === 'numero') {
                rangeWrapper.style.display = 'inline-flex';
            } else {
                rangeWrapper.style.display = 'none';
                const inputs = rangeWrapper.querySelectorAll('input');
                inputs.forEach(input => input.value = '');
            }
        }

        function removerCampo(elemento) {
            const div = elemento.parentElement;
            div.remove();
        }
    </script>
</body>

</html>