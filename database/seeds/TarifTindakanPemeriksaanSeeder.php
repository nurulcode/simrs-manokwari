<?php

use App\Models\Tarif;
use Illuminate\Database\Seeder;
use App\Models\Master\TindakanPemeriksaan;
use App\Enums\JenisTarif;

class TarifTindakanPemeriksaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file = new SplFileObject(
            database_path('seeds/data/tarif/tarif_0_tindakan_pemeriksaan.csv')
        );

        $this->seed($file, 278);

        $file = new SplFileObject(
            database_path('seeds/data/tarif/tarif_1_tindakan_pemeriksaan.csv')
        );

        $this->seed($file, 578);
    }

    public function seed($file, $count)
    {
        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY);

        $cmdOutput   = $this->command->getOutput();

        $progressBar = $cmdOutput->createProgressBar($count);

        $progressBar->start();

        while ($row = $file->fgetcsv()) {
            [$id, $kelas, $sarana, $pelayanan, $bhp] = $row;

            Tarif::updateOrCreate([
                'tarifable_type' => TindakanPemeriksaan::class,
                'tarifable_id'   => $id,
            ], [
                'tarif'          => [
                    $kelas => [
                        JenisTarif::SARANA    => $sarana,
                        JenisTarif::PELAYANAN => $pelayanan,
                        JenisTarif::BHP       => $bhp
                    ]
                ]
            ]);

            $progressBar->advance(1);
        }

        $progressBar->finish();

        $cmdOutput->newLine(2);
    }
}
