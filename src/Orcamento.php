<?php

namespace Alura\DesignPattern;

use Alura\DesignPattern\EstadosOrcamento\EmAprovacao;
use Alura\DesignPattern\EstadosOrcamento\EstadoOrcamento;

Class Orcamento implements Orcavel
{
    private array $itens;
    public EstadoOrcamento $estadoAtual;
    public float $valor;

    public function __construct()
    {
        $this->estadoAtual = new EmAprovacao();
        $this->itens = [];
    }

    public function aplicaDescontoExtra()
    {
        $this->valor -= $this->estadoAtual->calculaDescontoExtra($this);
    }

    public function aprova()
    {
        $this->estadoAtual->aprova($this);
    }

    public function reprova()
    {
        $this->estadoAtual->reprova($this);
    }

    public function finaliza()
    {
        $this->estadoAtual->finaliza($this);
    }

    public function addItem(Orcavel $item): void
    {
        $this->itens[] = $item;
    }

    public function valor(): float
    {
        $this->valor = array_reduce(
            $this->itens,
            fn (float $valorAcumulado, Orcavel $item) => $item->valor() + $valorAcumulado,
            0
        );

        sleep(1);
        return $this->valor;
    }
}