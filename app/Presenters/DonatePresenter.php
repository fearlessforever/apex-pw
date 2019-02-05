<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class DonatePresenter extends Presenter
{
    public function status()
    {
        $labels = [
            'initiated' => [
                'label' => 'Pendente',
                'color' => 'warning'
            ],
            1 => [
                'label' => 'Aguardando pagamento',
                'color' => 'warning'
            ],
            2 => [
                'label' => 'Em análise',
                'color' => 'warning'
            ],
            3 => [
                'label' => 'Aprovado',
                'color' => 'success'
            ],
            4 => [
                'label' => 'Aprovado',
                'color' => 'successs'
            ],
            5 => [
                'label' => 'Em disputa',
                'color' => 'danger',
            ],
            6 => [
                'label' => 'Devolvida',
                'color' => 'danger'
            ],
            7 => [
                'label' => 'Cancelada',
                'color' => 'danger',
            ],
            8 => [
                'label' => 'Debitado',
                'color' => 'danger',
            ],
            9 => [
                'label' => 'Retenção temporária',
                'color' => 'danger',
            ],
            'pending' => [
                'label' => 'Aguardando pagamento',
                'color' => 'warning',
            ],
            'approved' => [
                'label' => 'Aprovado',
                'color' => 'success',
            ],
            'in_process' => [
                'label' => 'Em revisão',
                'color' => 'warning',
            ],
            'in_mediation' => [
                'label' => 'Disputa',
                'color' => 'danger',
            ],
            'rejected' => [
                'label' => 'Rejeitado',
                'color' => 'danger',
            ],
            'cancelled' => [
                'label' => 'Cancelado',
                'color' => 'danger',
            ],
            'refunded' => [
                'label' => 'Devolvido',
                'color' => 'danger',
            ],
            'charged_back' => [
                'label' => 'Chargeback',
                'color' => 'danger'
            ],
        ];

        if (array_key_exists($this->transaction_status, $labels)) {
            return $labels[$this->transaction_status];
        }
    }
}
