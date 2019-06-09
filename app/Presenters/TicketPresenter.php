<?php

namespace App\Presenters;

use Laracasts\Presenter\Presenter;

class TicketPresenter extends Presenter
{
    const STATUS_PENDING = 1;
    const STATUS_WAITING_USER = 2;
    const STATUS_WAITING_STAFF = 3;
    const STATUS_RESOLVED = 4;

    public function statusLabel()
    {
        $statuses = [
            self::STATUS_PENDING => [
                'name' => 'Pendente',
                'color' => 'warning'
            ],
            self::STATUS_WAITING_USER => [
                'name' => 'Aguardando jogador',
                'color' => 'info'
            ],
            self::STATUS_WAITING_STAFF => [
                'name' => 'Aguardando staff',
                'color' => 'danger'
            ],
            self::STATUS_RESOLVED => [
                'name' => 'Resolvido',
                'color' => 'success'
            ],
        ];

        if (array_key_exists($this->status_id, $statuses)) {
            return $statuses[$this->status_id];
        }
    }
}
