<?php

namespace App\Infrastructure\Repository;

use App\Core\Domain\Model\Notifikasi;
use App\Core\Domain\Model\NotifikasiId;
use App\Core\Domain\Repository\NotifikasiRepository;
use Illuminate\Support\Facades\DB;
use DateTime;

class SqlServerNotifikasiRepository implements NotifikasiRepository
{
    public function byId(NotifikasiId $notifikasiId) : ?Notifikasi {
        $sql = "SELECT notifikasi_id, mahasiswa_id, jenis, pesan, dibaca, created_at
                FROM notifikasi
                WHERE id = :id";

        $notifikasi = DB::selectOne($sql, [
            'id' => $notifikasiId->id()
        ]);

        if ($notifikasi) {
            return new Notifikasi( 
                $notifikasiId,
                new MahasiswaId($notifikasi->mahasiswa_id),
                $notifikasi->janis,
                $notifikasi->pesan,
                $notifikasi->dibaca == 'Y' ? true : false,
                new DateTime($notifikasi->created_at)
            );
        }
        return null;
    }

    public function insert(Notifikasi $notifikasi): bool {
        $values = [
          'id' => $notifikasi->getId()->id(),
          'mahasiswa_id' => $notifikasi->getMahasiswaId()->id(),
          'jenis' => $notifikasi->getJenis(),
          'pesan' => $notifikasi->getPesan(),
          'dibaca' => $notifikasi->getDibaca() ? 'Y' : 'N',
          'created_at' => $notifikasi->getCreatedAt()->format('y-m-d'),
        ];
    
        return DB::table('notifikasi')->insert($values);
    }
    
    public function update(Notifikasi $notifikasi): bool {
        $values = [
            'id' => $notifikasi->getId()->id(),
            'mahasiswa_id' => $notifikasi->getMahasiswaId()->id(),
            'jenis' => $notifikasi->getJenis(),
            'pesan' => $notifikasi->getPesan(),
            'dibaca' => $notifikasi->getDiterima() ? 'Y' : 'N',
        ];
    
        $affected = DB::table('notifikasi')->where('id', $notifikasi->getId()->id())->update($values);

        Redis::expire('user:notifikasi'.$values['mahasiswa_id'], 60*5);
    
        return $affected === 1;
    }
}
