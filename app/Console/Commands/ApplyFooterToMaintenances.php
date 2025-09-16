<?php

namespace App\Console\Commands;

use App\Models\Maintenance;
use App\Services\MaintenanceService;
use Illuminate\Console\Command;

class ApplyFooterToMaintenances extends Command
{
    protected $signature = 'maintenances:apply-footer {id?}';
    protected $description = 'Aplica rodapé às imagens das manutenções já existentes. Se passar {id}, aplica apenas nessa manutenção.';

    public function handle(MaintenanceService $service)
    {
        $id = $this->argument('id');

        $query = Maintenance::query()->whereNotNull('photo_path');

        if ($id) {
            $query->where('id', $id);
        }

        $maintenances = $query->get();

        if ($maintenances->isEmpty()) {
            $this->warn('Nenhuma manutenção encontrada.');
        }

        foreach ($maintenances as $maintenance) {
            $filePath = storage_path('app/public/' . $maintenance->getRawOriginal('photo_path'));

            if (! file_exists($filePath)) {
                $this->warn("Arquivo não encontrado: {$filePath}");
                continue;
            }

            $this->info("Processando manutenção ID {$maintenance->id}...");

            $service->setMaintenance($maintenance);
            $service->addFooterToImage($filePath, $maintenance->toArray());

            $this->info("Rodapé aplicado em: {$filePath}");
        }

        $this->info('Processo concluído.');
    }
}
