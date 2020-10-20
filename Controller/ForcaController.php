<?php

require_once './src/View.php';

class ForcaController
{
    public function perguntaPalavra()
    {
        echo View::html('./View/forca/inicio.html', [
            '%TITLE%' => 'Jogo da Forca',

        ]);
    }

    public function recebePalavra()
    {
        $_SESSION['palavra'] = strtoupper($_POST['palavra']);
        $this->clonaPalavra();
        redirect('?p=forca&op=retornaHtml');
    }

    private function clonaPalavra()
    {
        $tamanho = strlen($_SESSION['palavra']);
        $_SESSION['limite'] = $_SESSION['restante'] = round($tamanho * 1.5);

        for ($i = 0; $i < strlen($_SESSION['palavra']); $i++) {
            $_SESSION['clone'][] =  '___';
            $_SESSION['cloneArr'][] = substr($_SESSION['palavra'], $i, 1);
        }

        return $_SESSION['cloneArr'];
    }

    public function recebeLetra()
    {
        $this->buscaLetra(strtoupper($_POST['letra']));
        redirect('?p=forca&op=retornaHtml');
    }

    public function checkFim()
    {
        // dd(array_search('___', $_SESSION['clone']));
        if (array_search('___', $_SESSION['clone']) === false) {
            swal('Fim', 'Parabéns você acertou todas as letras antes de terminar suas chances', 'success');
        }
    }

    public function buscaLetra($busco)
    {
        $_SESSION['cloneArr'] = $_SESSION['cloneArr'] ?? $this->clonaPalavra();
        $_SESSION['letrasInformadas'][] = $busco;

        $tem = false;

        for ($i = 0; $i < sizeof($_SESSION['cloneArr']); $i++) {
            $posicao = array_search($busco, $_SESSION['cloneArr']);

            if ($posicao !== false) {
                $tem = true;
                $_SESSION['cloneArr'][$posicao] = '';
                $_SESSION['clone'][$posicao] = $busco;
            }
        }

        if (!$tem) {
            $_SESSION['restante']--;

            if ($_SESSION['restante'] == 0) {
                alert('Que pena, você não foi capaz de identificar a palavra secreta. A palavra era ' . $_SESSION['palavra']);

                redirect('?p=forca&op=destroy');
            }
        }
        // dd($_SESSION['clone']);

    }

    public function retornaHtml()
    {
        echo View::html('./View/forca/forca.html', [
            '%QTD%' => $_SESSION["restante"],
            '%PREENCHIDO%' => implode(' ', $_SESSION['clone'] ?? []),
            '%LETRASINFORMADAS%' => implode(' ', $_SESSION['letrasInformadas'] ?? [])
        ]);
        $this->checkFim();
    }

    public function destroy()
    {
        session_destroy();
        redirect('?p=forca&op=perguntaPalavra');
    }
}
