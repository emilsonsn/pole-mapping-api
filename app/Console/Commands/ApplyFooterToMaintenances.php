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
            $publicPath = base_path('public_html/storage/' . $maintenance->getRawOriginal('photo_path'));

            if (! file_exists($filePath)) {
                $this->warn("Arquivo não encontrado: {$filePath}");
                continue;
            }

            $this->info("Processando manutenção ID {$maintenance->id}...");

            $service->setMaintenance($maintenance);
            $service->addFooterToImage($filePath, $maintenance->toArray());

            // garante que a pasta existe em public_html
            if (! file_exists(dirname($publicPath))) {
                mkdir(dirname($publicPath), 0755, true);
            }

            // copia a versão processada para o public_html
            copy($filePath, $publicPath);

            $this->info("Rodapé aplicado em: {$filePath}");
            $this->info("Arquivo atualizado em: {$publicPath}");
        }


        $this->info('Processo concluído.');
    }
}
